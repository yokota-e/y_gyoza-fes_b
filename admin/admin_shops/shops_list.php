<?php
// require_once __DIR__ . '../../function/function.php';

session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店舗一覧</title>
</head>

<body>

    <h1>店舗一覧</h1>

    <ul>
        <?php ?>
        <li><a href="shops_detail.php?id=<?php echo 'id' ?>"><?php echo 'name' ?></a></li>
        <?php ?>


    </ul>
</body>

</html>