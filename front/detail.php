<?php
$pageTitle = 'DETAIL';
require_once "../back/blog.php";
include '../inc/header2.php';

$blog = new Blog();
$result = $blog->getById($_GET['id']);
$timestamp = $result['post_at'];
$datetime = new DateTime($timestamp);
$date = $datetime->format('Y-m-d');
$date_with_periods = str_replace("-", ".", $date);
?>
<div class="wrapper">
    <div class="news_detail">
        <img src="<?php echo "{$result['file_path']}" ?>" alt="">
        <p>投稿日時: <?php echo $date_with_periods ?></p>
        <h3><?php echo $result['title'] ?></h3>
        <p><?php echo $result['content'] ?></p>
        <a href="javascript:history.back()">戻る</a>
    </div>
</div>

<?php
include '../inc/footer2.php';
?>