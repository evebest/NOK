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
    <meta charset="utf-8">
    <title>암환우 보호자 커뮤니티</title>
    <link rel="stylesheet" type="text/css" href="semantic/semantic.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="semantic/semantic.js"></script>
</head>

<body>
    <header>
        <h1>암환우 보호자 커뮤니티</h1>
    </header>
    <nav></nav>
    <article>
        <h3>
            암환우 보호자들의 자유로운 생각과 의견을 나누는 커뮤니티입니다. <br />자유롭게
            작성해주세요.
        </h3>
        <div>
            <nav id="left_nav">
            </nav>

            <nav id="right_nav">

            </nav>
        </div>
        <div id="center_content">
            <form class="ui form" action="process.php" method="POST">
                <div class="ui form">
                    <div class="field">
                        <label>구분</label>
                        <select class="ui search dropdown" name="classify">
                            <option value="병원문의">병원문의</option>
                            <option value="환자상태">환자상태</option>
                            <option value="나의기분">나의기분</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label>제목</label>
                    <input type="text" name="title">
                </div>
                <div class="field">
                    <textarea name="content"></textarea>
                </div>
                <div class="field">
                    <label>작성자</label>
                    <input type="text" name="writer">
                </div>
                <button class="ui button" type="submit">등록</button>
            </form>
        </div>
    </article>

</body>

</html>