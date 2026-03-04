<!-- カン：2026/03/03 記述 -->
<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_menu/menu_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
$path_to_img = __DIR__ . "/../../img/";
?>

<?php
//メイン処理
if (!empty($_POST["id"])) {
    $id = $_POST["id"];
    // menusテーブルに登録
    try {
        $db = db_connect();
        $sql = 'UPDATE menus SET is_deleted= 1 WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        exit('エラー（shopsテーブルの削除時）: ' . $e->getMessage());
    }
    header('location:./menu_list.php');
}
?>