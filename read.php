<?php
session_start();

require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);

//index.php에서 read.php?id=이라고 줬으니까 $_GET으로 받을 때도 id로 받아야 됨.
$post_id = $_GET["id"]; 

$sql = "SELECT a.title, a.classify, a.content, a.regdate, b.nickname FROM (SELECT * FROM post WHERE id=".$post_id.") a JOIN user b ON a.user_id = b.id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>



<!DOCTYPE html>
<html>

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Site Properties -->
    <title>암환우 보호자 커뮤니티</title>
    <link rel="stylesheet" type="text/css" class="ui" href="/semantic/semantic.min.css">

    <style type="text/css">
    body {
        background-color: #ffffff;
    }

    .ui.menu .item img.logo {
        margin-right: 1.5em;
    }

    .main.container {
        margin-top: 7em;
    }

    .ui.footer.segment {
        margin: 5em 0em 0em;
        padding: 5em 0em;
    }

    .ui.form textarea:not([rows]) {
        resize: none;
        height: 2em;
    }

    .top,
    .title,
    .content {
        margin: 10px 0px 50px 0px;
    }

    .content {
        font-size: 16px;
    }
    </style>
</head>

<body>
    <div class="ui fixed inverted menu">
        <div class="ui container">
            <a href="index.php" class="header item">
                <img class="logo" src="assets/images/logo.png" />
                Project Name
            </a>
            <a href="#" class="item">Home</a>
            <div class="ui simple dropdown item">
                Dropdown <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="#">Link Item</a>
                    <a class="item" href="#">Link Item</a>
                    <div class="divider"></div>
                    <div class="header">Header Item</div>
                    <div class="item">
                        <i class="dropdown icon"></i>
                        Sub Menu
                        <div class="menu">
                            <a class="item" href="#">Link Item</a>
                            <a class="item" href="#">Link Item</a>
                        </div>
                    </div>
                    <a class="item" href="#">Link Item</a>
                </div>
            </div>
            <div style="color: white;">
                <?php if (!empty($_SESSION['nickname'])) { echo $_SESSION['nickname']."님 환영합니다!";?>
                <button class="ui button" onclick="location.href='logout.php'">
                    로그아웃
                </button>
                <?php } else { ?>
                <button class="ui button" onclick="location.href='login.php?returnURL=i'">
                    로그인
                </button>
                <button class="ui button" onclick="location.href='signup.php'">
                    회원가입
                </button>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="ui main text container">
        <div class="top">
            <p><?php echo $row['classify']?></p>
            <p><?php echo $row['nickname']?></p>
        </div>
        <div class="title">
            <h1>
                <p><?php echo $row['title']?></p>
            </h1>
        </div>
        <div class="content">
            <?php echo $row['content']?>
        </div>

        <?php 
            $sql = "SELECT b.nickname, a.reply, a.regdate FROM (SELECT * FROM reply WHERE post_id=".$post_id.") a JOIN user b ON a.user_id=b.id";
            $result = mysqli_query($conn, $sql);                
            while($row = mysqli_fetch_array($result)) {
            ?>
        <p><?php echo $row['nickname']?></p>
        <p><?php echo $row['reply']?></p>
        <p><?php echo $row['regdate']?></p>
        <?php } ?>

        <?php if(!isset($_SESSION['is_login'])) {?>
        <div class="ui bottom attached warning message">
            <i class="icon pencil alternate"></i>
            댓글을 쓰려면 <a href="./login.php?post_id=<?php echo $post_id?>&returnURL=r">로그인</a> 이 필요합니다.
        </div>
        <?php } else { ?>
        <form class="ui reply form" id="frm" action="reply_process.php" method="POST">
            <div class="field">
                <textarea name="reply"></textarea>
                <input type="hidden" name="post_id" value="<?php echo $post_id?>">
            </div>
            <div class="ui right floated primary submit labeled icon button" onclick="test();">
                <!-- <div class="ui right floated primary submit labeled icon button" onclick="fetchReply('reply_list');"
                onclick="fetchReply('reply_list')">-->
                <i class="icon edit"></i>댓글달기
            </div>
        </form>
        <?php } ?>
    </div>

    <div class="ui inverted vertical footer segment">
        <div class="ui center aligned container">
            <div class="ui stackable inverted divided grid">
                <div class="three wide column">
                    <h4 class="ui inverted header">Group 1</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                        <a href="#" class="item">Link Three</a>
                        <a href="#" class="item">Link Four</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Group 2</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                        <a href="#" class="item">Link Three</a>
                        <a href="#" class="item">Link Four</a>
                    </div>
                </div>
                <div class="three wide column">
                    <h4 class="ui inverted header">Group 3</h4>
                    <div class="ui inverted link list">
                        <a href="#" class="item">Link One</a>
                        <a href="#" class="item">Link Two</a>
                        <a href="#" class="item">Link Three</a>
                        <a href="#" class="item">Link Four</a>
                    </div>
                </div>
                <div class="seven wide column">
                    <h4 class="ui inverted header">Footer Header</h4>
                    <p>
                        Extra space for a call to action inside the footer that could help
                        re-engage users.
                    </p>
                </div>
            </div>
            <div class="ui inverted section divider"></div>
            <img src="assets/images/logo.png" class="ui centered mini image" />
            <div class="ui horizontal inverted small divided link list">
                <a class="item" href="#">Site Map</a>
                <a class="item" href="#">Contact Us</a>
                <a class="item" href="#">Terms and Conditions</a>
                <a class="item" href="#">Privacy Policy</a>
            </div>
        </div>
    </div>

    <script>
    function test() {
        // str = document.getElementById("reply_id").value;
        // str = str.replace(/(?:\r\n|\r|\n)/g, '<br/>');
        // document.getElementById("reply_id").value = str;
        document.getElementById("frm").submit();
    }

    // function fetchReply(name) {
    //     fetch(name).then(function(response) {
    //         response.json().then(function(json) {
    //             console.log(json);
    //         })
    //     });
    // }
    </script>
</body>

</html>