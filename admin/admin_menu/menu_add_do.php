<!-- カン：2026/03/03 記述 -->
<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_menu/menu_add.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
?>


<!-------------------------------------------------------------------------
                    エラー処理と情報受け取り処理 
------------------------------------------------------------------------->
<?php
//外部キー対応配列の取得
$user_array = get_users_list();
//エラー用の変数宣言
$error_message = "";
$error_num = 0;

try {
    $db = db_connect();
    $sql = 'SELECT COUNT(name) FROM menus WHERE name=:name';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result[0] !== 0) {
        $error_message = "メニュー名が同じものが登録されています！！！";
        $error_num = 1;
    }
} catch (PDOException $e) {
    exit('エラー（shopsテーブルの重複確認時）: ' . $e->getMessage());
}

if (empty($_POST)) {
    $error_message = "POST通信ができていません/";
    $error_num = 10;
}
if (empty($_POST['name'])) {
    $error_message = "商品名が取得できていません/";
    $error_num = 12;
} else {
    $menu_name = $_POST["name"];
}
if (empty($_POST["amount"])) {
    $error_message = "商品個数が取得できていません/";
    $error_num = 13;
} else {
    $menu_amount = $_POST["amount"];
}
if (empty($_POST["price"])) {
    $error_message = "商品の値段が取得できていません/";
    $error_num = 14;
} else {
    $menu_price = $_POST["price"];
}
if (empty($_POST["description"])) {
    $error_message = "商品詳細が取得できていません/";
    $error_num = 15;
} else {
    $menu_desc = $_POST["description"];
}
if (empty($_FILES)) {
    $error_message = "FILE通信ができていません/";
    $error_num = 30;
}
if (empty($_FILES["image_file"]["name"])) {
    $error_message = "ファイル名が取得できていません/";
    $error_num = 31;
} else {
    $image_mame = $_FILES["image_file"]["name"];
}
if (empty($_FILES["image_file"]["tmp_name"])) {
    $error_message = "ファイルがアップロードできていません/";
    $error_num = 32;
} else {
    $image_tmp_path = $_FILES["image_file"]["tmp_name"];
}

if (empty($_SESSION["id"])) {
    $error_message = "セッションの情報（ユーザーのID）を取得できていません";
    $error_num = 40;
} else {
    $now_user_num = $_SESSION["id"];
}
?>
<?php if ($error_num !== 0): ?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>【管理用】メニュー追加</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
        <main>
            <div class="card shadow mt-5">
                <div class="card-header bg-danger text-white text-center fs-3">エラー！エラーナンバー：<?php echo $error_num ?></div>
                <div class="card-body">
                    <h2><?php echo $error_message ?></h2>
                    <a href="menu_list.php" class="btn btn-secondary me-3">
                        一覧へ戻る
                    </a>
                </div>
            </div>
        </main>
    </body>

    </html>
<?php endif; ?>

<?php PrintDebug($menu_name); ?>
<?php PrintDebug($menu_amount); ?>
<?php PrintDebug($menu_price); ?>
<?php PrintDebug($menu_desc); ?>
<?php PrintDebug($image_mame); ?>
<?php PrintDebug($image_tmp_path); ?>
<?php PrintDebug($now_user_num); ?>

<!-------------------------------------------------------------------------
                        データベース追加処理
------------------------------------------------------------------------->
<?php
// if ($error_num == 0) {
//     try {
//         // shopsテーブルに登録
//         $sql = 'INSERT INTO menus (name,description,booth,tel,address,created_at,created_user_id) VALUES (:name,:description,:booth,:tel,:address,now(),:created_user_id)';
//         $stmt = $db->prepare($sql);

//         $stmt->bindParam(':name', $name, PDO::PARAM_STR);
//         $stmt->bindParam(':description', $description, PDO::PARAM_STR);
//         $stmt->bindParam(':booth', $booth, PDO::PARAM_STR);
//         $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
//         $stmt->bindParam(':address', $address, PDO::PARAM_STR);
//         $stmt->bindParam(':created_user_id', $created_user_id, PDO::PARAM_INT);

//         $stmt->execute();
//     } catch (PDOException $e) {
//         exit('エラー（shopsテーブルに登録時）: ' . $e->getMessage());
//     }
// }
?>