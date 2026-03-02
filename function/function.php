<?php

// DBへの接続情報
define('DB_HOST', 'localhost');
define('DB_NAME', 'gyoza');
define('DB_USER', 'gyozauser');
define('DB_PASS', 'password');

// DBへ接続する関数
function db_connect()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}

//管理者IDから管理者名を返すID
function get_users_list()
{
    $roles = array();
    try {
        //rolesテーブルから全レコードを取得
        $db = db_connect();
        $sql = 'SELECT * FROM roles';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // debug_check_array($result);

        //$resultを使って$roles配列を作成
        foreach ($result as $row) {
            $roles[$row['id']] = $row['name'];
        }
        return $roles;
    } catch (PDOException $e) {
        exit('エラー: ' . $e->getMessage());
    }
}