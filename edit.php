<?php
    include "config.php";


    isAllowed();

    $message = "수정";
    $showForm = false;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        try{
            $result = getOneRecord($conn,$id,TABLE_GUEST);
            if($result){
                $showForm=true;
            }
            else{
                throw new Exception("불러오기 실패");
            }

        }catch(Exception $e) {
            $message = $e->getMessage();
        }
    }

    if(isset($_POST['submit'])){
/*        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];*/

        try {
            if(updateOneRecord($conn, $_POST, TABLE_GUEST)){
                $message = "감사합니다";
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
          showEditForm($result);
        }?>
    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>