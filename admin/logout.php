<?php 
include('../function/function.php');

// セッションの開始
session_start();

// ログイン情報をリセットする
if(isset($_SESSION['id'])){
// 変数を削除
unset($_SESSION['id']);
}
header('location:login.php');

?>