<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_shops/shops_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
$path_to_img = __DIR__ . "/../../img/";

$id = $_GET['id'];
$user_array = get_users_list();
$shop_list = get_shop_list();

// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM menus WHERE :id = id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】メニュー詳細</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">メニュー詳細</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card " style="width: 18rem;">
            <div class="card-body">
                <form action="menu_del_do.php" method="post">
                    <dl class="list-group list-group-flush">

                        <dt>メニューID</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['id']) ?>
                            <input type="hidden" name="id" value="<?php echo h($result['id']) ?>">
                        </dd>

                        <dt>商品名</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['name']) ?>
                            <input type="hidden" name="name" value="<?php echo h($result['name']) ?>">
                        </dd>

                        <dt>個数</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result["amount"]) ?>
                            <input type="hidden" name="amount" value="<?php echo h($result['amount']) ?>">
                        </dd>

                        <dt>価格</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result["price"]) ?>
                            <input type="hidden" name="price" value="<?php echo h($result['price']) ?>">
                        </dd>

                        <dt>説明文</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['description']) ?>
                            <input type="hidden" name="description" value="<?php echo h($result['description']) ?>">
                        </dd>

                        <dt>画像</dt>
                        <dd class="list-group-item card-text">
                            <img src="<?php echo "/y_gyoza-fes_b/img/" . $result['image'] ?>" alt="" class="img-fluid">
                            <input type="hidden" name="image" value="<?php echo h($result['image']) ?>">
                        </dd>

                        <!-- kantodo：文字表示する -->
                        <dt>店舗</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($shop_list[$result["mother_shop"]]) ?>
                            <input type="hidden" name="mother_shop" value="<?php echo h($result['mother_shop']) ?>">
                        </dd>

                        <dt>追加日時</dt>
                        <dd class="list-group-item card-text">
                            <?php echo date('Y年m月d日',  strtotime(h($result['created_at']))) ?>
                        </dd>

                        <dt>追加者</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($user_array[$result['created_user_id']]) ?>
                        </dd>

                        <dt>更新日時</dt>
                        <dd class="list-group-item card-text">
                            <?php echo  !empty($result['updated_at']) ? date('Y年m月d日',  strtotime(h($result['updated_at']))) : "" ?>
                            <input type="hidden" name="updated_at" value="<?php echo h($result['updated_at']) ?>">
                        </dd>

                        <dt>更新者</dt>
                        <dd class="list-group-item card-text">
                            <?php echo !empty($result['updated_user_id']) ? h($user_array[$result['updated_user_id']]) : "" ?>
                            <input type="hidden" name="updated_user_id" value="<?php echo h($result['updated_user_id'])  ?>">
                        </dd>
                        </dd>
                    </dl>
            </div>
        </div>

        <a href="menu_edit.php?id=<?php echo $id ?>" class="btn btn-outline-primary mt-5">メニューを編集する</a>
        <input type="submit" value="メニューを削除する" class="btn btn-outline-danger m-5">
        </form>
    </main>
    <footer class="text-center m-5 d-flex justify-content-center gap-5">
        <a href="./menu_list.php" class="btn btn-primary">メニュー一覧に戻る</a>
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>