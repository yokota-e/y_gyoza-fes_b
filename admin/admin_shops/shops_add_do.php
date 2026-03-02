<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

$created_user_id = $_SESSION['id'];

if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['booth']) && !empty($_POST['tel']) && !empty($_POST['address'])) {

        $name = $_POST['name'];
        $description = $_POST['description'];
        $booth = $_POST['booth'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];


        // TO DO 正規表現のチェック
        // if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
        //     header('location:shops_add.php');
        //     exit();
        // }

        // TODO: 店舗名が重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(name) FROM shops WHERE name=:name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM); //キーが連番の配列で取り出す

            if ($result[0] !== 0) {
                header('location:shops_add.php');
                exit();
            }

            // shopsテーブルに登録
            $sql_2 = 'INSERT INTO shops (name,description,booth,tel,address,created_at,created_user_id) VALUES (:name,:description,:booth,:tel,:address,now(),:created_user_id)';
            $stmt_2 = $db->prepare($sql_2);

            $stmt_2->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt_2->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt_2->bindParam(':booth', $booth, PDO::PARAM_STR);
            $stmt_2->bindParam(':tel', $tel, PDO::PARAM_STR);
            $stmt_2->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt_2->bindParam(':created_user_id', $created_user_id, PDO::PARAM_INT);

            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}


header('location:./shops_list.php');
