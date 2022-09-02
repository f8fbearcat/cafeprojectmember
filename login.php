<?php
include_once "config.php";
$messages = [];


if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    try {
        if(strlen($username)>0 && strlen($password)>0){
            $isValidPassword = verifyPassword($conn,$username,$password,TABLE_USERS);
            if($isValidPassword){
                //로그인 성공
                $_SESSION['user']=$username;
                header("Location: index.php");
            }
            else{
                throw new Exception("오류가 발생했습니다");
            }
        }else{
            throw new Exception("오류가 발생했습니다");

        }
    }
    catch (Exception $e){
        $messages[]=$e->getMessage();
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
        <h1>로그인</h1>
        <div class="error-messages">
            <?php
            foreach($messages as $message){
                echo "<p>* $message</p>";
            }
            ?>
        </div>
        <?php
            showLoginForm();
        ?>
    </main>
    <footer>
        <?= getFooter() ?>
    </footer>
</div>
</body>
</html>