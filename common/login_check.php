<?php

session_start();
if (!$_SESSION['id']) {
    header('location:http://localhost:8080/y_gyoza-fes_b/admin/login.php');
    exit();
}
