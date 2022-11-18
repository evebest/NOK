<?php 
session_start();

require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);
$result = mysqli_query($conn, "SELECT nickname FROM user WHERE login_id='".$_POST['login_id']."' AND pw=".$_POST['pw']);

$row = mysqli_fetch_assoc($result);

if(!empty($result)){
    $_SESSION['is_login'] = true;
    $_SESSION['nickname'] = $row['nickname'];
    if($_POST['type'] == 'w') {
        header("Location: ./write.php");
        exit;
    }
    header("Location: index.php");
    exit;
}
echo "로그인하지 못했습니다.";

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
    <script>
    console.log($_GET['returnURL'])
    </script>
</body>

</html>