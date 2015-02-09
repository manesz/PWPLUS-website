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
</div><!-- end of .everything wrapper -->

<!-- START FOOTER -->
<div id="big_footer">
    <div class="white_content_arrow">
        <!--    seta-->
        IdeaCorners Developer
    </div>

    <!-- TWITTER SCROLLER SCRIPT -->
    <script type="text/javascript">
        /*jQuery(function ($) {
            $(".tweet_scroll_text").tweet({
                username: "IdeCorners",
                page: 1,
                avatar_size: 0,
                count: 5,
                loading_text: "loading ..."
            }).bind("loaded", function () {
                    var ul = $(this).find(".tweet_list");
                    var ticker = function () {
                        setTimeout(function () {
                            ul.find('li:first').animate({marginTop: '-4em'}, 500, function () {
                                $(this).detach().appendTo(ul).removeAttr('style');
                            });
                            ticker();
                        }, 5000);
                    };
                    ticker();
                });
        });*/
    </script>

    <!-- TWITTER SCROLLER -->
    <div id="tweet_scroll_place">
        <div class="container tweet_bird">
            <div class="tweet_scroll_text sixteen columns"></div>
        </div>
    </div>

    <div id="footer_content">
        <div class="container">
            <div class="four columns">
                <div class="footer-widget widget_text" id="text-3">
                    <h4>หน่วยที่เกี่ยวข้องและให้การสนับสนุน</h4>
                    <hr>

                    <!-- SOCIAL ICONS -->
                    <div class="textwidget">
                        <div class='socialdiv'>
                            <ul>
                                <?php if ($facebook_script): ?>
                                <li><a href="<?php echo $facebook_script ? $facebook_script : "#"; ?>" target='_blank'
                                       class='facebook' title='Facebook'></a></li>
                                <?php endif; ?>
                                <?php if ($twitter_script): ?>
                                <li><a href="<?php echo $twitter_script ? $twitter_script : "#"; ?>" target='_blank'
                                       class='twitter' title='Twitter'></a></li>
                                <?php endif; ?>
                                <?php if ($google_plus_script): ?>
                                <li><a href="<?php echo $google_plus_script ? $google_plus_script : "#"; ?>"
                                       target='_blank' class='google' title='Google Plus'></a></li>
                                <?php endif; ?>
                                <!--                            <li><a href="http://www.facebook.com" target='_blank' class='facebook' title='Facebook'></a></li>-->
                                <!-- <li>###list###</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="four columns">
                <div class="recentPostsSidebar_widget">
                    <h2>ข่าวสารล่าสุด</h2>

                    <ul class="recentposts_listing">

                        <?php $args = array(
                            'numberposts' => 5,
                            'offset' => 0,
                            'category' => 0,
                            'orderby' => 'post_date',
                            'order' => 'DESC',
                            'include' => '',
                            'exclude' => '',
                            'meta_key' => '',
                            'meta_value' => '',
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'suppress_filters' => true);

                        $recent_posts = wp_get_recent_posts($args, ARRAY_A);
                        foreach ($recent_posts as $recent) {
                            ?>
                            <li>
                                <!--                                <div class="recentPostsSidebar slider"></div>-->
                                <?php
                                $url = wp_get_attachment_url(get_post_thumbnail_id($recent["ID"]));
                                if (empty($url)) {
                                    $getImage = get_post_meta(@$recent["ID"], 'imgslide', true);
                                    $countImage = count($getImage);
                                    $ranImage = rand(0, $countImage-1);
                                    $url = $getImage ? $getImage[$ranImage] : get_template_directory_uri() . "/assets/img/thumb.png";
                                }
                                ?>
                                <div
                                    style="width: 40px; height: 40px; overflow: hidden; background: url('<?php echo $url; ?>') no-repeat center center; background-size: 80px auto; position: relative; float: left; margin-right: 5px;"></div>

                                <div class="rc-container">
                                    <a class="the_title"
                                       href="<?php echo get_permalink($recent["ID"]); ?>"><?php echo $recent["post_title"]; ?></a><br>
                                    <span style="float:left;font-size: 11px; color: #999;font-weight: normal;"
                                          class="blog-i">Category:&nbsp;</span>
                                    <?php
                                    $categories = get_the_category($recent["ID"]);
                                    ?>
                                    <a style="font-size:11px;" class="the_author" href="<?php echo get_category_link($categories[0]->term_id); ?>">
                                        <?php
                                        echo $categories[0]->cat_name;
                                        ?>
                                    </a>
                                </div>
                            </li>

                        <?php
                        }
                        ?>
                        <!-- ###List### -->
                    </ul>
                </div>
            </div>

            <div class="four columns">
                <div class="footer-widget widget_categories" id="categories-2">
                    <h4>รายการ</h4>
                    <hr>
                    <?php wp_nav_menu(
                        array(
                            'menu' => 'Mobile Menu',
                            'menu_id' => '',
                            'menu_class' => '',
                        )
                    ); ?>
                </div>
            </div>

            <div class="four columns">
                <div class="footer-widget contact_form_widget" id="contactform_widget-2">
                    <div class="title">
                        <h4>ติดต่อ PWPLUS</h4>
                    </div>

                    <!-- CONTACT FORM WIDGET -->
                    <div class="contact-form">
                        <div class="message_success form_success"></div>

                        <form method="post" action="#" class="validateform">
                            <ul class="forms">
                                <li>
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                           class="yourname txt corner-input" onfocus="checkerror(this)"
                                           onblur="var v = $(this).val(); $('.yourname_val').html(v);">

                                    <div class="yourname_val" style="display:none"></div>
                                </li>

                                <li>
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="youremail txt corner-input"
                                           onfocus="checkerror(this)"
                                           onblur="var v = $(this).val(); $('.youremail_val').html(v);">

                                    <div class="youremail_val" style="display:none"></div>
                                </li>

                                <li>
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message"
                                              class="yourmessage textarea message corner-input"
                                              rows="20" cols="30" onfocus="checkerror(this)"
                                              onblur="var v = $(this).val(); $('.yourmessage_val').html(v);"></textarea>

                                    <div class="yourmessage_val" style="display:none"></div>
                                </li>

                                <li>
                                    <a id="send-comment" href="javascript:;"
                                       onclick="sendemail($(this), 'sales@pwplus.co.th', 'ติดต่อ PWPLUS', 'Name Error', 'Email Error', 'Message Error', 'Message Sent', 'Message Failed')"
                                       class="submit button small black round_corners">Send</a>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copys">
        <div class="container">
            <div class="copys_left eight columns">
                Copyright 2013 © PWPlus Co.,Ltd | ผลิตภัณฑ์รากฟันเทียมไทย. All rights reserved.
            </div>

            <div class="copys_right eight columns">
                <?php wp_nav_menu(
                    array(
                        'menu' => 'Footer Menu',
                        'menu_id' => 'footer_menu',
                        'menu_class' => 'footer_menuw',
                    )
                ); ?>


            </div>
        </div>
    </div>
