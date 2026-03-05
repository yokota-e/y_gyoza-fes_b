<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_faq/faq_detail.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

$id = $_GET['id'];

try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM faq WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // SQLの実行
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}

//外部キー対応配列の取得
$category_array = get_categories_list();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】よくある質問詳細</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center m-5">よくある質問詳細</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card " style="width: 25rem;">
            <div class="card-body">
                <form action="faq_del_do.php" method="post" onsubmit="return confirm('削除してよろしいですか？')">
                    <dl class="list-group list-group-flush">
                        <dt>ID</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['id']) ?>
                            <input type="hidden" name="id" value="<?php echo h($result['id']) ?>">
                        </dd>
                        <dt>カテゴリー</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($category_array[$result["category"]]) ?>
                            <input type="hidden" name="category" value="<?php echo h($result['category']) ?>">
                        </dd>

                        <dt>質問内容</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['question']) ?>
                            <input type="hidden" name="question" value="<?php echo h($result['question']) ?>">
                        </dd>

                        <dt>答え</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['answer']) ?>
                            <input type="hidden" name="answer" value="<?php echo h($result['answer']) ?>">
                        </dd>
                    </dl>
            </div>
        </div>

        <a href="faq_edit.php?id=<?php echo $id ?>" class="btn btn-outline-primary mt-5">よくある質問を編集する</a>
        <input type="submit" value="この質問を削除する" class="btn btn-outline-danger m-5">
        </form>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>