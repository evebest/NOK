<?php
####  session  ####
session_start();


####  db connection  ####
require("db_config.php");
$conn = mysqli_connect($dbConn["host"],$dbConn["user"],$dbConn["pwd"]);
if (!$conn) {
    die("데이터베이스에 연결할 수 없습니다.");
}
mysqli_select_db($conn, $dbConn["db"]);


####  pagination  ####
// 현재 페이지 번호
$current_page_num = isset($_GET["page"]) ? $_GET["page"] : 1;

// 총 리스트 개수
$sql = "SELECT a.id as user_id, nickname, b.id as post_id, b.title, b.classify, b.content, b.regdate FROM user a JOIN post b ON a.id = b.user_id";
$result = mysqli_query($conn, $sql);
$total_list_num = mysqli_num_rows($result); 

// 페이지당 보여줄 리스트 개수
$per_page_list_num = 10;

// 블록당 보여줄 페이지 개수
$per_block_page_num = 5;

// 현재 페이지 블록        ............... ex) 1,2,3,4,5 => 1블록 / 6,7,8,9,10 => 2블록
$current_block = ceil($current_page_num / $per_block_page_num);

// 블록 시작번호           ............... ex) 1,2,3,4,5(1블록)의 시작번호는 1 / 6,7,8,9,10(2블록)의 시작번호는 6
$start_block = (($current_block - 1) * $per_block_page_num) + 1;

// 블록 마지막번호         ............... ex) 1블록의 마지막번호는 1 + 5 - 1 = 5
$end_block = $start_block + $per_block_page_num - 1;

// 전체 페이지 개수        ............... ex) 총 리스트 개수 ÷ 페이지당 보여줄 리스트 개수 , 총 리스트 개수가 2개, 페이지당 보여줄 리스트 개수는 10라면 0.2의 올림이니까 1. 리스트 10개까지 페이지 개수는 1, 리스트 11개부터 페이지 개수가 2.
$total_page_num = ceil($total_list_num / $per_page_list_num);

// 블록 마지막번호가 전체 페이지 개수보다 많다면, 전체 페이지 개수를 블록 마지막번호로 바꾼다.
if($end_block > $total_page_num) $end_block = $total_page_num;

// 총 블록 개수            ............... ex) 전체 페이지 개수 ÷ 블록당 보여줄 페이지 개수 = 1 ÷ 5 = 0.2 = 1
$total_block_num = ceil($total_page_num / $per_block_page_num);

// 시작 페이지..라기보다 조건문을 위한 변수    ............... ex) 페이지가 1이라면 (1-1) * 5 = 0
$start_page = ($current_page_num - 1) * $per_page_list_num;

// 게시글을 시작페이지부터 페이지당 보여줄 리스트 개수만큼 보여주기
$sql2 = "SELECT a.id as user_id, nickname, b.id as post_id, b.title, b.classify, b.content, b.regdate FROM user a JOIN post b ON a.id = b.user_id ORDER BY post_id DESC LIMIT $start_page, $per_page_list_num";
$result = mysqli_query($conn, $sql2);

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

    .ui.footer.segment {
        margin: 5em 0em 0em;
        padding: 5em 0em;
    }

    form {
        margin-bottom: 3em;
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
        <h1 class="ui header">암환우 보호자 커뮤니티</h1>
        <p>암환우 보호자들의 자유로운 생각과 의견을 나누는 커뮤니티입니다.</p>
        <p>자유롭게 작성해 주세요.</p>

        <form class="ui form" id="search_opt" action="search.php">
            <div class="inline fields">
                <div class="three wide field">
                    <select class="ui fluid search dropdown" name="cate">
                        <option value="whole">전체</option>
                        <option value="title">제목</option>
                        <option value="content">내용</option>
                    </select>
                </div>
                <div class="eleven wide field">
                    <div class="ui icon input">
                        <input type="text" id="search" name="search_word" placeholder="검색어를 입력하세요..."
                            autocomplete="off">
                        <!-- <i class="search icon"></i> -->
                    </div>
                </div>
                <div class="two wide field">
                    <button class="ui button submit">검색</button>
                </div>
            </div>
        </form>

        <div>
            <button class="ui primary button" onclick="document.location.href='write.php'">글쓰기</button>
        </div>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) { 
        ?>
        <div class="ui card">
            <div class="content">
                <div class="header"><a
                        href="read.php?id=<?php echo $row['post_id']?>"><?php echo htmlspecialchars($row['title'])?></a>
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
                <div class="ui small feed" id="writer">
                    <?php echo htmlspecialchars($row['nickname'])?></div>
                <div class="ui small feed" id="regdate"><?php echo $row['regdate']?></div>
            </div>
        </div>
        <?php
         } 
        ?>
        <div>
            <button class="ui primary button" onclick="document.location.href='write.php'">글쓰기</button>
        </div>

        <?php 
        if ($current_page_num > 1) {
            echo "<a href='index.php?page=1'>처음</a>"; 
            $pre = $current_page_num - 1; 
            echo "<a href='index.php?page=$pre'>◀이전</a>";
        }

        for ($i = $start_block; $i <= $end_block; $i++) {
            if ($current_page_num === $i) {
                echo "<b>$i</b>";
            } else {
                echo "<a href='index.php?page=$i'>$i</a>";
            } 
        }



?>
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