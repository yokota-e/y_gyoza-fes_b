<!-- http://localhost:8080/gyoza-fes_b/admin/admin_shops/news_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT id,user_id,title,date,is_deleted FROM news ORDER BY id ASC';
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
    <title>【管理用】お知らせ一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">お知らせ一覧</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card " style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <?php foreach ($result as $news): ?>
                    <?php if ($news['is_deleted'] == 0): ?>
                        <li class="list-group-item"><a href="news_detail.php?id=<?php echo h($news['id']) ?>"><?php echo h($news['title']) ?></a>
                            <p><?php echo date('Y年m月d日',  strtotime(h($news['date']))) ?></p>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="d-block">
            <a href="news_add.php" class="btn btn-outline-primary mt-4">お知らせを追加する</a>
        </div>
        <div class="d-block">
            <a href="news_deleted_list.php" class="btn btn-outline-secondary m-5">削除済みのお知らせを復元する</a>
        </div>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>