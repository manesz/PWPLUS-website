<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manesz
 * Date: 10/21/13
 * Time: 9:50 PM
 * To change this template use File | Settings | File Templates.
 */


if (!class_exists('BlockInformation')) {
    include_once("lib/class/ClassBlockInformation.php");
}
$classBlockInformation = new BlockInformation($wpdb);
$listBlockInformation = $classBlockInformation->getList();


if (!class_exists('BlockTab')) {
    include_once("lib/class/ClassBlockTab.php");
}
$classBlockTab = new BlockTab($wpdb);
$listBlockTab = $classBlockTab->getList();
?>
<?php
get_header();
?>
    <!-- START: INFO ABOVE MENU
    <div class="info_above_menu">
        <div class="container">
            <div class="info_above_menu_left eight columns">
                Awesome html5 theme by Designare. <a href="http://themeforest.net/item/freshlook-responsive-multipurpose-html5-template/4452404?ref=Designare">Buy it on Themeforest  →</a>
            </div>
            <div class="info_above_menu_right eight columns">
                Email: <a href=mailto:geral@designarethemes.com> geral@designarethemes.com </a> &nbsp; | &nbsp; Tel: +351 966 666 666
            </div>
        </div>
    </div>
    -->
    <!-- END: INFO ABOVE MENU -->

<?php
get_template_part('front', 'slide');
?>
<style>
    .designare_icon{background: none !important}
