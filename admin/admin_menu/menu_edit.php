<!-- http://localhost:8080/gyoza-fes_b/admin/admin_news/news_edit.php?id= -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
$path_to_img = __DIR__ . "/../../img/";


$id = $_GET['id'];
try {
    $db = db_connect();
    $sql = 'SELECT * FROM menus WHERE id=:id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
}

try {
    $db = db_connect();
    $sql = 'SELECT id,name FROM shops WHERE is_deleted = 0';
    $stmt = $db->prepare($sql);
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
    <title>【管理用】メニュー - 編集</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="row">
            <h1 class="my-5">メニュー - 編集</h1>
            <form action="menu_edit_do.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo h($target["id"]) ?>">
                    <label for="name" class="form-label">商品名</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo h($target["name"]) ?>">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">個数</label>
                    <input type="text" name="amount" id="amount" class="form-control" value="<?php echo h($target["amount"]) ?>"">
                </div>
                <div class=" mb-3">
                    <label for="price" class="form-label">価格</label>
                    <input type="text" name="price" id="price" class="form-control" value="<?php echo h($target["price"]) ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">説明文</label>
                    <textarea name="description" id="description" class="form-control" rows="6"><?php echo h($target["description"]) ?></textarea>
                </div>
                <div class="mb-3 col-8">
                    <p>現在の画像<?php echo $target["image"] ?></p>
                    <!-- <p><img src="<?php echo "/y_gyoza-fes_b/img/" . $target['image'] ?>" alt="" class="w-50"></p> -->
                    <label for="image_file" class="form-label">画像ファイル</label>
                    <input type="file" name="image_file" id="image_file" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="mother_shop" class="form-label">出店店舗</label>
                    <select name="mother_shop" id="mother_shop">
                        <option value="">選択してください</option>
                        <?php foreach ($shops_name as $data): ?>
                            <option value="<?php echo h($data['id']) ?>" <?php echo $data['id'] ==  $target["mother_shop"] ? "selected" : "" ?>><?php echo h($data['name']) ?></option>
                        <?php endforeach; ?>
                </div>
                </select>
                <div class="mb-3">
                    <input type="submit" value="編集する" class="btn btn-primary">
                </div>
            </form>

            <footer class="text-center m-5 d-flex justify-content-center gap-5">
                <a href="./menu_list.php" class="btn btn-primary">メニュー一覧に戻る</a>
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