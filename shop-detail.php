<?php
include('function/function.php');

$page_id = htmlspecialchars($_GET['id']);



try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT shops.id AS shop_id,shops.name AS shop_name,shops.description AS shop_description,shops.tel,shops.address,menus.name AS menu_name,menus.amount,menus.price,menus.description,menus.image FROM shops AS shops INNER JOIN  menus AS menus ON shops.id = menus.id WHERE shops.id = :page_id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':page_id', $page_id, PDO::PARAM_STR);

    // SQLの実行
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="博多ぎょうざ堂の紹介・メニューの詳細を掲載。">
    <meta name="keywords" content="餃子,FES,長浜公園,参加無料,焼き餃子,博多ぎょうざ堂,肉汁あふれる焼き餃子">
    <meta name="author" content="ふくおか餃子FES実行委員会">
    <meta name="robots" content="noindex,nofollow">
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
    <title>ふくおか餃子FES-店舗詳細</title>
</head>

<body>
    <header class="l-header l-header--sub-page">
        <div id="top" class="c-top">
            <div class="l-wrapper c-top__contents">
                <h1 class="c-logo">
                    <a href="index.php">
                        <picture>
                            <source srcset="./img/logo_02.svg" media="(min-width: 768px)">
                            <img src="./img/logo_line_02.svg" alt="ふくおか餃子FES">
                        </picture>
                    </a>
                </h1>
                <nav class="c-header-nav">
                    <ul class="c-header-nav__list">
                        <li class="c-header-nav__item">
                            <a href="./index.php">Home</a>
                        </li>
                        <li class="c-header-nav__item">
                            <a href="./shop-list.php">店舗一覧</a>
                        </li>
                        <li class="c-header-nav__item">
                            <a href="./faq.php">よくある質問</a>
                        </li>
                        <li class="c-header-nav__item">
                            <a href="./form.php">お問い合わせ</a>
                        </li>
                    </ul>
                    <img class="c-header-nav__hamburger" src="./img/icon_hamburger.png" alt="">
                </nav>
            </div>
        </div>
        <nav class="c-breadcrumbs">
            <div class="l-wrapper">
                <ol class="c-breadcrumbs__list">
                    <li class="c-breadcrumbs__item"><a href="./index.php">Home</a></li>
                    <li class="c-breadcrumbs__item"><a href="./shop-list.php">店舗一覧</a></li>
                    <li class="c-breadcrumbs__item"><a href="./shop-detail.php">博多ぎょうざ堂</a></li>
                </ol>
            </div>
        </nav>
    </header>
    <main class="l-main">
        <div class="l-wrapper">
            <p class="c-sub-page-heading">店舗詳細</p>

            <div class="l-section__shop-detail">
                <div class="c-shop-introduction">
                    <div class="c-shop-introduction__description">
                        <h1 class="c-shop-introduction__description__name"><?php echo $result['shop_name'] ?></h1>
                        <p class="c-shop-introduction__description__text">
                            <?php echo $result['shop_description'] ?>
                        </p>
                    </div>
                    <div class="c-shop-introduction__address">
                        <p class="c-shop-introduction__address__phone-number"><?php echo $result['tel'] ?></p>
                        <p class="c-shop-introduction__address__email-address"><?php echo $result['address'] ?>/p>
                    </div>
                </div>
                <div class="c-product-introduction">
                    <div class="c-product-introduction__img">
                        <img src="./img/<?php echo $result['image'] ?>" alt="<?php echo $result['menu_name'] ?>">
                    </div>
                    <div class="c-product-introduction__description">
                        <div class="c-product-introduction__description__detail">
                            <p><?php echo $result['menu_name'] ?></p>
                            <p><?php echo $result['amount'] ?>個入り <?php echo $result['price'] ?>円（税込み）</p>
                        </div>
                        <p class="c-product-introduction__description__text">
                            <?php echo $result['description'] ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="l-btn-area">
                <a class="c-btn" href="./shop-list.php">一覧に戻る</a>
            </div>
        </div>
    </main>
    <footer class="l-footer">
        <div class="l-wrapper">
            <div class="l-btn-area l-btn-area--end">
                <a class="c-top-btn" href="#top">top</a>
            </div>
        </div>
        <div class="l-footer-inner">
            <div class="l-wrapper l-footer-contets">
                <div class="c-organization">
                    <div class="c-logo c-logo--footer">
                        <a href="index.php"><img src="./img/logo_02.svg" alt="ふくおか餃子FES"></a>
                    </div>
                    <dl class="c-organization__list">
                        <div class="c-organization__item">
                            <dt>主催</dt>
                            <dd>ふくおか餃子フェス実行委員会</dd>
                        </div>
                        <div class="c-organization__item">
                            <dt>協賛</dt>
                            <dd>九州餃子部</dd>
                        </div>
                        <div class="c-organization__item">
                            <dt>制作協力</dt>
                            <dd>創造社リカレントスクール 福岡校</dd>
                        </div>
                    </dl>
                </div>
                <nav class="c-footer-nav"><a href="./privacy.php">プライバシーポリシー</a></nav>
                <div class="c-sns">
                    <ul class="c-sns__list">
                        <li class="c-sns__item">
                            <a href="#"><img src="./img/sns_icon_x.png" alt="エックス"></a>
                        </li>
                        <li class="c-sns__item">
                            <a href="#"><img src="./img/sns_icon_instagram.png" alt="インスタグラム"></a>
                        </li>
                        <li class="c-sns__item">
                            <a href="#"><img src="./img/sns_icon_line.png" alt="ライン"></a>
                        </li>
                        <li class="c-sns__item">
                            <a href="#"><img src="./img/sns_icon_facebook.png" alt="フェイスブック"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="l-wrapper">
                <small class="c-copyright">&copy; 2025 ふくおか餃子FES実行委員会</small>
            </div>
        </div>
    </footer>
</body>

</html>