<?php
$conn = new mysqli("localhost", "root", "", "qlsv_nguyengiabao");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM table_students WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        die("Không tìm thấy sinh viên.");
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level_id = $_POST['level_id'];
    $group_id = $_POST['group_id'];

    $sql = "UPDATE table_students 
            SET fullname = '$fullname', dob = '$dob', gender = '$gender', 
                hometown = '$hometown', level_id = '$level_id', group_id = '$group_id' 
            WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật thông tin thành công!'); window.location='btgk.php';</script>";
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
    <title>Chỉnh sửa thông tin sinh viên</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>

<h1>Chỉnh sửa thông tin sinh viên</h1>
<form method="POST" action="">
    <label for="fullname">Họ và Tên:</label>
    <input type="text" id="fullname" name="fullname" value="<?= $student['fullname'] ?>" required>

    <label for="dob">Ngày Sinh:</label>
    <input type="date" id="dob" name="dob" value="<?= $student['dob'] ?>" required>

    <label>Giới Tính:</label>
    <div class="radio-group">
        <label><input type="radio" name="gender" value="Nam" <?= $student['gender'] == 'Nam' ? 'checked' : '' ?>> Nam</label>
        <label><input type="radio" name="gender" value="Nữ" <?= $student['gender'] == 'Nữ' ? 'checked' : '' ?>> Nữ</label>
    </div>

    <label for="hometown">Quê Quán:</label>
    <input type="text" id="hometown" name="hometown" value="<?= $student['hometown'] ?>" required>

    <label for="level_id">Trình Độ Học Vấn:</label>
    <select id="level_id" name="level_id" required>
        <option value="Tiến sĩ" <?= $student['level_id'] == 'Tiến sĩ' ? 'selected' : '' ?>>Tiến sĩ</option>
        <option value="Thạc sĩ" <?= $student['level_id'] == 'Thạc sĩ' ? 'selected' : '' ?>>Thạc sĩ</option>
        <option value="Khác" <?= $student['level_id'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
    </select>

    <label for="group_id">Nhóm:</label>
    <input type="text" id="group_id" name="group_id" value="<?= $student['group_id'] ?>" required>

    <button type="submit">Lưu</button>
</form>

</body>
</html>