
@extends('layouts.app')

@section('content')

<style>
    .profile-page {
        --ink: #30231B;
        --brown: #493629;
        --gold: #A17E55;
        --muted: #75675A;
        --cream: #F7F1E9;
        --card: #FFFCF7;
        --border: #E5D9CC;

        width: 100%;
        max-width: 1250px;
        margin: auto;
        padding: 30px clamp(16px, 3vw, 38px) 50px;
        color: var(--ink);
        box-sizing: border-box;
    }

    .profile-page *,
    .profile-page *::before,
    .profile-page *::after {
        box-sizing: border-box;
    }

    .profile-header {
        padding-bottom: 22px;
        margin-bottom: 27px;
        border-bottom: 1px solid var(--border);
    }

    .profile-eyebrow {
        display: block;
        color: var(--gold);
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 2px;
        margin-bottom: 9px;
    }

    .profile-header h1 {
        font-family: Georgia, serif;
        font-size: clamp(29px, 3vw, 38px);
        font-weight: 400;
        color: var(--ink);
        margin: 0 0 7px;
    }

    .profile-header p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
        margin: 0;
    }

    .profile-layout {
        display: grid;
        grid-template-columns: 265px minmax(0, 1fr);
        gap: 21px;
        align-items: start;
    }

    .profile-sidebar-card,
    .profile-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 7px;
        box-shadow: 0 4px 14px rgba(48, 35, 27, .035);
    }

    /* ACCOUNT SUMMARY */

    .profile-sidebar-card {
        padding: 22px;
    }

    .account-top {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .account-initials {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #F0E5D6;
        border: 1px solid #E2D1BB;
        color: #76583C;
        font-family: Georgia, serif;
        font-size: 23px;
        margin-bottom: 14px;
    }

    .account-name {
        color: var(--ink);
        font-family: Georgia, serif;
        font-size: 20px;
        font-weight: 400;
        line-height: 1.3;
        margin: 0 0 5px;
        overflow-wrap: anywhere;
    }

    .account-email {
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .account-type {
        display: inline-block;
        padding: 5px 9px;
        margin-top: 12px;
        border-radius: 3px;
        background: #F2E8DB;
        color: #76583C;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .7px;
    }

    .account-divider {
        height: 1px;
        background: var(--border);
        margin: 20px 0;
    }

    .account-detail {
        margin-bottom: 15px;
    }

    .account-detail:last-child {
        margin-bottom: 0;
    }

    .account-detail label {
        display: block;
        color: var(--gold);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .account-detail p {
        color: var(--ink);
        font-size: 11px;
        margin: 0;
        overflow-wrap: anywhere;
    }

    /* MAIN CONTENT */

    .profile-main {
        display: flex;
        flex-direction: column;
        gap: 18px;
        min-width: 0;
    }

    .profile-card {
        overflow: hidden;
    }

    .profile-card-header {
        padding: 17px 21px;
        border-bottom: 1px solid var(--border);
        background: var(--cream);
    }

    .profile-card-header h2 {
        color: var(--ink);
        font-family: Georgia, serif;
        font-size: 19px;
        font-weight: 400;
        margin: 0 0 5px;
    }

    .profile-card-header p {
        color: var(--muted);
        font-size: 10px;
        line-height: 1.6;
        margin: 0;
    }

    .profile-card-body {
        padding: 21px;
    }

    /* FORMS */

    .profile-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .form-group {
        min-width: 0;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        color: #554536;
        font-size: 10px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .form-control {
        width: 100%;
        min-height: 41px;
        padding: 10px 12px;
        border: 1px solid #DCCDBB;
        border-radius: 4px;
        background: #fff;
        color: var(--ink);
        font-family: inherit;
        font-size: 11px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(161, 126, 85, .12);
    }

    .form-control.is-invalid {
        border-color: #B84A4A;
    }

    .field-error {
        display: block;
        color: #B84A4A;
        font-size: 10px;
        margin-top: 6px;
    }

    .profile-form-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px solid var(--border);
    }

    .profile-button {
        padding: 11px 19px;
        background: var(--ink);
        border: 1px solid var(--ink);
        border-radius: 4px;
        color: #F5EBDD;
        font-family: inherit;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .4px;
        cursor: pointer;
        transition: background .2s, border-color .2s;
    }

    .profile-button:hover {
        background: #76583C;
        border-color: #76583C;
    }

    /* ALERTS */

    .profile-alert {
        padding: 11px 14px;
        border-radius: 4px;
        font-size: 11px;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .profile-alert.success {
        color: #41643C;
        background: #EDF4E9;
        border: 1px solid #D4E4CE;
    }

    .profile-alert.error {
        color: #963F3F;
        background: #F9ECEC;
        border: 1px solid #EBD1D1;
    }

    /* RESPONSIVE */

    @media(max-width: 850px) {
        .profile-layout {
            grid-template-columns: 1fr;
        }

        .profile-sidebar-card {
            display: grid;
            grid-template-columns: 58px minmax(0, 1fr);
            column-gap: 16px;
            align-items: center;
        }

        .account-top {
            display: contents;
        }

        .account-initials {
            grid-column: 1;
            grid-row: 1 / span 3;
            margin: 0;
        }

        .account-name,
        .account-email,
        .account-type {
            grid-column: 2;
        }

        .account-divider {
            grid-column: 1 / -1;
            width: 100%;
        }

        .account-detail {
            margin-bottom: 13px;
        }
    }

    @media(max-width: 550px) {
        .profile-page {
            padding: 24px 14px 35px;
        }

        .profile-card-header,
        .profile-card-body {
            padding: 16px;
        }

        .profile-form-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .form-group.full-width {
            grid-column: auto;
        }

        .profile-form-footer {
            justify-content: stretch;
        }

        .profile-button {
            width: 100%;
        }
    }
</style>

<div class="profile-page">

    {{-- PAGE HEADER --}}
    <header class="profile-header">
        <span class="profile-eyebrow">ADV-EDITS / ACCOUNT</span>
        <h1>My Profile</h1>
        <p>Personal information and account settings.</p>
    </header>

    {{-- SUCCESS MESSAGES --}}
    @if(session('success'))
        <div class="profile-alert success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('password_success'))
        <div class="profile-alert success">
            {{ session('password_success') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="profile-alert error">
            Please review the highlighted fields and try again.
        </div>
    @endif

    <div class="profile-layout">

        {{-- ACCOUNT SUMMARY --}}
        <aside class="profile-sidebar-card">

            <div class="account-top">

                <div class="account-initials">
                    {{ strtoupper(substr($user->name ?: 'U', 0, 1)) }}
                </div>

                <div>
                    <h2 class="account-name">
                        {{ $user->name }}
                    </h2>

                    <div class="account-email">
                        {{ $user->email }}
                    </div>
                </div>

                <span class="account-type">
                    {{ ($user->is_admin ?? false) ? 'Administrator' : 'Customer Account' }}
                </span>

            </div>

            <div class="account-divider"></div>

            <div class="account-detail">
                <label>Account ID</label>
                <p>#{{ $user->id }}</p>
            </div>

            <div class="account-detail">
                <label>Member Since</label>
                <p>
                    {{ $user->created_at
                        ? $user->created_at->format('F d, Y')
                        : 'Not available' }}
                </p>
            </div>

            <div class="account-detail">
                <label>Account Email</label>
                <p>{{ $user->email }}</p>
            </div>

        </aside>

        {{-- MAIN PROFILE CONTENT --}}
        <div class="profile-main">

            {{-- PERSONAL INFORMATION --}}
            <section class="profile-card">

                <div class="profile-card-header">
                    <h2>Personal Information</h2>
                    <p>Update your registered name and email address.</p>
                </div>

                <div class="profile-card-body">

                    <form
                        action="{{ route('profile.update') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="profile-form-grid">

                            <div class="form-group">
                                <label for="name">Full Name</label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Enter your full name"
                                    maxlength="255"
                                    required
                                >

                                @error('name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="Enter your email address"
                                    maxlength="255"
                                    required
                                >

                                @error('email')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="profile-form-footer">
                            <button type="submit" class="profile-button">
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </section>

            {{-- CHANGE PASSWORD --}}
            <section class="profile-card">

                <div class="profile-card-header">
                    <h2>Change Password</h2>
                    <p>Update your account password.</p>
                </div>

                <div class="profile-card-body">

                    <form
                        action="{{ route('profile.password.update') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <div class="profile-form-grid">

                            <div class="form-group full-width">
                                <label for="current_password">
                                    Current Password
                                </label>

                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="Enter current password"
                                    autocomplete="current-password"
                                    required
                                >

                                @error('current_password')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter new password"
                                    autocomplete="new-password"
                                    required
                                >

                                @error('password')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">
                                    Confirm New Password
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm new password"
                                    autocomplete="new-password"
                                    required
                                >
                            </div>

                        </div>

                        <div class="profile-form-footer">
                            <button type="submit" class="profile-button">
                                Update Password
                            </button>
                        </div>

                    </form>

                </div>
            </section>

        </div>

    </div>

</div>

@endsection
