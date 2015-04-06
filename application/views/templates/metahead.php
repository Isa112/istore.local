<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php if (isset($keyw) && isset($desc)): ?>
            <meta name="keywords" content="<?= $keyw ?>">
            <meta name="description" content="<?= $desc ?>">
        <?php else: ?>
            <meta name="keywords" content="<?= Modules::run('widget/getByTitle', 'meta-main-keywords') ?>">
            <meta name="description" content="<?= Modules::run('widget/getByTitle', 'meta-main-description') ?>">
        <?php endif; ?>

           <!-- Заглушка на старые браузеры -->
           <!--[if IE 8]>
              <script>
                 window.location = "oldbrowser/index.html";
              </script>
           <![endif]-->

            <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

           <!-- Bootstrap core JavaScript
           ================================================== -->
           <!-- Placed at the end of the document so the pages load faster -->
           
        <link href="/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.nicescroll.min.js"></script>
        <script src="/js/library.js"></script>
        <script src="/js/custom.js"></script>
    </head>