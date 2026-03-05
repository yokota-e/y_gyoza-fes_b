<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

if (!empty($_POST)) {
    if (!empty($_POST['category']) && !empty($_POST['question']) && !empty($_POST['answer'])) {
        $id = $_POST['id'];
        $category = $_POST['category'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        // $user_id = $_SESSION['id'];

        // タイトルが重複していないかチェック
        try {
            $db = db_connect();
            // newsテーブルに登録

            $sql = 'UPDATE faq SET category=:category,question=:question,answer=:answer WHERE id=:id';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:faq_detail.php?id=' . $id);
