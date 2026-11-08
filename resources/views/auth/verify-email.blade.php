
@extends('layouts.electrohub-auth')

@section('title', 'Verify Email')

@section('visual_title', 'One More Step to Get Connected.')

@section('visual_text', 'Verify your email address to help secure your ElectroHub account and enjoy your shopping experience.')

@section('content')

    <h1 class="eh-auth-title">Verify Your Email</h1>

    <p class="eh-auth-description">
        Thanks for signing up!

        Please verify your email address by
        clicking the link we sent to your inbox.
    </p>

    @auth
        <div class="eh-status">
            Email address:
            <strong>{{ auth()->user()->email }}</strong>
        </div>
    @endauth

    @if(session('status') === 'verification-link-sent')

        <div class="eh-status" role="status">
            A new verification link has been sent
            to your email address.
        </div>

    @endif

    <form method="POST"
          action="{{ route('verification.send') }}">

        @csrf

        <button type="submit"
                class="eh-primary-button">
            Resend Verification Email →
        </button>

    </form>

    <form method="POST"
          action="{{ route('logout') }}"
          style="margin-top:14px">

        @csrf

        <button type="submit"
                class="eh-secondary-button">
            Log Out
        </button>

    </form>

    <p class="eh-auth-bottom">
        Didn't receive an email?
        Check your spam folder or resend
        the verification link.
    </p>

@endsection
