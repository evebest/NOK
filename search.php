<?php 
session_start();

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
    'CATEGORY' => mysqli_real_escape_string($conn, $_GET['cate']),
    'SEARCH_WORD' => mysqli_real_escape_string($conn, $_GET['search_word'])
);

if($filtered['CATEGORY'] === "whole"){
    $sql = "SELECT * FROM post WHERE (classify LIKE '%".$filtered['SEARCH_WORD']."%' OR title LIKE '%".$filtered['SEARCH_WORD']."%' OR content LIKE '%".$filtered['SEARCH_WORD']."%')";
}else{
    $sql = "SELECT * FROM post WHERE ".$filtered['CATEGORY']." LIKE '%".$filtered['SEARCH_WORD']."%'";
}
// echo $sql;
$result = mysqli_query($conn, $sql);

if($result) {
    echo "조회 성공";

} else {
    echo "결과 없음: ".mysqli_error($conn);
}

if(!$result) $count = 0;

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>검색결과</title>
    <link rel="stylesheet" type="text/css" class="ui" href="/semantic/semantic.min.css">

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
        min-height: 400px;
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

    <div class=" ui main text container">
        <h1 class="ui header">검색결과</h1>
        <p>검색어 : <?=$filtered['SEARCH_WORD']?></p>


        <table style="width:1000px;" class=middle>
            <thead>
                <tr align=center>
                    <th width=70>No</th>
                    <th width=300>제목</th>
                    <th width=120>내용</th>
                    <th width=120>작성자</th>
                    <th width=70>작성일</th>
                    <th width=70>💜</th>
                </tr>
            </thead>
            <?php 
            $num_rows = mysqli_num_rows($result);
            if($num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tbody>
                <tr align=center>
                    <td><?php echo $row['id'];?></td>
                    <td>
                        <a href="read.php?id=<?php echo $row['id']?>"><?php echo htmlspecialchars($row['title'])?></a>
                    </td>
                    <!-- <td><?php echo $row['name'];?></td> -->
                    <!-- <td><?php echo $row['written'];?></td> -->
                    <!-- <td><?php echo $row['hit'];?></td> -->
                    <!-- <td><?php echo $row['liked'];?></td> -->
                </tr>
            </tbody>
            <?php } 
            } else {
             ?>
            <tr>
                <td colspan="6" style="text-align: center;">검색된 결과가 없습니다.</td>
            </tr>
            <?php } ?>
            <button class="ui primary button" onclick="history.back()">
                뒤로가기
            </button>
        </table>
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

    </script>

</body>

</html>