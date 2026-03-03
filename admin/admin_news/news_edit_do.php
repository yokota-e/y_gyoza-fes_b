<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';




if (!empty($_POST)) {

    if (!empty($_POST['title']) && !empty($_POST['body'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $body = $_POST['body'];


        $user_array = get_users_list();
        $user_id = $_SESSION['id'];

        // タイトルが重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(title) FROM news WHERE title=:title AND id!=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM); //キーが連番の配列で取り出す

            if ($result[0] !== 0) {
                header('location:news_edit.php?id=' . $id);
                exit();
            }

            // newsテーブルに登録

            $sql_2 = 'UPDATE news SET user_id=:user_id,title=:title,body=:body, date=now() WHERE id=:id';

            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt_2->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt_2->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt_2->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:news_detail.php?id=' . $id);
