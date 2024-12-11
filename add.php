<?php
$conn = new mysqli("localhost", "root", "", "qlsv_nguyengiabao");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level_id = $_POST['level_id'];
    $group_id = $_POST['group_id'];

    $sql = "INSERT INTO table_students (fullname, dob, gender, hometown, level_id, group_id)
            VALUES ('$fullname', '$dob', '$gender', '$hometown', '$level_id', '$group_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location='btgk.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>

<h1 class= "add">Nhập thông tin sinh viên </h1>
<form method="POST" action="">

    <label for="fullname">Họ và Tên:</label>
    <input type="text" id="fullname" name="fullname" required>

    <label for="dob">Ngày Sinh:</label>
    <input type="date" id="dob" name="dob" required>

    <label>Giới Tính:</label>
    <div class="radio-group">
        <label><input type="radio" name="gender" value="Nam" required> Nam</label>
        <label><input type="radio" name="gender" value="Nữ"> Nữ</label>
    </div>

    <label for="hometown">Quê Quán:</label>
    <input type="text" id="hometown" name="hometown" required>

    <label for="level_id">Trình Độ Học Vấn:</label>
    <select id="level_id" name="level_id" required>
        <option value="">-- Chọn trình độ --</option>
        <option value="Tiến Sĩ">Tiến sĩ</option>
        <option value="Thạc sĩ">Thạc sĩ</option>
        <option value="Khác">Khác</option>
    </select>

    <label for="group_id">Nhóm:</label>
    <input type="text" id="group_id" name="group_id" required>

    <button type="submit">Lưu</button>
</form>

</body>
</html>