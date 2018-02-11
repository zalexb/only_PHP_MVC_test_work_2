<!DOCTYPE>
<html>
<head>
    <title>My Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/web/static/css/style.css">

    <!-- jQuery library -->
    <script src="/web/static/js/jquery-3.3.1.min.js"></script>
    <!--custom-->
    <script src="/web/static/js/scripts.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<!--header-->
<div style="background-color: black;width: 100%;padding: 0;margin: 0" class="header-top">
    <div class="container">
        <div class="top-right">
            <?if(!$_SESSION['login']){?>
            <ul class="login_list">
                <li class="text"><a class="login" href="javascript;">Войти</a></li>
            </ul>
            <?}
            else{?>
                <ul class="login_list">
                    <li style="border-left: none" class="text"><span style="color: white"> Привет, <?echo $_SESSION['login']?></span></li>
                    <li class="text"><a href="/users/logout">Выйти</a></li>
                </ul>
            <?}?>
        </div>
    </div>
</div>
    <div class="header">
        <div class="container">
            <nav class="nav_bar">
                <div class="nav_bar_header">
                    <h1 class="nav_brand">
                       Мой блог
                    </h1>
                </div>
                <div class="collapse navbar-collapse">
                    <ul style="margin-top: 2em" class="nav navbar-nav">
                        <li><a href="/">Главная</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div id="content">
        <div style="" id="login_modal">
            <span id="login_close">X</span>
            <div style="color: red;font-size: 120%" class="login_errors"></div>
            <form id="login" method="POST" action="javascript:;">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input name="name" style="width: 200px" type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input name="password" style="width: 200px" type="password" class="form-control" id="password">
                </div>
                <input type="hidden" name="token" value="<?php
                echo $_SESSION['token'];
                ?>" />
                <button type="submit" class="btn btn-default">Войти</button>
            </form>
        </div>
        <div id="overlay"></div>
        <?include './web/application/views/'.$content_view;?>
    </div>
</body>
</html>