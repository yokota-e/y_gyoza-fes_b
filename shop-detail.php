<?php
include('function/function.php');

$page_id = htmlspecialchars($_GET['id']);



try {
    // DBへ接続
    $db = db_connect();
    // 店舗情報を取得
    $sql = 'SELECT shops.id AS shop_id,shops.name AS shop_name,shops.description AS shop_description,shops.tel,shops.address,menus.mother_shop FROM shops AS shops INNER JOIN  menus AS menus ON shops.id = menus.mother_shop WHERE shops.id = :page_id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':page_id', $page_id, PDO::PARAM_STR);

    // SQLの実行
    $stmt->execute();
    $shops_result = $stmt->fetch(PDO::FETCH_ASSOC);


    // 商品情報を取得
    $sql = 'SELECT shops.id AS shop_id,menus.name AS menu_name, shops.name AS shop_name, menus.amount,menus.price,menus.description,menus.image,menus.mother_shop FROM shops AS shops INNER JOIN  menus AS menus ON shops.id = menus.mother_shop WHERE shops.id = :page_id AND menus.is_deleted = 0';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':page_id', $page_id, PDO::PARAM_STR);

    // SQLの実行
    $stmt->execute();
    $menus_result = $stmt->fetchALL(PDO::FETCH_ASSOC);
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
        <?php include('./common/nav_var.php');  ?>
        <nav class="c-breadcrumbs">
            <div class="l-wrapper">
                <ol class="c-breadcrumbs__list">
                    <li class="c-breadcrumbs__item"><a href="./index.php">Home</a></li>
                    <li class="c-breadcrumbs__item"><a href="./shop-list.php">店舗一覧</a></li>
                    <li class="c-breadcrumbs__item"><a href="./shop-detail.php?id=<?php echo h($shops_result["shop_id"]) ?>"><?php echo h($shops_result["shop_name"]) ?></a></li>
                </ol>
            </div>
        </nav>
    </header>
    <main class="l-main">
        <div class="l-wrapper">
            <p class="c-sub-page-heading">店舗詳細</p>
            <!-- 店舗情報 -->
            <div class="l-section__shop-detail">
                <div class="c-shop-introduction">
                    <div class="c-shop-introduction__description">
                        <h1 class="c-shop-introduction__description__name"><?php echo $shops_result['shop_name'] ?></h1>
                        <p class="c-shop-introduction__description__text">
                            <?php echo $shops_result['shop_description'] ?>
                        </p>
                    </div>
                    <div class="c-shop-introduction__address">
                        <p class="c-shop-introduction__address__phone-number"><?php echo $shops_result['tel'] ?></p>
                        <p class="c-shop-introduction__address__email-address"><?php echo $shops_result['address'] ?></p>
                    </div>
                </div>

                <!-- 商品情報 -->
                <?php foreach ($menus_result as $data): ?>
                    <div class="c-product-introduction">
                        <div class="c-product-introduction__img">
                            <img src="./img/<?php echo $data['image'] ?>" alt="<?php echo $data['menu_name'] ?>">
                        </div>
                        <div class="c-product-introduction__description">
                            <div class="c-product-introduction__description__detail">
                                <p><?php echo $data['menu_name'] ?></p>
                                <p><?php echo $data['amount'] ?>個入り <?php echo $data['price'] ?>円（税込み）</p>
                            </div>
                            <p class="c-product-introduction__description__text">
                                <?php echo $data['description'] ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="l-btn-area">
                <a class="c-btn" href="./shop-list.php">一覧に戻る</a>
            </div>
        </div>
    </main>
    <footer class="l-footer">
        <?php include('./common/footer_bar.php');  ?>
    </footer>
    <script src="./js/script.js"></script>
</body>

</html>