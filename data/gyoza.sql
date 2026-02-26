-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-02-26 08:42:25
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gyoza`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, '来場について'),
(2, '会場について'),
(3, 'その他');

-- --------------------------------------------------------

--
-- テーブルの構造 `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_kana` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `tel` varchar(12) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `post_date` datetime DEFAULT NULL,
  `support_date` datetime DEFAULT NULL,
  `admin_name` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `contacts`
--

INSERT INTO `contacts` (`id`, `role`, `name`, `name_kana`, `company`, `tel`, `address`, `shop_name`, `body`, `post_date`, `support_date`, `admin_name`, `status`) VALUES
(1, 1, '横田', 'よこた', '創造社リカレントスクール', '092-401-1835', 'mail@mail.xx', '福岡校', 'テキストテキストテキスト', '2026-02-26 16:37:17', '2026-02-26 16:37:17', 3, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `faq`
--

INSERT INTO `faq` (`id`, `category`, `question`, `answer`, `is_deleted`) VALUES
(1, 1, '入場料はかかりますか？', '入場は無料です。どなたでもご自由にお楽しみいただけます。飲食の購入は各店舗でお支払いください。', 0),
(2, 1, '開催時間を教えてください', '開催時間は各日10:00~20:00を予定しています。最終日は終了時間が早まる場合があります。', 0),
(3, 1, '雨天の場合も開催されますか？', '雨天決行ですが、荒天の場合は、安全を考慮し中止となる場合があります。最新情報はSNSでお知らせします。', 0),
(4, 1, '支払方法を教えてください', '現金のほか、主要な電子マネー・QRコード決済がご利用いただけます。', 0),
(5, 2, '喫煙所はありますか？', '会場内は全面禁煙ですが、敷地外に指定の喫煙エリアを設けています。スタッフの案内に従ってご利用ください。', 0),
(6, 2, '授乳室やおむつ替えスペースはありますか？', 'はい、メインゲート付近に授乳室とオムツ替え代を設置しています。小さなお子様連れでも安心してご利用いただけます', 0),
(7, 2, '駐車場はありますか？', '専用駐車場はございません。公共交通機関のご利用をおすすめします。', 0),
(8, 2, 'ペットを連れて入場できますか？', '混雑が予想されるため、ペットの同伴はご遠慮ください。ただし、補助犬は入場可能です。', 0),
(9, 2, 'ゴミはどうすればよいですか？', '会場内に分別ゴミ箱を設置しています。リサイクルにご協力をお願いします。', 0),
(10, 3, '忘れ物をした場合はどうすればよいですか？', '会場本部でお預かりしています。イベント終了後は実行委員会までお問い合わせください。', 0),
(11, 3, 'トイレはどこにありますか？', '会場内に複数の仮設トイレを設置しています。マップの「トイレ」アイコンをご確認ください。', 0),
(12, 3, 'SNSで写真を投稿しても良いですか？', 'はい、大歓迎です！公式ハッシュタグ「＃ふくおか餃子FES」をつけて投稿してください。', 0),
(13, 3, '開催中止の場合はどうなりますか？', '安全を最優先に判断し、中止の場合は公式サイトとSNSでお知らせします。', 0),
(14, 3, '問い合わせ先を教えてください', '「お問い合わせ」ページのフォームまたは事務局メール宛にご連絡ください。', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(3) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `menus`
--

INSERT INTO `menus` (`id`, `name`, `amount`, `price`, `description`, `image`, `created_at`, `created_user_id`, `updated_at`, `updated_user_id`, `is_deleted`) VALUES
(1, '肉汁あふれる焼き餃子', 6, 580, '香ばしく焼き上げた皮の中には、あふれんばかりの肉汁がぎっしり。厳選された国産豚とキャベツの旨味が広がる、満足感たっぷりの一品です。\r\n一口噛めば、ジュワッとした肉汁が口いっぱいに広がります。', 'menu01.jpg', '2026-02-26 16:03:17', 3, '2026-02-26 16:03:17', 3, 0),
(2, 'ふっくら蒸しあげ餃子', 8, 520, 'もちもちの皮で包んだ餃子を、丁寧に蒸し上げた優しい味わいの一皿。\r\n 蒸気でふっくら仕上げた皮はとろけるようにやわらかく、野菜と肉の旨味がじんわり広がります。特製のポン酢だれをつけて、さっぱりとお召し上がりください。', 'menu02.jpg', '2026-02-26 16:03:17', 3, '2026-02-26 16:03:17', 3, 0),
(3, '中華風スープ餃子', 5, 680, '鶏ガラと香味野菜をじっくり煮込んだ特製スープに、つるりとした水餃子を浮かべた人気メニュー。\n旨味たっぷりのスープと、もちもち食感の餃子が絶妙に絡み合います。彩り豊かな野菜とご一緒に、ほっと温まる一杯をどうぞ。', 'menu03.jpg', '2026-02-26 16:03:17', 3, '2026-02-26 16:03:17', 3, 0),
(4, 'カリもち！揚げ餃子', 5, 600, '外はカリッ、中はもちっと食感が楽しい、人気の揚げ餃子。\r\n 特製スパイスを混ぜ込んだ肉餡は、香ばしい皮と相性抜群。おつまみとしても、おやつ感覚でも楽しめるクセになる味です。熱々のうちに、レモンを絞ってどうぞ！', 'menu04.jpg', '2026-02-26 16:03:17', 3, '2026-02-26 16:03:17', 3, 0),
(5, 'お口に広がる地中海の風', 5, 720, 'オリーブオイルとハーブで仕上げた、地中海スタイルの創作餃子。\r\nしっとりとした皮に包まれた具材は、チーズ・オリーブ・トマトの香りが絶妙なバランス。芳醇なオイルソースとハーブの香りが口いっぱいに広がります。ワインにもぴったりな、上品な一皿。', 'menu05.jpg', '2026-02-26 16:03:17', 3, '2026-02-26 16:03:17', 3, 0),
(6, '素材の旨味ひきたつ水餃子', 8, 550, '国産野菜と豚肉の旨味をぎゅっと閉じ込めた、つるんと食感の水餃子。\r\n素材本来の味を生かすため、化学調味料を使わず丁寧に手包み。あっさりとした特製だれで、いくつでも食べられる軽やかな味わいです。熱々のままでも、冷やしてもおいしい万能餃子。', 'menu06.jpg', '2026-02-26 16:03:17', 3, '2026-02-26 16:03:17', 3, 0),
(7, 'しびうまラー油餃子', 6, 620, '自家製の花椒ラー油をたっぷり絡めた、刺激的な一皿。\r\nひと口食べれば、山椒のしびれと唐辛子の辛味がじわっと広がり、ジューシーな肉餡の旨味が後を引きます。辛党必食！ 病みつきになる辛さでリピーター続出。', 'menu07.jpg', '2026-02-26 16:03:17', 3, '2026-02-26 16:03:17', 3, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `image`, `body`, `date`, `is_deleted`) VALUES
(1, 3, 'ふくおか餃子FES開催決定!', 'news_img1.png', 'テキストテキストテキストテキストテキストテキストテキスト', '2030-02-16 00:00:00', 0),
(2, 3, 'お得な前売り券は公式アプリで', 'news_img1.png', 'テキストテキストテキストテキストテキストテキストテキスト', '2030-02-23 00:00:00', 0),
(3, 3, '出展者インタビュー 博多で人気の「博多ぎょうざ堂」', 'news_img1.png', 'テキストテキストテキストテキストテキストテキストテキスト', '2030-02-25 00:00:00', 0),
(4, 3, 'ふくおか餃子FES開催決定!', 'news_img1.png', 'テキストテキストテキストテキストテキストテキストテキスト', '2030-02-16 00:00:00', 0),
(5, 3, 'ふくおか餃子FES開催決定!', 'news_img1.png', 'テキストテキストテキストテキストテキストテキストテキスト', '2030-02-16 00:00:00', 0),
(6, 3, 'ふくおか餃子FES開催決定!', 'news_img1.png', 'テキストテキストテキストテキストテキストテキストテキスト', '2030-02-16 00:00:00', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `booth` varchar(11) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `shops`
--

INSERT INTO `shops` (`id`, `name`, `description`, `booth`, `tel`, `address`, `created_at`, `created_user_id`, `updated_at`, `updated_user_id`, `is_deleted`) VALUES
(1, '博多ぎょうざ堂', '福岡を代表する老舗餃子専門店。国産豚とキャベツを使用し、ひとつひとつ手包みで仕上げています。外はカリッと、中は肉汁たっぷりの博多スタイルが人気。', 'B-01', '0X-XXXX-XXXX', 'mailmailmail@mail.com', '2026-02-26 15:31:45', 3, '2026-02-26 15:31:45', 3, 0),
(2, '中華食堂 蒸々屋（むしむしや）', '優しい味わいの蒸し料理を得意とする中華食堂。ふっくら蒸し上げた餃子や点心が好評で、家族連れにも人気。手作りの皮が自慢です。', 'B-02', '0X-XXXX-XXXX', 'mailmailmail@mail.com', '2026-02-26 15:31:45', 3, '2026-02-26 15:31:45', 3, 0),
(3, '餃子茶寮 彩香（さいか）', '和のテイストを取り入れた創作中華が魅力の茶寮。旨味たっぷりのスープ餃子をはじめ、彩り豊かなメニューを提供しています。', 'B-03', '0X-XXXX-XXXX', 'mailmailmail@mail.com', '2026-02-26 15:31:45', 3, '2026-02-26 15:31:45', 3, 0),
(4, '餃子バル 風雷坊（ふうらいぼう）', 'スタイリッシュな餃子バルとして若者に人気。ビールやワインとの相性を考えたスパイシーな揚げ餃子が名物。夜の一杯にぴったり。', 'B-04', '0X-XXXX-XXXX', 'mailmailmail@mail.com', '2026-02-26 15:31:45', 3, '2026-02-26 15:31:45', 3, 0),
(5, 'Mediterraneo Gyoza（メディテラネオ ギョウザ）', '地中海の食文化を融合した創作餃子専門店。オリーブやハーブを使った新感覚の餃子で女性客に人気。見た目も華やか。', 'B-05', '0X-XXXX-XXXX', 'mailmailmail@mail.com', '2026-02-26 15:31:45', 3, '2026-02-26 15:31:45', 3, 0),
(6, '餃子処 湯心（ゆごころ）', '素材の味を大切にした、体にやさしい餃子を提供。化学調味料不使用の水餃子が看板商品。シンプルながら深い味わいです。', 'B-06', '0X-XXXX-XXXX', 'mailmailmail@mail.com', '2026-02-26 15:31:45', 3, '2026-02-26 15:31:45', 3, 0),
(7, '辛味房 赤龍（しんみぼう せきりゅう）', '本格四川の技を受け継ぐ辛味料理専門店。花椒を効かせた「しびうまラー油餃子」が人気で、辛党ファンが多数来店。', 'B-07', '0X-XXXX-XXXX', 'mailmailmail@mail.com', '2026-02-26 15:31:45', 3, '2026-02-26 15:31:45', 3, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `state`
--

INSERT INTO `state` (`id`, `status`) VALUES
(1, '未対応'),
(2, '対応中'),
(3, '対応済み');

-- --------------------------------------------------------

--
-- テーブルの構造 `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `type`
--

INSERT INTO `type` (`id`, `role`) VALUES
(1, 'FESに関すること'),
(2, '店舗に関すること'),
(3, '会場に関すること'),
(4, 'その他お問い合わせ');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `date`, `is_deleted`) VALUES
(3, 'komatsu', '1234', '2026-02-26 15:20:32', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `admin_name` (`admin_name`),
  ADD KEY `status` (`status`);

--
-- テーブルのインデックス `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- テーブルのインデックス `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_user_id` (`created_user_id`),
  ADD KEY `updated_user_id` (`updated_user_id`);

--
-- テーブルのインデックス `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_user_id` (`created_user_id`),
  ADD KEY `updated_user_id` (`updated_user_id`);

--
-- テーブルのインデックス `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- テーブルの AUTO_INCREMENT `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`role`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `contacts_ibfk_2` FOREIGN KEY (`admin_name`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contacts_ibfk_3` FOREIGN KEY (`status`) REFERENCES `state` (`id`);

--
-- テーブルの制約 `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);

--
-- テーブルの制約 `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`created_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`updated_user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`created_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shops_ibfk_2` FOREIGN KEY (`updated_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
