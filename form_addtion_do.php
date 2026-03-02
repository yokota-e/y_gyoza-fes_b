<?php
include('./function/function.php');

session_start();
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

    $_SESSION["type"] = $role;
    $_SESSION["name"] = $name;
    $_SESSION["name_kana"] = $name_kana;
    $_SESSION["company"] = $company;
    $_SESSION["tel"] = $tel;
    $_SESSION["address"] = $address;
    $_SESSION["store"] = $shop_name;
    $_SESSION["text"] = $text_body;

    //send_compへ移行する
    header('Location: send_comp.php');
    exit();
} catch (PDOException $e) {
    exit('エラー' . $e->getMessage());
}
