<?php
require_once "./blog.php";

$blog = new Blog();

$blogs = $_POST;

// ブログ(お知らせ)のバリデーション
$blog->blogValidate($blogs);

//ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = '../upload_images/';

$save_filename = date('YmdHis') . $filename;
$save_path = $upload_dir . $save_filename;



// フラグの初期化
$upload_success = false;
//画像が指定されたとき (バリデーション)
if(is_uploaded_file($tmp_path)) {
    //ファイルのサイズが1MB未満か
    if($filesize > 1048576 || $file_err == 2) {
        echo 'ファイルサイズは1MB未満にしてください。';
        echo '<br>';
    } else {
        //拡張子が画像形式か
        $allow_ext = array('jpg', 'jpeg', 'png');
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array(strtolower($file_ext), $allow_ext)) {
            echo '画像ファイルを添付してください。';
            echo '<br>';
        } else {
            if(move_uploaded_file($tmp_path, $save_path)) {
                echo $filename . 'を' . $upload_dir .'にアップしました。';
                $upload_success = true;
            } else {
                echo 'ファイルが保存できませんでした。';
            }
        }
    }
}



// 画像のアップロードが成功した場合のみブログを保存
if ($upload_success) {
    $blog->blogUpdate_img($blogs, $filename, $save_path);
} else if($file['error'] == UPLOAD_ERR_NO_FILE){
    $blog->blogUpdate($blogs);
} else {
    echo '画像のアップロードに失敗したため、ブログの投稿は行われませんでした。';
}
?>