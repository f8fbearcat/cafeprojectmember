<?php
//데이터베이스
const HOST = 'localhost';
const USER = 'root';
const PASS = '';
const DB = "guestbook";
const TABLE_GUEST = 'guests';
const TABLE_USERS = 'users';

function connect(){
    try {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        if ($conn) {
            //echo "연결됨";
            return $conn;
        } else {
            throw new Exception("접속이 불가능합니다");
        }
    } catch (Exception $e) {
        echo "접속이 불가능합니다";
        echo "오류 : " . $e->getMessage();
    }
    return null;
}

function makeQuery($handle,$query)
{
    return mysqli_query($handle,$query);
}

function getOneRecord($handle,$id,$table){
    $query="SELECT * FROM $table WHERE id='$id'";
    return makeQuery($handle,$query);
}

function getAllRecord($handle,$table)
{

    $query="SELECT * FROM $table";
    return makeQuery($handle,$query);
}

function deleteOneRecord($handle,$id,$table){
    $query = "DELETE FROM $table WHERE id='$id'";
    return makeQuery($handle,$query);
}

function updateOneRecord($handle,$data,$table){
    $id=$data['id'];
    $name=$data['name'];
    $email=$data['email'];
    $comment=$data['comment'];
    $query = "UPDATE $table SET name='$name',email='$email',comment='$comment' WHERE id='$id'";
    return makeQuery($handle,$query);
}
function insertOneRecord($handle,$table,$data){
//    $name=$data['name'];
//    $email=$data['email'];
//    $comment=$data['comment'];
    $str = "";
    foreach ($data as $value){
        $str .= "'$value',";
    }

    $str = rtrim($str,',');
    echo $str;
    $query = "INSERT INTO $table VALUES(NULL,$str)";
    return makeQuery($handle, $query);
}

//회원가입 여부 확인
function verifyUser($handle,$username,$table){
    $query = "SELECT * FROM $table WHERE username='$username'";
    $result = makeQuery($handle,$query);
    if(mysqli_num_rows($result)>0) {
        ///회원이 이미 존재
        return true;
        }
    return false;
}

function verifyPassword($handle,$username,$password,$table){
    $query = "SELECT password FROM $table WHERE username='$username'";
    $result = makeQuery($handle,$query);
    if(mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_array($result);
        if ($password == $row['password']) {
            return true;
        }
    }
    return false;
}

