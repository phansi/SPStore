<?php 

require('./API/connection.php');
session_start();
if(!isset($_SESSION['user'])){
    header('Location:login.php');
    exit();
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Application Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <style>
        .list_start i:hover
        {
            cursor: pointer;
        }
        .list_text::after
        {
            right: 100%;
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            border-color: rgba(82,184,88,0);
            border-right-color: #52b858;
            border-width: 6px;
            margin-top: -6px;
        }
        body{
            background-image: url("https://news.fnal.gov/wp-content/uploads/2020/02/2020-02-11_5e42c8469d971_White_background-scaled.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body >

<nav class="navbar navbar-expand-lg navbar-light bg-light py-3 sticky-top">
        <div class="container-fluid">
            <a  class="navbar-brand m-0 py-3" href="index.php" >SPStore <img src="./assets/image/icon-pgn-11.jpg" alt="" width="32" height="30" class="d-inline-block align-text-top"></a>
        
           
            <?php if(isset($_SESSION['user'])){?>
                <div>
                    <a class="btn btn-sm btn-outline-success mr-2" href="./dashboard/">Trang cá nhân</a>
                    <a class="btn btn-sm btn-outline-success" href="index.php">Quay lại</a>
                </div>
            <?php } else {?>
                <div>
                    <a class="btn btn-sm btn-outline-success mr-2" href="login.php">Đăng nhập</a>
                    <a class="btn btn-sm btn-outline-success" href="register.php">Đăng ký</a>
                </div>
            <?php }?>


        </div>
    </nav>



    <div class="border" style="margin-top: 200px;margin-left: 300px;margin-right: 300px;">
        <div class="justify-content-center" style="display: flex;margin-top: 30px;">
            <div class="card p-12 shadow app-hover justify-content-center bt" >

                <img src="dashboard/tmpfile/Como-hacer-GIF-para-Instagram.jpg" width="300px" height="300px" class="card-img-top image-fluid">
                <div style="text-align: center;margin-top: 30px;">
                    <button class="btn btn-primary btn-block" href="" style="padding-left: 50px;padding-right: 50px;">Tải về</button>
                </div>
            </div>
            <div class="c">
                <h1 class="text-center">Tên sản phẩm</h1>
                <p>Thể loại:</p>
            </div>
        </div>

        <div >
            <h1 style="text-align: center;margin-top: 15px;">Thông tin</h1>
            <p>balabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabala<br>balabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabala<br>balabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabalabala</p>
        </div>
       
        <div class="compoment_rating" style="margin-bottom: 20px;">
            <h1>Đánh giá sản phẩm</h1>
            <div class="compoment_rating_content" style="display: flex;align-items: center;border: 1px solid #dedede;border-radius: 5px;">
                <div class="rating_item" style="width: 20%;position: relative;">
                    <span class="fa fa-star"
                        style="font-size: 100px;display: block;color: yellow;margin: 0 auto;text-align: center;"></span><b
                        style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);color: red;font-size: 25px;">2.5</b>
                </div>
                <div class="list_rating" style="width: 60%;padding: 20px;">
                    <div class="item_rating" style="display: flex;align-items: center">
                        <div style="width: 10%">
                            <a style="font-size: 15px;">1</a><span class="fa fa-star" style="font-size: 15px;"></span>
                        </div>
                        <div style="width: 70%;margin: 0 20px">
                            <span
                                style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius: 5px;background-color: #dedede;"><b
                                    style="width: 30%;background: tomato;display: block;height: 100%;border-radius: 5px;"></b></span>
                        </div>
                        <div style="width: 20%">
                            <a href="">1 đánh giá</a>
                        </div>
                    </div>
                    <div class="item_rating" style="display: flex;align-items: center">
                        <div style="width: 10%">
                            <a style="font-size: 15px;">2</a><span class="fa fa-star" style="font-size: 15px;"></span>
                        </div>
                        <div style="width: 70%;margin: 0 20px">
                            <span
                                style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius: 5px;background-color: #dedede;"><b
                                    style="width: 30%;background: tomato;display: block;height: 100%;border-radius: 5px;"></b></span>
                        </div>
                        <div style="width: 20%">
                            <a href="">1 đánh giá</a>
                        </div>
                    </div>
                    <div class="item_rating" style="display: flex;align-items: center">
                        <div style="width: 10%">
                            <a style="font-size: 15px;">3</a><span class="fa fa-star" style="font-size: 15px;"></span>
                        </div>
                        <div style="width: 70%;margin: 0 20px">
                            <span
                                style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius: 5px;background-color: #dedede;"><b
                                    style="width: 30%;background: tomato;display: block;height: 100%;border-radius: 5px;"></b></span>
                        </div>
                        <div style="width: 20%">
                            <a href="">1 đánh giá</a>
                        </div>
                    </div>
                    <div class="item_rating" style="display: flex;align-items: center">
                        <div style="width: 10%">
                            <a style="font-size: 15px;">4</a><span class="fa fa-star" style="font-size: 15px;"></span>
                        </div>
                        <div style="width: 70%;margin: 0 20px">
                            <span
                                style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius: 5px;background-color: #dedede;"><b
                                    style="width: 30%;background: tomato;display: block;height: 100%;border-radius: 5px;"></b></span>
                        </div>
                        <div style="width: 20%">
                            <a href="">1 đánh giá</a>
                        </div>
                    </div>
                    <div class="item_rating" style="display: flex;align-items: center">
                        <div style="width: 10%">
                            <a style="font-size: 15px;">5</a><span class="fa fa-star" style="font-size: 15px;"></span>
                        </div>
                        <div style="width: 70%;margin: 0 20px">
                            <span
                                style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius: 5px;background-color: #dedede;"><b
                                    style="width: 30%;background: tomato;display: block;height: 100%;border-radius: 5px;"></b></span>
                        </div>
                        <div style="width: 20%">
                            <a href="">1 đánh giá</a>
                        </div>
                    </div>
                </div>
                <div style="width: 20%">
                    <a href="" class="btn btn-primary btn-block">Gửi đánh giá của bạn</a>
                </div>
            </div>
            <div class="font-rating hide">
                <div style="display: flex;margin-top: 15px;font-size: 15px;">
                    <p style="margin-bottom: 0;margin-top: 15px">Chọn đánh giá của bạn</p>
                    <span style="margin: 0 15px;margin-top: 15px;" class="list_start">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                    <span
                        style="margin-top: 15px;display: inline_block;margin-left: 10px;position: relative;background: #52b858;color: white;padding: 2px 8px;box-sizing: border-box;font-size: 12px;border-radius: 2px;"
                        class="list_text">Tuyệt vời</span>
                </div>
                <div style="margin-top: 15px">
                    <textarea name="" class="font-control" id="" cols="30" rows="3"></textarea>
                </div>
                <div style="margin-top: 15px">
                    <a href="#" class="btn btn-primary btn-block">Gửi đánh giá</a>
                </div>
            </div>
        </div>
        <div>
            <h1>Đánh giá của người dùng</h1>
            <div class="border">
                <div style="display: flex">
                    <img src="a.jpg " width="100px" height="100px" class="rounded-circle">
                    <div>
                        <span style="margin: 0 15px;margin-top: 15px;" class="list_start">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span >
                        <p class="border" style="padding-bottom: 50px;background: white;">Tuyệt vời</p>
                    </div>
                </div>
            </div>
            <div class="border">
                <div style="display: flex">
                    <img src="a.jpg " width="100px" height="100px" class="rounded-circle">
                    <div>
                        <span style="margin: 0 15px;margin-top: 15px;" class="list_start">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span >
                        <p class="border" style="padding-bottom: 50px;background: white;">app xài ngon</p>
                    </div>
                </div>
            </div>
            <div class="border">
                <div style="display: flex">
                    <img src="a.jpg " width="100px" height="100px" class="rounded-circle">
                    <div>
                        <span style="margin: 0 15px;margin-top: 15px;" class="list_start">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span >
                        <p class="border" style="padding-bottom: 50px;background: white;">app nên thêm tính năng cho đa dạng</p>
                    </div>
                </div>
            </div>
            <div class="border">
                <div style="display: flex">
                    <img src="a.jpg " width="100px" height="100px" class="rounded-circle">
                    <div>
                        <span style="margin: 0 15px;margin-top: 15px;" class="list_start">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span >
                        <p class="border" style="padding-bottom: 50px;background: white;">app còn nhiều lỗi</p>
                    </div>
                </div>
            </div>
            <div class="border">
                <div style="display: flex">
                    <img src="a.jpg " width="100px" height="100px" class="rounded-circle">
                    <div>
                        <span style="margin: 0 15px;margin-top: 15px;" class="list_start">
                            <i class="fa fa-star"></i>
                        </span >
                        <p class="border" style="padding-bottom: 50px;background: white;">app dỏm</p>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>

</html>