<?php
//tạo liên kết đến csdl
require_once ("connection.php");
// tạo biến truy vấn dữ liệu
$sql = "select * from nhanvien";
//tào biên chuan bi thúc thị cau len
$stmp = $conn->prepare($sql);
//goi ham thuc thi
$stmp->execute();
//tạo biến lấy về dữ liệu:
$nhanvien =$stmp->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Thông tin nhân viên</h1>
            </div>
           
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Mã nhân viên</th>
                            <th scope="col">Tên nhân viên</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Quê quán</th>
                            <th scope="col">Lương</th>
                            <th scope="col">Sự kiện</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($nhanvien as $row): ?>
                        <tr>
                            <td><?php echo $row["maNhanvien"]; ?></td>
                            <td><?php echo $row['tenNhanvien']; ?></td>
                            <td><img src="./updates/<?php echo $row['hinhAnh'] ?>" width="200px"></td>
                            <td><?php echo $row['queQuan'] ?></td>
                            <td><?php echo $row['Luong'] ?></td>
                            <td>
                                <button type="button" class="btn btn-success">Sửa</button>
                                <button type="button" class="btn btn-success">Xóa</button>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
            <div>
                <a href="add.php"><button type="button" class="btn btn-success">Thêm nhân viên</button></a>
            </div>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>