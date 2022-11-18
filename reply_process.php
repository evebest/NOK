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
    'REPLY' => mysqli_real_escape_string($conn, $_POST['reply'])
);

// 회원 등록
// $sql = "INSERT INTO user (nickname, regdate, email, login_id, pw, name) VALUES ('".$filtered['NICKNAME']."', NOW(), '".$filtered['EMAIL']."', '".$filtered['LOGIN_ID']."', '".$filtered['PW']."', '".$filtered['NAME']."')";

// $result = mysqli_query($conn, $sql);

//Redirection 처리가 끝난 다음 사용자를 다시 어느 페이지로 되돌리는 것
// header("Location: http://localhost:3000/index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <textarea><?php echo $filtered["REPLY"]?></textarea> -->
    <?php echo $filtered["REPLY"]?>
</body>

</html>