<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta name="resource-type" content="document" />
        <meta name="robots" content="all, index, follow"/>
        <meta name="googlebot" content="all, index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <?php
        /** -- Copy from here -- */
        if (!empty($meta))
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
            }
        echo "\n";

        if (!empty($canonical)) {
            echo "\n\t\t";
            ?><link rel="canonical" href="<?php echo $canonical ?>" /><?php
        }
        echo "\n\t";

        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";

        foreach ($js as $file) {
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";

        /** -- to here -- */
        ?>

        <!-- Le styles -->
        <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/general.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/custom.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/layout.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/themes/default/css/chosen.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Caudex">



        <!-- Latest compiled and minified Jquery -->

        <script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/angular.min.js"></script> 

        <!-- Latest compiled and minified JavaScript -->

        <script src="<?php echo base_url(); ?>assets/themes/default/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/ui-bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/ui-bootstrap-tpls.min.js"></script>



        <script src="<?php echo base_url(); ?>assets/themes/default/js/chosen.jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/chosen.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=vcRecaptchaApiLoaded&render=explicit" async defer></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/angular-recaptcha.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/default/js/angular-beauty_bubble.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/themes/default/js/script.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/themes/default/js/jquery-ui-1.8.16.custom.min.js"></script>-->


        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/favicon.ico" type="image/x-icon"/>
        <meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png"/>
        <link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />


    </head>

    <body>
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));


        </script>


        <header class="navbar navbar-fixed-top">
            <nav class="container-fluid">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                    <a class="navbar-brand" href="<?php echo site_url(); ?>">
                        <img class="logo" src="<?php echo base_url(); ?>assets/themes/default/images/logo.png" alt="logo"/>
                    </a>
                    <div class="clear-div"></div>
                    <div class="nav_contact_info">
                        <p>

                            <a class="visible-xs contact_info" href="mailto:karina@beautybubble.co.nz?subject=Enquirey"><?php echo"Email"; ?></a>
                            <a class="hidden-xs contact_info" href="mailto:karina@beautybubble.co.nz?subject=Enquirey"><?php echo"karina@beautybubble.co.nz"; ?></a> <br />
                            <a class="contact_info" href="tel+6433442245"><?php echo"(03) 344 2245"; ?></a><br />
                            <a class="contact_info" href="tel+64273810095"><?php echo"027 3810095"; ?></a>
                        </p>
                    </div>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo site_url('/site/about_us'); ?>">About Us</a></li>
                        <li><a href="<?php echo site_url('site/our_treatments'); ?>">Our Treatments</a></li>
                        <li><a href="<?php echo site_url('/appointments/request'); ?>">Request Appointment</a></li>
                        <li><a href="<?php echo site_url('/site/contact'); ?>">Contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav><!-- /.container-fluid -->
            <div class="clear-div"></div>
        </header>    


        <div class="container-fluid">

            <?php echo $output; ?>

        </div>
        <!-- /container -->
        <footer class="container-fluid footer">
            <div class="row">

                <article class="col-md-4 col-md-push-2 quick-links-menu">
                    <h3><?php echo"QUICK LINKS"; ?></h3>
                    <ul>
                        <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo site_url('/site/about_us'); ?>">About Us</a></li>
                        <li><a href="<?php echo site_url('/site/contact'); ?>">Contact</a></li>
                    </ul>
                </article>
                <article class="col-md-4 guarantee-para">
                    <h3><?php echo"OUR GUARANTEE"; ?></h3>
                    <p><?php echo'We all know it can sometimes be risky trying a salon for the first time, after all who knows how good the staff really are, and if the salon is clean and professional? 
Visiting The Beauty Bubble is totally risk free, If you aren\'t totally delighted with your appointment and the results, we will re-do it FREE within 5 days of treatment*'; ?></p>
                </article>

                <article class="col-md-4 admin-menu">
                    <div class="form-group">
                    <h3><?php echo"ADMIN LOGIN"; ?></h3>
                   
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                             Admin acess
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('/auth/login'); ?>">Log-in</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('/auth/register'); ?>">Register</a></li>
                        </ul>
                    </div>
                    </div>
                </article>
            </div>

            <div class="row">
                <div class="col-md-12">
                    Copyright &copy; 2015 The Beauty Bubble Beauty Therapy | All rights reserved
                </div>
            </div>
        </footer>

        <div class="background_image">


        </div>     


    </body>
</html>
