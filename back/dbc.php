<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];


Class Dbc {

    protected $table_name;
    protected $dbHost;
    protected $dbName;
    protected $dbUser;
    protected $dbPass;

    public function __construct() {
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->dbUser = $_ENV['DB_USER'];
        $this->dbPass = $_ENV['DB_PASS'];
    }
    // データベース接続(本番)
    protected function dbc() {

        $dns = "mysql:host=$this->dbHost;
                dbname=$this->dbName;
                charset=utf8";


        try {
            $pdo = new PDO($dns, $this->dbUser, $this->dbPass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            return $pdo;
        } catch(PDOException $e) {
            exit($e->getMessage());
        }
    }

    // // データベース接続(localhost)
    // protected function dbc() {
    //     $host   = dbHost;
    //     $dbname = dbName;
    //     $user   = dbUser;
    //     $pass   = dbPass;

    //     $dns = "mysql:host=$host;
    //             dbname=$dbname;
    //             charset=utf8";


    //     try {
    //         $pdo = new PDO($dns, $user, $pass,
    //         [
    //             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //             PDO::ATTR_EMULATE_PREPARES => false,
    //         ]);
    //         return $pdo;
    //     } catch(PDOException $e) {
    //         exit($e->getMessage());
    //     }
    // }



    // すべてのお知らせデータを取得
    // return @array $blogs
    public function getAll() {
        $dbh = $this->dbc();

        $sql = "SELECT 
                    *
                FROM 
                    $this->table_name";

        $blogs = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $blogs;
    }


    // エスケープ処理の関数
    public function h($s) {
        return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }


    // 指定されたidのお知らせデータの取得
    // 引数: $id
    // 返り値: result
    public function getById($id) {
        if(empty($id)) {
            header('Location: ../front/failure.html');
            // exit('IDが不正です');
        }

        $dbh = $this->dbc();

        // SQL準備
        $stmt = $dbh->prepare("SELECT * FROM $this->table_name Where id = :id");
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$result){
            header('Location: ../front/failure.html');
            // exit('お知らせがありません');
        }

        return $result;
    }

    public function delete($id) {
        if(empty($id)) {
            exit('IDが不正です');
        }
        try {
            $dbh = $this->dbc();
            // SQL準備
            $stmt = $dbh->prepare("DELETE FROM $this->table_name Where id = :id");
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
    
            $message = urlencode('お知らせ削除に成功しました！');
            header("Location: ../front/allBlogs.php?result=$message");
        } catch(\Exception $e) {
            $message = urlencode('お知らせの削除に失敗しました: ' . $e->getMessage());
            header("Location: ../front/allBlogs.php?result=$message");
        }
        
    }


    public function login() {
        try {
            $dbh = $this->dbc();
            $sql = "SELECT password FROM users WHERE username = :username";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":username", $_POST['username'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$result) {
                // echo "ログインに失敗しました。";
                header('Location: ../front/failure.html');
                exit;
            }
            
            if(password_verify($_POST['password'], $result['password'])) {
                session_regenerate_id(true);
                $_SESSION['login'] = true;
                header("Location: allBlogs.php");
            }else {
                // echo 'ログインに失敗しました。(2)';
                header('Location: ../front/failure.html');
            }
        
        } catch (PDOException $e) {
            // echo "エラー！" . $this->h($e->getMessage());
            header('Location: ../front/failure.html');
            exit;
        }

    }
    
}


