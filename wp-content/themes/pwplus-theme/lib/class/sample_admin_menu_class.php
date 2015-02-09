<?php
/**
 * Class add Main Menu
 *
 * Usage: add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
 *
 * @page_title The text to be displayed in the title tags of the page when the menu is selected (string)(required)
 * @menu_title The on-screen name text for the menu (string)(required)
 * @capability The capability required for this menu to be displayed to the user.(string)(required)
 * Default: 'manage_options'
 * @menu_slug The slug name to refer to this menu(string)(required)
 * @function The function that displays the page content for the menu page (string)
 * @icon_url The icon for this menu. (string)
 * Reference: http://melchoyce.github.io/dashicons/
 * @position The position in the menu order this menu should appear (integer)
 *
 * Ref: http://codex.wordpress.org/Function_Reference/add_menu_page
 */
class addMainMenu {
    function registerMainMenu($array){
        add_menu_page( 'Site Information', 'site info.', 'manage_options', 'site-information', 'site_info_menu_page', 'dashicons-pressthis', 33 );
    }//END: register main menu

    function registerContactInfoPage(){
        add_action( 'admin_menu', 'registerContactInfoMainMenu' );
        function registerContactInfoMainMenu(){
            add_menu_page( 'Contact Information', 'contact info.', 'manage_options', 'contact-information', 'displayContactInfoPage' );
        }//END: register main menu
        function displayContactInfoPage(){
            get_template_part('pages/contact');//Get HTML Form
        }
    }//END: register Contact Info page

    function registerSliderPage(){
        add_action( 'admin_menu', 'registerSliderMainMenu' );
        function registerSliderMainMenu(){
            add_menu_page( 'Front Image Slider', 'image slider', 'manage_options', 'image-slider', 'displaySliderPage' );
        }//END: register main menu
        function displaySliderPage(){
            ?>

        <div class="wrap">
            <h2>ARv5 Theme Options</h2>

            <form method="post" action="options.php">

                <?php settings_fields('ARv5_group'); ?>
                <?php do_settings_sections(__FILE__); ?>

                <p class="submit">
                    <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
                </p>
            </form>

<!--        </div>-->

        <?php

        }//END: display slide page


    }//END: register slide image page
}

/**
 * Class add Sub Menu
 *
 * Usage: add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
 *
 * @parent_slug The slug name for the parent menu(string)(required)
 * @page_title The text to be displayed in the title tags of the page when the menu is selected (string)(required)
 * @menu_title The text to be used for the menu(string)(required)
 * @capability The capability required for this menu to be displayed to the user.(string)(required)
 * @menu_slug The slug name to refer to this menu by(string)(required)
 * @function The function to be called to output the content for this page.(string)
 *
 * Ref: http://codex.wordpress.org/Function_Reference/add_submenu_page
 */
class addSubmenu {
    function registerSiteContact($array){
        add_submenu_page( 'site-information', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'my-custom-submenu-page', 30 );
    }//END: register sub menu
}

/**
 * Class display main menu
 */
class addMainMenuPage {
    function menu_page(){
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Site Information</h2>';
        echo '</div>';
    }
}

/**
 * Class display main menu
 */
class addSubMenuPage {
    function sub_menu_page(){
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>My Custom Submenu Page</h2>';
        echo '</div>';
    }
}