</style>
    <!-- START: CONTENT -->
    <div id="white_content">
    <div id="wrapper">
    <div class="container">
    <div class="reset_960">

    <div id="post" class="post page article">

    <div class="entry-content">

        <!-- START: SERVICES ICONS -->
        <div id='service-29' class='shortcode-services default'>
            <ul class='service-items'>
                <!--<li class='service-item even one-third column no-flicker'>
            <p class='designare_icon'>
                <img src='<?php echo get_template_directory_uri();?>/assets/img/designare_icons/icon73.png'
                                           title='Perfect for your Business photo' class='designare_icon' alt=""></p>

            <p class='item-title'>Welcome</p>

            <p class='item-desc'>ในปัจจุบัน รากฟันเทียมได้มีการพัฒนาไปอย่าง มากทั้งในเชิงชีววัสดุ และการออกแบบองค์ประกอบของรากฟันเทียม ส่งผลให้ค่าใช้จ่ายลดลงกว่าในอดีต จึงทำให้วิธีการรักษาด้วยการใส่รากฟันเทียมมีอัตราขยายตัวขึ้นอย่างก้าวกระโดด ทั้งในส่วนของผู้เข้ารับการรักษา และทันตแพทย์</p>

        </li>

        <li class='service-item even one-third column no-flicker'>
            <p class='designare_icon'><img src='<?php echo get_template_directory_uri();?>/assets/img/designare_icons/icon84.png' title='Responsive Design photo'
                                           class='designare_icon' alt=""></p>

            <p class='item-title'>Certificate</p>

            <p class='item-desc'>ผลิตภัณฑ์รากฟันเทียม PW+ ได้รับการรับรองมาตรฐานระดับโลก<br/>
                EN ISO 13485 : 2003/AC : 2007<br/>
                MDD 93/42/EEC Annex II (CE 0123)<br/>
                GMP Ref.No. 1-1-04-17-06-00032</p>

        </li>

        <li class='service-item odd one-third column no-flicker'>
            <p class='designare_icon'><img src='<?php echo get_template_directory_uri();?>/assets/img/designare_icons/icon24.png'
                                           title='Flying Text Captions photo' class='designare_icon' alt=""></p>

            <p class='item-title'>News/Event</p>

            <p class='item-desc'>
                >> โครงการรากฟันเทียมแก่ผู้ใช้แรงงาน 20,000 คน ฟรี อ่านต่อ..<br/>
                >> บริการทันตกรรมรากฟันเทียม ฟรี แก่ประชาชน ผู้สูงอายุ ผู้ด้อยโอกาส จำนวน 10,000 ราย ที่มีฟันปลอมทั้งปากหรือสูญเสียฟันทั้งหมด อ่านต่อ..<br/>
                >> 2/12/53 > รายการเจาะใจ “ด้วยพระบารมี โครงการรากฟันเทียมเฉลิมพระเกียรติ<br/>
                >> 28/11/53 > รายการดลใจประชาราษฎร์ “รากฟันเทียมเฉลิมพระเกียรติ”
            </p>
        </li>
        -->
                <?php foreach ($listBlockInformation as $key => $value): ?>
                    <li class='service-item odd one-third column no-flicker'>
                        <p class='designare_icon'>
                            <img src='<?php echo $value->image_path; ?>'
                                 title='Flying Text Captions photo' class='designare_icon' alt=""></p>

                        <a href="<?php echo $value->link; ?>"><p class='item-title'><?php echo $value->title; ?></p>

                            <p class='item-desc'><?php echo nl2br(htmlentities($value->description, ENT_QUOTES, 'UTF-8')); ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li style="list-style: none; display: inline">
                    <p></p>
                </li>
            </ul>

            <div class='fix'></div>
        </div>
        <!-- END: SERVICES ICONS -->

        <!-- 1/2 + 1/2 COLUMNS -->
        <div class="main_cols container">
            <br/>
            <!-- 1/2 COLUMN -->
            <div class="eight columns"
                 onclick="if(this.innerHTML == &quot;Type your text here…&quot;) this.innerHTML = &quot; &quot;">
                <?php if ($listBlockTab): ?>
                    <!-- START: FLEXSLIDER -->
                    <div id="myslider-1" class="flexslider clearfix" style="overflow:hidden;">
                        <h4 class="flex-title"></h4>

                        <ul class="slides">
                            <?php foreach ($listBlockTab as $key => $value): ?>
                                <li>
                                    <a href='javascript:;'><img style="width: 460px; height: 460px;"
                                            src='<?php echo $value->image_path; ?>'
                                            alt='<?php echo $value->title; ?>'></a>

                                    <p class='flex-caption'><span
                                            class='caption-title'><?php echo $value->title; ?></span>
                                    </p>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- END: FLEXSLIDER -->
                <?php endif; ?>
                <!-- START: FLEXSLIDER SCRIPT-->
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#myslider-1').flexslider({
                            animation: "fade",
                            slideDirection: "vertical",
                            directionNav: true,
                            slideshowSpeed: 5500,
                            controlsContainer: '#myslider-1 .flex-container',
                            pauseOnAction: false,
                            pauseOnHover: true,
                            keyboardNav: false,
                            controlNav: false,
                            start: function (slider) {
                                $("#myslider-1 .slides li").eq(slider.currentSlide).find(".flex-caption").animate({'bottom': '0'}, 500);
                            }, after: function (slider) {
                                $("#myslider-1 .slides li").find(".flex-caption").each(function () {
                                    $(this).css('bottom', '-100px');
                                    if ($(this).parent().hasClass('clone')) {
                                    }
                                    else {
                                        $(this).animate({'bottom': '-100px'}, 500);
                                    }
                                });
                                $("#myslider-1 .slides li").eq(slider.currentSlide).find(".flex-caption").animate({'bottom': '0'}, 500);
                            }
                        });
                    });
                </script>
                <!-- END: SCRIPT -->
            </div>

            <?php if ($listBlockTab): ?>
                <!-- 1/2 COLUMN -->
                <div class="eight columns"
                     onclick="if(this.innerHTML == &quot;Type your text here…&quot;) this.innerHTML = &quot; &quot;">
                    <h3><?php echo $classBlockTab->getTitle(); ?></h3><br/>
                    <!-- START: ACCORDEON -->
                    <div id="accordion" class="shortcode-accs default">

                        <?php foreach ($listBlockTab as $key => $value): ?>
                            <h2 onclick="changeAccord(this)" <?php echo !$key ? 'class="current"' : ""; ?>
                                style="cursor: pointer; color: rgb(85, 85, 85);">
                                <?php echo $value->title; ?></h2>

                            <div class="pane acc-sec"
                                 style="opacity: 1; padding-bottom: 20px; display: <?php echo $key ? 'none"' : "block"; ?>;">
                                <p><?php echo nl2br(htmlentities($value->description, ENT_QUOTES, 'UTF-8')); ?></p>
                            </div>
                            <!--/.section-->

                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- END: ACCORDEON -->

            <?php endif; ?>
        </div>
    </div>

    <!-- START: RECENT PROJECTS STYLE 1 -->
    <div id="lastprojects3" class="home_widget recentProjects3">
        <div class="projects_container_proj">
            <div class="project_open_s3 four columns">
                <!-- BEGIN Slides Arrows -->
                <div class="pag-proj2_s3" style="top: 27px; z-index:99;"></div>
                <!-- END Slides Arrows -->

                <h2 class="page_title_s3"><span class="page_info_title_s3">หน่วยงานที่เกี่ยวข้อง</span></h2>

        <span class="overlay_sep"
              style="width: 50px; top: 0px; position: relative; float: left; background-color: rgb(122, 179, 23);
              background-position: initial initial; background-repeat: initial initial;top: -10px;height: 3px;">

        </span>
                <?php
                $args = array(
                    'numberposts' => -1,
                    'offset' => 0,
                    'category' => "9",
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'include' => '',
                    'exclude' => '',
                    'meta_key' => '',
                    'meta_value' => '',
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'suppress_filters' => true
                );
                $getCatAgency = wp_get_recent_posts($args, ARRAY_A);
                $categories = $getCatAgency? get_the_category(@$getCatAgency[0]["ID"]):'No category';
                ?>
                <?php ?>
                <div class="project_content_s3">
                    <p class="p_excerpt"><?php echo @$categories[0]->cat_name; ?></p>
                    <a href="<?php echo home_url(); ?>/category/<?php echo @$categories[0]->slug; ?>"
                       class="viewmore_btn button small small black">Show all</a>
                </div>
            </div>

            <!-- START: CAROUSEL SLIDER -->
            <div style="margin-top: 20px;" class="project_list_s3 twelve columns">
                <div class=" jcarousel-skin-tango">
                    <div class="jcarousel-container jcarousel-container-horizontal"
                         style="position: relative; display: block;">
                        <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                            <?php if ($getCatAgency): ?>
                                <ul class="slides_container jcarousel-list jcarousel-list-horizontal"
                                    style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px;">
                                    <?php $count = 1;
                                    foreach ($getCatAgency as $value):
                                        $categories = get_the_category(@$value["ID"]);
