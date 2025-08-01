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
$sql = "SELECT * FROM 교직원차량";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>신우초 - 교직원 차량 관리</title>
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
            <a class="navlink" href="adminRoutine.php">정기 방문자 관리</a>
            <div class="ydivider"></div>
            <a class="navlink clicked" href="adminTeacher.php">교직원 차량 관리</a>
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
        <h1>교직원 차량 관리</h1>
        <button class="print-button" onclick="window.print()"><span class="print-icon"></span></button>
        </div>
        <table id="guestbook-teacher">
            <thead>
                <tr>
                    <th class='minitd'></th>
                    <th>직급</th>
                    <th>성명</th>
                    <th>차량종류</th>
                    <th>앞번호</th>
                    <th>차량번호</th>
                    <th>요일제 제외 사유</th>
                    <th>휴무일</th>
                </tr>
            </thead>
        <tbody>
            <?php
            // 데이터베이스 결과가 있는 경우
            if ($result->num_rows > 0) {
                // 각 행 출력
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='minitd'><div class='miniform'><form method='POST' action='Controller/deleteRecord_R.php' onsubmit='return confirm(\"정말 삭제하시겠습니까?\");'>
                            <input type='hidden' name='id' value='" . $row["교직원ID"] . "'>
                            <input type='submit' class='btndelete' value='삭제 X'>
                          </form></div></td>";
                    echo "<td>" . $row["직급"] . "</td>";
                    echo "<td>" . $row["성명"] . "</td>";
                    echo "<td>" . $row["차량종류"] . "</td>";
                    echo "<td>" . $row["앞번호"] . "</td>";
                    echo "<td>" . $row["차량번호"] . "</td>";
                    echo "<td>" . $row["요일제제외사유"] . "</td>";
                    echo "<td>" . $row["휴무일"] . "</td>";
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
        <h1>교직원 차량 추가</h1>
        <form method="post" action="Controller/checkT.php" accept-charset="UTF-8">
            <div class="contsurvey">
                <div class="continput">
                    <p class="pname">직급</p>
                    <input type="text" class="sinput" id="tjob" name="직급" maxlength="10" placeholder="직급을 적어주세요"/>
                    <p class="pessential petjob">직급을 적어주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">성명</p>
                    <input type="text" class="sinput" id="tname" name="성명" maxlength="4" placeholder="홍길동"/>
                    <p class="pessential petname">이름을 적어주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">차량종류</p>
                    <input type="text" class="sinput" id="tcartype" name="차량종류" maxlength="10" placeholder="K5"/>
                    <p class="pessential petct">차량종류를 적어주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">앞번호</p>
                    <input type="text" class="sinput" id="tcarnum1" name="앞번호" maxlength="4" placeholder="차량 앞번호 입력"/>
                    <p class="pessential petcn1">앞번호를 입력해주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">차량번호</p>
                    <input type="number" class="sinput" id="tcarnum2" name="차량번호" maxlength="4" oninput="maxLengthCheck(this)" placeholder="차량 뒷번호 입력"/>
                    <p class="pessential petcn2">차량번호를 입력해주세요</p>
                </div>
                <div class="continput">
                    <p class="pname">요일제 제외 사유 (해당 시)</p>
                    <textarea class="area2 sarea" id="treason" name="요일제제외사유" maxlength="30" placeholder="사유를 적어주세요"></textarea>
                </div>
            </div>
            <div class="btncont">
                <input type="submit" id="surveybtnt" value="제출" class="btnsubmit" />
            </div>
        </form>
    </section>
    </article>
    <script type="text/javascript" src="../Script/tbgd.js"></script>
</body>
</html>