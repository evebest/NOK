<?php
session_start();
if(!empty($_GET['returnURL'])){
    $type= $_GET['returnURL'];
}

require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);
$result = mysqli_query($conn, "SELECT * FROM freeboard");
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Site Properties -->
    <title>로그인</title>
    <link rel="stylesheet" type="text/css" class="ui" href="./semantic/semantic.min.css">

    <style type="text/css">
    body {
        background-color: #ffffff;
    }

    .ui.container {
        width: 523px;
        min-width: 420px;
    }

    .ui.card {
        width: 100%;
    }

    .main.container {
        margin-top: 7em;
    }

    .signup {
        margin-bottom: 30px;
        ;
    }

    .ui .message {
        margin-top: 3em;
    }
    </style>
</head>

<body>
    <div class="ui main text container">
        <h1>로그인</h1>
        <div class="signup"></div>
        <form class="ui form" action="login_process.php" method="POST">
            <div class="signup" id="id">
                <label>아이디</label>
                <div class="ui fluid input">
                    <input type="text" name="login_id">
                </div>
            </div>
            <div class="signup" id="pw">
                <label>비밀번호</label>
                <div class="ui fluid input">
                    <input type="text" name="pw">
                </div>
            </div>
            <input type="hidden" name="type" value=<?php echo $type?>>
            <?php if(!empty($_GET['post_id'])) { 
                $post_id = $_GET['post_id']; ?>
            <input type="hidden" name="post_id" value=<?php echo $post_id?>>
            <?php } ?>
            <button class="ui primary fluid button" type="submit">로그인</button>
        </form>
        <div class="ui message">아이디가 없으신가요? <a href="signup.php">회원가입</a></div>

    </div>


</body>

</html>