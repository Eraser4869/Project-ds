<?php

//connect.php 파일 읽어오기
include_once("connect.php");

#form 데이터 읽어오기
$직급 = isset($_POST['직급']) ? $_POST['직급'] : '';
$성명 = isset($_POST['성명']) ? $_POST['성명'] : '';
$차량종류 = isset($_POST['차량종류']) ? $_POST['차량종류'] : '';
$앞번호 = isset($_POST['앞번호']) ? $_POST['앞번호'] : '';
$차량번호 = isset($_POST['차량번호']) ? $_POST['차량번호'] : '';
$전화번호 = isset($_POST['전화번호']) ? $_POST['전화번호'] : '';
$비고 = isset($_POST['비고']) ? $_POST['비고'] : '';

$sql = "INSERT INTO 정기방문자 (직급,성명,차량종류,앞번호,차량번호,전화번호,비고) 
VALUES('$직급','$성명','$차량종류','$앞번호','$차량번호','$전화번호','$비고')";


//윈도우 로케이션 위치 수정 필요.
if($conn->query($sql))echo '<script type="text/javascript">

alert("정기 방문자 등록 완료!");
window.location="adminRoutine.php";
</script>';
exit();

?>
