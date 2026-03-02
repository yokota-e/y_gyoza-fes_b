<!-- カンごみ：2026/03/02 記述 -->
<!-- カンごみ：http://localhost:8080/y_gyoza-fes_b/admin/admin_form/form_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';
?>


<!-------------------------------------------------------------------------
                            データベース処理
------------------------------------------------------------------------->
<?php
// contactテーブルから読み込み
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM contacts ORDER BY id ASC';
    $stmt = $db->prepare($sql);
    // SQLの実行
    $stmt->execute();

    $contact_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー（contactテーブル読み込み時）:' . $e->getMessage());
}

//typeテーブルから読み込み
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM type ORDER BY id ASC';
    $stmt = $db->prepare($sql);
    // SQLの実行
    $stmt->execute();

    $role_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー（typeテーブル読み込み時）:' . $e->getMessage());
}

//stateテーブルから読み込み
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM state ORDER BY id ASC';
    $stmt = $db->prepare($sql);
    // SQLの実行
    $stmt->execute();

    $state_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー（stateテーブル読み込み時）:' . $e->getMessage());
}
?>




<!-------------------------------------------------------------------------
                            HTML本文
------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】店舗一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="container">
        <h1 class="text-center m-5">お問い合わせ一覧</h1>
        <div class="row">
            <table class="col-10 table table-striped mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>問い合わせ種別</th>
                        <th>名前</th>
                        <th>お問い合わせ内容</th>
                        <th>投稿日時</th>
                        <th>対応状況</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contact_list as $contact_datas): ?>
                        <tr>
                            <td><?php echo $contact_datas["id"] ?></td>
                            <td><?php echo $role_list[0]["role"] ?></td>
                            <td><?php echo $contact_datas["name"] ?></td>
                            <td><?php echo $contact_datas["body"] ?></td>
                            <td><?php echo $contact_datas["post_date"] ?></td>
                            <td><?php echo $contact_datas["status"] ?></td>
                            <td>
                                <form action="form_detail.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $contact_datas["id"] ?>">
                                    <input type="submit" class="btn btn-primary" value="詳細">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>

</html>