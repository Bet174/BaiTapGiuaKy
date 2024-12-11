<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'qlsv_nguyengiabao';

$conn = new mysqli($server, $user, $pass, $database);
if ($conn) {
   mysqli_query($conn, "GET NAMES 'utf8' ");
   //echo 'Đã kết nối database thành công';
   //echo '<br>';
}
else {
    echo 'kết nối thất bại';
}

?>
