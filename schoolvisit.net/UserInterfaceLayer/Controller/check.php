<?php

//connect.php 파일 읽어오기
include_once("../../Config/connect.php");

#form 데이터 읽어오기
$이름 = isset($_POST['이름']) ? $_POST['이름'] : '';
$소속직위 = isset($_POST['소속직위']) ? $_POST['소속직위'] : '';
$성별 = isset($_POST['성별']) ? $_POST['성별'] : '';
$생년월일 = isset($_POST['생년월일']) ? $_POST['생년월일'] : '';
$연락처 = isset($_POST['연락처']) ? $_POST['연락처'] : '';
$방문목적 = isset($_POST['방문목적']) ? $_POST['방문목적'] : '';
$차량번호 = isset($_POST['차량번호']) ? $_POST['차량번호'] : '';

$sql = "INSERT INTO 일일방명록 (이름,소속직위,성별,생년월일,연락처,방문목적,차량번호) VALUES('$이름','$소속직위','$성별','$생년월일','$연락처','$방문목적','$차량번호')";


if($conn->query($sql))echo '<script type="text/javascript">
window.location="../ibgdFin.html";
</script>';
exit();

?>