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
?>

<?php wp_nav_menu(
    array(
        'menu' => 'Top Menu',
        'menu_id'  => 'menulava',
        'menu_class' => 'sf-menu sf-js-enabled sf-shadow',
    )
); ?>

<nav class="menu eleven columns">

    <!-- PRIMARY MENU (NORMAL BROWSERS) [ add class="selected" on the current <a> ]-->

    <!-- END OF PRIMARY MENU (NORMAL BROWSERS) -->

    <!-- SECONDARY MENU (MOBILE BROWSERS AND SMALLER RESOLUTIONS) -->
    <div id="select-menu">

        <?php
//            wp_nav_menu(
//            array(
//                'menu' => 'Mobile Menu',
//                'menu_id'  => '',
//                'menu_class' => '',
//                'items_wrap'     => '<select id="menu" class="dropdown-menu"><option value="">Mobile menu</option>%3$s</select>',
//                'container' => false,
//                'theme_location' => 'main-nav')
//            );

        /**
         * Mobile Menu
         *
         */
        require_once('lib/class/nav-menu-dropdown.php');
        wp_nav_menu(    array(
            'show_description' => false,
            'menu' => 'Mobile Menu',
            'items_wrap'     => '<select id="menu" class="dropdown-menu"><option value="">Mobile Menu</option>%3$s</select>',
            'container' => false,
            'walker'  => new Walker_Nav_Menu_Dropdown(),
            'theme_location' => 'main-nav'));

        ?>




    </div><!-- End Menu -->

</nav>