<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['id'])) {

        $id = $_POST['id'];



        try {
            // DBへ接続
            $db = db_connect();
            // プリペアードステートメント作成
            $sql = 'SELECT id,is_deleted FROM shops WHERE :id = id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // SQLの実行
            $stmt->execute();
            $deleted_check = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit('エラー:' . $e->getMessage());
        }



        // 復元したい時
        if ($deleted_check['is_deleted'] = 1) {
            try {
                $db = db_connect();
                // usersテーブルから1行削除するSQL
                $sql = 'UPDATE shops SET is_deleted= 0 WHERE id = :id';
                $stmt = $db->prepare($sql);
                // idをプレースホルダへバインド
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // トップページへ画面遷移
                header('location:./shops_list.php');
                exit();
            } catch (PDOException $e) {
                exit('エラー: ' . $e->getMessage());
            }
        }


        // 削除したい時

        if ($deleted_check['is_deleted'] = 0) {
            try {
                $db = db_connect();
                // usersテーブルから1行削除するSQL
                $sql = 'UPDATE shops SET is_deleted= 1 WHERE id = :id';
                $stmt = $db->prepare($sql);
                // idをプレースホルダへバインド
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                // トップページへ画面遷移
                header('location:./shops_list.php');
                exit();
            } catch (PDOException $e) {
                exit('エラー: ' . $e->getMessage());
            }
        }
    }
}
header('location:./shops_list.php');