</div>
<!-- end of everything -->

<!-- GOOGLE ANALYTICS -->
<!-- END OF GOOGLE ANALYTICS -->


<!-- BODY TYPE: OPTIONS: full | boxed -->
<div id="bodyLayoutType" style="display:none;">full</div>

<!-- if body type == boxed, choose between "image", "pattern" or "color" -->
<div id="bodyBoxedType" class="image" style="display:none;">
    http://designarethemes.com/themes/freshlookwp/wp-content/uploads/2012/11/1353782739bigsize.jpg
</div>

<div id="templatepath" style="display:none;"><?php echo get_template_directory_uri(); ?>/</div>

<div id="homeURL" style="display:none;"><?php echo get_template_directory_uri(); ?>/</div>

<!-- GENERAL COLOR TO BE APPLIED -->
<div id="styleColor" style="display:none;">#7AB317</div>

<!-- BLOG PAGINATION RELATED OPTIONS -->
<div style="display:none;" id="loader-startPage">0</div>

<div style="display:none;" id="loader-maxPages"></div>

<!--<div style="display:none;" id="loader-nextLink">http://designarethemes.com/themes/freshlookwp/page/2/</div>-->

<div style="display:none;" id="reading_option"></div>

<div style="display:none;" id="freshlook_no_more_posts_text">No more posts to load.</div>

<div style="display:none;" id="freshlook_load_more_posts_text">Load More Posts</div>

<div style="display:none;" id="freshlook_loading_posts_text">Loading posts...</div>

<div style="display:none;" id="freshlook_links_color_hover"></div>

<!-- IMAGE LOADER -->
<div style="display:none;" class="loadinger"><img alt="loading"
                                                  src="<?php echo get_template_directory_uri(); ?>/assets/img/ajx_loading.gif">
</div>

</body>
</html>
