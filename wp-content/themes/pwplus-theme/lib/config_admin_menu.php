<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */

$webSiteName = "WP PLUS";
add_action('admin_menu', 'setup_theme_admin_menus');
function setup_theme_admin_menus()
{
    //Add script upload
    wp_enqueue_style('thickbox');
    wp_enqueue_script('thickbox');

    add_menu_page(
        'Theme settings',
        'Theme Options',
        'manage_options',
        'ics_theme_settings',
        'ics_page',
        get_bloginfo('template_directory') . '/lib/images/ics.png'
    );
}

function ics_page()
{
    global $webSiteName;
    ?>
    <script>
        var base_url = "<?php bloginfo('template_directory'); ?>/";
    </script>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/tytabs.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css" rel="stylesheet"
          type="text/css"/>
    <div class="wrap">
    <div id="icon-themes" class="icon32"><br/></div>
    <h2><?php _e(@$webSiteName . ' BAFCO theme controller', 'wp_toc'); ?></h2>

    <p><?php echo @$webSiteName; ?> business website theme &copy; developer by <a href="http://www.ideacorners.com" target="_blank">IdeaCorners
            Developer</a></p>
    <div style="width:100%; height: 100%">
    <iframe width="100%" height="100%" src="http://goo.gl/FE7eo1"></iframe>
    </div>
<?php
}