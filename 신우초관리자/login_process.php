<?php

session_start();

// 데이터베이스 연결
include 'connect.php'; // 데이터베이스 연결 파일

// 입력값 가져오기
$adminId = trim($_POST['adminId']);
$adminPw = trim($_POST['adminPw']);

// 입력값 유효성 검사
if (empty($adminId) || empty($adminPw)) {
    $_SESSION['error'] = "아이디와 비밀번호를 입력해 주세요.";
    header("Location: adminlogin.php");
    exit();
}

/*
// 비밀번호를 해시화하여 데이터베이스에서 확인할 수 있도록 합니다.
$adminPw = hash('sha256', $adminPw); // 암호화 방법을 변경할 수 있습니다.
*/

// 데이터베이스 쿼리 준비 및 실행
$sql = "SELECT * FROM 관리자목록 WHERE 관리자ID = ? AND 관리자비번 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $adminId, $adminPw);
$stmt->execute();
$result = $stmt->get_result();

// 로그인 확인
if ($result->num_rows === 1) {
    // 로그인 성공
    $_SESSION['loggedin'] = true;
    $_SESSION['adminId'] = $adminId; // 세션에 관리자 ID 저장
    header("Location: admindaily.php"); // 로그인 후 리다이렉트할 페이지
} else {
    // 로그인 실패
    $_SESSION['error'] = "아이디 또는 비밀번호가 잘못되었습니다.";
    header("Location: adminlogin.php");
}

$stmt->close();
$conn->close();


?>
