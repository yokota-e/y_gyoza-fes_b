<!-- http://localhost:8080/gyoza-fes_b/admin/admin_shops/news_add.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';

?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】お知らせ - 新規追加</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="d-flex flex-column align-items-center m-5">
        <div>
            <h1 class="my-5">お知らせ - 新規追加</h1>
            <form action="news_add_do.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="mb-3">
                    <p>画像</p>
                    <input type="file" name="image">
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label">本文</label>
                    <textarea name="body" id="body" class="form-control" rows="6"></textarea>
                </div>



                <div class="mb-3">
                    <input type="submit" value="登録する" class="btn btn-primary">
                </div>
            </form>

            <footer class="text-center m-5">
                <a href="./news_list.php" class="btn btn-primary">お知らせ一覧に戻る</a>
                <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
            </footer>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>