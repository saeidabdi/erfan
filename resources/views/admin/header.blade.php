<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
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
    <!-- --- slick -->
    <link rel="stylesheet" type="text/css" href="/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css">
    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
            direction: ltr !important;
        }

        * {
            box-sizing: border-box;
        }

        .slider {
            width: 50%;
            margin: 100px auto;
        }

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
        }


        .slick-slide {
            /* transition: all ease-in-out .3s;
            opacity: .2; */
        }

        .slick-active {
            /* opacity: .5; */
        }

        .slick-current {
            opacity: 1;
        }
    </style>
</head>

<body style="background: #ccc;">

    <div class="main" id="app" v-cloak v-if="logined && admin">
        <div class="header">
            <nav dir="ltr" class="navbar navbar-expand-lg" style="background: #1c5b99!important;">

            </nav>
        </div>