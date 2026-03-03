<?php

session_start();
if (!$_SESSION['id']) {
    header('location:http://localhost:8080/gyoza-fes_b/admin/login.php');
    exit();
}
