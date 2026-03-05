<!-- http://localhost:8080/gyoza-fes_b/admin/admin_shops/news_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

$id = $_GET['id'];




// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM news WHERE :id = id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);


    // SQLの実行
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_array = get_users_list();
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】お知らせ詳細</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">お知らせ詳細</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card " style="width: 18rem;">
            <div class="card-body">
                <form action="news_del_do.php" method="post" onsubmit="return confirm('削除してよろしいですか？')">
                    <dl class="list-group list-group-flush">

                        <dt>ID</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['id']) ?>
                            <input type="hidden" name="id" value="<?php echo h($result['id']) ?>">
                        </dd>



                        <dt>タイトル</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['title']) ?>
                            <input type="hidden" name="name" value="<?php echo h($result['title']) ?>">
                        </dd>


                        <dt>画像</dt>
                        <dd class="list-group-item card-text">
                            <img src="../../img/<?php echo h($result['image']) ?>" alt="" class="img-fluid">
                            <input type="hidden" name="description" value="<?php echo h($result['image']) ?>">
                        </dd>

                        <dt>本文</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($result['body']) ?>
                            <input type="hidden" name="booth" value="<?php echo h($result['body']) ?>">
                        </dd>



                        <dt>更新日時</dt>
                        <dd class="list-group-item card-text">
                            <?php echo date('Y年m月d日',  strtotime(h($result['date']))) ?>

                        </dd>

                        <dt>更新者</dt>
                        <dd class="list-group-item card-text">
                            <?php echo h($user_array[$result['user_id']]) ?>
                        </dd>

                    </dl>
            </div>
        </div>

        <a href="news_edit.php?id=<?php echo $id ?>" class="btn btn-outline-primary mt-5">内容を編集する</a>
        <input type="submit" value="投稿を削除する" class="btn btn-outline-danger m-5">
        </form>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>