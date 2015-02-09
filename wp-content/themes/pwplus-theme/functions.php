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


require_once("lib/send_mail.php");
require_once("lib/config_admin_menu.php");
require_once("lib/sort_post_agency.php");
require_once("lib/image_slide.php");
require_once("lib/site_information.php");
require_once("lib/contact_config.php");
require_once("lib/secondary_office.php");
require_once("lib/block_information.php");
require_once("lib/block_tab.php");
require_once("lib/image_gallery.php");
require_once("lib/video_gallery.php");

require_once("lib/image_gallery_in_post.php");


// Register Navigation Menus #########################################################################################
function custom_navigation_menus() {
    $locations = array(
        'header_menu' => __( 'Header Menu', 'text_domain' ),
        'footer_menu' => __( 'Footer Menu', 'text_domain' ),
        'mobile_menu' => __( 'Mobile Menu', 'text_domain' ),
    );
    register_nav_menus( $locations );
}
add_action( 'init', 'custom_navigation_menus' );


// Register Post Thumbnail ##########################################################################################
add_theme_support( 'post-thumbnails' );

// Register Admin Menu Page #########################################################################################
//function register_my_custom_menu_page(){
//    add_menu_page(
//        'custom menu title',
//        'custom menu',
//        'manage_options',
//        'custompage',
//        'my_custom_menu_page',
//        plugins_url( 'myplugin/images/icon.png' ),
//        6
//    );
//}
//function my_custom_menu_page(){
//    echo "Admin Page Test";
//}
//add_action( 'admin_menu', 'register_my_custom_menu_page' );

// Register Admin Menu Page #########################################################################################
//function setup_theme_admin_menus(){
//    add_menu_page(
//        'Theme settings',
//        'Example theme',
//        'manage_options',
//        'tut_theme_settings',
//        'theme_settings_page'
//    );
//
//    add_submenu_page(
//        'tut_theme_settings',
//        'Front Page Elements',
//        'Front Page',
//        'manage_options',
//        'front-page-elements',
//        'theme_front_page_settings'
//    );
//}
function theme_settings_page() {
// Content ################################################################
?>
<script type="text/javascript">
    var elementCounter = 0;
    jQuery(document).ready(function() {
        jQuery("#add-featured-post").click(function() {
            var elementRow = jQuery("#front-page-element-placeholder").clone();
            var newId = "front-page-element-" + elementCounter;

            elementRow.attr("id", newId);
            elementRow.show();

            var inputField = jQuery("select", elementRow);
            inputField.attr("name", "element-page-id-" + elementCounter);

            var labelField = jQuery("label", elementRow);
            labelField.attr("for", "element-page-id-" + elementCounter);

            elementCounter++;
            jQuery("input[name=element-max-id]").val(elementCounter);

            jQuery("#featured-posts-list").append(elementRow);

            return false;

            function removeElement(element) {
                jQuery(element).remove();
            }

            var removeLink = jQuery("a", elementRow).click(function() {
                removeElement(elementRow);
                return false;
            });

            if (is_admin()) {
                wp_enqueue_script('jquery-ui-sortable');
            }

            jQuery("#featured-posts-list").sortable( {
                stop: function(event, ui) {
                    var i = 0;

                    jQuery("li", this).each(function() {
                        setElementId(this, i);
                        i++;
                    });

                    elementCounter = i;
                    jQuery("input[name=element-max-id]").val(elementCounter);
                }
            });

            function setElementId(element, id) {
                var newId = "front-page-element-" + id;

                jQuery(element).attr("id", newId);

                var inputField = jQuery("select", element);
                inputField.attr("name", "element-page-id-" + id);

                var labelField = jQuery("label", element);
                labelField.attr("for", "element-page-id-" + id);
            }
        });

    });
</script>
<div class="wrap">
    <?php screen_icon('themes'); ?> <h2>Front page elements</h2>

    <form method="POST" action="">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="num_elements">
                        Number of elements on a row:
                    </label>
                </th>
                <td>
                    <input type="text" name="num_elements" size="25" />
                </td>
            </tr>
        </table>

        <h3>Featured posts</h3>

        <ul id="featured-posts-list">
        </ul>

        <input type="hidden" name="element-max-id" />

        <a href="#" id="add-featured-post">Add featured post</a>
    </form>

    <li class="front-page-element" id="front-page-element-placeholder"
        style="display:none;">
        <label for="element-page-id">Featured post:</label>
        <select name="element-page-id">
            <?php foreach ($posts as $post) : ?>
            <option value="<?php echo $post->ID; ?>">
                <?php echo $post->post_title; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <a href="#">Remove</a>
    </li>

    <p>
        <input type="submit" value="Save settings" class="button-primary"/>
    </p>

</div>

<?php
// END : Content #########################################################

}
add_action( 'admin_menu', 'setup_theme_admin_menus' );
?>