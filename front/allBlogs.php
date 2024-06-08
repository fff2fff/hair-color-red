<?php
require_once '../back/login_check.php';
require_once "../back/blog.php";


$blog = new Blog();
$blogs = $blog->getAll();
$reversed_blogs = array_reverse($blogs);

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$total_blogs = count($reversed_blogs);
$pages = ceil($total_blogs / $limit);

$paginated_blogs = array_slice($reversed_blogs, $start, $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="newsBox">
        <div class="newsList">
            <h2>お知らせ管理画面</h2>
                
            <a href="upload_form.php" class="addNewsButton">お知らせを追加する</a><br>
            <a href="../back/logout.php" class="logoutButton">ログアウト</a>
            <?php if (isset($_GET['result'])): ?>
                <div class="result-message">
                    <?php echo htmlspecialchars($_GET['result'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
            <?php foreach ($paginated_blogs as $element): ?>
                <li>              
                    <a class="newsLink" href="./update_form.php?id=<?php echo $element['id'] ?>">
                        <div class="newsImg">
                            <img src="<?php echo empty($element['file_path']) ? '../images_red/mobileLogo.png' : "{$element['file_path']}" ?>" alt="">
                        </div>
                        <div>
                            <div class="news_date_title">
                                <div>
                                    <?php
                                    $timestamp = $element['post_at'];
                                    $datetime = new DateTime($timestamp);
                                    $date = $datetime->format('Y-m-d');
                                    $date_with_periods = str_replace("-", ".", $date);
                                    ?>
                                    <?php echo $date_with_periods ?>
                                </div>
                                <div class="news_title">
                                    【<?php  echo $blog->h("{$element['title']}") ?>】
                                </div>
                            </div>
                            <div class="news_content">
                                <p><?php echo $blog->h("{$element['content']}") ?></p>
                            </div>
                        </div>
                        
                    </a>
                </li>
            <?php endforeach; ?>

            <div class="pagination">

                
                <?php if($pages != 1): ?>
                    <?php if($page > 1): ?>
                        <a class="pagination_link" href="?page=<?php echo $page - 1; ?>"><</a>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $pages; $i++): ?>
                        <a class="pagination_link <?php echo $i == $page ? 'current_page' : '' ?>" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <?php if($page < $pages): ?>
                        <a class="pagination_link" href="?page=<?php echo $page + 1; ?>">></a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

        </div>
    </div>
</body>
</html>
