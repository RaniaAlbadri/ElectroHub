
@extends('layouts.electrohub-auth')

@section('title', 'Confirm Password')

@section('visual_title', 'Your Security Comes First.')

@section('visual_text', 'Keep your account protected with secure access to your ElectroHub profile and shopping information.')

@section('content')

    <h1 class="eh-auth-title">Confirm Password</h1>

    <p class="eh-auth-description">
        This is a secure area of ElectroHub.

        Please confirm your password
        before continuing.
    </p>

    <form method="POST"
          action="{{ route('password.confirm') }}">

        @csrf

        <div class="eh-field">
            <label for="password">
                Current Password
            </label>

            <div class="eh-input-wrap">
                <input
                    class="eh-input"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                    autofocus
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

        <button type="submit"
                class="eh-primary-button">
            Confirm Password →
        </button>

    </form>

    <p class="eh-auth-bottom">
        <a href="{{ route('profile.edit') }}"
           class="eh-text-link">
            Back to My Profile
        </a>
    </p>

@endsection
