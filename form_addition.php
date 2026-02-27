<?php
include './form_addition.php';

$role = $_POST['role'];
$name = $_POST['name'];
$name_kana = $_POST['name_kana'];
$company = $_POST['company'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$shop_name = $_POST['shop_name'];
$body = $_POST['body'];

?>
<html>

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
                        下記の内容でよろしいですか？
                    </p>
                </section>
                <form action="./form_addition_do.php" method="post">
                    <dl class="l-contact-form">
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-type">お問い合わせ種別</label>
                            </dt>
                            <dd class="c-contact-type__content c-contact-type__content--select">
                                <p><?php echo $role ?></p>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name">お名前</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <p><?php echo $name ?></p>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name-furigana">ふりがな</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <p><?php echo $name_kana ?></p>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="company-name">会社名</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <p><?php echo $company ?></p>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="telephone-number">電話番号</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <p><?php echo $tel ?></p>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-email-address">メールアドレス</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <p><?php echo $address ?></p>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="store-name">店名・媒体名</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <p><?php echo $shop_name ?></p>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-details">お問い合わせ内容</label>
                            </dt>
                            <dd class="c-contact-type__content c-contact-type__content--long">
                                <p><?php echo $body ?></p>
                            </dd>
                        </div>
                    </dl>
                    <div class="l-contact-agree">
                        <input class="c-btn" type="submit" value="送信する">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>