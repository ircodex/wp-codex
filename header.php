<?php
    $type = 'function';
    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }
    
    $search = '';
    if(isset($_POST['s'])){
        $search = $_POST['s'];
        $type = 'all';
    }else{
        if(isset ($_GET['s'])){
            $search = $_GET['s'];
        }
    }
    
    $since = '';
    if(isset($_GET['since'])){
        $since = $_GET['since'];
        $type = 'all';
    }
    
    $file = '';
    if(isset($_GET['file'])){
        $file = $_GET['file'];
        $type = 'all';
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wordpress Offline Documentation</title>
        
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="fonts/weblogma_yekan.css" rel="stylesheet">
        
        <!-- Include *at least* the core style and default theme -->
        <link href="css/sh/shCore.css" rel="stylesheet" type="text/css" />
        <link href="css/sh/shThemeDefault.css" rel="stylesheet" type="text/css" />

        <link href="css/style.css" rel="stylesheet" type="text/css" />
        
         <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            
            <nav class="navbar navbar-default by" role="navigation">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">باز شدن منو</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                    <a class="navbar-brand" href="#"><img width="30%" class="img-responsive" src="images/wp-icon.png"></a>
                  <!--<a class="navbar-brand" href="#" onclick="">-->
                      <form action="http://localhost/codex/index.php?type=all" id="search" onsubmit="" method="post">
                          <input type="text" class="search" value="<?php echo $search;?>" name="s">
                          <input type="submit" class="search-btn" value="search">
                      </form>
                  <!--</a>-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  

                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">WordPress Referecne<span class="caret"></span></a>
                        <ul class="menu dropdown-menu" role="menu">
                            <li class="menu-item menu-item-1">
                                <a href="<?php echo SITE_URL;?>index.php?type=all">All references</a>
                            </li>
                            <li class="menu-item menu-item-2">
                                <a href="<?php echo SITE_URL;?>index.php?type=function">Functions</a>
                            </li>
                            <li class="menu-item menu-item-3">
                                <a href="<?php echo SITE_URL;?>index.php?type=hook">Hooks</a>
                            </li>
                            <li class="menu-item menu-item-4">
                                <a href="<?php echo SITE_URL;?>index.php?type=class">Classes</a>
                            </li>
                            <li class="menu-item menu-item-5">
                                <a href="http://localhost/codex/index.php?type=method">Methods</a>
                            </li>
                        </ul>
                    </li>
                  </ul>
                                   </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
            
            <p style="text-align: center; background: #252525; padding: 5px;border-radius: 3px; color: #FFF">
                CopyRight reserved. Design by Hamed Moodi From <a href="http://ircodex.ir" target="_blank">ircodex.ir</a>
            </p>