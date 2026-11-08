
@extends('layouts.electrohub-auth')

@section('title', 'Reset Password')

@section('visual_title', 'A Fresh Start for Your Account.')

@section('visual_text', 'Choose a new password and get back to exploring the latest tech accessories at ElectroHub.')

@section('content')

    <h1 class="eh-auth-title">Reset Password</h1>

    <p class="eh-auth-description">
        Create a new password to regain
        access to your ElectroHub account.
    </p>

    <form method="POST"
          action="{{ route('password.store') }}">

        @csrf

        <!-- Password Reset Token -->
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >

        <!-- Email -->
        <div class="eh-field">
            <label for="email">Email Address</label>

            <input
                class="eh-input"
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                autocomplete="username"
                required
                autofocus
            >

            @error('email')
                <p class="eh-field-error">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="eh-field">
            <label for="password">New Password</label>

            <div class="eh-input-wrap">
                <input
                    class="eh-input"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter new password"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >

                <button
                    type="button"
                    class="eh-password-toggle"
                    data-password-toggle="password"
                    aria-controls="password"
                    aria-pressed="false">
                    Show
                </button>
            </div>

            @error('password')
                <p class="eh-field-error">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="eh-field">
            <label for="password_confirmation">
                Confirm New Password
            </label>

            <div class="eh-input-wrap">
                <input
                    class="eh-input"
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repeat new password"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >

                <button
                    type="button"
                    class="eh-password-toggle"
                    data-password-toggle="password_confirmation"
                    aria-controls="password_confirmation"
                    aria-pressed="false">
                    Show
                </button>
            </div>
        </div>

        <button type="submit"
                class="eh-primary-button">
            Reset Password →
        </button>

    </form>

    <p class="eh-auth-bottom">
        <a href="{{ route('login') }}"
           class="eh-text-link">
            Back to Sign In
        </a>
    </p>

@endsection
