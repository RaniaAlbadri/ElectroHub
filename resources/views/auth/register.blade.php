
@extends('layouts.electrohub-auth')

@section('title', 'Create Account')

@section('visual_title', 'Discover More. Experience Better.')

@section('visual_text', 'Create your ElectroHub account to explore smart gadgets and keep track of your favorite tech essentials.')

@section('content')

    <h1 class="eh-auth-title">Create Account</h1>

    <p class="eh-auth-description">
        Join ElectroHub and start exploring
        modern tech accessories.
    </p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="eh-field">
            <label for="name">Full Name</label>

            <input
                class="eh-input"
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Enter your full name"
                autocomplete="name"
                maxlength="255"
                required
                autofocus
            >

            @error('name')
                <p class="eh-field-error">
                    {{ $message }}
                </p>
            @enderror
        </div>

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
                autocomplete="email"
                maxlength="255"
                required
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
                    placeholder="Minimum 8 characters"
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
                Confirm Password
            </label>

            <div class="eh-input-wrap">
                <input
                    class="eh-input"
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Repeat your password"
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
            Create Account →
        </button>

    </form>

    <p class="eh-auth-bottom">
        Already have an account?

        <a href="{{ route('login') }}"
           class="eh-text-link">
            Sign In
        </a>
    </p>

@endsection
