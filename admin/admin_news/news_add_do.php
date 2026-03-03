<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';




if (!empty($_POST)) {

    if (!empty($_POST['title']) && !empty($_POST['body'])) {

        $title = $_POST['title'];
        $body = $_POST['body'];


        $user_array = get_users_list();
        $user_id = $_SESSION['id'];


        // タイトルが重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(title) FROM news WHERE title=:title';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM); //キーが連番の配列で取り出す

            if ($result[0] !== 0) {
                header('location:news_add.php');
                exit();
            }

            // 今から登録するレコードのIDを、画像のファイル名に入れ込みたい
            // レコードIDを取得
            $sql = 'SELECT id FROM news ORDER BY id DESC LIMIT 1';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $latestRecord = $stmt->fetch(PDO::FETCH_ASSOC);
            $imageId = $latestRecord['id'] + 1;

            $msg = null;
            $alert = null;
            if (isset($_FILES["image"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {

                $old_name = $_FILES["image"]["tmp_name"];
                $new_name = 'news_img ' . $imageId;
                $size = getimagesize($_FILES["image"]["tmp_name"]);
                switch ($size[2]) {
                    case IMAGETYPE_JPEG:
                        $new_name .= ".jpg";
                        break;
                    case IMAGETYPE_GIF:
                        $new_name .= ".gif";
                        break;
                    case IMAGETYPE_PNG:
                        $new_name .= ".png";
                        break;
                    case IMAGETYPE_WEBP:
                        $new_name .= ".webp";
                        break;
                    default:
                        header("location: upload.php");
                        exit();
                }

                move_uploaded_file($old_name, '../../img/' . $new_name);
            }



            // newsテーブルに登録

            $sql_2 = 'INSERT INTO news (user_id,title,image,body,date) VALUES (:user_id,:title,:image,:body,now()) ';
            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_2->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt_2->bindParam(':image', $new_name, PDO::PARAM_STR);
            $stmt_2->bindParam(':body', $body, PDO::PARAM_STR);

            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:news_list.php');
