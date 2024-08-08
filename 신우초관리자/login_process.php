<?php

/*

session_start();
include 'connect.php'; // 데이터베이스 연결 파일

// 사용자 입력값 가져오기
$adminId = isset($_POST['adminId']) ? $_POST['adminId'] : '';
$adminPw = isset($_POST['adminPw']) ? $_POST['adminPw'] : '';

// 데이터베이스에서 사용자 확인
if (!empty($adminId) && !empty($adminPw)) {
    // 비밀번호를 안전하게 비교하기 위해 해시를 사용하는 경우
    $stmt = $conn->prepare("SELECT 관리자비번 FROM 관리자목록 WHERE 관리자ID = ?");
    $stmt->bind_param("s", $adminId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['관리자비번'];

        // 비밀번호가 해시된 경우, password_verify() 사용
        if (password_verify($adminPw, $hashedPassword)) {
            // 로그인 성공: 세션 변수 설정
            $_SESSION['loggedin'] = true;
            $_SESSION['adminId'] = $adminId;
            $_SESSION['error'] = ''; // 오류 메시지 초기화
            header("Location: admindaily.php"); // 대시보드 페이지로 리다이렉트
        } else {
            // 비밀번호 불일치
            $_SESSION['error'] = "아이디 또는 비밀번호가 잘못되었습니다.";
            header("Location: adminlogin.html"); // 로그인 페이지로 리다이렉트
        }
    } else {
        // 사용자 ID 존재하지 않음
        $_SESSION['error'] = "아이디 또는 비밀번호가 잘못되었습니다.";
        header("Location: adminlogin.html"); // 로그인 페이지로 리다이렉트
    }

    $stmt->close();
} else {
    // 필수 입력값이 비어있는 경우
    $_SESSION['error'] = "아이디와 비밀번호를 입력해 주세요.";
    header("Location: adminlogin.html"); // 로그인 페이지로 리다이렉트
}

$conn->close();

*/

session_start();

$_SESSION['loggedin'] = true;
header("Location: admindaily.php");
exit();




/*
// 로그인 정보
$validId = 'ds@admin.com'; // 허용된 ID
$validPw = '1234'; // 허용된 비밀번호

// 사용자 입력값 가져오기
$adminId = $_POST['adminId'];
$adminPw = $_POST['adminPw'];



// 로그인 정보 확인
if ($adminId === $validId && $adminPw === $validPw) {
    // 세션 변수 설정
    $_SESSION['loggedin'] = true;
    $_SESSION['adminId'] = $adminId;

    // 대시보드 페이지로 리다이렉트
    header("Location: admindaily.php");
    exit();
} else {
    // 로그인 실패 시 메시지 설정
    $_SESSION['error'] = "아이디 또는 비밀번호가 잘못되었습니다.";
    header("Location: adminlogin.html");
    exit();
}
*/

?>