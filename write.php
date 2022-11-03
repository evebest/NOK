<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="semantic/semantic.css" />
    <script src="semantic/semantic.js"></script>
    <title>작성하기</title>
</head>

<body>
    <h1>작성하기 페이지 입니다.</h1>
    <form class="ui form" action="http://localhost:3000/3.php" method="POST">
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
        <button class="ui button" type="submit">등록</button>
    </form>

</body>

</html>