<?php

session_start();

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: adminlogin.php");
    
}


// 데이터베이스 연결 포함
include 'connect.php';

// SQL 쿼리 작성
$sql = "SELECT * FROM 정기방문자";

$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
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
            <a class="navlink" href="admindaily.php">일일 방문자 관리</a>
            <div class="ydivider"></div>
            <a class="navlink clicked" href="adminroutine.php">정기 방문자 관리</a>
            <div class="ydivider"></div>
            <a class="navlink" href="adminteacher.php">교사 방문자 관리</a>
        </div>
    </nav>
    <section>
        <h1>정기 방명록</h1>

        <!--추가 Delete 섹션 시작 -->
        <form id="deleteForm" method="POST" action="deleteRecord_R.php">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" required>
            <button type="button" onclick="deleteRecord()">Delete</button>
        </form>

        <script>

            function deleteRecord() {
                if (confirm("정말로 이 레코드를 삭제하시겠습니까?")) {
                    document.getElementById('deleteForm').submit();
                }
            }
        </script>
        </script>
      

        
        <!-- 추가 Delete 섹션 종료 -->


        <table id="guestbook-routine">
            <thead>
                <tr>
                    <th>ID 정기방문자</th>
                    <th>직급</th>
                    <th>성명</th>
                    <th>차량종류</th>
                    <th>앞번호</th>
                    <th>차량번호</th>
                    <th>전화번호</th>
                    <th>비고</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 데이터베이스 결과가 있는 경우
                if ($result->num_rows > 0) {
                    // 각 행 출력
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ID 정기방문자"] . "</td>";
                        echo "<td>" . $row["직급"] . "</td>";
                        echo "<td>" . $row["성명"] . "</td>";
                        echo "<td>" . $row["차량종류"] . "</td>";
                        echo "<td>" . $row["앞번호"] . "</td>";
                        echo "<td>" . $row["차량번호"] . "</td>";
                        echo "<td>" . $row["전화번호"] . "</td>";
                        echo "<td>" . $row["비고"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No data found</td></tr>";
                }
                // 연결 종료
                $conn->close();
                ?>
            </tbody>
        </table>

    </section>
    <script type="text/javascript" src="admin.js"></script>

    <!--인쇄 -->
    <button onclick="window.print()">인쇄</button>
</body>
</html>
