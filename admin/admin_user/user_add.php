<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_user/user_add.php -->

<?php require_once __DIR__ . '/../../function/function.php'; ?>

<!doctype html>
<html lang="ja" >
  <head>
    <title>ログイン</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  </head>
  <body>

    <!-- <?php include('navbar.php'); ?> -->

    <main role="main" class="container" style="padding:60px 15px 0">

        <!-- ここから「本文」-->
        <h1 class="my-5">新規ユーザー登録</h1>
      <form action="user_add_do.php" method="post">
        <div class="row">
          <div class="mb-3 col">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
          <div class="mb-3 col">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
        </div>
        <div class="mb-3">
          <input type="submit" value="登録する" class="btn btn-primary">
        </div>
      </form>

        <!-- 本文ここまで -->
 
    </main>

    <script src="../js/script.js"></script>
  </body>
</html>