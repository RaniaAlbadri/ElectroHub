
@extends('layouts.electrohub-account')

@section('title', 'My Profile')

@section('content')

    <div class="eh-crumb">
        <a href="{{ route('home') }}">Home</a>
        / My Account
    </div>

    <div class="eh-heading">
        <h1>My Profile</h1>

        <p>
            Manage your personal information,
            account security, and shopping experience.
        </p>
    </div>

    <div class="eh-grid">

        <!-- Personal Information -->
        <section class="eh-card">

            <h2>Personal Information</h2>

            <p class="eh-subtitle">
                Update your name and email address.
            </p>

            @if (session('status') === 'profile-updated')
                <div class="eh-alert">
                    Your profile was updated successfully!
                </div>
            @endif

            <form method="POST"
                  action="{{ route('profile.update') }}">

                @csrf
                @method('PATCH')

                <div class="eh-field">
                    <label for="name">Full Name</label>

                    <input
                        class="eh-input"
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        autocomplete="name"
                        maxlength="255"
                        required
                    >

                    @error('name')
                        <p class="eh-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="eh-field">
                    <label for="email">Email Address</label>

                    <input
                        class="eh-input"
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        autocomplete="email"
                        maxlength="255"
                        required
                    >

                    @error('email')
                        <p class="eh-error">{{ $message }}</p>
                    @enderror
                </div>

                <button class="eh-btn" type="submit">
                    Save Changes
                </button>

            </form>

            <div style="margin-top:30px;padding-top:22px;border-top:1px solid #e5ebf4">
                <h2 style="font-size:15px">Account Information</h2>

                <div class="eh-summary">
                    <span class="eh-muted">Member Name</span>
                    <strong>{{ $user->name }}</strong>
                </div>

                <div class="eh-summary">
                    <span class="eh-muted">Joined</span>
                    <strong>
                        {{ $user->created_at?->format('M d, Y') }}
                    </strong>
                </div>
            </div>

        </section>

        <!-- Password -->
        <section class="eh-card">

            <h2>Account Security</h2>

            <p class="eh-subtitle">
                Change your password to keep
                your account secure.
            </p>

            @if (session('status') === 'password-updated')
                <div class="eh-alert">
                    Password updated successfully!
                </div>
            @endif

            <form method="POST"
                  action="{{ route('password.update') }}">

                @csrf
                @method('PUT')

                <div class="eh-field">
                    <label for="current_password">
                        Current Password
                    </label>

                    <input
                        class="eh-input"
                        type="password"
                        id="current_password"
                        name="current_password"
                        autocomplete="current-password"
                        required
                    >

                    @error('current_password', 'updatePassword')
                        <p class="eh-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="eh-field">
                    <label for="password">
                        New Password
                    </label>

                    <input
                        class="eh-input"
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="new-password"
                        required
                    >

                    @error('password', 'updatePassword')
                        <p class="eh-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="eh-field">
                    <label for="password_confirmation">
                        Confirm New Password
                    </label>

                    <input
                        class="eh-input"
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <button class="eh-btn" type="submit">
                    Update Password
                </button>

            </form>

            <div style="margin-top:32px;padding-top:22px;border-top:1px solid #e5ebf4">
                <h2 style="font-size:15px">Shopping History</h2>

                <p class="eh-subtitle">
                    Review your previously placed orders
                    and their current status.
                </p>

                <a href="{{ route('orders.index') }}"
                   class="eh-btn eh-btn-secondary">
                    View My Orders →
                </a>
            </div>

        </section>

    </div>

    <!-- Delete Account -->
    <section class="eh-card"
             style="margin-top:22px;border-color:#f2dce0">

        <h2>Delete Account</h2>

        <p class="eh-subtitle">
            Permanently delete your account and
            its personal profile information.
            This action cannot be undone.
            Historical demo orders may remain
            in the store database.
        </p>

        <form method="POST"
              action="{{ route('profile.destroy') }}"
              onsubmit="return confirm('Permanently delete your account? This cannot be undone.');">

            @csrf
            @method('DELETE')

            <div class="eh-field" style="max-width:400px">
                <label for="delete_password">
                    Confirm Your Password
                </label>

                <input
                    class="eh-input"
                    id="delete_password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                >

                @error('password', 'userDeletion')
                    <p class="eh-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="eh-btn eh-btn-danger">
                Delete My Account
            </button>
        </form>

    </section>

@endsection
