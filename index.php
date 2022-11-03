<?php
$conn = mysqli_connect("localhost","root","rkdtoa87");
mysqli_select_db($conn, "nok");
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
        <div id="search">
            <input type="text" placeholder="검색어를 입력하세요" />
            <button class="ui button">검색</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>no</th>
                    <th>구분</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>등록일</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['classify']."</td><td>".$row['title']."</td><td>".$row['writer']."</td><td>".$row['regdate']."</td></tr>";
                        }?>
            </tbody>
            <!-- <tfoot>
                <tr>
                    <td>Sum</td>
                    <td>$180</td>
                </tr>
            </tfoot> -->
        </table>
    </article>

</body>

</html>