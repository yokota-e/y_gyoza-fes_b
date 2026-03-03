<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['id'])) {

        $id = $_POST['id'];

        // DBに接続
        try {
            $db = db_connect();
            // usersテーブルから1行削除するSQL
            $sql = 'UPDATE news SET is_deleted= 1 WHERE id = :id';
            $stmt = $db->prepare($sql);
            // idをプレースホルダへバインド
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // トップページへ画面遷移
            header('location:news_list.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:/news_list.php');
