<!-- http://localhost:8080/y_gyoza-fes_b/admin/login.php -->

<?php include('../function/function.php'); ?>

<!doctype html>
<html lang="ja" >
  <head>
    <title>ログイン</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
      form  {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        text-align: center;
      }

      #name{
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      #password{
        margin-bottom: 10px;
        border-top-right-radius: 0;
        border-top-left-radius: 0;
      }

    </style>

  </head>
  <body>

    <main role="main" class="container" style="padding:60px 15px 0">
      <div>
        <!-- ここから「本文」-->

        <form action="login_do.php" method="post">
          <h1>サークルサイト</h1>
          <label for="name" class="sr-only">ユーザー名</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="ユーザー名" required>
          <label for="password" class="sr-only" >パスワード</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="パスワード" required>
          <input type="submit" class="btn btn-primary btn-block" value="ログイン">

        </form>
       

        <!-- 本文ここまで -->
      </div>
    </main>

    <script src="../js/script.js"></script>
  </body>
</html>