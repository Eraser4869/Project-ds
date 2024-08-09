<?php

session_start();

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: adminlogin.php");
    
}

// 데이터베이스 연결
include 'connect.php';

// 날짜 범위 초기화
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// 종료일이 제공되면, 종료일에 시간 '23:59:59'를 추가
$search_end_date = $end_date; // 폼에서 보여줄 날짜
if ($start_date && $end_date) {
    $end_date = $end_date . ' 23:59:59';
    $stmt = $conn->prepare("SELECT * FROM 일일방명록 WHERE 방문시간 BETWEEN ? AND ? ORDER BY 방문시간 ASC");
    $stmt->bind_param("ss", $start_date, $end_date);
} else {
    $stmt = $conn->prepare("SELECT * FROM 일일방명록 ORDER BY 방문시간 DESC");
}

// 쿼리 실행
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
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
        <div class="adminnavcont">
            <a class="navlink clicked" href="admindaily.php">일일 방문자 관리</a>
            <div class="ydivider"></div>
            <a class="navlink" href="adminroutine.php">정기 방문자 관리</a>
            <div class="ydivider"></div>
            <a class="navlink" href="adminteacher.php">교사 방문자 관리</a>
        </div>
    </nav>
    <section>
        <h1>일일 방명록</h1>
        
        <!-- 날짜 검색 폼 -->
        <form method="post" action="">
            시작 날짜: <input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            끝 날짜: <input type="date" name="end_date" value="<?php echo htmlspecialchars($search_end_date ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            <button type="submit">조회</button>
        </form>
        
        <table id="guestbook-daily">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>이름</th>
                    <th>소속직위</th>
                    <th>성별</th>
                    <th>생년월일</th>
                    <th>연락처</th>
                    <th>방문목적</th>
                    <th>차량번호</th>
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
                        echo "<td>" . htmlspecialchars($row["소속직위"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["성별"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["생년월일"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["연락처"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["방문목적"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["차량번호"]) . "</td>";
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
    <script type="text/javascript" src="admin.js"></script>

    <!-- 인쇄 버튼 -->
    <button onclick="window.print()">인쇄</button>
</body>
</html>