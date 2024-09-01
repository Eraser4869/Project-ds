<?php

session_start();

// 데이터베이스 연결
include '../../Config/connect.php'; // 데이터베이스 연결 파일

// 입력값 가져오기
$mbPin = trim($_POST['mbPin']);

// 입력값 유효성 검사
if (empty($mbPin)) {
    $_SESSION['error'] = "비밀번호를 입력해 주세요.";
    header("Location: mbLogin.php");
    exit(); // exit() 호출로 인해 이후 코드가 실행되지 않음
}

// 데이터베이스 쿼리 준비 및 실행
$sql = "SELECT 관리자비번 FROM 관리자목록 WHERE 로그인허용 = 'false'"; // 로그인 허용 여부와 비밀번호 해시를 쿼리
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// 로그인 확인
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedHash = $row['관리자비번']; // 데이터베이스에서 가져온 해시

    // 비밀번호 해시화 확인
    if (password_verify($mbPin, $storedHash)) {
        // 로그인 성공
        $_SESSION['mb_loggedin'] = true;
        header("Location: middleBoss.php"); // 로그인 후 리다이렉트할 페이지
        exit(); // exit() 호출로 인해 이후 코드가 실행되지 않음
    } else {
        // 로그인 실패
        $_SESSION['error'] = "비밀번호가 잘못되었습니다.";
        header("Location: mbLogin.php");
        exit(); // exit() 호출로 인해 이후 코드가 실행되지 않음
    }
} else {
    // 로그인 실패
    $_SESSION['error'] = "비밀번호가 잘못되었습니다.";
    header("Location: mbLogin.php");
    exit(); // exit() 호출로 인해 이후 코드가 실행되지 않음
}


?>