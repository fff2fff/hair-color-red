<?php
// session_start();
require_once "dbc.php";



Class Blog extends Dbc {
    
    protected $table_name = 'blog';
    
    public function blogCreate_img($blogs, $filename, $save_path) {
        // ブログのタイトルと内容を挿入
        $sql = "INSERT INTO 
                    $this->table_name(title, content, file_name, file_path) 
                VALUES 
                    (:title, :content, :file_name, :file_path)";

        $dbh = $this->dbc();    
        // トランザクションの開始           
        // $this->dbc()->beginTransaction();
        try {
            
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':file_name', $filename, PDO::PARAM_STR);
            $stmt->bindValue(':file_path', $save_path, PDO::PARAM_STR);
            $stmt->execute();
            // $this->dbc()->commit();
            // echo "ブログの投稿とファイルのアップロードが成功しました！";
            // echo "<a href=allBlogs.php>一覧に戻る</a>";
            $message = urlencode('お知らせの投稿とファイルのアップロードが成功しました！');
            header("Location: ../front/allBlogs.php?result=$message");
        } catch(\Exception $e) {
            // echo $e->getMessage();
            $message = urlencode('お知らせの投稿に失敗しました: ' . $e->getMessage());
            header("Location: ../front/allBlogs.php?result=$message");
        }
    }

    public function blogCreate($blogs) {
        $sql = "INSERT INTO 
                    $this->table_name(title, content) 
                VALUES 
                    (:title, :content)";

        $dbh = $this->dbc();
        // $this->dbc()->beginTransaction();
        try {
            // ブログのタイトルと内容を挿入
           
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
            $stmt->execute();
            // $this->dbc()->commit();
            // echo "ブログの投稿に成功しました！";
            // echo "<a href=allBlogs.php>一覧に戻る</a>";
            $message = urlencode('お知らせの投稿とファイルのアップロードが成功しました！');
            header("Location: ../front/allBlogs.php?result=$message");
        } catch(\Exception $e) {
            // echo $e->getMessage();
            $message = urlencode('お知らせの投稿に失敗しました: ' . $e->getMessage());
            header("Location: ../front/allBlogs.php?result=$message");
        }
    }

    public function blogUpdate_img($blogs, $filename, $save_path) {
        // ブログのタイトルと内容を挿入
        $sql = "UPDATE $this->table_name SET
                    title = :title, content = :content, file_name = :file_name, file_path = :file_path 
                WHERE
                    id = :id";

        $dbh = $this->dbc();
        // $this->dbc()->beginTransaction();
        try {         
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':file_name', $filename, PDO::PARAM_STR);
            $stmt->bindValue(':file_path', $save_path, PDO::PARAM_STR);
            $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
            $stmt->execute();
            // $this->dbc()->commit();
            // echo "ブログのファイルの更新が成功しました！";
            // echo "<a href=allBlogs.php>一覧に戻る</a>";
            $message = urlencode('お知らせの投稿とファイルのアップロードが成功しました！');
            header("Location: ../front/allBlogs.php?result=$message");
        } catch(\Exception $e) {
            // echo $e->getMessage();
            $message = urlencode('お知らせの投稿に失敗しました: ' . $e->getMessage());
            header("Location: ../front/allBlogs.php?result=$message");
        }
    }
    
    public function blogUpdate($blogs) {
        // ブログのタイトルと内容を挿入
        $sql = "UPDATE $this->table_name SET
                    title = :title, content = :content
                WHERE
                    id = :id";

        $dbh = $this->dbc();    
        // $this->dbc()->beginTransaction();
        try {    
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
            $stmt->execute();
            // $this->dbc()->commit();
            // echo "ブログの更新に成功しました！";
            // echo "<a href=allBlogs.php>一覧に戻る</a>";
            $message = urlencode('お知らせの投稿とファイルのアップロードが成功しました！');
            header("Location: ../front/allBlogs.php?result=$message");
        } catch(\Exception $e) {
            // echo $e->getMessage();
            $message = urlencode('お知らせの投稿に失敗しました: ' . $e->getMessage());
            header("Location: ../front/allBlogs.php?result=$message");
        }
    }



    // ブログ(お知らせ)のバリデーション
    // public function blogValidate($blogs) {
    //     if(empty($blogs['title'])) {
    //         exit('タイトルを入力してください。');
    //     }
        
    //     if(mb_strlen($blogs['title']) > 191) {
    //         exit('タイトルを191文字以下にしてください。');
    //     }
        
    //     if(empty($blogs['content'])) {
    //         exit('本文をにゅうりょくしてください。');
    //     }
    // }

    public function blogValidate($blogs) {
        $errors = [];
    
        if (empty($blogs['title'])) {
            $errors[] = 'タイトルを入力してください。';
        }
        
        if (mb_strlen($blogs['title']) > 191) {
            $errors[] = 'タイトルを191文字以下にしてください。';
        }
        
        if (empty($blogs['content'])) {
            $errors[] = '本文を入力してください。';
        }
    
        return $errors;
    }
    
}
?>