<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="admin.css" />
        <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
    </head>
<body class="darkback">
    <section>

        <div class="logincont">
            <div class="loginimgcont"><img class="sinublack" src="img/신우초-검.png"/></div>
            <h2>관리자 페이지 로그인</h2>

            <form method="post" action="login_process.php" id="admin-login">
                <h4>로그인 ID</h4>
                <input type="email" id="adminId" name="adminId" placeholder="Admin123@example.com">
                <h4>비밀번호</h4>
                <input type="password" id="adminPw" name="adminPw" placeholder="Password123">
                
                <div class="errorcont">
                <?php
                    session_start();
                    if (isset($_SESSION['error'])) {
                        echo '<div><p id="error-message" class="error">' . htmlspecialchars($_SESSION['error']) . '</p></div>';
                        unset($_SESSION['error']);
                    }
                ?>
                </div>
                <input type="submit" value="Login">
            </form>

            
            
        </div>
    </section>
</body>
</html>

