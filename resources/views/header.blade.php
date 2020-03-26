<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>چاپ عرفان</title>
    <!-- =============== css ================ -->
    <!-- font-awesome -->
    <link rel="stylesheet" type="text/css" href="/as/fonts/fontAwsome/css/all.css">
    <!-- <link rel="stylesheet" type="text/css" href="fonts/fontAwsome/css/font-awesome.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="fonts/fontAwsome/css/font-awesome.main.css"> -->
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="/as/css/bootstrap/css/bootstrap.min.css">
    <!-- amazingslider -->
    <link rel="stylesheet" type="text/css" href="/as/sliderengine/amazingslider-1.css">
    <!-- my styles -->
    <link rel="stylesheet" href="/as/css/style.css">
</head>

<body>
    <div class="main" id="app" v-cloak>
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">چاپ عرفان</a>
                <a v-if="logined" href="/add_order" class="navbar-brand add_order">ثبت سفارش</a>
                <div style="text-align: center" class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">صفحه اصلی</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/news">اخبار چاپ</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/contact">تماس با ما</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/about">درباره ی ما</a>
                        </li>
                        <li v-if="logined" class="nav-item active">
                            <a class="nav-link" href="/home">ناحیه کاربری</a>
                        </li>
                        <li v-if="logined" class="nav-item active">
                            <a class="nav-link" href="/profile">پروفایل</a>
                        </li>
                        <li style="cursor: pointer;" v-if="logined" class="nav-item active">
                            <a class="nav-link" @click="exit_user()">خروج</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>