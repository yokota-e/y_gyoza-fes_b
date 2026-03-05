<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_shops/news_deleted_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT id,title,is_deleted FROM news WHERE is_deleted = 1 ORDER BY id ASC';
    $stmt = $db->prepare($sql);


    // SQLの実行
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】削除済みのお知らせ一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">削除済みのお知らせ一覧</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card" style="width: 20rem;">
            <ul class="list-group list-group-flush">
                <?php if (count($result) == 0): ?>
                    <p>削除済みのお知らせはありません</p>
                <?php else: ?>
                    <?php foreach ($result as $news): ?>
                        <?php if ($news['is_deleted'] == 1): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <p><?php echo h($news['title']) ?></p>
                                <a href="news_restore_do.php?id=<?php echo h($news['id']) ?>" class="btn btn-outline-primary">復元する</a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
        <a href="news_list.php" class="btn btn-secondary mt-5">
            一覧へ戻る
        </a>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>