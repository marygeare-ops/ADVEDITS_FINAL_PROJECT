```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADV-EDITS | Home</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        nav {
            background: #171717;
            color: white;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        nav h2 {
            margin: 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 8px;
            font-size: 14px;
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
            background: #e5e5e5;
        }

        .hero h1 {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .hero p {
            max-width: 600px;
            margin: 0 auto 25px;
            line-height: 1.7;
        }

        .button {
            display: inline-block;
            background: #171717;
            color: white;
            padding: 13px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .content {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            text-align: center;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        footer {
            background: #171717;
            color: white;
            text-align: center;
            padding: 18px;
        }

        @media (max-width: 600px) {
            .hero h1 {
                font-size: 32px;
            }

            nav {
                justify-content: center;
            }

            nav a {
                display: inline-block;
                margin: 6px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <h2>ADV-EDITS</h2>
        <div>
            <a href="/">Home</a>
            <a href="/services">Services</a>
            <a href="/booking">Booking</a>
            <a href="/payment">Payment</a>
            <a href="/profile">Profile</a>
        </div>
    </nav>

    <section class="hero">
        <h1>Capture Your Best Moments</h1>
        <p>
            ADV-EDITS provides photography and videography services
            for weddings, birthdays, and other special events.
            Let us help you preserve your unforgettable memories.
        </p>

        <a class="button" href="/services">Explore Services</a>
        <a class="button" href="/booking">Book an Event</a>
    </section>

    <section class="content">
        <h2>Our Services</h2>
        <p>Professional coverage for your important occasions.</p>

        <div class="features">
            <div class="card">
                <h3>Wedding Coverage</h3>
                <p>Preserve the special moments of your wedding day.</p>
            </div>

            <div class="card">
                <h3>Birthday Coverage</h3>
                <p>Capture celebrations, smiles, and memorable moments.</p>
            </div>

            <div class="card">
                <h3>Special Events</h3>
                <p>Photography and videography for different occasions.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 ADV-EDITS. All rights reserved.</p>
    </footer>

</body>
</html>
```