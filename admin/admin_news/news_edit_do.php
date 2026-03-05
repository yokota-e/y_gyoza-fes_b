<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
$path_to_img = __DIR__ . "/../../img/";
$param = date("YmdHis");
$param .= mt_rand();



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

            if (!is_uploaded_file($_FILES["image_file"]["tmp_name"])) {
                //newsテーブルからファイル名取得
                try {
                    $db = db_connect();
                    $sql = 'SELECT image FROM news WHERE id=:id';
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                    $stmt->execute();

                    $news_file_name = $stmt->fetchColumn();
                } catch (PDOException $e) {
                    exit('エラー（newsテーブルからファイル名取得）: ' . $e->getMessage());
                }
            } else {
                $image_tmp_path = $_FILES["image_file"]["tmp_name"];
                //ファイル命名処理
                $size = getimagesize($image_tmp_path);
                switch ($size[2]) {
                    case IMAGETYPE_JPEG:
                        $file_type = ".jpg";
                        break;

                    case IMAGETYPE_PNG:
                        $file_type = ".png";
                        break;

                    case IMAGETYPE_WEBP:
                        $file_type = ".webp";
                        break;

                    default:
                        $error_message .= "ファイルが画像ではありません";
                        $error_num = 32;
                        break;
                }
                $news_file_name = $param . "_" . "news" . $id . $file_type;
                if (!move_uploaded_file($image_tmp_path, $path_to_img . $news_file_name)) {
                    $error_message .= "ファイルのアップロードに失敗しました。";
                    $error_num = 50;
                }
            }

            // newsテーブルに登録

            $sql_2 = 'UPDATE news SET user_id=:user_id,title=:title,image=:image,body=:body, date=now() WHERE id=:id';

            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt_2->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt_2->bindParam(':image', $news_file_name, PDO::PARAM_STR);
            $stmt_2->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt_2->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:news_detail.php?id=' . $id);
