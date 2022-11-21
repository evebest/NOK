<?php 
session_start();
// echo 'nickname='.$_SESSION['nickname'];
// echo 'post_id='.$_POST['post_id'];

require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);

$pre_sql = "SELECT id FROM user WHERE nickname='".$_SESSION['nickname']."'";
echo $pre_sql;
$pre_result = mysqli_query($conn, $pre_sql);
$row = mysqli_fetch_assoc($pre_result);
echo 'user_id='.$row['id'];

// 보안을 위한 Escape 처리 (그냥 문자로 처리함)
// injection 공격 : 고의로 DROP TABLE과 같은 명령어를 입력할 때 
// $_POST로 넘어오는 인자값들을 직접 받지 않고, mysqli_real_eacape_string을 통해 filtering된 인자로 받아줌.
$filtered = array(
    'REPLY' => mysqli_real_escape_string($conn, $_POST['reply'])
);

// 댓글 등록
$sql = "INSERT INTO reply (reply, regdate, user_id, post_id) VALUES ('".$filtered['REPLY']."', NOW(), '".$row['id']."', '".$_POST['post_id']."')";


mysqli_query($conn, $sql);
mysqli_close($conn);

//Redirection 처리가 끝난 다음 사용자를 다시 어느 페이지로 되돌리는 것
header("Location: http://localhost:3000/read.php?id=".$_POST['post_id']);
?>
<script>

</script>