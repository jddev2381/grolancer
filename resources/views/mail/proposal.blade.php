<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Proposal</title>
</head>
<body>
    <h3>Hey {{ $mailData['to_name'] }},</h3>
    <p>{{ $mailData['from_name'] }} has sent you a proposal.</p>
    <p>
        <a style="background-color: #DD5A0E; color: white; padding: 10px 35px; border-radius: 6px; text-decoration: none;" href="{{ $mailData['url'] }}">View Proposal</a>
    </p>
</body>
</html>