<!DOCTYPE html>
<html>
<head>
    <title>Lead Published</title>
</head>
<body>
    <p>Hello,</p>
    <p>A lead has just been published that matches your settings:</p>
    <p><strong>Job Type:</strong> {{ $lead->job_type }}</p>
    <p><strong>Budget:</strong> {{ $lead->budget }}</p>
    <p><strong>Price:</strong> €{{ $lead->price }}</p>
    <p>Check out the new lead details in your account.</p>
    <p>Best regards,<br>Your Team</p>
</body>
</html>
