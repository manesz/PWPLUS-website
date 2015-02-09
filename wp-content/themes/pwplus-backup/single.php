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
?>

    <!-- START: PAGE TITLE -->
    <div class="fullwidth-container"
         style="position: relative;float: left; height: 110px; width: 100%;height: 110px;background: white;">
        <div class="container container-border" style='border-top: 1px solid #ededed;'>
            <div class="pageTitle sixteen columns" style='margin-top: 0px;'>
                <h3 class="page_title nine columns" style="color: #444444; font-size: 18px"><?php the_title(); ?></h3>

                <div class="entry-breadcrumb no-flicker seven columns"
                     style="  border: none; color: #444444; font-size: 18px">
                    <p style="float: right;">You are here: <a href="<?php bloginfo('siteurl'); ?>">PWPlus.co.th</a> » <a
                            href="#"></a> »  <?php the_title(); ?></p>
                </div>

            </div>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <div id="white_content">
        <div id="wrapper">
            <div class="container" style='border-top: 1px solid #ededed;'>

                <!-- LEFT SIDEBAR -->
                <div style="float: left;">
                    <?php include "sidebar.php";?><!-- #secondary .widget-area -->
                </div>

                <section class="one column"></section>

                <section id="primary" role="region" class="eleven columns" style="margin-top: 50px;">
                    <div id="content">
                        <div class="post-listing" style="border-left: 1px solid #EDEDED; padding-left: 40px;">
                            <!-- START: FLEXSLIDER -->
                            <!--                        <div id="myslider-1" class="flexslider clearfix">-->
                            <!--                            <h4 class="flex-title"></h4>-->
                            <!---->
                            <!--                            <ul class="slides">-->
                            <!--                                <li>-->
                            <!--                                    <a href='javascript:;'><img src='assets/img/products/img-slide.jpg' alt='' ></a>-->
                            <!--                                    <p class='flex-caption'><span class='caption-title'>Unlimited Colors & Sidebars</span></p>-->
                            <!--                                </li>-->
                            <!--                            </ul>-->
                            <!--                        </div>-->
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


                            <p>
                                <?php if (have_posts()) :
                                    while (have_posts()) : the_post();
                                        the_content();
                                    endwhile;
                                else:
                                ?>

                            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                            <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <!-- end of wrapper -->
    </div><!-- end of white_content -->

<?php get_footer(); ?>