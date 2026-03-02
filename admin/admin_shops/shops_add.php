<!-- http://localhost:8080/gyoza-fes_b/admin/admin_shops/shops_add.php -->

<?php
require_once __DIR__ . '/../../function/function.php';

?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】店舗 - 新規追加</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="d-flex flex-column align-items-center m-5">
        <div>
            <!-- ここから「本文」-->

            <h1 class="my-5">店舗 - 新規追加</h1>
            <form action="shops_add_do.php" method="post">

                <div class="mb-3">
                    <label for="name" class="form-label">店舗名</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">店舗詳細文</label>
                    <textarea name="description" id="description" class="form-control" rows="6"></textarea>
                </div>

                <div class="mb-3">
                    <label for="booth" class="form-label">ブース番号</label>
                    <input type="text" name="booth" id="booth" class="form-control" placeholder="B-00">
                </div>

                <div class="mb-3">
                    <label for="tel" class="form-label">電話番号</label>
                    <input type="tel" name="tel" id="tel" class="form-control" placeholder="0X-XXXX-XXXX">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">メールアドレス</label>
                    <input type="email" name="address" id="address" class="form-control" placeholder="mailmailmail@mail.com">
                </div>

                <div class="mb-3">
                    <input type="submit" value="登録する" class="btn btn-primary">
                </div>
            </form>

            <footer class="text-center m-5">
                <a href="./shops_list.php" class="btn btn-primary">店舗一覧に戻る</a>
                <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
            </footer>
            <!-- 本文ここまで -->
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>