<?php
    include "config.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="main-container">
    <?php showHeader() ?>
    <main>
        <h1>내용</h1>
        <?php $conn = connect();
        showGuestbook($conn,TABLE_GUEST )?>
    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>