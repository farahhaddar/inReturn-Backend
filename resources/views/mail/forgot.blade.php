<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
</head>
<body>
pinCode: {{$data}};
 <br>
    Follow the link to change your password:
    
    <br>
    <a href="http://localhost:8000/reset/{{$data}}">Follow Me ! </a>
</body>
</html>