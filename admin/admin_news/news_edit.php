<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_news/news_edit.php?id= -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
// DBに接続

$id = $_GET['id'];

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT * FROM news WHERE id=:id';
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
    <title>【管理用】お知らせ詳細 - 変更</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="d-flex flex-column align-items-center m-5">
        <div>
            <h1 class="my-5">お知らせ詳細 - 編集</h1>
            <form action="news_edit_do.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo  h($target['title']); ?>">
                </div>

                <div class="mb-3 col-8">
                    <p>現在の画像<?php echo $target["image"] ?></p>
                    <p><img src="<?php echo "/y_gyoza-fes_b/img/" . $target['image'] ?>" alt="" class="w-50"></p>
                    <label for="image_file" class="form-label">画像ファイル</label>
                    <input type="file" name="image_file" id="image_file" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">本文</label>
                    <textarea name="body" id="body" class="form-control" rows="6"><?php echo h($target['body']); ?></textarea>
                </div>


                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
                    <input type="submit" value="変更する" class="btn btn-primary">
                </div>
            </form>
            <a href="../admin.php">管理者画面に戻る</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>