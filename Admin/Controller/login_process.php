<?php

//세션 시작
session_start();

// 데이터베이스 연결
include '../../Config/connect.php'; // 데이터베이스 연결 파일

// 입력값 가져오기
$adminId = trim($_POST['adminId']);
$adminPw = trim($_POST['adminPw']);

// 입력값 유효성 검사
if (empty($adminId) || empty($adminPw)) {
    $_SESSION['error'] = "아이디와 비밀번호를 입력해 주세요.";
    header("Location: ../adminLogin.php");
    exit();
}

// 데이터베이스 쿼리 준비 및 실행
$sql = "SELECT 관리자비번 FROM 관리자목록 WHERE 관리자ID = ? AND 로그인허용 = TRUE";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $adminId);
$stmt->execute();
$result = $stmt->get_result();

// 로그인 확인
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedHash = $row['관리자비번'];
    
    //비밀번호 해시화
    if (password_verify($adminPw, $storedHash)) {
        // 로그인 성공
        $_SESSION['loggedin'] = true;
        $_SESSION['adminId'] = $adminId; // 세션에 관리자 ID 저장
        header("Location: ../adminDaily.php"); // 로그인 후 리다이렉트할 페이지
    } else {
        // 로그인 실패
        $_SESSION['error'] = "아이디 또는 비밀번호가 잘못되었습니다.";
        header("Location: ../adminLogin.php");
    }
} else {
    // 로그인 실패
    $_SESSION['error'] = "아이디 또는 비밀번호가 잘못되었습니다.";
    header("Location: ../adminLogin.php");
}

$stmt->close();
$conn->close();

exit();



?>
