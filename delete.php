<?php
    include "config.php";

    isAllowed();
    $message = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        try{
            $result = deleteOneRecord($conn,$id,TABLE_GUEST);
            if($result){
                $message="삭제 성공";
            }
            else{
                throw new Exception("삭제 실패");
            }

        }catch(Exception $e) {
            $message = $e->getMessage();
        }
    }


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
        <p><?=$message?></p>
    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>