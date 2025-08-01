<?php


session_start();

// 로그인 상태 확인
if (!isset($_SESSION['mb_loggedin']) || $_SESSION['mb_loggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: mbLogin.php");
}



// 데이터베이스 연결
include '../../Config/connect.php';

$stmt = $conn->prepare("SELECT * FROM 중간관리자 ORDER BY 입교시간 DESC");

// 쿼리 실행
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>신우초 - 일일 방명록 조회</title>
    <link rel="stylesheet" href="../../Content/middleBoss.css" />
    <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
</head>
<body class="midbosbody">
    <nav>
        <div class="title">
            <img class="sinublackmain" src="../../Images/신우초-검.png"/>
        </div>
    </nav>
    <article>
    <div class="logoutmoblie">
        <button class="blogout" onclick="mbLogout()">
            <img class="imglogout" src="../../Images/바퀴.png">
            <img class="imgout" src="../../Images/로그아웃.png"><p class="plogout">로그아웃</p>
        </button>
    </div>
    <section>
        <div class="title">
        <h1>일일 방문자 중간 관리</h1>
        <button class="print-button" onclick="window.print()"><span class="print-icon"></span></button>
        </div>
        <table id="guestbook-daily">
            <thead>
                <tr>
                    <th>이름</th>
                    <th>방문증 번호</th>
                    <th>반납 여부</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    // Each row will have a data attribute with the row data in JSON format
                    echo "<tr onclick='showPopup(this)' data-row='".json_encode($row, JSON_UNESCAPED_UNICODE)."'>";
                    echo "<td>" . htmlspecialchars($row["이름"]) . "</td>";
                    echo "<td><input type='number' class='inputmid' value='" . htmlspecialchars($row["방문증번호"]) . "' onchange='updateRecord(" . $row["방문자ID"] . ", \"방문증번호\", this.value)'></td>";

                    // 반납 여부를 체크박스로 변경
                    $checked = ($row["반납여부"] === '완료') ? "checked" : "";
                    echo "<td><input type='checkbox' $checked onchange='updateCheckbox(" . $row["방문자ID"] . ", this.checked)'> 완료</td>";
                    echo "</tr>";
                    }
                    } else {
                        echo "<tr><td colspan='9'>데이터가 없습니다.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <div id="popup" class="popup">
            <div onclick="btnhide();" class="delbtn"></div>
            <div class="poptext"><p>이름</p><span id="popup-name"></span></div>
            <div class="poptext"><p>방문증번호</p><span id="popup-id"></span></div>
            <div class="poptext"><p>반납여부</p><span id="popup-return"></span></div>
            <div class="poptext"><p>입교시간</p><span id="popup-entry"></span></div>
            <div class="poptext"><p>퇴교시간</p><span id="popup-exit"></span></div>
        </div>
    </section>
    </article>
    <script type="text/javascript" src="../../Script/middleBoss.js"></script>
</body>
</html>