
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ADV-EDITS</title>

    <style>
        :root {
            --sidebar-bg: #211812;
            --sidebar-secondary: #30231B;
            --sidebar-hover: #3B2B21;
            --sidebar-active: #493528;

            --text-primary: #F5EBDD;
            --text-secondary: #B9A28D;
            --text-muted: #8E7662;

            --accent: #C5A477;
            --accent-hover: #D7B88F;
            --border-color: #49372B;

            --page-bg: #F4EFE8;
            --content-text: #30251E;
            --white: #FFFFFF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--page-bg);
            color: var(--content-text);
        }

        /* BURGER BUTTON */
        .menu-toggle {
            position: fixed;
            top: 18px;
            left: 18px;
            z-index: 1200;
            width: 46px;
            height: 46px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--sidebar-bg);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            transition: background 0.2s ease, left 0.3s ease;
        }

        .menu-toggle:hover {
            background: var(--sidebar-hover);
        }

        .menu-toggle span {
            display: block;
            width: 21px;
            height: 2px;
            background: var(--text-primary);
            border-radius: 2px;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        /* LEFT SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 265px;
            height: 100vh;
            padding: 82px 20px 20px;
            background: var(--sidebar-bg);
            color: var(--text-primary);
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            z-index: 1100;
            transform: translateX(0);
            transition: transform 0.3s ease;

            /* Keeps logout at the bottom */
            display: flex;
            flex-direction: column;
        }

        /* BRAND / LOGO */
        .sidebar-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            text-decoration: none;
            color: var(--text-primary);
            margin-bottom: 42px;
            flex-shrink: 0;
        }

        .logo-circle {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--sidebar-secondary);
            border: 2px solid var(--accent);
            margin-bottom: 15px;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-placeholder {
            font-size: 34px;
            color: var(--accent);
        }

        .brand-name {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 3px;
            line-height: 1.4;
        }

        .brand-subtitle {
            margin-top: 7px;
            color: var(--text-secondary);
            font-size: 9px;
            letter-spacing: 2px;
            line-height: 1.6;
        }

        /* NAVIGATION HEADING */
        .sidebar-heading {
            margin: 0 0 14px 12px;
            color: var(--text-muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            flex-shrink: 0;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-links li {
            margin-bottom: 7px;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 14px;
            border-radius: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s ease, color 0.2s ease,
                        transform 0.2s ease;
        }

        .nav-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            min-width: 22px;
            font-size: 19px;
            color: var(--accent);
        }

        .nav-links a:hover {
            background: var(--sidebar-hover);
            color: var(--text-primary);
            transform: translateX(3px);
        }

        .nav-links a.active {
            background: var(--sidebar-active);
            color: var(--text-primary);
            box-shadow: inset 3px 0 0 var(--accent);
        }

        .nav-links a.active .nav-icon {
            color: var(--accent-hover);
        }

        /* NAVIGATION TAKES AVAILABLE SPACE */
        .sidebar nav {
            flex: 1;
        }

        /* LOGOUT SECTION */
        .sidebar-logout {
            margin-top: auto;
            padding-top: 20px;
            flex-shrink: 0;
        }

        .logout-divider {
            border: 0;
            border-top: 1px solid var(--border-color);
            margin: 0 0 15px;
        }

        .logout-form {
            width: 100%;
            margin: 0;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 14px;
            border: 1px solid rgba(197, 164, 119, 0.25);
            border-radius: 8px;
            background: transparent;
            color: var(--accent);
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            text-align: left;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .logout-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            min-width: 22px;
            font-size: 19px;
        }

        .logout-btn:hover {
            background: var(--sidebar-hover);
            color: var(--text-primary);
        }

        /* MAIN PAGE CONTENT */
        .page-content {
            min-height: 100vh;
            margin-left: 265px;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        main {
            flex: 1;
            min-width: 0;
        }

        a {
            transition: color 0.2s ease;
        }

        /* WHEN SIDEBAR IS CLOSED */
        body.sidebar-closed .sidebar {
            transform: translateX(-100%);
        }

        body.sidebar-closed .page-content {
            margin-left: 0;
        }

        body.sidebar-closed .menu-toggle {
            left: 18px;
        }

        /* BACKGROUND OVERLAY ON MOBILE */
        .sidebar-overlay {
            display: none;
        }

        /* TABLET */
        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
                padding: 82px 18px 20px;
            }

            .page-content {
                margin-left: 250px;
            }

            .brand-name {
                font-size: 20px;
                letter-spacing: 2px;
            }

            .logo-circle {
                width: 74px;
                height: 74px;
            }
        }

        /* MOBILE */
        @media (max-width: 560px) {
            .sidebar {
                width: 265px;
                max-width: 85vw;
                padding: 82px 20px 20px;
                box-shadow: 8px 0 25px rgba(0, 0, 0, 0.15);
            }

            .page-content {
                margin-left: 0;
            }

            body:not(.sidebar-closed) .sidebar-overlay {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1050;
            }

            .menu-toggle {
                top: 14px;
                left: 14px;
            }

            body.sidebar-closed .menu-toggle {
                left: 14px;
            }
        }
    </style>
