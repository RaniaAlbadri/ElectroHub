
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_activity_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->string('admin_name', 150);
            $table->string('admin_email', 191);

            $table->string('section', 60)->index();
            $table->string('event', 100);
            $table->string('route_name', 191);

            $table->string('target', 191)->nullable();
            $table->unsignedInteger('selected_count')->nullable();

            $table->string('http_method', 10);
            $table->timestamp('created_at')->useCurrent();

            $table->index(['section', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_activity_logs');
    }
};
