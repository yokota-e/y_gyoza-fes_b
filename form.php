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
                        当イベントへのお問い合わせは、下記のフォームよりお願い致します。
                    </p>
                </section>
                <form action="./form_addition.php" method="post">
                    <dl class="l-contact-form">
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-type">お問い合わせ種別</label>
                            </dt>
                            <dd class="c-contact-type__content c-contact-type__content--select">
                                <select name="inquiry-type" id="inquiry-type" required>
                                    <option value="選択してください" hidden>選択してください</option>
                                    <option value="FESに関すること">FESに関すること</option>
                                    <option value="店舗に関すること">店舗に関すること</option>
                                    <option value="会場に関すること">会場に関すること</option>
                                    <option value="その他お問い合わせ">その他お問い合わせ</option>
                                </select>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name">お名前</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <input type="text" id="user-name" name="user-name" required>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-name-furigana">ふりがな</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <input type="text" id="user-name-furigana" name="user-name-furigana" required>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="company-name">会社名</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <input type="text" id="company-name" name="company-name">
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="telephone-number">電話番号</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <input type="tel" id="telephone-number" name="telephone-number">
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="user-email-address">メールアドレス</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <input type="email" id="user-email-address" name="user-email-address" required>
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="store-name">店名・媒体名</label>
                            </dt>
                            <dd class="c-contact-type__content">
                                <input type="text" id="store-name" name="store-name">
                            </dd>
                        </div>
                        <div class="c-contact-type">
                            <dt class="c-contact-type__title">
                                <label for="inquiry-details">お問い合わせ内容</label>
                            </dt>
                            <dd class="c-contact-type__content c-contact-type__content--long">
                                <textarea name="inquiry-details" id="inquiry-details" required></textarea>
                            </dd>
                        </div>
                    </dl>
                    <div class="l-contact-agree">
                        <div class="c-contact-agree">
                            <p class="c-contact-agree__text">
                                当イベントの
                                <a href="./privacy.php">プライバシーポリシー</a>
                                に同意頂ける場合は「同意する」にチェックを付け「入力内容の確認」ボタンをクリックしてください
                            </p>
                            <p class="c-contact-agree__item">
                                <input type="checkbox" id="agree" name="agree" value="同意する" required><label
                                    for="agree">同意する</label>
                            </p>
                        </div>
                        <input class="c-btn" type="submit" value="送信する">
                    </div>
                </form>
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