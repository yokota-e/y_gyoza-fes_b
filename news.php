<?php
include('function/function.php');

// $page_id = htmlspecialchars($_GET['id']);
$page_id = $_GET['id'];

try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql_2 = 'SELECT id,date,title,image,body FROM news WHERE id = :page_id';
    $stmt = $db->prepare($sql_2);
    $stmt->bindParam(':page_id', $page_id, PDO::PARAM_INT);
    // SQLの実行
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}
// 1. 曜日の配列を用意する
$weeks = ['日', '月', '火', '水', '木', '金', '土'];

// 2. 日付から曜日の番号（0〜6）を取得
$w = date('w', strtotime($result['date']));
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子フェスの最新情報を掲載しています。">
    <meta name="keywords" content="福岡,餃子,フェス,長浜公園,最新情報,イベント情報">
    <meta name="author" content="ふくおか餃子FES実行委員会">
    <!-- ロボット検索除け -->
    <meta name="robots" content="noindex, nofollow">
    <!-- fonts: Zen Maru Gothic & Zen Antique -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Antique&family=Zen+Maru+Gothic&display=swap"
        rel="stylesheet">
    <!-- DNC css reset -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@4.0.1/destyle.min.css">
    <!-- my style css -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- ファビコン -->
    <link rel="icon" href="./img/logo_symbol_02.svg" type="image/svg+xml">
    <link rel="icon alternate" href="./img/logo_symbol_02.png" type="image/png">
    <title>ふくおか餃子FES-公式サイト</title>
</head>

<body>
    <header class="l-header l-header--sub-page">
        <?php include('./common/nav_var.php');  ?>
        <nav class="c-breadcrumbs">
            <div class="l-wrapper">
                <ol class="c-breadcrumbs__list">
                    <li class="c-breadcrumbs__item"><a href="./index.php">Home</a></li>
                    <li class="c-breadcrumbs__item"><a href="./news.php">お知らせ詳細</a></li>
                </ol>
            </div>
        </nav>
    </header>
    <main class="l-main">
        <article class="l-wrapper">
            <div class="l-wrapper-inner">
                <div class="l-news-time">
                    <time class="c-news-date">
                        <?php echo date('Y.m.d', strtotime($result['date'])) . '(' . $weeks[$w] . ')'; ?>
                        <!-- ここをphpで反映させる -->
                    </time>
                </div>
                <!-- ここをphpで反映させる -->
                <h1 class="c-sub-page-heading c-sub-page-heading--news"><?php echo $result['title']; ?></h1>
                <div class="l-news-img">
                    <img class="gyoza-img" src="./img/<?php echo $result['image'] ?>" alt="餃子の写真">
                </div>
                <p class="c-news__text"><?php echo $result['body'] ?></p>
                <div class="l-btn-area l-news-cat">
                    <a class="c-btn" href="index.php#news">一覧に戻る</a>
                </div>
                <div class="social">
                    <p class="social-text">シェアする</p>

                    <ul class="social-list">

                        <li class="social-list-X">
                            <a target="_blank" href="#">
                                <img src="./img/X_white.png" alt="">
                            </a>
                        </li>

                        <li class="social-list-Instagram">
                            <a target="_blank" href="#">
                                <img src="./img/instagram_white.png" alt="">
                            </a>
                        </li>

                        <li class="social-list-LINE">
                            <a target="_blank" href="#">
                                <img src="./img/line_white.png" alt="">
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </article>
    </main>
    <footer class="l-footer">
        <?php include('./common/footer_bar.php');  ?>

    </footer>
    <script src="./js/script.js"></script>
</body>

</html>