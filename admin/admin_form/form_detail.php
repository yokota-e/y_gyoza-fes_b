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
$id = $_POST["id"];
// // contactsテーブルからIDと対応したcontact情報の読み込み
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM contacts WHERE :id = id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    // SQLの実行
    $stmt->execute();
    $contact_datas = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー（contactテーブルからのデータ取得時）:' . $e->getMessage());
}

//外部キー対応配列の取得
$role_array = get_type_list();
$state_array = get_state_list();
$user_array = get_users_list();
?>




<!-------------------------------------------------------------------------
                            HTML本文
------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】お問い合わせ詳細</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">お問い合わせ詳細</h1>
    <main role="main" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow mt-5 mb-5">
                    <div class="card-header bg-primary text-white text-center fs-3">お問い合わせ詳細</div>
                    <div class="card-body">
                        <form method="POST" action="form_check_do.php" class="text-center">
                            <dl class="row">
                                <dt class="col-sm-4 text-center">ID</dt>
                                <dd class="col-sm-8">
                                    <?php echo ($contact_datas["id"]) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">お問い合わせ種別</dt>
                                <dd class="col-sm-8">
                                    <?php echo ($role_array[$contact_datas["role"]]) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">名前（ふりがな）</dt>
                                <dd class="col-sm-8">
                                    <?php echo h(($contact_datas["name"] . "（" . $contact_datas["name_kana"] . "）")) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">会社名</dt>
                                <dd class="col-sm-8">
                                    <?php echo h(($contact_datas["company"])) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">電話番号</dt>
                                <dd class="col-sm-8">
                                    <?php echo h(($contact_datas["tel"])) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">メールアドレス</dt>
                                <dd class="col-sm-8">
                                    <?php echo h(($contact_datas["address"])) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">店名・媒体名</dt>
                                <dd class="col-sm-8">
                                    <?php echo h(($contact_datas["shop_name"])) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">お問い合わせ内容</dt>
                                <dd class="col-sm-8">
                                    <?php echo h(($contact_datas["body"])) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">投稿日時</dt>
                                <dd class="col-sm-8">
                                    <?php echo ($contact_datas["post_date"]) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">対応日時</dt>
                                <dd class="col-sm-8">
                                    <?php echo ($contact_datas["support_date"]) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">対応者</dt>
                                <dd class="col-sm-8">
                                    <?php echo ($user_array[$contact_datas["admin_name"]]) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">現在の対応状況</dt>
                                <dd class="col-sm-8">
                                    <?php echo ($state_array[$contact_datas["status"]]) ?>
                                </dd>
                                <hr>
                                <dt class="col-sm-4 text-center">
                                    <label for="status_select" class="form-label">対応状況の変更</label>
                                </dt>
                                <dd class="col-sm-8">
                                    <select name="status" class="form-select" id="status_select" require>
                                        <option value="1" <?php echo $contact_datas["status"] == 1 ? "selected" : "" ?>>未対応</option>
                                        <option value="2" <?php echo $contact_datas["status"] == 2 ? "selected" : "" ?>>対応中</option>
                                        <option value="3" <?php echo $contact_datas["status"] == 3 ? "selected" : "" ?>>対応済み</option>
                                    </select>
                                </dd>
                                <hr>
                            </dl>

                            <a href="form_list.php" class="btn btn-secondary mt-2 mb-4 me-5">
                                一覧へ戻る
                            </a>

                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" class="btn btn-primary mb-3 me-5" value="変更確定">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>

</html>