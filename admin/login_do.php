<?php 
include('../function/function.php');

// セッションの開始
session_start();

// ログインの状態のチェック
if(isset($_SESSION['id'])){
  // ログイン済み

  header('location:admin.php');
  exit();

}else if(isset($_POST['name']) && isset($_POST['password'])){
 

try{
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM users WHERE name = :name AND is_deleted = 0 LIMIT 1';
    $stmt = $db->prepare($sql);
    // $stmt->bindParam('プレースホルダ',プレースホルダに埋め込みたい値,データ型)
    $stmt->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
    // SQLの実行
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($_POST['password'], $row['password'])) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name']; // 任意
    header('Location: admin.php');
    exit;
  }else{

  // 失敗：ログイン画面へ
  header('Location: login.php');
  exit;
  }


}catch(PDOException $e){
    exit('エラー:' .$e->getMessage());
}

}

?>