<?php
session_start();

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
    <link rel="stylesheet" type="text/css" href="semantic/components/card.css" />


    <style type="text/css">
    body {
        background-color: #ffffff;
    }

    .ui.menu .item img.logo {
        /* em : 지정되거나 상속받은(혹은 상위 elements)에 대한 상대적인 백분율 크기  */
        /* 따라서 화면 크기에 동적으로 반응하는 확장형 웹에 유용함. */
        margin-right: 1.5em;
    }

    .ui.card {
        width: 100%;
    }

    #writer {
        display: inline;
    }

    #regdate {
        display: inline;
        float: right;
    }

    .main.container {
        margin-top: 7em;
    }

    .wireframe {
        margin-top: 2em;
    }

    .ui.footer.segment {
        margin: 5em 0em 0em;
        padding: 5em 0em;
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
            <div style="color: white;">
                <?php 
            if (!empty($_SESSION['nickname'])) echo $_SESSION['nickname']."님 환영합니다!"?>
            </div>
            <button class="ui button" onclick="location.href='login.php'">
                로그인
            </button>
            <button class="ui button" onclick="location.href='logout.php'">
                로그아웃
            </button>
        </div>
    </div>

    <div class=" ui main text container">
        <h1 class="ui header">암환우 보호자 커뮤니티</h1>
        <p>암환우 보호자들의 자유로운 생각과 의견을 나누는 커뮤니티입니다.</p>
        <p>자유롭게 작성해 주세요.</p>
        <div class="ui fluid icon input">
            <input type="text" placeholder="검색어를 입력하세요...">
            <i class="search icon"></i>
        </div>
        <?php 
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="ui card">
            <div class="content">
                <div class="header"><a
                        href="read.php?id=<?php echo $row['id']?>"><?php echo htmlspecialchars($row['title'])?></a>
                </div>
            </div>
            <div class="content">
                <h4 class="ui sub header"><?php echo $row['classify']?></h4>
                <div class="ui small feed">
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <?php echo htmlspecialchars($row['content'])?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="extra content">
                <div class="ui small feed" id="writer"><?php echo htmlspecialchars($row['writer'])?></div>
                <div class="ui small feed" id="regdate"><?php echo $row['regdate']?></div>
            </div>
        </div>
        <?php } ?>
        <div>
            <button class="ui primary button" onclick="document.location.href='write.php'">글쓰기</button>
        </div>

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
</body>

</html>