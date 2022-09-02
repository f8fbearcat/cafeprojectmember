<?php
    include_once "config.php";
    $message = "작성";
    $showForm = true;
    if(isset($_POST['submit'])){

/*        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];*/

        try {
            unset($_POST['submit']);
            if(insertOneRecord($conn, TABLE_GUEST, $_POST)){
                $message = "수정됨";
                $showForm=false;

            }
            else{
                throw new Exception("오류가 발생했습니다");
            }
        }catch (Exception $e){
            $message=$e->getMessage();
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
        <?php
        if($showForm){
          showGuestbookForm();
        }?>
    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>