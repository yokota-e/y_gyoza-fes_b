<?php
require_once __DIR__ . '/../../function/function.php';
// DBに接続
// TODO: ID取得とバリデーション

if (!empty($_POST)) {

    // 必須項目が入力されているかチェック
    if (!empty($_POST['name']) && !empty($_POST['id'])) {
        // $_POSTから値を取り出す

        $name = $_POST['name'];
        $password = $_POST['password'];
        $id = (int)$_POST['id'];
        echo $password;
        // ユーザー名の書式チェック(半角英数4文字以上)
        if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
            header('location:user_edit.php');
            exit();
        }
        // ユーザー名が重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(name) FROM users WHERE name=:name AND id!=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM);
            if ($result[0] !== 0) {
                header('location:user_edit.php');
                exit();
            }
            // パスワードが入力されたときだけパスワードをハッシュ化
            if (!empty($password)) {
                $password_h = password_hash($password, PASSWORD_DEFAULT);
            }
            // usersテーブルに登録
            if (!empty($password)) {
                $sql_2 = 'UPDATE users SET name=:name,password=:password WHERE id=:id';
            } else {
                $sql_2 = 'UPDATE users SET name=:name WHERE id=:id';
            }
            
            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':name', $name, PDO::PARAM_STR);
            if (!empty($password)) {
                $stmt_2->bindParam(':password', $password_h, PDO::PARAM_STR);
            }
            $stmt_2->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:../admin.php');