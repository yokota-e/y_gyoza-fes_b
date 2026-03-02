<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

// TODO: データ受け取り
if (!empty($_SESSION)) {
    // POST送信されたとき
    if (!empty($_SESSION['id'])) {
        // TODO: idのチェック（空の場合）
        $id = $_SESSION['id'];
      
        // DBに接続
        try {
            $db = db_connect();
            // usersテーブルから1行削除するSQL
            $sql = 'UPDATE users SET is_deleted= 1 WHERE id = :id';
            $stmt = $db->prepare($sql);
            // idをプレースホルダへバインド
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // トップページへ画面遷移
            header('location:../admin.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: '.$e->getMessage());
        }
    }
}
header('location:../login.php');
