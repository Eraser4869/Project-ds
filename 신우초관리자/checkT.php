<?php

// connect.php 파일 읽어오기
include_once("connect.php");

#form 데이터 읽어오기
$직급 = isset($_POST['직급']) ? $_POST['직급'] : '';
$성명 = isset($_POST['성명']) ? $_POST['성명'] : '';
$차량종류 = isset($_POST['차량종류']) ? $_POST['차량종류'] : '';
$앞번호 = isset($_POST['앞번호']) ? $_POST['앞번호'] : '';
$차량번호 = isset($_POST['차량번호']) ? $_POST['차량번호'] : '';
$요일제제외사유 = isset($_POST['요일제제외사유']) ? $_POST['요일제제외사유'] : '';

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

// SQL 쿼리 작성 (열 이름에 백틱 사용)
$sql = "INSERT INTO 교직원차량 (`직급`, `성명`, `차량종류`, `앞번호`, `차량번호`, `요일제제외사유`, `휴무일`) 
VALUES ('$직급', '$성명', '$차량종류', '$앞번호', '$차량번호', '$요일제제외사유', '$휴무일')";

// 윈도우 로케이션 위치 수정 필요.
if($conn->query($sql)) {
    echo '<script type="text/javascript">
    alert("교사 방문자 등록 완료!");
    window.location="adminTeacher.php";
    </script>';
} else {
    echo "데이터 삽입 오류: " . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();

exit();

?>
