<!-- http://localhost:8080/y_gyoza-fes_b/admin/ -->

<?php
require_once __DIR__ . '/../function/function.php';

session_start();

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
    <h1>管理者画面</h1>
    <ul>
      <li>
        <p>お問い合わせ</p>
        <a href="./admin_form/form_list.php" class="btn btn-primary">一覧</a>
      </li>
      <li>
        <p>店舗</p>
        <a href="./admin_shops/shops_list.php" class="btn btn-primary">一覧</a>
      </li>
      <li>
        <p>メニュー</p>
        <a href="./admin_menu/menu_list.php" class="btn btn-primary">一覧</a>
      </li>
      <li>
        <p>お知らせ</p>
        <a href="./admin_news/news_list.php" class="btn btn-primary">一覧</a>
      </li>

    </ul>
    <div>
      <p>ユーザー</p>
      <a href="./admin_user/user_edit.php" class="btn btn-primary">編集</a>
      <a href="./admin_user/user_add.php" class="btn btn-success">追加</a>
      <a href="./admin_user/user_del_do.php" class="btn btn-danger">削除</a>
    </div>
    <div>
      <a href="./logout.php" class="btn btn-warning">ログアウトする</a>
    </div>





    <!-- 本文ここまで -->

  </main>

  <script src="../js/script.js"></script>
</body>

</html>