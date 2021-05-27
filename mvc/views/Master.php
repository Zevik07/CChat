<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CChat</title>
    <!-- Import Boostrap css, js, font awesome here -->
    <base href="http://localhost/CChat/"/>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" href="public/fontawesome/css/all.css">
    <link rel="stylesheet" href="public/css/main.css"> 
</head>
<body>
    <div class="container">
        <div class="header">
            <div id="loader_holder" class="loader_on">
                <img class="header__img" src="">
            </div>
            <h3 class="header__title">CChat</h3>
        </div>
        <div class="content">
            <!-- Phần bên trái màn hình -->
            <div class="left_pannel">
                <?php
                    require_once "./mvc/views/block/user-info.php";
                ?>
            </div>
            <!-- Phần bên phải màn hình -->
            <div class="right_pannel">
                <div id="inner-container">
                    <?php
                        require_once "./mvc/views/page/".$data['Page'].".php";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="public/js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="public/js/main.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script type="text/javascript" src="public/js/loginModal.js"></script>
    <script type="text/javascript" src="public/js/parseData.js"></script> -->
</body>
</html>