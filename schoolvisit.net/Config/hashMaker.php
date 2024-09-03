<?php
$adminPw = '#12dff'; // 평문 비밀번호
$hashedPw = hash('sha256', $adminPw); // SHA-256 해시화
echo $hashedPw;
?>