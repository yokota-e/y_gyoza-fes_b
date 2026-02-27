<?php
include('function/function.php');
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT shops.id AS shop_id,shops.name AS shop_name,menus.name AS menu_name,menus.amount,menus.price,menus.image FROM shops AS shops INNER JOIN  menus AS menus ON shops.id = menus.id';
    $stmt = $db->prepare($sql);


    // SQLの実行
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ふくおか餃子FES出店店舗の一覧を掲載しています。">
    <meta name="keywords" content="焼き餃子,蒸しあげ餃子,中華風,揚げ餃子,地中海,水餃子,ラー油">
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
                    <li class="c-breadcrumbs__item"><a href="./shop-list.php">店舗一覧</a></li>
                </ol>
            </div>
        </nav>
    </header>


    <main class="l-main">
        <div class="l-wrapper">
            <h1 class="c-sub-page-heading">店舗一覧</h1>
            <ul class="l-shop-list">

                <?php foreach ($result as $shop): ?>
                    <li class="c-shop-card">
                        <img src="./img/<?php echo $shop['image'] ?>" alt="<?php echo $shop['shop_name'] ?>">
                        <div class="c-shop-card_detail">
                            <div class="c-shop-card_detailtext">
                                <p class="c-shop-card__shopname"><?php echo $shop['shop_name'] ?></p>
                                <div class="c-shop-card_detailgyoza">
                                    <p class="c-shop-card__gyozaname"><?php echo $shop['menu_name'] ?></p>
                                    <p class="c-shop-card__gyozadetail"><?php echo $shop['amount'] ?>個入り <?php echo $shop['price'] ?>円（税込）</p>
                                </div>
                            </div>
                            <a href="shop-detail.php?id=<?php echo $shop['shop_id'] ?>">詳しくはこちら</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>

    <footer class="l-footer">
        <?php include('./common/footer_bar.php');  ?>

    </footer>
    <script src="./js/script.js"></script>
</body>

</html>