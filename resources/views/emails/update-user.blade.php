<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0f1217;
            font-family: system-ui;
            color: white;
        }

        .container {
            background-color: #1b1f24;
            max-width: 600px;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
        }

        .header {
            padding: 20px;
            margin-left: 20px;
        }

        .header a {
            color: #ffffff;
            text-decoration: none;
            font-size: 30px;
            font-weight: bold;
        }

        .content {
            padding: 20px 30px;
        }

        .content h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .content p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .btn-reset {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn-reset:hover {
            background-color: #1d4ed8;
        }

        .footer {
            border-top: solid 1px gray;
            text-align: center;
            padding: 10px 20px;
            color: #888888;
            font-size: 12px;
        }
    </style>
</head>

<div class="container">
    <div class="header">
        <h1><a href="{{ url('/') }}">everyday.dev</a></h1>
    </div>

    <div class="content">
        <h2>Profile Information Update</h2>
        <p>Hi {{$mailData['name']}},</p>
        <p>We wanted to let you know that your profile information has been <strong>updated by an
                administrator</strong>. If you made this request, no further action is needed.</p>
        <p>If you did not authorize these changes or notice any unexpected activity, please contact our support team
            immediately.</p>
        <a href="{{ route('user.posts', $mailData['id']) }}" class="btn-reset">View Your Account</a>
        <p>Thanks,<br>The everyday.dev Team</p>
    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} everyday.dev. All rights reserved.</p>
    </footer>
</div>

</html>