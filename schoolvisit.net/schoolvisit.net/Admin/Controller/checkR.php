<?php

// 세션 시작
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: adminLogin.php");
    exit();
}

// connect.php 파일 읽어오기
include_once("../../Config/connect.php");

// 입력값 읽어오기 및 필터링
$직급 = isset($_POST['직급']) ? trim($_POST['직급']) : '';
$성명 = isset($_POST['성명']) ? trim($_POST['성명']) : '';
$차량종류 = isset($_POST['차량종류']) ? trim($_POST['차량종류']) : '';
$앞번호 = isset($_POST['앞번호']) ? trim($_POST['앞번호']) : '';
$차량번호 = isset($_POST['차량번호']) ? trim($_POST['차량번호']) : '';
$전화번호 = isset($_POST['전화번호']) ? trim($_POST['전화번호']) : '';
$비고 = isset($_POST['비고']) ? trim($_POST['비고']) : '';

// 데이터 유효성 검사
if (!preg_match('/^[0-9]+$/', $차량번호)) {
    echo '<script type="text/javascript">
    alert("유효한 차량 고유 번호를 입력해 주세요.");
    window.history.back();
    </script>';
    exit();
}

if (!preg_match('/^[0-9]+$/', $전화번호)) {
    echo '<script type="text/javascript">
    alert("유효한 전화 번호를 입력해 주세요.");
    window.history.back();
    </script>';
    exit();
}

// SQL 인젝션 방지 prepare statement
$sql = "INSERT INTO 정기방문자 (직급, 성명, 차량종류, 앞번호, 차량번호, 전화번호, 비고) 
VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $직급, $성명, $차량종류, $앞번호, $차량번호, $전화번호, $비고);

if($stmt->execute()) {
    echo '<script type="text/javascript">
    alert("정기 방문자 등록 완료!");
    window.location="../adminRoutine.php";
    </script>';
} else {
    error_log("Error inserting data: " . $stmt->error);
    echo '<script type="text/javascript">
    alert("등록 실패. 다시 시도해 주세요.");
    window.location="../adminRoutine.php";
    </script>';
}

$stmt->close();
$conn->close();
exit();

?>
