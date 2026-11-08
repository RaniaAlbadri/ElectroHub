
@extends('layouts.electrohub-auth')

@section('title', 'Sign In')

@section('visual_title', 'Your Tech Journey Starts Here.')

@section('visual_text', 'Sign in to discover your favorite gadgets, manage your orders, and enjoy a smarter shopping experience.')

@section('content')

    <h1 class="eh-auth-title">Welcome Back!</h1>

    <p class="eh-auth-description">
        Sign in to your ElectroHub account
        to continue shopping.
    </p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="eh-field">
            <label for="email">Email Address</label>

            <input
                class="eh-input"
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="name@example.com"
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

        <!-- Password -->
        <div class="eh-field">
            <label for="password">Password</label>

            <div class="eh-input-wrap">
                <input
                    class="eh-input"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
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

        <!-- Remember / Forgot Password -->
        <div class="eh-form-options">

            <label class="eh-remember">
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >
                Remember me
            </label>

            <a href="{{ route('password.request') }}"
               class="eh-text-link">
                Forgot Password?
            </a>

        </div>

        <button type="submit"
                class="eh-primary-button">
            Sign In →
        </button>

    </form>

    <p class="eh-auth-bottom">
        Don't have an account?

        <a href="{{ route('register') }}"
           class="eh-text-link">
            Create Account
        </a>
    </p>

@endsection
