
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADV-EDITS | Photography & Videography</title>

    <style>
        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #F4EFE8;
            color: #30251E;
        }

        .guest-header {
            width: 100%;
            min-height: 76px;
            padding: 12px 5.5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #211812;
            position: relative;
            z-index: 10;
        }

        .guest-brand {
            color: #F5EBDD;
            text-decoration: none;
            font-family: Georgia, serif;
            font-size: 23px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .guest-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .guest-login,
        .guest-register {
            display: inline-block;
            padding: 11px 22px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
            transition: .2s ease;
        }

        .guest-login {
            background: transparent;
            color: #F5EBDD;
            border: 1px solid #C5A477;
        }

        .guest-login:hover {
            background: rgba(197,164,119,.15);
        }

        .guest-register {
            background: #C5A477;
            color: #211812;
            border: 1px solid #C5A477;
        }

        .guest-register:hover {
            background: #D7B88F;
            border-color: #D7B88F;
        }

        @media(max-width:560px) {
            .guest-header {
                padding: 12px 5%;
            }

            .guest-brand {
                font-size: 18px;
            }

            .guest-actions {
                gap: 7px;
            }

            .guest-login,
            .guest-register {
                padding: 10px 11px;
                font-size: 9px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <header class="guest-header">

        <a href="{{ route('home') }}" class="guest-brand">
            ADV-EDITS
        </a>

        <div class="guest-actions">
            <a href="{{ route('customer.login') }}" class="guest-login">
                LOG IN
            </a>

            <a href="{{ route('customer.register') }}" class="guest-register">
                CREATE ACCOUNT
            </a>
        </div>

    </header>

    <main>
        @yield('content')
    </main>

    @stack('scripts')

</body>
</html>
