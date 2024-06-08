<?php 
require_once './blog.php';

$blog = new Blog();
$result = $blog->delete($_GET['id']);

?>

<p><a href="../back/allBlogs.php">ブログ一覧に戻る</a></p>