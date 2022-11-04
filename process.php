<?php 
require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);

// 글 등록
$sql = "INSERT INTO freeboard (classify, title, content, writer, regdate) VALUES ('".$_POST["classify"]."', '".$_POST["title"]."', '".$_POST["content"]."', '".$_POST["writer"]."', now())";
$result = mysqli_query($conn, $sql);

//Redirection 처리가 끝난 다음 사용자를 다시 어느 페이지로 되돌리는 것
header("Location: http://localhost:3000/index.php");
?>