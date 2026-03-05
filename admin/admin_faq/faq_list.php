<!-- http://localhost:8080/y_gyoza-fes_b/admin/faq_shops/shops_list.php -->

<?php
require_once __DIR__ . '/../../function/function.php';
require_once __DIR__ . '/../../common/login_check.php';


// ログインしてる人用
try {
    // DBへ接続
    $db = db_connect();
    // プリペアードステートメント作成
    $sql = 'SELECT id,question,is_deleted FROM faq ORDER BY id ASC';
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
    <title>【管理用】よくある質問一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <h1 class="text-center m-5">よくある質問一覧</h1>
    <main class="d-flex flex-column align-items-center m-5">
        <div class="card " style="width: 25rem;">
            <ul class="list-group list-group-flush">
                <?php foreach ($result as $faq): ?>
                    <?php if ($faq['is_deleted'] == 0): ?>
                        <li class="list-group-item"><a href="faq_detail.php?id=<?php echo h($faq['id']) ?>"><?php echo h($faq['question']) ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="d-block">
            <a href="faq_add.php" class="btn btn-outline-primary mt-4">よくある質問を追加する</a>
        </div>
        <div class="d-block">
            <a href="faq_deleted_list.php" class="btn btn-outline-secondary m-5">削除済みのよくある質問を復元する</a>
        </div>
    </main>
    <footer class="text-center m-5">
        <a href="../admin.php" class="btn btn-primary">管理者TOPに戻る</a>
    </footer>
</body>
</html>

        <section class="l-faq" id="held-in">
            <div class="l-wrapper">
                <div class="l-faq-bg">
                    <h3 class="l-faq-about">来場について</h3>
                </div>
                <div class="l-wrapper-inner">
                    <dl class="c-faq">
                        <div class="c-faq-content">
                            <dt class="c-faq-question">
                                Q.入場料はかかりますか？</dt>
                            <dd class="c-faq-answer">A.入場は無料です。どなたでもご自由にお楽しみいただけます。飲食の購入は各店舗でお支払いください。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.開催時間を教えてください</dt>
                            <dd class="c-faq-answer">A.開催時間は各日10:00~20:00を予定しています。最終日は終了時間が早まる場合があります。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.雨天の場合も開催されますか？</dt>
                            <dd class="c-faq-answer">A.雨天決行ですが、荒天の場合は、安全を考慮し中止となる場合があります。最新情報はSNSでお知らせします。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.支払方法を教えてください</dt>
                            <dd class="c-faq-answer">A.現金のほか、主要な電子マネー・QRコード決済がご利用いただけます。</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>
        <section class="l-faq" id="event">
            <div class="l-wrapper">
                <div class="l-faq-bg">
                    <h3 class="l-faq-about">会場について</h3>
                </div>
                <div class="l-wrapper-inner">
                    <dl class="c-faq">
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.喫煙所はありますか？</dt>
                            <dd class="c-faq-answer">A.会場内は全面禁煙ですが、敷地外に指定の喫煙エリアを設けています。スタッフの案内に従ってご利用ください。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.授乳室やおむつ替えスペースはありますか？</dt>
                            <dd class="c-faq-answer">A.はい、メインゲート付近に授乳室とオムツ替え代を設置しています。小さなお子様連れでも安心してご利用いただけます</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.駐車場はありますか？</dt>
                            <dd class="c-faq-answer">A.専用駐車場はございません。公共交通機関のご利用をおすすめします。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.ペットを連れて入場できますか？</dt>
                            <dd class="c-faq-answer">A.混雑が予想されるため、ペットの同伴はご遠慮ください。ただし、補助犬は入場可能です。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.ゴミはどうすればよいですか？</dt>
                            <dd class="c-faq-answer">A.会場内に分別ゴミ箱を設置しています。リサイクルにご協力をお願いします。</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>
        <section class="l-faq" id="other">
            <div class="l-wrapper">
                <div class="l-faq-bg">
                    <h3 class="l-faq-about">その他</h3>
                </div>
                <div class="l-wrapper-inner">
                    <dl class="c-faq">
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.忘れ物をした場合はどうすればよいですか？</dt>
                            <dd class="c-faq-answer">A.会場本部でお預かりしています。イベント終了後は実行委員会までお問い合わせください。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.トイレはどこにありますか？</dt>
                            <dd class="c-faq-answer">A.会場内に複数の仮設トイレを設置しています。マップの「トイレ」アイコンをご確認ください。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.SNSで写真を投稿しても良いですか？</dt>
                            <dd class="c-faq-answer">A.はい、大歓迎です！公式ハッシュタグ「＃ふくおか餃子FES」をつけて投稿してください。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.開催中止の場合はどうなりますか？</dt>
                            <dd class="c-faq-answer">A.安全を最優先に判断し、中止の場合は公式サイトとSNSでお知らせします。</dd>
                        </div>
                        <div class="c-faq-content">
                            <dt class="c-faq-question">Q.問い合わせ先を教えてください</dt>
                            <dd class="c-faq-answer">A.「<a href="form.php">お問い合わせ</a>」ページのフォームまたは事務局メール宛にご連絡ください。</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>