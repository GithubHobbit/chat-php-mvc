<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" href="/app/Layouts/css/default.css">
        <title><?php echo $title ?></title>
        <script language="JavaScript" type="text/javascript" src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script language="JavaScript" type="text/javascript" src="/vendor/components/jquery/jquery.js"></script>
    </head>
    <body>
        <div class="default_app mx-auto">
            <?php include_once 'app/Layouts/header.php' ?>
            <div class="container-fluid">
                <?php echo $content ?>     
            </div>
        </div>
    </body>