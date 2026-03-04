<!-- http://localhost:8080/gyoza-fes_b/admin/admin_shops/menu_add.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT id,name FROM shops WHERE is_deleted = 0';
    $stmt = $db->prepare($sql);

    // SQLの実行
    $stmt->execute();

    $shops_name = $stmt->fetchALL(PDO::FETCH_ASSOC);



    $user_array = get_users_list();
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}


?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】メニュー - 新規追加</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="d-flex flex-column align-items-center m-5">
        <div>
            <!-- ここから「本文」-->

            <h1 class="my-5">メニュー - 新規追加</h1>
            <form action="menu_add_do.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">商品名</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="やばウマ餃子">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">個数</label>
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="（個は不要）">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">価格</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="（円は不要）">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">説明文</label>
                    <textarea name="description" id="description" class="form-control" rows="6" placeholder="おいしい餃子です。みんな食べてね～"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_file" class="form-label">画像ファイル</label>
                    <input type="file" name="image_file" id="image_file" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="mother_shop" class="form-label">出店店舗</label>
                    <select name="mother_shop" id="mother_shop">
                        <option value="">選択してください</option>
                        <?php foreach ($shops_name as $data): ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                        <?php endforeach; ?>
                </div>
                </select>
                <div class="mb-3">
                    <input type="submit" value="登録する" class="btn btn-primary">
                </div>
            </form>

            <footer class="text-center m-5 d-flex justify-content-center gap-5">
                <a href="./shops_list.php" class="btn btn-primary">店舗一覧に戻る</a>
                <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
            </footer>
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