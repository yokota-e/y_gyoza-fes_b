<?php
require_once __DIR__ . '/../../function/function.php';

session_start();


if (!empty($_POST)) {

    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['booth']) && !empty($_POST['tel'])  && !empty($_POST['address'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $booth = $_POST['booth'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];

        $_SESSION['shops_edit'] = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'booth' => $booth,
            'tel' => $tel,
            'address' => $address,

        ];

        // TODO: 書式、正規表現のチェック追加

        // ブース番号が重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(booth) FROM shops WHERE booth=:booth AND id!=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':booth', $booth, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM); //キーが連番の配列で取り出す

            if ($result[0] !== 0) {
                header('location:shops_edit.php?id=' . $id);
                exit();
            }

            // shopsテーブルに登録

            $sql_2 = 'UPDATE shops SET name=:name,description=:description,booth=:booth,tel=:tel,address=:address  WHERE id=:id';

            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt_2->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt_2->bindParam(':booth', $booth, PDO::PARAM_STR);
            $stmt_2->bindParam(':tel', $tel, PDO::PARAM_STR);
            $stmt_2->bindParam(':address', $address, PDO::PARAM_STR);

            $stmt_2->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:shops_detail.php?id=' . $id);
