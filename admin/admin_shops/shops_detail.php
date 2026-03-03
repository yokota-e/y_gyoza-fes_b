<!-- http://localhost:8080/gyoza-fes_b/admin/admin_shops/shops_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

$id = $_GET['id'];

// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM shops WHERE :id = id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);


    // SQLの実行
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
    <title>【管理用】店舗詳細</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">店舗詳細</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card " style="width: 18rem;">
            <div class="card-body">
                <form action="shops_del_do.php" method="post">
                    <dl class="list-group list-group-flush">

                        <dt>店舗ID</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['id']) ?>
                            <input type="hidden" name=id value=<?php echo h($result['id']) ?>>
                        </dd>



                        <dt>店舗名</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['name']) ?>
                            <input type="hidden" name=name value=<?php echo h($result['name']) ?>>
                        </dd>


                        <dt>店舗詳細</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['description']) ?>
                            <input type="hidden" name=description value=<?php echo h($result['description']) ?>>
                        </dd>

                        <dt>ブース番号</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['booth']) ?>
                            <input type="hidden" name=booth value=<?php echo h($result['booth']) ?>>
                        </dd>

                        <dt>電話番号</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['tel']) ?>
                            <input type="hidden" name=tel value=<?php echo h($result['tel']) ?>>
                        </dd>

                        <dt>メールアドレス</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['address']) ?>
                            <input type="hidden" name=address value=<?php echo h($result['address']) ?>>
                        </dd>

                        <dt>追加日時</dt>
                        <dd class="list-group-item card-text">
                            <?php echo date('Y年m月d日',  strtotime(h($result['created_at']))) ?>

                        </dd>

                        <dt>追加者</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['created_user_id']) ?>
                        </dd>

                        <dt>更新日時</dt>
                        <dd class="list-group-item card-text">
                            <?php echo date('Y年m月d日',  strtotime(h($result['updated_at']))) ?>
                            <input type="hidden" name=updated_at value=<?php echo h($result['updated_at']) ?>>
                        </dd>

                        <dt>更新者</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['updated_user_id']) ?>
                            <input type="hidden" name=updated_user_id value=<?php echo h($result['updated_user_id']) ?>>
                        </dd>
                        </dd>
                    </dl>
            </div>
        </div>

        <a href="shops_edit.php?id=<?php echo $id ?>" class="btn btn-outline-primary mt-5">店舗情報を編集する</a>
        <input type="submit" value="店舗を削除する" class="btn btn-outline-danger m-5">
        </form>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>