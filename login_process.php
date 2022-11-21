<?php 
session_start();

require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);
$result = mysqli_query($conn, "SELECT nickname, id FROM user WHERE login_id='".$_POST['login_id']."' AND pw=".$_POST['pw']);

$row = mysqli_fetch_assoc($result);

if(!empty($row)){
    $_SESSION['is_login'] = true;
    $_SESSION['nickname'] = $row['nickname'];
    $_SESSION['user_id'] = $row['id'];
    if($_POST['type'] == 'w') {
        header("Location: ./write.php");
        exit;
    } else if($_POST['type'] == 'r') {
        header("Location: ./read.php?id=".$_POST['post_id']);
        exit;
    } 
    header("Location: index.php");
    exit;
}else{
    echo "<script type='text/javascript'>";
    echo "alert('로그인하지 못했습니다.');";
    echo "window.location.href='login.php?returnURL=i';";
    echo "</script>";
}
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