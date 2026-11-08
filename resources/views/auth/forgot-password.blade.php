
@extends('layouts.electrohub-auth')

@section('title', 'Forgot Password')

@section('visual_title', 'Stay Connected to Your Tech.')

@section('visual_text', 'Forgot your password? We will help you securely recover access to your ElectroHub account.')

@section('content')

    <h1 class="eh-auth-title">Forgot Password?</h1>

    <p class="eh-auth-description">
        No worries! Enter your registered
        email address and we'll send you
        a password reset link.
    </p>

    <form method="POST"
          action="{{ route('password.email') }}">

        @csrf

        <div class="eh-field">
            <label for="email">Email Address</label>

            <input
                class="eh-input"
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                placeholder="name@example.com"
                autocomplete="email"
                required
                autofocus
            >

            @error('email')
                <p class="eh-field-error">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit"
                class="eh-primary-button">
            Send Reset Link →
        </button>

    </form>

    <p class="eh-auth-bottom">
        Remember your password?

        <a href="{{ route('login') }}"
           class="eh-text-link">
            Back to Sign In
        </a>
    </p>

@endsection
