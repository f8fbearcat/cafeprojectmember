<?php
function isAllowed(){
    if(!isset($_SESSION['user'])){
        header("location: index.php");
    }
}
function getTopNav()
{
    $str = "
    <nav>
    <ul> 
        <li><a href='index.php'>홈</a></li>
        <li><a href='view.php'>보기</a></li>
        <li><a href='signup.php'>등록</a></li>";
    if(!isset($_SESSION['user'])){
        $str .= "
        <li><a href='register.php'>가입</a></li>
        <li><a href='login.php'>로그인</a></li>";
    } else {
        $str .= "
        <li><a href='logout.php'>로그아웃</a></li>";
        }
    $str .= "</ul></nav>";
    return $str;
}
function getFooter()
{
    return "<footer>임시 FOOTER</footer>";
}
function showHeader(){
    $user = "Guest";
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }
    ?>
    <header>
        <h1>로그인</h1>
        <?=getTopNav()?>
        <div class="user-login">
            <p>환영합니다, <?= $user?></p>
        </div>
    </header>
    <?php
}
function showGuestbook($handle,$table)
{
    ?>
<table class="guestbook_table" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th>No.</th>
        <th>이름</th>
        <th>이메일</th>
        <th>코멘트</th>
        <?php
        if (isset($_SESSION['user'])){
        ?>
        <th>적용</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $result = getAllRecord($handle, $table);
    $counter = 1;
    while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?=$counter++?></td>
        <td><?=$row['name']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['comment']?></td>
        <?php
        if (isset($_SESSION['user'])){
            ?>
        <td>
            <ul>
                <li><a href="edit.php?id=<?= $row['id'] ?>">편집</a></li>
                <li><a href="delete.php?id=<?= $row['id'] ?>">삭제</a></li>
            </ul>
        </td>
        <?php } ?>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<?php
}

function showGuestbookForm(){
    ?>
<form name="guest_book" id="guest_book" action="<?= $_SERVER['PHP_SELF']?>" method="post">
    <div class="guestbook_control">
        <label for="name">이름:</label>
        <input name="name" id="name">
    </div>
    <div class="guestbook_control">
        <label for="email">이메일:</label>
        <input name="email" id="email">
    </div>
    <div class="guestbook_control">
        <label for="comment">내용:</label>
        <textarea name="comment" id="comment"></textarea>
    </div>
    <div class="guestbook_control">
        <input class="btn-submit" type="submit" name="submit">
        <input class="btn-reset" type="reset"
               name="reset" value="초기화">
    </div>
</form>
<?php
}


function showEditForm($result){
    $row = mysqli_fetch_array(($result));
    ?>
    <form name="guest_book" id="guest_book" action="<?= $_SERVER['PHP_SELF']?>" method="post">

        <input type="hidden" name="id" id="id" value="<?=$row['id']?>">

        <div class="guestbook_control">
            <label for="name">이름:</label>
            <input name="name" id="name" value="<?=$row['name']?>">
        </div>
        <div class="guestbook_control">
            <label for="email">이메일:</label>
            <input name="email" id="email" value="<?=$row['email']?>">
        </div>
        <div class="guestbook_control">
            <label for="comment">내용:</label>
            <textarea name="comment" id="name"><?=$row['comment']?></textarea>
        </div>
        <div class="guestbook_control">
            <input class="btn-submit" type="submit" name="submit">
            <input class="btn-reset" type="reset"
                   name="reset" value="초기화">
        </div>
    </form>
    <?php
}

function showLoginForm(){
    ?>
    <form name="login_form" id="login_form" action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <div class="login_control">
            <label for="username">유저명:</label>
            <input name="username" id="username" required>
        </div>
        <div class="login_control">
            <label for="password">암호:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="login_control">
            <input class="btn-submit" type="submit" name="submit" value="Login">
            <input class="btn-reset" type="reset"
                   name="reset" value="초기화">
        </div>
    </form>
    <?php
}

function showRegForm(){
    ?>
    <form name="reg_form" id="reg_form" action="<?= $_SERVER['PHP_SELF']?>" method="post">
        <div class="reg_control">
            <label for="username">유저명:</label>
            <input name="username" id="username" required>
        </div>
        <div class="reg_control">
            <label for="email">이메일:</label>
            <input name="email" id="email" required>
        </div>
        <div class="reg_control">
            <label for="password">암호:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="reg_control">
            <label for="re_password">암호 확인:</label>
            <input type="password" name="re_password" id="re_password" required>
        </div>
        <div class="reg_control">
            <label for="adress">주소:</label>
            <input name="adress" id="adress">
        </div>
        <div class="reg_control">
            <input class="btn-submit" type="submit" name="submit" value="Reg">
            <input class="btn-reset" type="reset"
                   name="reset" value="Reset">
        </div>
    </form>
    <?php
}