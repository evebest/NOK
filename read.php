<?php
require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);
$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM freeboard WHERE id='".$id."'");
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

    <link rel="stylesheet" type="text/css" href="semantic/components/reset.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/site.css" />

    <link rel="stylesheet" type="text/css" href="semantic/components/container.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/grid.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/header.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/image.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/menu.css" />

    <link rel="stylesheet" type="text/css" href="semantic/components/divider.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/list.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/segment.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/dropdown.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/icon.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/input.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/button.css" />
    <link rel="stylesheet" type="text/css" href="semantic/components/form.css" />


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
            <a href="#" class="header item">
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
        </div>
    </div>

    <div class="ui main text container">
        <div class="top">
            <p><?php echo $row['classify']?></p>
            <p><?php echo $row['writer']?></p>
        </div>
        <div class="title">
            <h1>
                <p><?php echo $row['title']?></p>
            </h1>
        </div>
        <div class="content">
            <?php echo $row['content']?>
        </div>
        <form class="ui reply form" id="frm" action="reply_process.php" method="POST">
            <div class="field">
                <textarea name="reply"></textarea>
            </div>
            <div class="ui right floated primary submit labeled icon button" onclick="test();">
                <i class="icon edit"></i>댓글달기
            </div>
        </form>
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
        alert("까꿍!");
        document.getElementById("frm").submit();
    }
    </script>
</body>

</html>