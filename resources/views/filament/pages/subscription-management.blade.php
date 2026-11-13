
<x-filament-panels::page>
    <style>
        .sub-page {
            display: grid;
            gap: 24px;
            color: #30251e;
        }

        .sub-hero {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
            padding: 42px;
            border-radius: 20px;
            background: linear-gradient(120deg, #241a14, #57402e);
            color: #fff8ed;
        }

        .sub-hero::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: 150px;
            top: -150px;
            border: 1px solid rgba(218, 184, 139, .2);
            border-radius: 50%;
            box-shadow: 0 0 0 35px rgba(218, 184, 139, .04),
                        0 0 0 70px rgba(218, 184, 139, .03);
        }

        .sub-eyebrow {
            color: #d6b58a;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .sub-hero h2 {
            margin: 13px 0;
            color: #fff8ed;
            font-family: Georgia, serif;
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 700;
        }

        .sub-hero p {
            max-width: 490px;
            color: #dfd0bd;
            font-size: 14px;
            line-height: 1.8;
        }

        .sub-price {
            min-width: 205px;
            padding: 25px;
            border: 1px solid rgba(218, 184, 139, .4);
            border-radius: 15px;
            background: rgba(255,255,255,.08);
            text-align: center;
        }

        .sub-price small {
            color: #e0c49f;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .sub-price strong {
            display: block;
            margin: 10px 0 3px;
            color: #fff;
            font-family: Georgia, serif;
            font-size: 38px;
        }

        .sub-price span {
            color: #dfd0bd;
            font-size: 12px;
        }

        .sub-section-title {
            margin-bottom: 15px;
            color: #30251e;
            font-family: Georgia, serif;
            font-size: 23px;
            font-weight: 700;
        }

        .sub-features {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .sub-feature {
            padding: 25px;
            border: 1px solid #e8dccd;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(48, 37, 30, .04);
        }

        .sub-feature-icon {
            display: flex;
            width: 45px;
            height: 45px;
            align-items: center;
            justify-content: center;
            margin-bottom: 17px;
            border-radius: 12px;
            background: #f5eee5;
            color: #987044;
            font-size: 21px;
        }

        .sub-feature h3 {
            margin-bottom: 9px;
            color: #30251e;
            font-size: 16px;
            font-weight: 700;
        }

        .sub-feature p {
            color: #817366;
            font-size: 13px;
            line-height: 1.8;
        }

        .sub-payment {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
            padding: 30px;
            border: 1px solid #e5d5c1;
            border-radius: 17px;
            background: #f9f5ef;
        }

        .sub-payment h3 {
            margin-bottom: 8px;
            color: #30251e;
            font-family: Georgia, serif;
            font-size: 23px;
            font-weight: 700;
        }

        .sub-payment p {
            color: #817366;
            font-size: 13px;
            line-height: 1.7;
        }

        .sub-payment-amount {
            margin-top: 10px;
            color: #987044 !important;
            font-weight: 700;
        }

        .sub-pay-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-shrink: 0;
            padding: 15px 24px;
            border: 1px solid #d4b17f;
            border-radius: 9px;
            background: #30231b;
            color: #fff8ed !important;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none !important;
            transition: .25s ease;
        }

        .sub-pay-button:hover {
            transform: translateY(-3px);
            background: #60452f;
            box-shadow: 0 8px 20px rgba(48, 35, 27, .18);
        }

        .sub-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 17px 20px;
            border: 1px solid #e8dccd;
            border-radius: 12px;
            background: #fff;
            color: #817366;
            font-size: 12px;
            line-height: 1.7;
        }

        .sub-note span {
            color: #987044;
            font-size: 18px;
        }

        @media(max-width: 700px) {
            .sub-hero,
            .sub-payment {
                align-items: stretch;
                flex-direction: column;
                padding: 25px;
            }

            .sub-price {
                min-width: 0;
            }

            .sub-features {
                grid-template-columns: 1fr;
            }

            .sub-pay-button {
                width: 100%;
            }
        }
    </style>

    <div class="sub-page">

        <section class="sub-hero">
            <div>
                <span class="sub-eyebrow">ADV-EDITS MEMBERSHIP</span>
                <h2>Your Business.<br>Your Subscription.</h2>
                <p>
                    Keep your business management dashboard active and
                    continue managing your bookings, customers, gallery,
                    and business records.
                </p>
            </div>

            <div class="sub-price">
                <small>Monthly Plan</small>
                <strong>₱1,000</strong>
                <span>per month</span>
            </div>
        </section>

        <section>
            <h3 class="sub-section-title">Your Membership Benefits</h3>

            <div class="sub-features">
                <div class="sub-feature">
                    <div class="sub-feature-icon">▣</div>
                    <h3>Business Management</h3>
                    <p>
                        Manage bookings, appointments, customer information,
                        and business activities in one dashboard.
                    </p>
                </div>

                <div class="sub-feature">
                    <div class="sub-feature-icon">✓</div>
                    <h3>Verified Subscription</h3>
                    <p>
                        Your payment receipt is reviewed by the Developer
                        before your monthly access is activated.
                    </p>
                </div>
            </div>
        </section>

        <section class="sub-payment">
            <div>
                <h3>Ready to Renew?</h3>
                <p>
                    Pay using GCash and submit your transaction details
                    for verification.
                </p>
                <p class="sub-payment-amount">
                    Total Due: ₱1,000.00 / month
                </p>
            </div>

            <a
                href="{{ route('subscription.renewal') }}"
                class="sub-pay-button"
            >
                Proceed to Payment <span>→</span>
            </a>
        </section>

        <div class="sub-note">
            <span>ⓘ</span>
            <div>
                <strong>Payment Reminder</strong><br>
                Make sure to enter the correct GCash reference number
                and upload a valid receipt. Your subscription will
                only be activated after Developer verification.
            </div>
        </div>

    </div>
</x-filament-panels::page>
