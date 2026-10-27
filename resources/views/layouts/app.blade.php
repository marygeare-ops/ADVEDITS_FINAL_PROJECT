
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADV-EDITS</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            background: #171717;
            color: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 2px;
            color: white;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            color: #ddd;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: white;
            border-bottom: 2px solid white;
            padding-bottom: 5px;
        }

        main {
            min-height: 80vh;
        }

        footer {
            background: #171717;
            color: #ccc;
            text-align: center;
            padding: 22px;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 15px 5%;
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                gap: 20px;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <a href="{{ route('home') }}" class="logo">ADV-EDITS</a>

        <nav>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('gallery') }}"
                       class="{{ request()->routeIs('gallery') ? 'active' : '' }}">
                        Gallery
                    </a>
                </li>

                <li>
                    <a href="{{ route('services.index') }}"
                       class="{{ request()->routeIs('services.index') ? 'active' : '' }}">
                        Services
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} ADV-EDITS. All rights reserved.
    </footer>
</body>
</html>
