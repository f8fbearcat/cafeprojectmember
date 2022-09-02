<?php
    include_once "config.php";
    $errors=[];
$message = "";
$showForm = true;
if(isset($_POST['submit'])) {
        /*        $name = $_POST['name'];
                $email = $_POST['email'];
                $comment = $_POST['comment'];*/

        try {
            unset($_POST['submit']);

            foreach ($_POST as $key => $value) {
                $item = trim($value); //공백 제거
                if (strlen($item) == 0) {
                    $errors[] = $key . "을 입력하십시오.";
                } else {
                    $_POST[$key] = $item;
                }
            }
            if(verifyUser($conn,$_POST['username'],TABLE_USERS)){
                $errors[]= "같은 유저명이 이미 존재합니다";
            }else{

            if (!$errors) {
                $password = $_POST['password'];
                $re_password = $_POST['re_password'];

                if ($password == $re_password) {
                    unset($_POST['re_password']);
                    if (insertOneRecord($conn, TABLE_USERS, $_POST)) {
                        $message = "등록 완료";
                        $showForm = false;
                    }
                    else {
                        throw new Exception("오류가 발생했습니다");
                    }
                }
                else {
                    $errors[] = "암호 불일치";
                }
            }
        }
    }
    catch
    (Exception $e){
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
        <h1><?=$message?></h1>
        <div class="error-messages">
            <?php
            foreach($errors as $error){
                echo"<span>* $error</span><br>";
            }
            ?>
        </div>
        <?php
        if($showForm){
            showRegForm();
        }?>
    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>