<!-- カン：2026/03/02 記述 -->
<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_form/form_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
?>


<!-------------------------------------------------------------------------
                    エラー処理と情報受け取り処理 
------------------------------------------------------------------------->
<?php
//外部キー対応配列の取得
$state_array = get_state_list();
$user_array = get_users_list();
//エラー用の変数宣言
$error_message = "";
$error_num = 0;

if (empty($_POST)) {
    $error_message = "POST通信ができていません";
    $error_num = 1;
}
if (empty($_POST['id'])) {
    $error_message = "IDが取得できていません";
    $error_num = 2;
} else {
    $id = $_POST["id"];
}
if (empty($_POST["status"])) {
    $error_message = "ステータス番号が取得できていません";
    $error_num = 3;
} else {
    $staus_num = $_POST["status"];
}
if (empty($_SESSION["id"])) {
    $error_message = "セッションの情報（ユーザーのID）を取得できていません";
    $error_num = 4;
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
        <title>【管理用】お問い合わせ担当編集</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
        <main>
            <div class="card shadow mt-5">
                <div class="card-header bg-danger text-white text-center fs-3">エラー！エラーナンバー：<?php echo $error_num ?></div>
                <div class="card-body">
                    <h2><?php echo $error_message ?></h2>
                    <a href="form_list.php" class="btn btn-secondary me-3">
                        一覧へ戻る
                    </a>
                </div>
            </div>
        </main>
    </body>

    </html>
<?php endif; ?>




<!-------------------------------------------------------------------------
                        データベース変更処理
------------------------------------------------------------------------->
<?php
if ($error_num == 0) {
    try {
        $db = db_connect();
        $sql = 'UPDATE contacts SET support_date=NOW(), admin_name=:admin_name, status=:status WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':admin_name', $now_user_num, PDO::PARAM_INT);
        $stmt->bindParam(':status', $staus_num, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        exit('エラー（データベース変更時での）： ' . $e->getMessage());
    }
    header("location:form_list.php");
    exit();
}
?>