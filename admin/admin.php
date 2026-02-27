<!-- http://localhost:8080/y_gyoza-fes_b/admin/ -->

<?php
require_once __DIR__ . '/../function/function.php';
require_once __DIR__ . '/../common/login_check.php';

$id = $_SESSION['id'];

try {
  // DBへ接続
  $db = db_connect();

  // ユーザー一覧用
  $sql = 'SELECT id,name FROM users ORDER BY id ASC';
  $stmt = $db->prepare($sql);

  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // ログイン中のユーザー情報用
  $sql = 'SELECT id,name,date FROM users WHERE :id = id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  $logged_in_acount = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit('エラー:' . $e->getMessage());
}
?>

<!doctype html>
<html lang="ja">

<head>
  <title>管理者画面</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <style>
    form {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
      text-align: center;
    }

    #name {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    #password {
      margin-bottom: 10px;
      border-top-right-radius: 0;
      border-top-left-radius: 0;
    }
  </style>

</head>

<body>

  <!-- <?php include('navbar.php'); ?> -->

  <main role="main" class="container" style="padding:60px 15px 0">

    <!-- ここから「本文」-->
    <h1 class="text-center m-5">管理者画面</h1>
    <main class="d-flex flex-column align-items-center m-5">
      <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between">
            <p>お問い合わせ</p>
            <a href="./admin_form/form_list.php" class="btn btn-primary">一覧</a>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <p>店舗</p>
            <a href="./admin_shops/shops_list.php" class="btn btn-primary">一覧</a>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <p>メニュー</p>
            <a href="./admin_menu/menu_list.php" class="btn btn-primary">一覧</a>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <p>お知らせ</p>
            <a href="./admin_news/news_list.php" class="btn btn-primary">一覧</a>
          </li>

        </ul>
      </div>
      <div>
        <h2 class="text-center mt-5">ユーザー一覧</h2>
        <ul class="list-group list-group-flush">
          <?php foreach ($result as $user): ?>
            <li class="list-group-item"><?php echo $user['name'] ?>
            <?php endforeach; ?>
            <div class="d-block">
              <a href="./admin_user/user_add.php" class="btn btn-outline-primary m-5">ユーザーを追加する</a>
            </div>
        </ul>
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h3 class="card-title">ログイン中のアカウント</h3>
            <dl class="list-group list-group-flush">

              <dt>ID</dt>
              <dd class="list-group-item card-text">
                <?php echo $logged_in_acount['id'] ?>
              </dd>


              <dt>名前</dt>
              <dd class="list-group-item card-text">
                <?php echo $logged_in_acount['name'] ?>
              </dd>


              <dt>投稿日時</dt>
              <dd class="list-group-item card-text">
                <?php echo date('Y年m月d日',  strtotime($logged_in_acount['date'])) ?>
              </dd>


            </dl>


            <a href="./admin_user/user_edit.php" class="btn btn-primary">編集</a></li>
            <a href="./admin_user/user_del_do.php" class="btn btn-danger">削除</a>
          </div>
        </div>
      </div>
      <div class="m-5">
        <a href="./logout.php" class="btn btn-warning">ログアウトする</a>
      </div>
    </main>





    <!-- 本文ここまで -->

  </main>

  <script src="../js/script.js"></script>
</body>

</html>