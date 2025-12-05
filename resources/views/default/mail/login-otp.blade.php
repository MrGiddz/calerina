<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $settings->site_name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet"/>
</head>
<body style="margin: 0; font-family: 'Poppins', sans-serif; background: #ffffff; font-size: 14px; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 40px 20px;">
        <!-- Logo/Icon -->
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ url(custom_theme_url($settings->logo_path)) }}" alt="Logo" style="height: 60px;"/>
        </div>

        <!-- Main Content -->
        <div style="text-align: center;">
            <h1 style="font-size: 20px; font-weight: 500; color: #333; margin-bottom: 20px;">
                Verify your email to sign in to {{ $settings->site_name }}
            </h1>

          <p style="color: #555; margin-bottom: 20px;">
              Hello <strong>{{ $user->name }}</strong>
          </p>


            <p style="color: #555; margin-bottom: 30px;">
                Use the code above to complete your login. This code is valid for a limited time only.
            </p>

            <!-- OTP Code Box -->
            <div style="background: #f5f5f5; padding: 15px; border-radius: 4px; margin: 30px 0;">
                <span style="font-size: 24px; font-weight: 600; letter-spacing: 2px; color: #333;">{{ $otp }}</span>
            </div>

            <!-- Security Notice -->
            <p style="color: #666; font-size: 12px; line-height: 1.5; margin-top: 40px; text-align: left;">
                If you didn't attempt to sign in but received this email, or if the location doesn't match, please ignore this email. Don't share or forward the 4-digit code with anyone. Our customer service will never ask for it. Do not read this code out loud. Be cautious of phishing attempts and always verify the sender and domain ({{ $settings->site_name }}.com) before acting. If you are concerned about your account's safety, please visit our <a href="https://calerina.com/contact-us" style="color: #32a852; text-decoration: none;">Help page</a> to get in touch with us.
            </p>
        </div>
    </div>
</body>
</html>