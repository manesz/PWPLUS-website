<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
if (!class_exists('SiteInformation')) {
    include_once("class/ClassSiteInformation.php");
    global $wpdb;
    $classSiteInformation = new SiteInformation($wpdb);
}

if ($_POST) {
    $typePost = @$_POST['type_post'];
    $postPage = @$_POST['post_page'];
    if ($postPage == "site_information") {
        if ($typePost == 'add') {
            try {
                $classSiteInformation->addSiteInformation($_POST);
                echo "add success";
            } catch (Exception $e) {
                echo "add fail";
            }
        } else if ($typePost == "edit") {
            try {
                $classSiteInformation->editSiteInformation($_POST);
                echo "add success";
            } catch (Exception $e) {
                echo "add fail";
            }
        }
        exit;
    }
}

add_action('admin_menu', 'theme_site_information_add');
function theme_site_information_add()
{
    add_submenu_page(
        'ics_theme_settings',
        'Site Information',
        'Site Information',
        'manage_options',
        'site-information',
        'theme_site_information_page'
    );
}

function theme_site_information_page()
{
    global $webSiteName;
    global $classSiteInformation;
    $arrayData = $classSiteInformation->getSiteInformation();
    ?>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/tytabs.css" rel="stylesheet" type="text/css"/>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo includes_url(); ?>css/editor.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/site_information.js"></script>
    <input type="hidden" value="<?php bloginfo('template_directory'); ?>/lib/js/jquery.min.js" id="getjqpath"/>
    <input type="hidden" value="<?php bloginfo('template_directory'); ?>/" id="getbasepath"/>
    <div class="wrap">
        <div id="icon-themes" class="icon32"><br/></div>

        <h2><?php _e(@$webSiteName . ' theme controller', 'wp_toc'); ?></h2>

        <p><?php echo @$webSiteName; ?> business website theme &copy; developer by <a href="http://www.ideacorners.com"
                                                                                      target="_blank">IdeaCorners
                Developer</a></p>
        <!-- If we have any error by submiting the form, they will appear here -->
        <?php settings_errors('tab1-errors'); ?>
        <div class="center">
            <!-- Tabs -->
            <div id="tabsholder">
                <div class="contents marginbot">
                    <div class="tabscontent">
                        <input type="hidden" id="base_patch" value="<?php echo network_site_url('/'); ?>"/>

                        <h3>Site Information</h3>

                        <div class="update-nag" id="show_status"></div>
                        <form method="post" id="frm_post">
                            <input type="hidden" id="type_post" name="type_post"
                                   value="<?php echo count($arrayData) > 0 ? 'edit' : "add"; ?>">
                            <input type="hidden" id="post_page" name="post_page" value="site_information"/>

                            <div class="tb-insert">
                                <div class="handle-head-tb">
                                    <table class="wp-list-table widefat" cellspacing="0" width="100%">
                                        <tbody id="the-list-edit">
                                        <tr class="alternate">
                                            <td><label for="path_image_logo">Logo:</label></td>
                                            <td>
                                                <input id="path_image_logo" type="text" name="path_image_logo" size="57"
                                                       placeholder="Path Image"
                                                       title="Path Image" value="<?php echo @$arrayData[0]->path_image_logo; ?>"/>
                                                <input id="uploadImageButton" type="button" class="button"
                                                       value="Upload Image"
                                                       onclick="imageUploader('#path_image_logo');"/>
                                            </td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="logo_description">Logo Description:</label></td>
                                            <td><textarea name="logo_description" id="logo_description" cols="70" rows="5"
                                                          placeholder="Logo Description"
                                                          title="Logo Description"><?php echo @$arrayData[0]->logo_description; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="path_image_fav_icon">Fav Icon:</label></td>
                                            <td>
                                                <input id="path_image_fav_icon" type="text" name="path_image_fav_icon" size="57"
                                                       placeholder="Path Image"
                                                       title="Path Image" value="<?php echo @$arrayData[0]->path_image_fav_icon; ?>"/>
                                                <input id="uploadImageButton" type="button" class="button"
                                                       value="Upload Image"
                                                       onclick="imageUploader('#path_image_fav_icon');"/>
                                            </td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="facebook_script">Facebook Script:</label></td>
                                            <td><textarea name="facebook_script" id="facebook_script" cols="70" rows="5"
                                                          placeholder="Facebook Script"
                                                          title="Facebook Script"><?php echo @$arrayData[0]->facebook_script; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="twitter_script">Twitter Script:</label></td>
                                            <td><textarea name="twitter_script" id="twitter_script" cols="70" rows="5"
                                                          placeholder="Twitter Script"
                                                          title="Twitter Script"><?php echo @$arrayData[0]->twitter_script; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="google_plus_script">Google Plus Script:</label></td>
                                            <td><textarea name="google_plus_script" id="google_plus_script" cols="70" rows="5"
                                                          placeholder="Google Plus Script"
                                                          title="Google Plus Script"><?php echo @$arrayData[0]->google_plus_script; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="google_analytic_script">Google Analytic Script:</label></td>
                                            <td><textarea name="google_analytic_script" id="google_analytic_script" cols="70" rows="5"
                                                          placeholder="Google Analytic Script"
                                                          title="Google Analytic Script"><?php echo @$arrayData[0]->google_analytic_script; ?></textarea>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="handle-head-submit">
                                        <input type="submit" class="button-primary" value="Save" name="btn_save"
                                               id="btn_save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Tabs -->
        </div>
    </div>
<?php
}