<?php
// 세션 시작
session_start();

// 세션 변수 삭제

$_SESSION = array();

// 세션 쿠키 삭제 (쿠키가 설정되어 있다면)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// 세션 종료
session_destroy();

// 인덱스 페이지로 리다이렉트
header("Location: ../../index.html");
exit;

?>