<?php
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
    <title>회원가입</title>

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
    </style>
</head>

<body>
    <div class="ui main text container">
        <h1>회원가입</h1>
        <div class="signup"></div>
        <form class="ui form" action="signup_process.php" method="POST">
            <div class="signup" id="id">
                <label>아이디</label>
                <div class="ui fluid input">
                    <input type="text" name="login_id" placeholder="4~15자 이내로 입력해주세요">
                </div>
            </div>
            <div class="signup" id="pw">
                <label>비밀번호</label>
                <div class="ui fluid input">
                    <input type="text" name="pw" placeholder="최소 6자 이상(알파벳, 숫자 필수)">
                </div>
            </div>
            <div class="signup" id="email">
                <label>이메일</label>
                <div class="ui fluid input">
                    <input type="text" name="email" placeholder="abcd@cancer.com">
                </div>
            </div>
            <div class="signup" id="name">
                <label>실명</label>
                <div class="ui fluid input">
                    <input type="text" name="name" placeholder="홍길동">
                </div>
            </div>
            <div class="signup" id="nickname">
                <label>닉네임</label>
                <div class="ui fluid input">
                    <input type="text" name="nickname" placeholder="홍길동">
                </div>
            </div>

            <button class="ui primary fluid button" type="submit">회원가입</button>
        </form>
    </div>


</body>

</html>