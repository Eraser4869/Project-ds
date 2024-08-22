<?php

/*
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['mbLoggedin']) || $_SESSION['mbLoggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: mbLogin.htmlS");
}
*/


// 데이터베이스 연결
include 'connect.php';

$stmt = $conn->prepare("SELECT * FROM 일일방명록 ORDER BY 방문시간 DESC");

// 쿼리 실행
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>일일 방명록</title>
    <link rel="stylesheet" href="admin.css" />
    <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
</head>
<body>
    <nav>
        <div class="title">
            <img class="sinublackmain" src="img/신우초-검.png"/>
            <button class="blogout" onclick="logout()"><img class="imglogout" src="img/바퀴.png"><p class="plogout">로그아웃</p></button>
        </div>
    </nav>
    <article>
    <section>
        <div class="title">
        <h1>일일 방문자 중간 관리</h1>

        <button class="print-button" onclick="window.print()"><span class="print-icon"></span></button>
        </div>
        <table id="guestbook-daily">
            <thead>
                <tr>
                    <th>ID<th>
                    <th>이름</th>
                    <th>방문시간</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $new_id = 1; // 새로운 ID 초기화
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $new_id . "</td>";
                        echo "<td>" . htmlspecialchars($row["이름"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["방문시간"]) . "</td>";
                        echo "</tr>";
                        $new_id++;
                    }
                } else {
                    echo "<tr><td colspan='9'>데이터가 없습니다.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </section>
    <article>
    <script type="text/javascript" src="middleBoss.js"></script>
</body>
</html>