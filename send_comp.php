<?php
include('./function/function.php');

session_start();
$role = $_SESSION["type"];
$name = $_SESSION["name"];
$name_kana = $_SESSION["name_kana"];
$company = $_SESSION["company"];
$tel = $_SESSION["tel"];
$address = $_SESSION["address"];
$shop_name = $_SESSION["store"];
$text_body = $_SESSION["text"];
$type = get_type_list();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- サイト情報 -->
    <meta name="description" content="ふくおか餃子FESのイベントに関する問い合わせページ。フォーム送信やSNSリンクを掲載。">
    <meta name="keywords" content="餃子,FES,長浜公園,お問い合わせ,フォーム">
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
    <title>ふくおか餃子FES-お問い合わせ</title>
</head>

<body>
    <header class="l-header l-header--sub-page">
        <?php include('./common/nav_var.php');  ?>
        <nav class="c-breadcrumbs">
            <div class="l-wrapper">
                <ol class="c-breadcrumbs__list">
                    <li class="c-breadcrumbs__item"><a href="./index.php">Home</a></li>
                    <li class="c-breadcrumbs__item"><a href="./form.php">お問い合わせ</a></li>
                </ol>
            </div>
        </nav>
    </header>

    <main class="l-main">
        <div class="l-wrapper">
            <div class="l-wrapper-inner">
                <section class="l-contact-heading">
                    <h1 class="c-sub-page-heading">お問い合わせ</h1>
                    <p>
                        下記の内容で送信しました。
                    </p>
                </section>
                <form action="./form_addtion_do.php" method="post">
                    <dl class="l-contact-form">
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-type">お問い合わせ種別</label>
                            </dt>
                            <p><?php echo $type[$role] ?></p>
                            <input type="hidden" name="type" value="<?php echo $role ?>">
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name">お名前</label>
                            </dt>
                            <p><?php echo $name ?></p>
                            <input type="hidden" name="name" value="<?php echo $name ?>">
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name-furigana">ふりがな</label>
                            </dt>
                            <p><?php echo $name_kana ?></p>
                            <input type="hidden" name="name_kana" value="<?php echo $name_kana ?>">

                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="company-name">会社名</label>
                            </dt>
                            <p><?php echo $company ?></p>
                            <input type="hidden" name="company" value="<?php echo $company ?>">
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="telephone-number">電話番号</label>
                            </dt>
                            <p><?php echo $tel ?></p>
                            <input type="hidden" name="tel" value="<?php echo $tel ?>">
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-email-address">メールアドレス</label>
                            </dt>
                            <p><?php echo $address ?></p>
                            <input type="hidden" name="address" value="<?php echo $address ?>">
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="store-name">店名・媒体名</label>
                            </dt>
                            <p><?php echo $shop_name ?></p>
                            <input type="hidden" name="store" value="<?php echo $shop_name ?>">
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-details">お問い合わせ内容</label>
                            </dt>
                            <p><?php echo $text_body ?></p>
                            <input type="hidden" name="text" value="<?php echo $text_body ?>">
                        </div>
                    </dl>
                    <div class="l-contact-agree">
                        <form action="./form.php" method="post">
                            <input class="c-btn-return" type="button" value="前の画面に戻る" onclick="history.back()">
                        </form>
                        <input class="c-btn" type="submit" value="送信する">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="l-footer">
        <?php include('./common/footer_bar.php');  ?>

    </footer>
    <script src="./js/script.js"></script>

</body>

</html>