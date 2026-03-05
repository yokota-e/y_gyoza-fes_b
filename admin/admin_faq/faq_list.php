<!-- http://localhost:8080/y_gyoza-fes_b/admin/faq_shops/shops_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成➀
    $sql_1 = 'SELECT id,category,question,is_deleted FROM faq WHERE category = :category ORDER BY id ASC;';
    $stmt_1 = $db->prepare($sql_1);
    // SQLの実行
    $stmt_1->execute(['category' => 1]);

    $visitor = $stmt_1->fetchAll(PDO::FETCH_ASSOC);

    // プリペアードステートメント作成➁
    $sql_2 = 'SELECT id,category,question,is_deleted FROM faq WHERE category = :category ORDER BY id ASC;';
    $stmt_2 = $db->prepare($sql_2);
    // SQLの実行
    $stmt_2->execute(['category' => 2]);

    $hall = $stmt_2->fetchAll(PDO::FETCH_ASSOC);

    // プリペアードステートメント作成➂
    $sql_3 = 'SELECT id,category,question,is_deleted FROM faq WHERE category = :category ORDER BY id ASC;';
    $stmt_3 = $db->prepare($sql_3);
    // SQLの実行
    $stmt_3->execute(['category' => 3]);

    $other = $stmt_3->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}
?>
<!DOCTYPE html>
<lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>【管理用】よくある質問一覧</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    </head>

    <body>
        <h1 class="text-center m-5">よくある質問一覧</h1>
        <main class="d-flex flex-column align-items-center m-5">
            <div class="l-faq-bg">
                <h2 class="l-faq-about mt-4">来場について</h2>
            </div>
            <div class="card " style="width: 25rem;">
                <ul class="list-group list-group-flush">
                    <?php foreach ($visitor as $faq): ?>
                        <?php if ($faq['is_deleted'] == 0): ?>
                            <li class="list-group-item"><a href="faq_detail.php?id=<?php echo h($faq['id']) ?>"><?php echo h($faq['question']) ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="l-faq-bg">
                <h2 class="l-faq-about mt-4">会場について</h2>
            </div>
            <div class="card " style="width: 25rem;">
                <ul class="list-group list-group-flush">
                    <?php foreach ($hall as $faq): ?>
                        <?php if ($faq['is_deleted'] == 0): ?>
                            <li class="list-group-item"><a href="faq_detail.php?id=<?php echo h($faq['id']) ?>"><?php echo h($faq['question']) ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="l-faq-bg">
                <h2 class="l-faq-about mt-4">その他</h2>
            </div>
            <div class="card " style="width: 25rem;">
                <ul class="list-group list-group-flush">
                    <?php foreach ($other as $faq): ?>
                        <?php if ($faq['is_deleted'] == 0): ?>
                            <li class="list-group-item"><a href="faq_detail.php?id=<?php echo h($faq['id']) ?>"><?php echo h($faq['question']) ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="d-block">
                <a href="faq_add.php" class="btn btn-outline-primary mt-4">よくある質問を追加する</a>
            </div>
            <div class="d-block">
                <a href="faq_deleted_list.php" class="btn btn-outline-secondary m-5">削除済みのよくある質問を復元する</a>
            </div>
        </main>
        <footer class="text-center m-5">
            <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
        </footer>
    </body>