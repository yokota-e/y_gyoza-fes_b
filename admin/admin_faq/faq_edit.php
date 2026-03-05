<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
// DBに接続
// TODO: ID取得とバリデーション

$id = $_GET['id'];

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT id,category,question,answer FROM faq WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果セットを連想配列の形で取得
    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}

?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】よくある質問 - 変更</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="d-flex flex-column align-items-center m-5">
        <div>
            <!-- ここから「本文」-->

            <h1 class="my-5">よくある質問 - 編集</h1>
            <form action="faq_edit_do.php" method="post">

                <div class="mb-3">
                    <label for="category" class="form-label">カテゴリー</label>
                    <select name="category" id="category" require>
                        <option value="1" <?php echo $target["category"] == 1 ? "selected" : "" ?>>来場について</option>
                        <option value="2" <?php echo $target["category"] == 2 ? "selected" : "" ?>>会場について</option>
                        <option value="3" <?php echo $target["category"] == 3 ? "selected" : "" ?>>その他</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="question" class="form-label">質問</label>
                    <textarea name="question" id="question" class="form-control" rows="6"><?php echo h($target['question']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">答え</label>
                    <textarea name="answer" id="answer" class="form-control" rows="6"><?php echo h($target['answer']); ?></textarea>
                </div>

                <div class="mb-3">

                    <input type="submit" value="変更する" class="btn btn-primary">
                </div>
                <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
            </form>
            <a href="../admin.php" class="btn btn-primary">管理者画面に戻る</a>
            <!-- 本文ここまで -->
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>