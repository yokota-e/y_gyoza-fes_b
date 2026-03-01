<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
// DBに接続
// TODO: ID取得とバリデーション

$id = $_GET['id'];

// DB接続
try {
    $db = db_connect();
    $sql = 'SELECT id,name,description,booth,tel,address FROM shops WHERE id=:id';
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
    <title>【管理用】店舗詳細 - 変更</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="d-flex flex-column align-items-center m-5">
        <div>
            <!-- ここから「本文」-->

            <h1 class="my-5">店舗詳細 - 編集</h1>
            <form action="shops_edit_do.php" method="post">

                <div class="mb-3">
                    <label for="name" class="form-label">店舗名</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $target['name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">店舗詳細文</label>
                    <textarea name="description" id="description" class="form-control" rows="6"><?php echo $target['description']; ?>
                    </textarea>
                </div>

                <div class="mb-3">
                    <label for="booth" class="form-label">ブース番号</label>
                    <input type="text" name="booth" id="booth" class="form-control" value="<?php echo $target['booth']; ?>">
                </div>

                <div class="mb-3">
                    <label for="tel" class="form-label">電話番号</label>
                    <input type="tel" name="tel" id="tel" class="form-control" value="<?php echo $target['tel']; ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $target['address']; ?>">
                </div>

                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
                    <input type="submit" value="変更する" class="btn btn-primary">
                </div>
            </form>
            <a href="../admin.php">管理者画面に戻る</a>
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