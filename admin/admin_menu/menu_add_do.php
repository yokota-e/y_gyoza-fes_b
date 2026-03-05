<!-- カン：2026/03/03 記述 -->
<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_menu/menu_add.php -->

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
$error_num_ary = array();
$error_num_ary[0] = 0;

//menuテーブルの列数取得
try {
    $db = db_connect();
    $sql = "SELECT COUNT(id) FROM menus";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $total_row_num = $stmt->fetchColumn();
    $table_row_new_num = $total_row_num + 1;
} catch (PDOException $e) {
    exit('エラー（shopsテーブルの列数取得時）: ' . $e->getMessage());
}

//menusテーブルの重複確認
try {
    $db = db_connect();
    $sql = 'SELECT COUNT(name) FROM menus WHERE name=:name';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    if ($result[0] !== 0) {
        $error_message .= "メニュー名が同じものが登録されています！！！";
        $error_num_ary[1] = 1;
        $error_num_ary[0] = 1;
    }
} catch (PDOException $e) {
    exit('エラー（shopsテーブルの重複確認時）: ' . $e->getMessage());
}

if (empty($_POST)) {
    $error_message .= "POST通信ができていません/";
    $error_num_ary[10] = 10;
    $error_num_ary[0] = 1;
}
if (empty($_POST['name'])) {
    $error_message .= "商品名が入力できていません/";
    $error_num_ary[12] = 12;
    $error_num_ary[0] = 1;
} else {
    $menu_name = $_POST["name"];
}
if (empty($_POST["amount"])) {
    $error_message .= "商品個数が入力できていません/";
    $error_num_ary[13] = 13;
    $error_num_ary[0] = 1;
} else {
    $menu_amount = intval($_POST["amount"]);
    if (is_int($menu_amount) && ($menu_amount > 0)) {
    } else {
        $error_message .= "商品個数は正の値で整数値を入力してください/";
        $error_num_ary[60] = 60;
        $error_num_ary[0] = 1;
    }
}
if (empty($_POST["price"])) {
    $error_message .= "商品の値段が入力できていません/";
    $error_num_ary[14] = 14;
    $error_num_ary[0] = 1;
} else {
    $menu_price = intval($_POST["price"]);
    if (is_int($menu_price) && ($menu_price > 0)) {
    } else {
        $error_message .= "商品の値段は正の値で整数値を入力してください/";
        $error_num_ary[61] = 61;
        $error_num_ary[0] = 1;
    }
}
if (empty($_POST["description"])) {
    $error_message .= "商品詳細が入力できていません/";
    $error_num_ary[15] = 15;
    $error_num_ary[0] = 1;
} else {
    $menu_desc = $_POST["description"];
}
if (empty($_POST["mother_shop"])) {
    $error_message .= "所属店舗が入力されていません/";
    $error_num_ary[16] = 16;
    $error_num_ary[0] = 1;
} else {
    $mother_shop = $_POST["mother_shop"];
}
if (empty($_FILES)) {
    $error_message .= "FILE通信ができていません/";
    $error_num_ary[30] = 30;
    $error_num_ary[0] = 1;
}
if (!is_uploaded_file($_FILES["image_file"]["tmp_name"])) {
    $error_message .= "ファイルをアップロードしてください(tmpファイルがないです)/";
    $error_num_ary[31] = 31;
    $error_num_ary[0] = 1;
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
            $file_type = ".error";
            $error_message .= "ファイルが画像ではありません";
            $error_num_ary[32] = 32;
            $error_num_ary[0] = 1;
            break;
    }
    $new_file_name =  $param . "_" . "menu" . $table_row_new_num . $file_type;
    if (!move_uploaded_file($image_tmp_path, $path_to_img . $new_file_name)) {
        $error_message .= "ファイルのアップロードに失敗しました。";
        $error_num_ary[50] = 50;
        $error_num_ary[0] = 1;
    }
}

if (empty($_SESSION["id"])) {
    $error_message .= "セッションの情報（ユーザーのID）を取得できていません";
    $error_num_ary[40] = 40;
    $error_num_ary[0] = 1;
} else {
    $now_user_num = $_SESSION["id"];
}
?>
<!-- エラー表示処理 -->
<?php if ($error_num_ary[0] !== 0): ?>
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
                <div class="card-header bg-danger text-white text-center fs-3">エラー！エラーナンバー：<?php echo implode("/", array_slice($error_num_ary, 1)) ?></div>
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
if ($error_num_ary[0] == 0) {
    // menusテーブルに登録
    try {
        $sql = 'INSERT INTO menus (id,name,amount,price,description,image,created_at,created_user_id,mother_shop) VALUES (:id,:name,:amount,:price,:description,:image_name,NOW(),:created_user_id,:mother_shop)';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $table_row_new_num, PDO::PARAM_INT);
        $stmt->bindParam(':name', $menu_name, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $menu_amount, PDO::PARAM_INT);
        $stmt->bindParam(':price', $menu_price, PDO::PARAM_INT);
        $stmt->bindParam(':description', $menu_desc, PDO::PARAM_STR);
        $stmt->bindParam(':image_name', $new_file_name, PDO::PARAM_STR);
        $stmt->bindParam(':created_user_id', $now_user_num, PDO::PARAM_INT);
        $stmt->bindParam(':mother_shop', $mother_shop, PDO::PARAM_INT);

        $stmt->execute();
    } catch (PDOException $e) {
        exit('エラー（shopsテーブルに登録時）: ' . $e->getMessage());
    }
    header('location:./menu_list.php');
}
?>