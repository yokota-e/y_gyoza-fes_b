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

//お問い合わせの種別IDから種別名を返す関数
function get_type_list()
{
    $role = array();
    try {
        //rolesテーブルから全レコードを取得
        $db = db_connect();
        $sql = 'SELECT * FROM type';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //$resultを使って$role配列を作成
        foreach ($result as $row) {
            $role[$row['id']] = $row['role'];
        }
        return $role;
    } catch (PDOException $e) {
        exit('エラー: ' . $e->getMessage());
    }
}


//お問い合わせの対応状況IDから対応状況名を返す関数
function get_state_list()
{
    $role = array();
    try {
        //rolesテーブルから全レコードを取得
        $db = db_connect();
        $sql = 'SELECT * FROM state';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $role[$row['id']] = $row['status'];
        }
        return $role;
    } catch (PDOException $e) {
        exit('エラー: ' . $e->getMessage());
    }
}



//管理者IDから管理者名を返す関数
function get_users_list()
{
    $role = array();
    try {
        //rolesテーブルから全レコードを取得
        $db = db_connect();
        $sql = 'SELECT * FROM users';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $role[$row['id']] = $row['name'];
        }
        return $role;
    } catch (PDOException $e) {
        exit('エラー: ' . $e->getMessage());
    }
}
