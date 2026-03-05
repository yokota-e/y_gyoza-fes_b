<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
$path_to_img = __DIR__ . "/../../img/";
$param = date("YmdHis");
$param .= mt_rand();
?>


<!-------------------------------------------------------------------------
                    エラー処理と情報受け取り処理 
------------------------------------------------------------------------->
<?php
//エラー用の変数宣言
$error_message = "";
$error_num = 0;
$id = $_POST["id"];
//menusテーブルの重複確認
try {
    $db = db_connect();
    $sql = 'SELECT COUNT(name) FROM menus WHERE name=:name AND id!=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result[0] !== 0) {
        $error_message .= "メニュー名が同じものが登録されています！！！";
        $error_num = 1;
    }
} catch (PDOException $e) {
    exit('エラー（menusテーブルの重複確認時）: ' . $e->getMessage());
}

if (empty($_POST)) {
    $error_message .= "POST通信ができていません/";
    $error_num = 10;
}
if (empty($_POST['id'])) {
    $error_message .= "idが取得できていません/";
    $error_num = 11;
} else {
    $id = $_POST["id"];
}
if (empty($_POST['name'])) {
    $error_message .= "商品名が取得できていません/";
    $error_num = 12;
} else {
    $menu_name = $_POST["name"];
}
if (empty($_POST["amount"])) {
    $error_message .= "商品個数が取得できていません/";
    $error_num = 13;
} else {
    $menu_amount = $_POST["amount"];
}
if (empty($_POST["price"])) {
    $error_message .= "商品の値段が取得できていません/";
    $error_num = 14;
} else {
    $menu_price = $_POST["price"];
}
if (empty($_POST["description"])) {
    $error_message .= "商品詳細が取得できていません/";
    $error_num = 15;
} else {
    $menu_desc = $_POST["description"];
}
if (empty($_FILES)) {
    $error_message .= "FILE通信ができていません/";
    $error_num = 30;
}
if (!is_uploaded_file($_FILES["image_file"]["tmp_name"])) {
    //menusテーブからファイル名取得
    try {
        $db = db_connect();
        $sql = 'SELECT image FROM menus WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        // $menu_file_name = $param;
        $menu_file_name = $stmt->fetchColumn();
    } catch (PDOException $e) {
        exit('エラー（menusテーブからファイル名取得時）: ' . $e->getMessage());
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
    $menu_file_name = $param . "_" . "menu" . $id . $file_type;
    if (!move_uploaded_file($image_tmp_path, $path_to_img . $menu_file_name)) {
        $error_message .= "ファイルのアップロードに失敗しました。";
        $error_num = 50;
    }
}

if (empty($_SESSION["id"])) {
    $error_message .= "セッションの情報（ユーザーのID）を取得できていません";
    $error_num = 40;
} else {
    $now_user_num = $_SESSION["id"];
}

if (empty($_POST["mother_shop"])) {
    $error_message .= "所属店舗が選択されていません";
    $error_num = 16;
} else {
    $mother_shop = $_POST["mother_shop"];
}

?>
<!-- エラー表示処理 -->
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



<!-------------------------------------------------------------------------
                        データベース追加処理
------------------------------------------------------------------------->
<?php
//メイン処理
if ($error_num == 0) {
    // menusテーブルに登録
    try {
        $sql = 'UPDATE menus SET name=:name, amount=:amount, price=:price, description=:description, image=:image, updated_at=NOW(), updated_user_id=:updated_user_id, mother_shop=:mother_shop WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $menu_name, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $menu_amount, PDO::PARAM_INT);
        $stmt->bindParam(':price', $menu_price, PDO::PARAM_INT);
        $stmt->bindParam(':description', $menu_desc, PDO::PARAM_STR);
        $stmt->bindParam(':image', $menu_file_name, PDO::PARAM_INT);
        $stmt->bindParam(':updated_user_id', $now_user_num, PDO::PARAM_INT);
        $stmt->bindParam(':mother_shop', $mother_shop, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        exit('エラー（menusテーブルの更新時）: ' . $e->getMessage());
    }
    header('location:./menu_list.php');
}
?>