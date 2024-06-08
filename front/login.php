<?php
session_start();
require_once '../back/dbc.php';
$dbc = new Dbc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <form method="post" action="login.php">
        <p>
            <label for="username">ユーザ名:</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">パスワード:</label>
            <input type="password" name="password" required>
        </p>
        <input type="submit" value="ログイン" class="button">
    </form>
</div>
</body>
</html>


<?php
if(!empty($_SESSION['login'])) {
    echo "ログイン済みです。<br>";
    echo "<a href=allBlogs.php>リストに戻る</a>";
    exit;
}

if((empty($_POST['username'])) || (empty($_POST['password']))) {
    // echo "ユーザ名、パスワードを入力してください。";
    exit;
}

$dbc->login();

