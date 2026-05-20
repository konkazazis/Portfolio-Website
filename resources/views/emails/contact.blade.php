<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New contact message</title>
</head>

<body>
    <h1>New contact request</h1>

    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    <p><strong>Message:</strong></p>
    <p style="white-space: pre-line;">{{ $data['message'] }}</p>

    <hr>
    <p>This message was sent from the portfolio contact form.</p>
</body>

</html>