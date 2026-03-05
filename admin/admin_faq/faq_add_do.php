<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

$created_user_id = $_SESSION['id'];

if (!empty($_POST)) {
    if (!empty($_POST['category']) && !empty($_POST['question']) && !empty($_POST['answer']) ) {

        $category = $_POST['category'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];


        // TO DO 正規表現のチェック
        // if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
        //     header('location:shops_add.php');
        //     exit();
        // }

        // TODO: 店舗名が重複していないかチェック
        try {
            $db = db_connect();
            // faqテーブルに登録
            $sql = 'INSERT INTO faq(category , question , answer) VALUES (:category,:question,:answer)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:./faq_list.php');