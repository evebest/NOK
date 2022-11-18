<?php 
require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);

// 보안을 위한 Escape 처리 (그냥 문자로 처리함)
// injection 공격 : 고의로 DROP TABLE과 같은 명령어를 입력할 때 
// $_POST로 넘어오는 인자값들을 직접 받지 않고, mysqli_real_eacape_string을 통해 filtering된 인자로 받아줌.
$filtered = array(
    'TITLE' => mysqli_real_escape_string($conn, $_POST['title']),
    'CONTENT' => mysqli_real_escape_string($conn, $_POST['content']),
    'WRITER' => mysqli_real_escape_string($conn, $_POST['writer']),
);

// 글 등록
$sql = "INSERT INTO freeboard (classify, title, content, writer, regdate) VALUES ('".$_POST["classify"]."', '".$filtered['TITLE']."', '".$filtered['CONTENT']."', '".$filtered['WRITER']."', now())";

$result = mysqli_query($conn, $sql);

//Redirection 처리가 끝난 다음 사용자를 다시 어느 페이지로 되돌리는 것
header("Location: http://localhost:3000/index.php");
exit;
?>