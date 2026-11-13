
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Subscription | ADV-EDITS')</title>

    <style>
        :root {
            --gold: #C5A477;
            --cream: #F4EFE8;
            --brown: #211812;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            min-height: 100%;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            color: var(--cream);
            background: var(--brown);
            overflow-x: hidden;
        }

        .website-background {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
            z-index: -3;
        }

        .background-overlay {
            position: fixed;
            inset: 0;
            z-index: -2;
            background: rgba(25, 17, 12, .58);
            backdrop-filter: blur(3px);
        }

        .subscription-header {
            min-height: 72px;
            padding: 16px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(25, 17, 12, .72);
            border-bottom: 1px solid rgba(255, 255, 255, .15);
            backdrop-filter: blur(16px);
        }

        .brand {
            font-family: Georgia, serif;
            font-size: 23px;
            font-weight: 600;
            letter-spacing: 3px;
            color: #E3C69D;
            text-decoration: none;
        }

        .header-label {
            font-size: 11px;
            letter-spacing: 2px;
            color: #F1E4D2;
        }

        .subscription-container {
            width: min(1050px, 92%);
            margin: 48px auto;
            position: relative;
        }

        .subscription-footer {
            padding: 25px;
            text-align: center;
            color: rgba(255, 255, 255, .75);
            font-size: 12px;
            text-shadow: 0 1px 5px rgba(0, 0, 0, .5);
        }

        @media (max-width: 600px) {
            .subscription-header {
                min-height: 62px;
                padding: 15px 5%;
            }

            .brand {
                font-size: 18px;
            }

            .header-label {
                font-size: 9px;
                letter-spacing: 1px;
            }

            .subscription-container {
                width: 92%;
                margin: 28px auto;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <iframe
        class="website-background"
        src="{{ url('/') }}"
        title="ADV-EDITS Website Background"
        loading="eager"
        aria-hidden="true"
        tabindex="-1">
    </iframe>

    <div class="background-overlay"></div>

    <header class="subscription-header">
        <a href="{{ url('/') }}" class="brand">ADV-EDITS</a>
        <div class="header-label">SUBSCRIPTION PORTAL</div>
    </header>

    <main class="subscription-container">
        @yield('content')
    </main>

    <footer class="subscription-footer">
        © {{ date('Y') }} ADV-EDITS Photography & Videography
    </footer>

    @stack('scripts')

</body>
</html>
