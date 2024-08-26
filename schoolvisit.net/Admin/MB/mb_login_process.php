<?php

/*
session_start();

$_SESSION['mb_loggedin'] = true;
header("Location: middleBoss.php");
exit();

*/

session_start();

// 데이터베이스 연결
include '../../Config/connect.php'; // 데이터베이스 연결 파일

// 입력값 가져오기
$mbPin = trim($_POST['mbPin']);

// 입력값 유효성 검사
if (empty($mbPin)) {
    $_SESSION['error'] = "비밀번호를 입력해 주세요.";
    header("Location: mbLogin.php");
    exit();
}


// 비밀번호를 해시화하여 데이터베이스에서 확인할 수 있도록 합니다.
$mbPin = hash('sha256', $mbPin); // 암호화 방법을 변경할 수 있습니다.


// 데이터베이스 쿼리 준비 및 실행
$sql = "SELECT * FROM 관리자목록 WHERE 로그인허용 = 'false' AND 관리자비번 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mbPin);
$stmt->execute();
$result = $stmt->get_result();

// 로그인 확인
if ($result->num_rows === 1) {
    // 로그인 성공
    $_SESSION['mb_loggedin'] = true;


    //$_SESSION['adminId'] = $adminId; // 세션에 관리자 ID 저장
    header("Location: middleBoss.php"); // 로그인 후 리다이렉트할 페이지
} else {
    // 로그인 실패
    $_SESSION['error'] = "비밀번호가 잘못되었습니다.";
    header("Location: mbLogin.php");
}

$stmt->close();
$conn->close();


?>
