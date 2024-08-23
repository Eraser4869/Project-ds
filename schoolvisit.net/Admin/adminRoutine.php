<?php

session_start();

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: adminLogin.php");
    
}

// 데이터베이스 연결 포함
include '../Config/connect.php';


// SQL 쿼리 작성
$sql = "SELECT * FROM 정기방문자";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>신우초 - 정기 방문자 관리</title>
        <link rel="stylesheet" href="../Content/admin.css" />
        <link href='https://fonts.googleapis.com/css?family=Noto Sans' rel='stylesheet'>
    </head>
<body>
    <nav>
        <div class="title">
            <img class="sinublackmain" src="../Images/신우초-검.png"/>
            <button class="blogout" onclick="logout()"><img class="imglogout" src="../Images/바퀴.png"><p class="plogout">로그아웃</p></button>
        </div>
        <div class="adminnavcont">
            <a class="navlink" href="adminDaily.php">일일 방문자 관리</a>
            <div class="ydivider"></div>
            <a class="navlink clicked" href="adminRoutine.php">정기 방문자 관리</a>
            <div class="ydivider"></div>
            <a class="navlink" href="adminTeacher.php">교직원 차량 관리</a>
        </div>
    </nav>
    <aside>
        <div class="adminsidecont">
            <div class="sidea clicked" id="sidershow">목록 관리</div>
            <div class="xdivider"></div>
            <div class="sidea" id="sideradd">목록 추가</div>
        </div>
    </aside>
    <article>
    <section class="ritem rshow">
        <div class="title">
        <h1>정기 방문자 관리</h1>
        <button class="print-button" onclick="window.print()"><span class="print-icon"></span></button>
        </div>
        <table id="guestbook-routine">
        <thead>
            <tr>
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
                    echo "<td>" . $row["직급"] . "</td>";
                    echo "<td>" . $row["성명"] . "</td>";
                    echo "<td>" . $row["차량종류"] . "</td>";
                    echo "<td>" . $row["앞번호"] . "</td>";
                    echo "<td>" . $row["차량번호"] . "</td>";
                    echo "<td>" . $row["전화번호"] . "</td>";
                    echo "<td>" . $row["비고"] . "</td>";
                    // 삭제버튼 추가 (해당 ID를 쿼리스트링에 포함)
                    echo "<td><form method='POST' action='Controller/deleteRecord_R.php' onsubmit='return confirm(\"정말 삭제하시겠습니까?\");'>
                            <input type='hidden' name='id' value='" . $row["ID 정기방문자"] . "'>
                            <input type='submit' class='btndelete' value='삭제 X'>
                          </form></td>";
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

    <section class="ritem radd">
        <h1>정기 방문자 추가</h1>
        <form method="post" action="Controller/checkR.php" accept-charset="UTF-8">
            <div class="contsurvey">
                <div class="continput">
                    <p class="pname">직급</p>
                    <input type="text" class="sinput" id="rjob" name="직급" maxlength="15" placeholder="직위나 소속을 적어주세요"/>
                    <p class="pessential perjob">직급을 적어주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">성명</p>
                    <input type="text" class="sinput" id="rname" name="성명" maxlength="4" placeholder="홍길동"/>
                    <p class="pessential pername">직급을 적어주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">차량종류</p>
                    <input type="text" class="sinput" id="rcartype" name="차량종류" maxlength="10" placeholder="K5"/>
                    <p class="pessential perct">차량종류를 적어주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">차량 앞번호</p>
                    <input type="text" class="sinput" id="rcarnum1" name="앞번호" maxlength="4" placeholder="차량 앞번호 입력"/>
                    <p class="pessential percn1">차량의 앞번호를 입력해주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">차량번호</p>
                    <input type="number" class="sinput" id="rcarnum2" name="차량번호" maxlength="4" oninput="maxLengthCheck(this)" placeholder="차량 뒷번호 입력"/>
                    <p class="pessential percn2">차량번호를  입력해주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">전화번호</p>
                    <input type="number" class="sinput" id="rphoneNum" name="전화번호" maxlength="11" oninput="maxLengthCheck(this)" placeholder="숫자만 입력"/>
                    <p class="pessential perpn">전화번호 11자리를 입력해주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">비고</p>
                    <textarea class="area2 sarea" id="reason" name="비고" maxlength="45" placeholder=""></textarea>
                </div>
            </div>
            <div class="btncont">
                <input type="submit" id="surveybtnr" value="제출" class="btnsubmit" />
            </div>
        </form>
    </section>
    </article>
    <script type="text/javascript" src="../Script/rbgd.js"></script>
</body>
</html>