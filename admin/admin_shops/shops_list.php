<!-- http://localhost:8080/gyoza-fes_b/admin/admin_shops/shops_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT id,name FROM shops ORDER BY id ASC';
    $stmt = $db->prepare($sql);


    // SQLの実行
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】店舗一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">店舗一覧</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card " style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <?php foreach ($result as $shop): ?>
                    <li class="list-group-item"><a href="shops_detail.php?id=<?php echo $shop['id'] ?>"><?php echo $shop['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="d-block">
            <a href="shops_add.php" class="btn btn-outline-primary m-5">店舗を追加する</a>
        </div>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>