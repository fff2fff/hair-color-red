<?php 
$pageTitle = 'HOME';
require_once "back/blog.php";
include './inc/header1.php';


$blog = new Blog();
$blogs = $blog->getAll();
$reversed_blogs = array_reverse($blogs);
$blogsOfFive = array_slice($reversed_blogs, 0, 5);
?>
<main>
    <div class="mv">
        <div class="item">
            <img src="images_red/20231025_155355.jpg" alt="">
        </div>
        <div class="item">
            <img src="images_red/1699388660239.jpg" alt="">
        </div>
        <div class="item">
            <img src="images_red/20231025_155707.jpg" alt="">
        </div>
    </div>


    <div class="contents">
        <div class="box">
            <div class="img-box">
                <img src="images_red/1694764289418.jpg" alt="">
            </div>
            <div class="text-box">
                <h2>髪とあなたを美しく元気にする</h2>
                <p>40年間お客様の髪とまっすぐ向き合って数万人の笑顔を見てきました。<br>
                スタイリング剤に頼らないカット！<br>髪と頭皮によくないものは使わない！<br>
                これからもこのスタイルを守って、お客様に選ばれていく美容室でありたい。</p>
                <a href="concept.php">Read more</a>
            </div>
        </div>
        
        <div class="box">
                <div class="img-box">
                    <img src="images_red/1699388651964.jpg" alt="">
                </div>
            <div class="text-box">
                <h2>MENU</h2>
                <p>美容室redでは、お客様一人ひとりの髪質やスタイルに合わせたカット、カラー、パーマなど多彩なメニューをご用意しています。<br>
                特に、美容室のうち1%しか取り扱うことのできないアルマダスタイルシリーズを使用したヘアケアは、髪本来の美しさを引き出します。<br>
                上質なサービスで、あなたの理想のスタイルを実現します。</p>
                <a href="menu.php">Read more</a>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="images_red/1694764276832.jpg" alt="">
            </div>
            <div class="text-box">
                <h2>ACCESS</h2>
                <p>美容室redは、鳥取市富安１丁目２１３西尾ビル1Fにあります。<br>
                鳥取駅から徒歩5分の便利な立地で、駐車場も完備しておりますので、お車でもご来店いただけます。</p>
                <a href="access.php">Read more</a>
            </div>
        </div>
        <div class="box">
                <div class="img-box">
                    <img src="images_red/1694764281024.jpg" alt="">
                </div>
            <div class="text-box">
                <h2>Advice</h2>
                <p>ヘアスタイルはあなたの個性を引き立てる重要な要素です。<br>
                美容室redでは、40年以上の経験を持つオーナーが、あなたに最適なヘアスタイルを提案します。<br>
                普段のお手入れやスタイリング方法についてもアドバイスいたしますので、ぜひお気軽にご相談ください。</p>
                <a href="advice.php">Read more</a>
            </div>
        </div>

    </div>

    <div class="contact">
        <div class="contact_box">
            <h2>CONTACT</h2>
            <h3>ご予約・お問い合わせなどはこちらから</h3>
            <div class="tel">
                <a href="tel:0120010234">
                    <h4>ご予約専用ダイヤル</h4>
                    <p>0120-01-0243</p>
                </a>
            </div>
            <div class="hpb">
                <a href="https://beauty.hotpepper.jp/slnH000404099/?cstt=1">
                    <img src="images_red/無題7_20231018105408.png" alt="Banner">
                </a>
            </div>
        </div>
    </div>

    <div class="newsBox">
        <div class="newsList">
            <h2>NEWS</h2> 
            <h3>REDからのお知らせ</h3>
            <?php foreach ($blogsOfFive as $element): ?>
                <li>              
                    <a class="newsLink" href="./front/detail.php?id=<?php echo $element['id'] ?>">
                        <div class="newsImg">
                            <img src="<?php echo empty($element['file_path']) ? './images_red/mobileLogo.png' : "./upload_images/{$element['file_path']}" ?>" alt="">
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
            <a class="allNewsLink" href="allBlogs2.php">Read more</a>
        </div>
    </div>
    
</main>


<?php
include __DIR__ . '/inc/footer1.php';
?>