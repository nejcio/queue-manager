<?php

session_start();
$_SESSION['csrf'] =  $csrf_token;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HLRLookUP</title>
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
                    <label for="fabonacci">Fabonacci</label>
                    <input type="text" name="fabonacci" value="" placeholder="Fabonacci)">
                    <label for="algebra">Algebra</label>
                    <input type="text" name="algebra" value="" placeholder="Algebra)">
                    <label for="fabonacci">Fabonacci</label>
                    <input type="text" name="fabonacci" value="" placeholder="Fabonacci)">
                    <label for="fabonacci">Fabonacci</label>
                    <input type="text" name="fabonacci" value="" placeholder="Fabonacci)">
                 <button type="post" class="btn">SEND</button>
                </form>
            </div>
        </section>
    <!-- JAVASCTIPT -->
    <script src="/js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="/js/app.js" type="text/javascript"></script>
</body>
</html>