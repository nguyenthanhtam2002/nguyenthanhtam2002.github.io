<?php
// ket noi csdl
require_once("connection.php");

// truy vấn lấy dữ liệu phòng ban
$sqlpb = "SELECT * FROM phongban";

// tạo biến chuẩn bị thực thi câu truy vấn
$stmtpb = $conn->prepare($sqlpb);

// gọi hàm thực thi câu truy vấn
$stmtpb->execute();

// gán biến hiển thị dữ liệu phòng ban đổ ra
$row = $stmtpb->fetchAll();

if (isset($_POST['smbt'])) {

    // khai báo các biến đối tượng nhận dữ liệu từ form
    $manhanvien = $_POST['maNV'];
    $tennhanvien = $_POST['tenNV'];

    // nhận file chuyển vào thư mục hinhanh
    $hinhanh = $_FILES['hinhAnh']['name'];
    $hinhanh_tmp = $_FILES['hinhAnh']['tmp_name'];

    move_uploaded_file($hinhanh_tmp, "updates/" . $hinhanh);

    $queQuan = $_POST['queQuan'];
    $luong = $_POST['luong'];
    $maPB = $_POST['maPB'];

    // câu lệnh thêm dữ liệu
    $themNV = "INSERT INTO nhanvien
                (maNhanVien, tenNhanVien, hinhAnh, queQuan, luong, maPhongban)
               VALUES
                (:manhanvien, :tennhanvien, :hinhanh, :quequan, :luong, :mapb)";

    // tạo biến chuẩn bị thêm dữ liệu
    $stmt = $conn->prepare($themNV);

    // gán tham số
    $stmt->bindParam(':manhanvien', $manhanvien);
    $stmt->bindParam(':tennhanvien', $tennhanvien);
    $stmt->bindParam(':hinhanh', $hinhanh);
    $stmt->bindParam(':quequan', $queQuan);
    $stmt->bindParam(':luong', $luong);
    $stmt->bindParam(':mapb', $maPB);

    // gọi hàm thực thi câu truy vấn
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>Thêm nhân viên</h1>
        </div>

        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Mã nhân viên</label>
                    <input type="number"
                           class="form-control"
                           name="maNV"
                           required>
                </div>

                <div class="form-group">
                    <label>Tên nhân viên</label>
                    <input type="text"
                           class="form-control"
                           name="tenNV"
                           required>
                </div>

                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file"
                           class="form-control-file"
                           name="hinhAnh"
                           required>
                </div>

                <div class="form-group">
                    <label>Quê quán</label>
                    <input type="text"
                           class="form-control"
                           name="queQuan"
                           required>
                </div>

                <div class="form-group">
                    <label>Lương</label>
                    <input type="number"
                           class="form-control"
                           name="luong"
                           required>
                </div>

                <div class="form-group">
                    <label>Mã phòng ban</label>
                    <select class="form-control" name="maPB" required>
                        <?php foreach ($row as $rowPB) { ?>
                            <option value="<?php echo $rowPB['maPhongban']; ?>">
                                <?php echo $rowPB['tenPhongban']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" name="smbt">
                    Submit
                </button>

            </form>
        </div>

        <div class="card-footer text-muted">
            Footer
        </div>
    </div>
</div>

</body>
</html>