<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        foreach ($js as $file) {
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
        ?>
        <?php
        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";
        ?>
        <?php
        if (!empty($meta))
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
            }
        ?>
        <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/general.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/custom.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/layout.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/chosen.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Caudex">


        <!-- Latest compiled and minified Jquery -->
        <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.12.1/ui-bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.12.1/ui-bootstrap-tpls.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/chosen.jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/chosen.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/angular-beauty_bubble.js"></script>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/favicon.ico" type="image/x-icon"/>
        <meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png"/>
        <link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />

    </head>
    <body>
        <div>
            <header>
                <nav class="navbar navbar-fixed-top">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo site_url('/dashboard/index'); ?>">
                                <img class="logo" src="<?php echo base_url(); ?>assets/themes/default/images/logo.png" alt="logo"/>
                            </a>
                        </div>
                    </div>
                </nav>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuDivider">
                    <li>Profile</li>
                    <li role="presentation" class="divider">Logout</li>
                </ul>
            </header>
            
            <div class="row dash_wrapper">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="col-md-6 collapse navbar-collapse dash_nav_wrapper " id="bs-example-navbar-collapse-1">
                    <ul class="nav nav-pills nav-stacked dash_nav">
                        <li class="active"><a href="<?php echo site_url('/dashboard/index'); ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li><a href="<?php echo site_url('/dashboard/status'); ?>"><span class="glyphicon glyphicon-tasks"></span> View current appointments</a></li>
                        <li><a href="<?php echo site_url('/dashboard/status'); ?>"><span class="glyphicon glyphicon-ban-circle"></span> View expired appointments</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <!-- /.container-fluid -->

                <div class="col-md-6">

                <?php echo $output; ?>
                </div>
            </div>

            <div class="dash_background">

        </div>     
            
    </body>
</html>