//                                        $getImage = get_post_meta(@$value["ID"], 'imgslide', true);

                                        $getImage = wp_get_attachment_url(get_post_thumbnail_id($value["ID"]));
//                                        $countImage = count($getImage);
//                                        $ranImage = rand(0, $countImage-1);
//                                        $pathImage = $getImage ? $getImage[$ranImage] : get_template_directory_uri() . "/assets/img/thumb.png";
                                        $pathImage = $getImage ? $getImage : get_template_directory_uri() . "/assets/img/thumb.png";
                                        ?>
                                        <li class="four columns jcarousel-item jcarousel-item-horizontal jcarousel-item-<?php echo $count; ?> jcarousel-item-<?php echo $count; ?>-horizontal"
                                            style="float: left; list-style: none;">
                                            <div class="slides_item post-thumb">
                                                <ul class="ch-grid">
                                                    <li>
                                                        <div class="ch-item">
                                                            <a style="position: relative; float: left; width: 100%; height: 100%; overflow:hidden;"
                                                               href="<?php echo get_permalink(@$value["ID"]); ?>">
                                                                <img class="img_thumb" alt=""
                                                                     src="<?php echo $pathImage; ?>"
                                                                     style="position:relative; height:100%; width: 100%;"></a>
                                                            <a class="flex_this_thumb"
                                                               href="<?php echo $pathImage; ?>"></a>

                                                            <div class="hover_the_thumbs"
                                                                 style="position: absolute; float: left; width: 100%; height: 100%;">
                                                                <div class="magnify_this_thumb"
                                                                     style="position: absolute; width: 30px; height: 30px; top: 43%; float: left; left: -15%; color: black; background: white;"
                                                                     onclick="$(this).parents('.ch-item').find('.flex_this_thumb').click();">
                                                                    <img
                                                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/magnifying_glass_16x16.png"
                                                                        style="margin-top: 7px; opacity: .8 !important;"
                                                                        alt=""></div>

                                                                <div class="hyperlink_this_thumb"
                                                                     onclick="window.location = $(this).parents('.ch-item').children('a').eq(0).attr('href');"
                                                                     style="position: absolute; width: 30px; height: 30px; top: 43%; float: left; left: 105%; color: black; background: white;">
                                                                    <img
                                                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/link_16x16.png"
                                                                        style="margin-top: 7px; opacity: .8 !important;"
                                                                        alt=""></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <div class="no-flicker"
                                                     style="position: relative; background: #EEE; padding-bottom: 15px; -webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;">
                                                    <div style="height: 52px;">
                                                        <div
                                                            style="padding-left: 15px; padding-top: 9px; border-top: solid 4px #DDD; -webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;"
                                                            class="p_title no-flicker">
                                                            <a style="-webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;"
                                                               href="<?php echo get_permalink(@$value["ID"]); ?>"><?php echo @$value["post_title"]; ?></a>
                                                        </div>

                                                        <div style="padding-left: 15px;" class="p_exerpt no-flicker">
                                                            <p style="-webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;">
                                                                <?php echo @$categories[0]->cat_name; ?></p>

                                                            <div
                                                                style="width: 0; height: 0; border-bottom: 15px solid white; border-left: 15px solid transparent; position: absolute; right: 0px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php $count++;
                                    endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $('#lastprojects3 .slides_container').jcarousel({scroll: 1});
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- END: RECENT PROJECTS STYLE 1 -->


    <!-- START: FEATURED BOXWITH SIMPLE BORDER-->
    <!--<div>-->
    <!--    <div class="featured-box simpleborder">-->
    <!--        <div class="fancyb">-->
    <!--            <h3 style="font-size: 23px;text-align: left;width: 77%;clear: right;float: left;top: 10px;position: relative;left: 13px;">-->
    <!--                Freshlook is a ultra-responsive business / portfolio theme.</h3>-->
    <!---->
    <!--            <p style="text-align: left; color: #999;width: 72%; position: relative; float: left;top: 9px;">-->
    <!--                <span style="font-size: 18px;left: 13px;position: relative;left: 13px;font-weight: 100;color: #999;top:2px;">It looks just mega awesome on all the diferent devices!</span>-->
    <!--            </p>-->
    <!---->
    <!--            <p style="text-align: right;width: 22%;float: right;position: relative;top: -18px;right: 8px;">-->
    <!--                <a class="button big yellow">-->
    <!--                    <span class="des-">Request a Quote</span>-->
    <!--                </a>-->
    <!--            </p>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!--<br/>-->
    <!-- END: FEATURED BOX WITH SIMPLE BORDER -->


    </div>
    <!-- .entry-content -->

    </div>
    <!-- #post -->

    </div>


    <script type="text/javascript">

        $(document).ready(function () {

            var styleColor = $("#styleColor").html();
            /* slideshow */
            window.firstSlider = true;
            window.sliderIndex = 0;

            window.firstLoad = true;

            if ($('#slider_container').length) {

                $('#slider_container').camera({
                    pagination: true,
                    loader: 'bar',
                    fx: 'random',
                    transPeriod: 500,
                    barPosition: 'bottom',
                    loaderStroke: 3,
                    loaderPadding: 0,
                    loaderOpacity: .6,
                    loaderColor: 'rgba(0,0,0,.3)',
                    height: '400px',
                    time: 6000,
                    hover: true,
                    playPause: false,
                    pauseOnClick: false,
                    autoAdvance: true,
                    thumbnails: false,
                    imagePath: $('#templatepath').html() + "images/",
                    onLoaded: function () {
                        if (window.firstSlider) {
                            //$('#white_content > div').prepend($('#slider_container .camera_pag').html());
                            $('#white_content > #wrapper').prepend('<div class="cameracontrols" style="position: absolute; height: 66px; right: 2%; top: -66px; z-index: 99;  "><div class="controls-mover" style="position: relative; float: left; top: 33px;"><div class="camera-controls-toggler closed" style="position: relative; float: right; padding: 5px 0px; display: inline-block; clear: both; background: #95c245; color: white; font-weight: bold; font-size: 14px; cursor: pointer; width: 34px; text-align: center; border-bottom: 3px solid ' + $('#styleColor').html() + ';" onclick="toggleCameraControls($(this));" >+</div><div class="cameraholder" /></div></div>');
                            $('#slider_container .camera_pag_ul').clone(true, true).prependTo($('#white_content .cameraholder'));
                            $('#white_content .cameraholder').prepend('<div id="triangle-bottomleft" /><div class="vert-sep" style="display: inline-block; position: absolute; float: right; width: 1px; height: 17px; top: 9px; right: 33px; background: #628f12;" />');

                            var classPlaying = "playing";
                            classPlaying = "paused";

                            $('#white_content .cameraholder #triangle-bottomleft').html('<div id="play_pause" class="' + classPlaying + '" onclick="playpause($(this));"/>');

                            $('.camera_caption .container').css({'opacity': 1, 'filter': 'alpha(opacity=100)', 'display': 'block'});

                            var ind = parseInt($('#slider_container .camera_pag_ul .cameracurrent').index('li'), 10);
                            window.sliderIndex = ind;

                            window.firstSlider = false;

                            $('.camera_prev').hover(function () {
                                $(this).css('opacity', 1);
                            }, function () {
                                $(this).css('opacity', .6);
                            });
                            $('.camera_next').hover(function () {
                                $(this).css('opacity', 1);
                            }, function () {
                                $(this).css('opacity', .6);
                            });

                        }

                        if ($('#bodyLayoutType').html() == "boxed") {
                            $('.camera_caption').each(function () {
                                $(this).find('.container > .eight.columns').css('margin-right', '0px');
                                $(this).find('.container > .eight.columns').eq(0).css('margin-left', '20px');
                            });
                        }

                    },
                    onStartTransition: function () {
                        var ind = 0;
                        //ind = parseInt($('#slider_container .camera_pag_ul .cameracurrent').index('li'),10);

                        for (var x = 0; x < $('#slider_container .camera_pag_ul li').length; x++) {
                            if ($('#slider_container .camera_pag_ul li').eq(x).hasClass('cameracurrent')) {
                                ind = x;
                            }
                        }

                        //console.log(ind);
                        //var ind = $('#slider_container .camera_pag_ul li').find('.cameracurrent').index();
                        $('#white_content .camera_pag_ul').find('.cameracurrent').removeClass('cameracurrent');
                        $('#white_content .camera_pag_ul li').eq(ind).addClass('cameracurrent');
                        //$('.camera_target_content .cameraContent:eq('+ind+')').unbind('hover');

                        var source = $('#slider_container .camera_pag_ul li').eq(ind).html();

                        $('.camera_target_content .cameraContents').children().eq(ind).unbind('mouseenter mouseleave');

                    },
                    onEndTransition: function () {

                        if ($('.cameracurrent .camera_caption').length) {
                            if ($('.cameracurrent .camera_caption').find('.title').length) {
                                var animation = $('.cameracurrent .camera_caption').find('.title').attr('class').split(' ');
                                type = animation[0];
                                animation = animation[animation.length - 1];
                                animateElement($('.cameracurrent .camera_caption').find('.title'), type, animation);
                            }
                            if ($('.cameracurrent .camera_caption').find('.text').length) {
                                var animation = $('.cameracurrent .camera_caption').find('.text').attr('class').split(' ');
                                type = animation[0];
                                animation = animation[animation.length - 1];
                                animateElement($('.cameracurrent .camera_caption').find('.text'), type, animation);
                            }
                            if ($('.cameracurrent .camera_caption').find('.image').length) {
                                var animation = $('.cameracurrent .camera_caption').find('.image').attr('class').split(' ');
                                type = animation[0];
                                animation = animation[animation.length - 1];
                                animateElement($('.cameracurrent .camera_caption').find('.image'), type, animation);
                            }
                            if ($('.cameracurrent .camera_caption').find('.button').length) {
                                var animation = $('.cameracurrent .camera_caption').find('.button').attr('class').split(' ');
                                type = animation[0];
                                animation = animation[animation.length - 1];
                                animateElement($('.cameracurrent .camera_caption').find('.button'), type, animation);
                            }

                        }

                    }
                });

            }

        });

        function toggleCameraControls($toggle) {
            if ($toggle.hasClass('closed')) {

                $toggle.parents('.controls-mover').stop().animate({
                    'top': '0px'
                }, 500, 'easeInOutExpo');

                $toggle.removeClass('closed').addClass('open').html('-');
            } else {

                $toggle.parents('.controls-mover').stop().animate({
                    'top': '33px'
                }, 500, 'easeInOutExpo');

                $toggle.removeClass('open').addClass('closed').html('+');
            }
        }

    </script>

    </div>
    </div>
    <!-- #primary -->
    </div><!-- enf of .container -->

<?php
get_footer();
?>