</head>

<body>

    <!-- BURGER MENU BUTTON -->
    <button
        type="button"
        class="menu-toggle"
        id="menuToggle"
        aria-label="Open navigation menu"
        aria-controls="sidebar"
        aria-expanded="true"
    >
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- MOBILE BACKGROUND OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDE NAVIGATION -->
    <aside class="sidebar" id="sidebar">

        <!-- BRAND / LOGO -->
        <a href="{{ route('home') }}" class="sidebar-brand">

            <div class="logo-circle">
                <span class="logo-placeholder">📷</span>
            </div>

            <span class="brand-name">ADV-EDITS</span>

            <span class="brand-subtitle">
                PHOTOGRAPHY &amp; VIDEOGRAPHY
            </span>

        </a>

        <p class="sidebar-heading">MAIN MENU</p>

        <nav aria-label="Main navigation">

            <ul class="nav-links">

                <!-- HOME -->
                <li>
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <span class="nav-icon">⌂</span>
                        <span>Home</span>
                    </a>
                </li>

                <!-- GALLERY -->
                <li>
                    <a href="{{ route('gallery') }}"
                       class="{{ request()->routeIs('gallery') ? 'active' : '' }}">
                        <span class="nav-icon">▧</span>
                        <span>Gallery</span>
                    </a>
                </li>

                <!-- SERVICES -->
                <li>
                    <a href="{{ route('services.index') }}"
                       class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                        <span class="nav-icon">◈</span>
                        <span>Services</span>
                    </a>
                </li>

                <!-- BOOKING -->
                <li>
                    <a href="{{ route('booking.index') }}"
                       class="{{ request()->is('booking*') ? 'active' : '' }}">
                        <span class="nav-icon">▦</span>
                        <span>Booking</span>
                    </a>
                </li>

                <!-- MY PROFILE -->
                <li>
                    <a href="{{ route('profile.index') }}"
                       class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <span class="nav-icon">♙</span>
                        <span>My Profile</span>
                    </a>
                </li>

                <!-- NOTIFICATIONS -->
                <li>
                    <a href="{{ route('notifications.index') }}"
                       class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                        <span class="nav-icon">♧</span>
                        <span>Notifications</span>
                    </a>
                </li>

            </ul>

        </nav>

        <!-- LOGOUT BUTTON -->
        <div class="sidebar-logout">

            <hr class="logout-divider">

            <form
                action="{{ route('customer.logout') }}"
                method="POST"
                class="logout-form"
            >
                @csrf

                <button type="submit" class="logout-btn">
                    <span class="logout-icon">↪</span>
                    <span>Log Out</span>
                </button>

            </form>

        </div>

    </aside>

    <!-- CUSTOMER PAGE CONTENT -->
    <div class="page-content">

        <main>
            @yield('content')
        </main>

    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebar = document.getElementById('sidebar');

        function setSidebar(open) {
            document.body.classList.toggle('sidebar-closed', !open);

            menuToggle.setAttribute('aria-expanded', String(open));

            menuToggle.setAttribute(
                'aria-label',
                open ? 'Close navigation menu' : 'Open navigation menu'
            );
        }

        menuToggle.addEventListener('click', function () {
            const isOpen = !document.body.classList.contains('sidebar-closed');
            setSidebar(!isOpen);
        });

        sidebarOverlay.addEventListener('click', function () {
            setSidebar(false);
        });

        // Close the sidebar after selecting a link on mobile.
        sidebar.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 560) {
                    setSidebar(false);
                }
            });
        });

        // Start with sidebar open on desktop and closed on mobile.
        if (window.innerWidth <= 560) {
            setSidebar(false);
        } else {
            setSidebar(true);
        }

        // Reset sidebar when moving between mobile and desktop sizes.
        window.addEventListener('resize', function () {
            if (window.innerWidth > 560) {
                setSidebar(true);
            } else {
                setSidebar(false);
            }
        });
    </script>

</body>
</html>
