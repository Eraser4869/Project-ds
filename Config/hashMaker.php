<?php

/*
$adminPw = ''; // 평문 비밀번호
$hashedPw = hash('sha256', $adminPw); // SHA-256 해시화
echo $hashedPw;
*/

// 비밀번호를 해시화
$password = '2488'; // 관리자 비밀번호
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// 이 해시된 비밀번호를 데이터베이스에 저장합니다.
echo $hashedPassword; // 이 값을 데이터베이스에 저장합니다.


/*

*/
?>