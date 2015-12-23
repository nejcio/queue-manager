<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Results</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
     <!-- CONTENT -->
        <section id="content">
            <class="results">
                <?php
                if ($results):
                    foreach ($results as $result):
                    switch ($result["type"]) {
                        case 1:
                            $type = 'Algebra';
                             break;
                        case 2:
                            $type = 'Bcrypt';
                             break;
                         case 3:
                            $type = 'Fabonacci';
                             break;
                         case 4:
                            $type = 'Reverse Text';
                             break;
                     } ;?>
                        <div class="row"><span><b>Date: <?= $result['created_at'];?></b></span></div>
                        <div class="row"><span><b>Type:</b> <?= $type;?></span></div>
                        <div class="row"><span><b>Input:</b> <?= $result['data'];?></span></div>
                        <div class="row"><span><b>Result:</b> <?= $result['result']?></span></div>
                    <?php if ($result['extra'] != null):?>
                        <div class="row"><span><b>Full result(Fibonacci):</b> <?= $result['extra']?></span></div>
                <?php
                        endif;
                        ?> <br><?php
                    endforeach;
                else:
                    echo 'No Results, wait a minute!';
                endif;
                ?>
            </div>
        </section>
    </body>
</html>