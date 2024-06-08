<?php
require_once '../back/login_check.php';
require_once "../back/blog.php";

$blog = new Blog();
$result = $blog->getById($_GET['id']);

$id = $result['id'];
$title = $result['title'];
$content = $result['content'];
$filename = $result['file_name'];
$save_path = $result['file_path'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NewsForm</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="formBox">
        <h2 class="formTitle">お知らせ更新フォーム</h2>
        <div class="container">
            <form action="../back/blog_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <p>お知らせタイトル：</p>
                <input type="text" name="title" value="<?php echo $title ?>" required>
                <p>本文：</p>
                <textarea name="content" id="content" cols="30" rows="10" required><?php echo $content ?></textarea>
                <br>
                <div class="file-up">
                    <p>現在の画像：<?php echo empty($filename) ? '画像は指定されていません' : "$filename" ?></p>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input name="img" type="file" accept="image/*" value="<?php echo $filename ?>" />
                </div>
                <input type="submit" value="送信" class="button">
            </form>
            <a href="../back/blog_delete.php?id=<?php echo $id ?>" class="deleteButton">削除</a>
            <a href="./allBlogs.php" class="backLink">ブログ一覧に戻る</a>
        </div>
    </div>
    
</body>
</html>