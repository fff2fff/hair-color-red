<?php require_once '../back/login_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlogForm</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="formBox">
        <h2 class="formTitle">お知らせ追加フォーム</h2>
        <div class="container">
            <form action="../back/blog_create.php" method="POST" enctype="multipart/form-data">
                <p>お知らせタイトル：</p>
                <input type="text" name="title" required>
                <p>本文：</p>
                <textarea name="content" id="content" cols="30" rows="10" required></textarea>
                <br>
                <div class="file-up">
                    <p>画像：</p>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input name="img" type="file" accept="image/*" />
                </div>
                <input type="submit" value="送信" class="button">
            </form>
            <a href="./allBlogs.php"  class="backLink">ブログ一覧に戻る</a>
        </div>
    </div>
</body>
</html>