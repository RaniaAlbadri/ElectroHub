<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RecordAdminActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only record requests that can change data.
        if (!in_array($request->method(), [
            'POST',
            'PUT',
            'PATCH',
            'DELETE',
        ], true)) {
            return $response;
        }

        // Ignore failed HTTP responses.
        if ($response->getStatusCode() < 200 ||
            $response->getStatusCode() >= 400) {
            return $response;
        }

        // Do not record requests that returned validation or
        // application errors through the session.
        if ($request->hasSession()) {
            $session = $request->session();

            if (
                $session->has('errors') ||
                $session->has('error')
            ) {
                return $response;
            }
        }

        $admin = $request->user();
        $route = $request->route();

        if (!$admin || !$route) {
            return $response;
        }

        $routeName = $route->getName();

        if (!$routeName || !str_starts_with($routeName, 'admin.')) {
            return $response;
        }

        $parts = explode('.', $routeName);

        $section = $parts[1] ?? 'general';
        $operation = end($parts);

        $labels = [
            'store'       => 'Created',
            'update'      => 'Updated',
            'destroy'     => 'Deleted',
            'bulk-delete' => 'Bulk Delete',
            'promote'     => 'Granted Admin Access',
            'revoke'      => 'Revoked Admin Access',
            'status'      => 'Changed Status',
            'approve'     => 'Approved',
            'cancel'      => 'Cancelled',
        ];

        $event = $labels[$operation]
            ?? ucwords(str_replace(['-', '_'], ' ', $operation));

        $target = null;

        // Identify a resource from route model binding.
        foreach (['product', 'category', 'brand', 'order', 'user'] as $key) {
            $value = $route->parameter($key);

            if (!$value) {
                continue;
            }

            if ($value instanceof Model) {
                $attributes = $value->getAttributes();

                $label = $attributes['name']
                    ?? $attributes['order_number']
                    ?? $attributes['email']
                    ?? ucfirst($key);

                $target = mb_substr((string) $label, 0, 150)
                    . ' (#' . $value->getKey() . ')';
            } else {
                $target = ucfirst($key) . ' #' . (string) $value;
            }

            break;
        }

        // For newly created products, categories or brands.
        if ($target === null && $operation === 'store') {
            $name = $request->input('name');

            if (is_string($name) && trim($name) !== '') {
                $target = mb_substr(trim($name), 0, 191);
            }
        }

        // Record how many records were selected for a bulk request.
        $selectedCount = null;

        if ($operation === 'bulk-delete') {
            $ids = $request->input('ids', []);

            if (is_array($ids)) {
                $selectedCount = count($ids);
            }
        }

        try {
            DB::table('admin_activity_logs')->insert([
                'admin_id'      => $admin->id,
                'admin_name'    => mb_substr($admin->name, 0, 150),
                'admin_email'   => mb_substr($admin->email, 0, 191),
                'section'       => mb_substr($section, 0, 60),
                'event'         => mb_substr($event, 0, 100),
                'route_name'    => mb_substr($routeName, 0, 191),
                'target'        => $target,
                'selected_count'=> $selectedCount,
                'http_method'   => $request->method(),
                'created_at'    => now(),
            ]);
        } catch (\Throwable $exception) {
            report($exception);
        }

        return $response;
    }
}
