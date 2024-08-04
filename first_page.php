<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="./css/background.css">
    <script type="text/javascript" src="./js/login.js"></script>
</head>
<body>
<div class="container">
    <div class="image-section">
        <img src="./img/korea.jpg" alt="Image">
    </div>
    <div class="form-section">
        <form name="login" action="login.php" method="post">
            <h1>Travel In Korea</h1>
            <h2>로그인</h2>
            <input type="text" name="id" placeholder="username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <div class="button-container">
                <input type="submit" name="login" value="Login" class="login-button" onclick="check_input()">
                <input type="submit" formaction="sign.php" name="sign" value="Sign" class="sign-button" onclick="removeRequired()">
            </div>
        </form>
    </div>
</div>
</body>
</html>
