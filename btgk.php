<?php
//kết nối database
include "connect.php";

$sql = "SELECT * FROM table_students";

$result = mysqli_query( $conn, $sql );

//tìm kiếm
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM table_students 
            WHERE fullname LIKE '%$search%' 
               OR hometown LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM table_students";
}
$result = $conn->query($sql);

//xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM table_students WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Xóa học viên thành công!'); window.location='btgk.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="btgk.css">
</head>
<body>
    <h1 class="title"> Danh sách sinh viên</h1>
    
<div class="search-bar">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Nhập tên hoặc quê quán để tìm kiếm..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn-search">🔍 Tìm kiếm</button>
        <a href="add.php" class="btn-add">Thêm sinh viên</a>

    </form>
</div>
    <table>
      <thead>
        <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Quê quán</th>
            <th>Trình độ học vấn</th>
            <th>Nhóm</th>
            <th>Thực hiện</th>
        </tr>
      </thead>
      <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['fullname'] ?></td>
                        <td><?= $row['dob'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['hometown'] ?></td>
                        <td><?= $row['level_id'] ?></td>
                        <td><?= $row['group_id'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">Sửa</a>
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Không có sinh viên nào</td>
                </tr>
                <tr>
                <td colspan="8">Không tìm thấy sinh viên nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    

</body>
</html>
