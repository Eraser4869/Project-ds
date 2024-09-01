<?php

//세션 시작
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 로그인 페이지로 리다이렉트
    $_SESSION['error'] = "다시 로그인 해야합니다.";
    header("Location: adminLogin.php");
    exit();
}


// connect.php 파일 읽어오기
include_once("../../Config/connect.php");

#form 데이터 읽어오기
$직급 = isset($_POST['직급']) ? trim($_POST['직급']) : '';
$성명 = isset($_POST['성명']) ? trim($_POST['성명']) : '';
$차량종류 = isset($_POST['차량종류']) ? trim($_POST['차량종류']) : '';
$앞번호 = isset($_POST['앞번호']) ? trim($_POST['앞번호']) : '';
$차량번호 = isset($_POST['차량번호']) ? trim($_POST['차량번호']) : '';
$요일제제외사유 = isset($_POST['요일제제외사유']) ? trim($_POST['요일제제외사유']) : '';

// 차량 번호 끝자리 추출
$차량번호끝자리 = substr($차량번호, -1);

// 차량 번호 끝자리에 따른 휴무일 설정
switch($차량번호끝자리) {
    case '1':
    case '6':
        $휴무일 = '월요일';
        break;
    case '2':
    case '7':
        $휴무일 = '화요일';
        break;
    case '3':
    case '8':
        $휴무일 = '수요일';
        break;
    case '4':
    case '9':
        $휴무일 = '목요일';
        break;
    case '5':
    case '0':
        $휴무일 = '금요일';
        break;
    default:
        $휴무일 = '없음';
        break;
}

// SQL 쿼리 준비
$stmt = $conn->prepare("INSERT INTO 교직원차량 (`직급`, `성명`, `차량종류`, `앞번호`, `차량번호`, `요일제제외사유`, `휴무일`) 
VALUES (?, ?, ?, ?, ?, ?, ?)");

// 값 바인딩
$stmt->bind_param("sssssss", $직급, $성명, $차량종류, $앞번호, $차량번호, $요일제제외사유, $휴무일);

// 실행 및 결과 처리
if ($stmt->execute()) {
    echo '<script type="text/javascript">
    alert("교직원 차량 등록 완료!");
    window.location="../adminTeacher.php";
    </script>';
} else {
    echo "데이터 삽입 오류가 발생했습니다. 다시 시도해 주세요.";
}

// 준비된 쿼리 종료
$stmt->close();
$conn->close();

exit();


?>
