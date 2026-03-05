<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


if (!empty($_GET)) {

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];

        $db = db_connect();
        $sql = 'SELECT id,is_deleted FROM shops WHERE :id = id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $deleted_check = $stmt->fetch(PDO::FETCH_ASSOC);

        // 復元したい時
        if ($deleted_check['is_deleted'] == 1) {
            try {
                $db = db_connect();
                $sql = 'UPDATE shops SET is_deleted= 0 WHERE id = :id';
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                header('location:./shops_list.php');
                exit();
            } catch (PDOException $e) {
                exit('エラー: ' . $e->getMessage());
            }
        }
    }
}
header('location:./shops_list.php');
