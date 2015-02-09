<?php
/**
 * Created by IdeaCorners Developer.
 * Dev: Mr.Wararit Satitnimankan
 * Date: 10/21/13
 * Time: 9:53 PM
 *
 * @package PWPlus Corperate Theme by IdeaCorners Developer
 * @subpackage ic-corperate-theme
 * @author Corperate Themes - www.ideacorners.com
 */


if (!class_exists('SiteInformation')) {
    include_once("lib/class/ClassBlockTab.php");
}
$classSiteInformation = new SiteInformation($wpdb);
$listSiteInformation = $classSiteInformation->getSiteInformation();
$listSiteInformation = @$listSiteInformation[0];
extract((array)$listSiteInformation);

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-US" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-US" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en-US"> <!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

    <?php wp_head();?>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="author" content="IdeaCorners Developer">
    <meta name="keywords" content="<?php bloginfo('description'); ?>">

    <!-- Place favicon.ico and apple-touch-icons in the images folder -->
    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo @$path_image_fav_icon; ?>">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri();?>/assets/img/apple-touch-icon.png"><!--60X60-->
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri();?>/assets/img/apple-touch-icon-ipad.png"><!--72X72-->
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri();?>/assets/img/apple-touch-icon-iphone4.png"><!--114X114-->
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri();?>/assets/img/apple-touch-icon-ipad3.png">	<!--144X144-->


    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE 8]>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/ieeight.css" type="text/css" media="screen, projection" />
    <![endif]-->

    <!--[if IE 9]>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/ienine.css" type="text/css" media="screen, projection" />
    <![endif]-->

    <!-- Freshlook CSS -->
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/skeleton.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/reset.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/default.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/camera.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/da-thumbs.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/tango/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/flexslider.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/superfish.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/blog.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/projects.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/prettyPhoto.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/resize.css' type='text/css' media='all' />
<!--    <link rel='stylesheet' href='--><?php //echo get_template_directory_uri();?><!--/assets/css/tweet.css' type='text/css' media='all' />-->
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/farbtastic.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/captions-original.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/captions.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='<?php echo get_template_directory_uri();?>/assets/css/mediaelementplayer.css' type='text/css' media='all' />


    <!-- Freshlook Scripts -->
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.1.8.3.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/slides.min.jquery.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.jcarousel.min.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/mediaelement-and-player.min.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.easing.1.3.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/modernizr.custom.79639.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/camera.min.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.themepunch.revolution.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.themepunch.plugins.min.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/tabs.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.flexslider-min.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.prettyPhoto.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/freshlook.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.hoverdir.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.cycle.all.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jQuerytools.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/superfish.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/supersubs.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jflickrfeed.js'></script>
<!--    <script type='text/javascript' src='http://twitter.com/javascripts/blogger.js'></script>-->
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.quicksand.js'></script>
    <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/contact.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.scrolltotop.js'></script>
<!--    <script type='text/javascript' src='--><?php //echo get_template_directory_uri();?><!--/assets/js/jquery.tweet.js'></script>-->
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/farbtastic.js'></script>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/assets/js/jquery.xcolor.js'></script>

    <style>
        html {
            margin-top: 0px !important;
        }
        /* iPads (portrait and landscape) ----------- */
        @media (max-width : 768px) {
            #menulava {display: none !important;}
        }
    </style>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-28094135-5', 'pwplus.co.th');
	  ga('send', 'pageview');

	</script>
</head>

<body class="home page">

<div class="everything">

    <!-- COLOR Switcher (hidden by default) -->
    <div id="option_wrapper" style="display: none;">

        <div class="inner">
            <div id="colorpicker"></div>
            <form style="margin: 20px 20px 0 28px;position: relative;top:12px;">
                <input type="text" id="color" name="color" value="#7AB317" />
            </form>
        </div>

    </div>

    <div class="option_btn settings-close" style="display: none;"></div>
    <!-- END OF COLOR Switcher -->

    <!-- START: HEADER -->
    <div class="header_container">
        <header id="header" class="container">

            <div class="logo_and_menu">

                <!-- START: LOGO & SLOGAN -->
                <div class="logo three columns" style="float: left;">
                    <div>
						<a href="<?php echo home_url(); ?>" tabindex="-1" style="text-indent: 0px;">
							<h1 class="logo" style="width: 143px; height: 50px; top: 24px; left: 0px;
                            background: url('<?php echo @$path_image_logo; ?>') no-repeat; background-size: 140px; font-size: 12px;"></h1>
						</a>
					</div>
                    <div class=""
                         style="background: none;
                                font-family: 'Georgia';
                                font-style: italic;
                                font-size: 12px;
                                color: #cccccc;
								width: 100%;
								position: relative;
								float: left;
								margin: 10px 0 10px 0;">
						<?php bloginfo('title'); ?>
                    </div>
                </div>
                <div style="float: right;">
                    <?php get_template_part( 'navigator' ); ?>
                </div>
            </div>
        </header>
        <!-- HEADER SHADOW -->
        <div class="header-shadow"></div>
    </div>
    <!-- END: HEADER -->