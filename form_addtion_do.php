<?php
include('./function/function.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$role = $_POST["type"];
$name = $_POST["name"];
$name_kana = $_POST["name_kana"];
$company = $_POST["company"];
$tel = $_POST["tel"];
$address = $_POST["address"];
$shop_name = $_POST["store"];
$text_body = $_POST["text"];
}
//必須項目チェック
if ($role == '' || $name == '' || $name_kana == '' ||  $company == '' || $tel == '' || $address == '' || $shop_name == '' || $text_body == '') {
    // header("Location: form_addition.php");
    exit();
}

try {
    //sDBへ接続
    $db = db_connect();
    //プリペアードステートメント作成
    $sql = 'INSERT INTO contacts(`role`, `name`, `name_kana`, `company`, `tel`, `address`, `shop_name`, `body`,`post_date`) VALUES (:role,:name,:name_kana,:company,:tel,:address,:shop_name,:body,now())';
    $stmt = $db->prepare($sql);
    //$stmt->bindParam（’プレースホルダ’、プレースホルダに埋め込みたい値、データ型）
    $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':name_kana', $name_kana, PDO::PARAM_STR);
    $stmt->bindParam(':company', $company, PDO::PARAM_STR);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':shop_name', $shop_name, PDO::PARAM_STR);
    $stmt->bindParam(':body', $text_body, PDO::PARAM_STR);
    //SQL実行
    $stmt->execute();
} catch (PDOException $e) {
    exit('エラー' . $e->getMessage());
}
