<!-- http://localhost:8080/y_gyoza-fes_b/admin/admin_faq/faq_add.php -->

<?php
require_once __DIR__ . '/../../function/function.php';

?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【管理用】よくある質問 - 新規追加</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <main class="d-flex flex-column align-items-center m-5">
        <div>
            <!-- ここから「本文」-->

            <h1 class="my-5">よくある質問 - 新規追加</h1>
            <form action="faq_add_do.php" method="post">

                <div class="mb-3">
                    <label for="category" class="form-label">カテゴリー</label>
                    <select name="category" id="category" require>
                        <option value="選択してください" hidden>選択してください</option>
                        <option value="1">来場について</option>
                        <option value="2">会場について</option>
                        <option value="3">その他</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="question" class="form-label">質問</label>
                    <textarea name="question" id="question" class="form-control" rows="6"></textarea>
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label">回答</label>
                    <textarea name="answer" id="answer" class="form-control" rows="6"></textarea>
                </div>

                <div class="mb-3">
                    <input type="submit" value="登録する" class="btn btn-primary">
                </div>
            </form>

            <footer class="text-center m-5">
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