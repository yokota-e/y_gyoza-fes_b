<!-- カン：2026/03/03 記述 -->
<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_menu/menu_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
?>


<!-------------------------------------------------------------------------
                            データベース処理
------------------------------------------------------------------------->
<?php
// menuテーブルから読み込み
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT id,name,is_deleted FROM menus ORDER BY id ASC';
    $stmt = $db->prepare($sql);
    // SQLの実行
    $stmt->execute();

    $menu_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー（contactテーブル読み込み時）:' . $e->getMessage());
}
?>




<!-------------------------------------------------------------------------
                            HTML本文
------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】メニュー一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="d-flex flex-column align-items-center m-5">
        <h1 class="text-center m-5">メニュー一覧</h1>
        <div class="card " style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <?php foreach ($menu_list as $menu_data): ?>
                    <!-- kan_to_do：is_detetedが１の時消えるか確認 -->
                    <?php if ($menu_data['is_deleted'] == 0): ?>
                        <li class="list-group-item"><a href="menu_detail.php?id=<?php echo h($menu_data['id']) ?>"><?php echo h($menu_data['name']) ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="d-block">
            <a href="menu_add.php" class="btn btn-outline-primary mt-4">メニューを追加する</a>
        </div>
        <div class="d-block">
            <a href="menu_deleted_list.php" class="btn btn-outline-secondary m-5">削除済みのメニューを復元する</a>
        </div>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>