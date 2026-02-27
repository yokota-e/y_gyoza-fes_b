<?php
include('./function/function.php');

$role = $_POST["inquiry-type"];
$name = $_POST["user-name"];
$name_kana = $_POST["user-name-furigana"];
$company = $_POST["company-name"];
$tel = $_POST["telephone-number"];
$address = $_POST["user-email-address"];
$shop_name = $_POST["store-name"];
$text_body = $_POST["inquiry-details"];


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
                        下記の内容で送信してよろしいですか？
                    </p>
                </section>
                <form action="./form_addition_do.php" method="post">
                    <dl class="l-contact-form">
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-type">お問い合わせ種別</label>
                            </dt>
                            <!-- <dd class="c-contact-type__content c-contact-type__content--select"> -->
                            <p><?php echo $role ?></p>
                            <!-- </dd> -->
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name">お名前</label>
                            </dt>
                            <!-- <dd class="c-contact-type__content"> -->
                            <p><?php echo $name ?></p>
                            <!-- </dd> -->
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name-furigana">ふりがな</label>
                            </dt>
                            <!-- <dd class="c-contact-type__content"> -->
                            <p><?php echo $name_kana ?></p>
                            <!-- </dd> -->
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="company-name">会社名</label>
                            </dt>
                            <p><?php echo $company ?></p>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="telephone-number">電話番号</label>
                            </dt>
                            <p><?php echo $tel ?></p>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-email-address">メールアドレス</label>
                            </dt>
                            <!-- <dd class="c-contact-type__content"> -->
                            <p><?php echo $address ?></p>
                            <!-- </dd>  -->
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="store-name">店名・媒体名</label>
                            </dt>
                            <!-- <dd class="c-contact-type__content"> -->
                            <p><?php echo $shop_name ?></p>
                            <!-- </dd>? -->
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-details">お問い合わせ内容</label>
                            </dt>
                            <!-- <dd class="c-contact-type__content c-contact-type__content--long"> -->
                            <p><?php echo $text_body ?></p>
                            <!-- </dd> -->
                        </div>
                    </dl>
                    <div class="l-contact-agree">
                        <form action="./form.php" method="post">
                            <input class="c-btn-return" type="button" value="前の画面に戻る" onclick="history.back()">
                        </form>
                    </div>
                    <div class="l-contact-agree">
                        <form action="./form_addtion_do.php" method="post">
                            <input class="c-btn" type="submit" value="送信する">
                        </form>
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