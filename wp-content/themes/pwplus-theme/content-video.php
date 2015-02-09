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

get_header();


if (!class_exists('VideoGallery')) {
    include_once("lib/class/ClassVideoGallery.php");
}
$classVideoGallery = new VideoGallery($wpdb);
$listVideoGallery = $classVideoGallery->getList();

?>

    <!-- START: PAGE TITLE -->
    <div class="fullwidth-container"
         style="position: relative;float: left; height: 110px; width: 100%;height: 110px;background: white;">
        <div class="container container-border" style='border-top: 1px solid #ededed;'>
            <div class="pageTitle sixteen columns" style='margin-top: 0px;'>
                <h3 class="page_title nine columns" style="color: #444444; font-size: 18px"><?php the_title(); ?></h3>

                <div class="entry-breadcrumb no-flicker seven columns"
                     style="  border: none; color: #444444; font-size: 18px">
                    <p style="float: right;">You are here: <a href="<?php bloginfo('siteurl'); ?>">PWPlus.co.th</a>
                        »  <?php the_title(); ?></p>
                </div>

            </div>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <div id="white_content">

        <div id="wrapper">

            <div class="container" style='border-top: 1px solid #ededed;'>
                <div class="reset_960">

                    <article id="projects-2" class="post page type-page status-publish hentry" role="article">

                        <div class="entry-content project_list_s2">

                            <!--
                            <div class="moreinfo_text sixteen columns">
                                <div class="filterby">
                                    <div class="filterby_btn closed" onclick="toggleFilter($(this));">Filter by<div class="arrow-right"></div></div>
                                    <ul class="projectCategories">
                                        <ul class="splitter">
                            
                                            <li  id='term_id_-1' class='segment-1 selected-1 termCat active'>
                                                <a class='no-flicker' href='javascript:;' data-value='all'>All</a>
                                            </li>
                            
                                            <li  id='term_id_10' class='segment-0 termCat'>
                                                <a href='javascript:;' class='no-flicker' data-value='video'>Video</a>
                                            </li>
                            
                                            <li  id='term_id_11' class='segment-0 termCat'>
                                                <a href='javascript:;' class='no-flicker' data-value='web-design'>Web Design</a>
                                            </li>
                            
                                            <li  id='term_id_13' class='segment-0 termCat'>
                                                <a href='javascript:;' class='no-flicker' data-value='illustration'>Illustration</a>
                                            </li>
                            
                                            <li  id='term_id_16' class='segment-0 termCat'>
                                                <a href='javascript:;' class='no-flicker' data-value='branding'>Branding</a>
                                            </li>
                            
                                            <li  id='term_id_19' class='segment-0 termCat'>
                                                <a href='javascript:;' class='no-flicker' data-value='photography'>Photography</a>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            
                            </div>
                            
                            -->

                            <div class="thumbnails_list">
                                <ul class="proj_list">
                                    <?php foreach ($listVideoGallery as $key => $value): ?>
                                        <!-- <?php echo $key + 1; ?>RST ELEMENT -->
                                        <li style="margin-bottom: 20px;" data-id="id-<?php echo $key + 1; ?>"
                                            class="branding  view slides_item one-third column">
                                            <div class="post-thumb post-thumb-s2">
                                                <ul class="ch-grid">
                                                    <li class="nc3">
                                                        <div class="ch-item">
                                                            <a style="position: relative; float: left; width: 100%; height: 100%; overflow:hidden;"
                                                               href="<?php echo @$value->link; ?>">
                                                                <img class="img_thumb" alt="" src="<?php echo @$value->image_path; ?>"
                                                                     style="position:relative; height:100%; width: 100%;"/>
                                                            </a>
                                                            <a class="flex_this_thumb"
                                                               href="<?php echo @$value->video_script; ?>"><?php echo @$value->title; ?></a>

                                                            <div class="hover_the_thumbs"
                                                                 style="position: absolute; float: left; width: 100%; height: 100%;">
                                                                <div class="magnify_this_thumb"
                                                                     style="position: absolute; width: 30px; height: 30px; top: 43%; float: left; left: -15%; color: black; background: white;">
                                                                    <img
                                                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/magnifying_glass_16x16.png"
                                                                        style="margin-top: 7px; opacity: .8 !important;"
                                                                        alt=""/>
                                                                </div>
                                                                <div class="hyperlink_this_thumb"
                                                                     style="position: absolute; width: 30px; height: 30px; top: 43%; float: left; left: 105%; color: black; background: white;">
                                                                    <img
                                                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/link_16x16.png"
                                                                        style="margin-top: 7px; opacity: .8 !important;"
                                                                        alt=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="no-flicker"
                                                     style="position: relative; background: #EEE; padding-bottom: 15px; -webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;">
                                                    <div style="height: 50px;">
                                                        <div
                                                            style="padding-left: 15px; padding-top: 6px; border-top: solid 4px #DDD; -webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;"
                                                            class="p_title no-flicker">
                                                            <a style="-webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;"
                                                               href="<?php echo @$value->link; ?>"><?php echo @$value->title; ?></a>
                                                        </div>
                                                        <div style="padding-left: 15px;" class="p_exerpt no-flicker">
                                                            <p style="height: 18px; overflow-y: hidden; -webkit-transition: all 0.4s ease-in-out; -moz-transition: all 0.4s ease-in-out; -o-transition: all 0.4s ease-in-out; -ms-transition: all 0.4s ease-in-out; transition: all 0.4s ease-in-out;"><?php echo @$value->description; ?></p>

                                                            <div
                                                                style="width: 0; height: 0; border-bottom: 15px solid white; border-left: 15px solid transparent; position: absolute; right: 0px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END OF <?php echo $key + 1; ?>RST ELEMENT -->
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            $('.projectCategories .splitter li').each(function () {
                $(this).click(function () {
                    $(this).addClass('active').siblings().removeClass('active');
                    $(this).siblings().not('active').slideHorzHide();
                    $(this).parents(".filterby").children(".filterby_btn").removeClass("open").addClass("closed");
                });
            });

            $('.projectCategories .splitter').children('li').not('.active').slideHorzHide();

            if ($('#type_of_sorting').html() === 'opacity') {
                $('.thumbnails_list > ul').removeClass('proj_list').addClass('proj_list_overlay');
                clickThumbsOverlay("projects-2");
            }
            else {
                $('#projects-2 .da-thumbs > li').hoverdir();
                quicksandstart("projects-2");
            }
            thumbnailsBehavior();
        });

        function toggleFilter($el) {
            if ($el.hasClass('closed')) {alert(55)
                /* OPEN */
                $el.siblings('.projectCategories').children('.splitter').children('li').slideHorzShow();
                $el.removeClass('closed').addClass('open');
            } else {
                /* CLOSE */
                $el.siblings('.projectCategories').children('.splitter').children('li').not('.active').slideHorzHide();
                $el.removeClass('open').addClass('closed');
            }
        }

        function thumbnailsBehavior() {

            $('.thumbnails_list > ul > li').each(function () {

                $(this).find('.magnify_this_thumb')
                    .click(function () {
//                        $(this).parent('.hover_the_thumbs').siblings('.flex_this_thumb').prettyPhoto();
                        $(this).parent('.hover_the_thumbs').siblings('.flex_this_thumb').trigger('click');
                    })
                    .hover(function () {
                        $(this).css('background', '#7AB317');
                    }, function () {
                        $(this).css('background', 'white');
                    });

                $(this).find('.hyperlink_this_thumb')
                    .click(function () {
                        window.location = $(this).parents('.ch-item').children('a').eq(0).attr('href');
                    })
                    .hover(function () {
                        $(this).css('background', '#7AB317');
                    }, function () {
                        $(this).css('background', 'white');
                    });

                /*mouseenter and mouseleave events*/
                $(this).hover(function () {
                    $(this).find('.hover_the_thumbs').css('background-color', 'rgba(0, 0, 0, 0.6)');
                    /*set the color of the div with the text*/
                    $(this).children('div').css('background', '#7AB317');
                    $(this).find('.p_title a').css('color', 'white');
                    $(this).find('.p_exerpt p').css('color', 'white');
                    /*set the color of the darker divider of the div with the text*/
                    $(this).find('.p_title').css('border-top', '4px solid #628f12');
                }, function () {
                    $(this).find('.hover_the_thumbs').css('background-color', 'rgba(0, 0, 0, 0)');
                    $(this).children('div').css('background', '#EEE');
                    $(this).find('.p_exerpt p').css('color', '');
                    $(this).find('.p_title a').css('color', '');
                    $(this).find('.p_title').css('border-top', '4px solid #DDD');
                });
            });
        }

        $.fn.slideHorzShow = function (speed, easing, callback) {
            this.animate({ marginLeft: 'show', marginRight: 'show', paddingLeft: 'show', paddingRight: 'show', width: 'show' }, speed, easing, callback);
        };
        $.fn.slideHorzHide = function (speed, easing, callback) {
            this.animate({ marginLeft: 'hide', marginRight: 'hide', paddingLeft: 'hide', paddingRight: 'hide', width: 'hide' }, speed, easing, callback);
        };

    </script>

<?php
get_footer();
?>