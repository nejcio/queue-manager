<?php

session_start();
$_SESSION['csrf'] =  $csrf_token;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Homework nr.2</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
     <!-- CONTENT -->
        <section id="content">
            <div class="result">
                <div class="success"></div>
                <div class="error"></div>
            </div>
            <div class="form">
                <form action="" method="post" class="ajaxcall" accept-charset="utf-8">
                    <input type="hidden" name="csrf" value="<?php echo $csrf_token ;?>">
                    <label for="fabonacci">Fibonacci </label>
                    <input type="text" name="fibonacci" value="" placeholder="Fibonacci">
                    <label for="algebra">Algebra</label>
                    <input type="text" name="algebra" value="" placeholder="Algebra">
                    <label for="mirrored_text">Mirrored text</label>
                    <input type="text" name=" mirrored_text" value="" placeholder="Returns Mirrored text">
                    <label for="bcrypt">Bcrypt</label>
                    <input type="text" name="bcrypt" value="" placeholder="Bcrypt">
                 <button type="post" class="btn">SEND</button>
                </form>
            </div>
        </section>
    <!-- JAVASCTIPT -->
    <script src="/js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="/js/app.js" type="text/javascript"></script>
</body>
</html>