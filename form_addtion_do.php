<?php
include('./function/function.php');

$role = $_POST["inquiry-type"];
echo $role;
$name = $_POST["user-name"];
$name_kana = $_POST["user-name-furigana"];
$company = $_POST["company-name"];
$tel = $_POST["telephone-number"];
$address = $_POST["user-email-address"];
$shop_name = $_POST["store-name"];
$text_body = $_POST["inquiry-details"];

//必須項目チェック
if ($role == '' || $name == '' || $name_kana == '' ||  $company == '' || $tel == '' || $address == '' || $shop_name == '' || $text_body == '') {
    // header("Location: form_addition.php");
    exit();
}

try {
    //sDBへ接続
    $db = db_connect();
    //プリペアードステートメント作成
    $sql = 'INSERT INTO contacts(`role`, `name`, `name_kana`, `company`, `tel`, `address`, `shop_name`, `body`,now()) VALUES (:role,:name,:name_kana,:company,:tel,:address,:shop_name,:body,now())';
    $stmt = $db->prepare($sql);
    //$stmt->bindParam（’プレースホルダ’、プレースホルダに埋め込みたい値、データ型）
    $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':name_kana', $name_kana, PDO::PARAM_STR);
    $stmt->bindParam(':company', $company, PDO::PARAM_STR);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':shop_name', $shop_name, PDO::PARAM_STR);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
    //SQL実行
    $stmt->execute();
} catch (PDOException $e) {
    exit('エラー' . $e->getMessage());
}
