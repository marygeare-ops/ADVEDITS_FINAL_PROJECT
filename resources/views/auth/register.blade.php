@extends('layouts.guest')

@section('content')

<style>
    .auth-wrapper {
        min-height: calc(100vh - 76px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
    }

    .auth-card {
        width: 100%;
        max-width: 480px;
        background: #fff;
        padding: 42px;
        border-radius: 14px;
        box-shadow: 0 8px 30px rgba(48, 37, 30, 0.08);
        border: 1px solid #e8ded1;
    }

    .auth-card h1 {
        font-family: Georgia, serif;
        color: #30251E;
        text-align: center;
        margin-bottom: 10px;
    }

    .auth-subtitle {
        text-align: center;
        color: #8E7662;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .auth-group {
        margin-bottom: 20px;
    }

    .auth-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #49372B;
        font-size: 14px;
    }

    .auth-group input {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #d8cabb;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
    }

    .auth-group input:focus {
        border-color: #C5A477;
        box-shadow: 0 0 0 3px rgba(197, 164, 119, 0.15);
    }

    .auth-button {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 7px;
        background: #493528;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        font-size: 15px;
    }

    .auth-button:hover {
        background: #30231B;
    }

    .auth-footer {
        text-align: center;
        margin-top: 24px;
        color: #8E7662;
        font-size: 14px;
    }

    .auth-footer a {
        color: #9A7549;
        font-weight: 600;
        text-decoration: none;
    }

    .auth-error {
        color: #b42318;
        font-size: 13px;
        margin-top: 6px;
    }

    .auth-alert {
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 20px;
        background: #fce8e6;
        color: #b42318;
        font-size: 14px;
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">

        <h1>Create Account</h1>

        <p class="auth-subtitle">
            Join ADV-EDITS and start planning your special moments.
        </p>

        @if ($errors->any())
            <div class="auth-alert">
                Please check the information you entered.
            </div>
        @endif

        <form method="POST" action="{{ route('customer.register.store') }}">
            @csrf

            <div class="auth-group">
                <label for="name">Full Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                    autocomplete="name"
                >

                @error('name')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="auth-group">
                <label for="email">Email Address</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autocomplete="email"
                >

                @error('email')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="auth-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Create a password"
                    required
                    autocomplete="new-password"
                >

                @error('password')
                    <div class="auth-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="auth-group">
                <label for="password_confirmation">Confirm Password</label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    required
                    autocomplete="new-password"
                >
            </div>

            <button type="submit" class="auth-button">
                Create My Account
            </button>
        </form>

        <div class="auth-footer">
            Already have an account?
            <a href="{{ route('customer.login') }}">Log in</a>
        </div>

    </div>
</div>

@endsection