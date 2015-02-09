<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
if (!class_exists('SecondaryOffice')) {
    include_once('class/ClassSecondaryOffice.php');
    global $wpdb;
    $classSecondaryOffice = new SecondaryOffice($wpdb);
    if (isset($_POST['update_secondary_office_map'])) {
//        $classSecondaryOffice->latitude_Update();
        $classSecondaryOffice->secondaryOfficeUpdate();
        exit;
    }
}

add_action('admin_menu', 'theme_secondary_office_add');
function theme_secondary_office_add()
{
    add_submenu_page(
        'ics_theme_settings',
        'Secondary Office',
        'Secondary Office',
        'manage_options',
        'secondary-office',
        'theme_secondary_office_page'
    );
}

function theme_secondary_office_page()
{
    global $classSecondaryOffice;
    global $webSiteName;
    ?>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/tytabs.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo includes_url(); ?>css/editor.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/secondary_office.js"></script>
    <input type="hidden" value="<?php bloginfo('template_directory'); ?>/lib/js/jquery.min.js"
           id="getjqpath"/>
    <input type="hidden" value="<?php bloginfo('template_directory'); ?>/" id="getbasepath"/>
    <div class="wrap">
    <div id="icon-themes" class="icon32"><br/></div>

    <h2><?php _e(@$webSiteName . ' theme controller', 'wp_toc'); ?></h2>

    <p><?php echo @$webSiteName; ?> business website theme &copy; developer by
        <a href="http://www.ideacorners.com" target="_blank">IdeaCorners Developer</a></p>
    <!-- If we have any error by submiting the form, they will appear here -->
    <?php settings_errors('tab1-errors'); ?>
    <div class="center">
        <!-- Tabs -->
        <div id="tabsholder">
            <div class="contents marginbot">
                <div class="tabscontent">
                    <h2>Site Secondary Office</h2>
                    <style type="text/css">
                        #mapapi {
                            height: 360px;
                            width: 100%
                        }
                    </style>
                    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
                    <script type="text/javascript"
                            src="<?php bloginfo('template_directory'); ?>/lib/plugin/googleMap/gmap3.min.js"></script>
                    <form action="" method="post" id="secondary_office-map">
                        <input type="hidden" value="1" name="update_secondary_office_map" id="update_secondary_office_map"/>
                        <h3>Location</h3>
                        <button class="button" id="addlocalformtb"><i class="icon-plus-2"></i> Add Location</button>
                        <div id="location-stage">
                            <?php $secondaryOffices = $classSecondaryOffice->getAlldataSecondaryOffice('publish');
                            foreach ($secondaryOffices as $secondary_office) {
                                ?>
                                <div class="tb-insert">
                                <div class="handle-head-tb">
                                    <a href="#" class="close-tb"><i class="icon-cancel"></i></a></div>
                                <table class="wp-list-table widefat" cellspacing="0" width="100%">
                                    <tr class="alternate">
                                        <td><label for="titlelo">Title:</label></td>
                                        <td><input name="titlelo[]" type="text" placeholder="Title" title="Title"
                                                   value="<?php echo @$secondary_office->title ?>" size="30" maxlength="255"/>
                                        </td>
                                    </tr>
                                    <tbody id="the-list-edit">
                                    <tr class="alternate">
                                        <td><label for="desclo">Description:</label></td>
                                        <td><textarea name="desclo[]" cols="70" rows="5" placeholder="Description"
                                                      title="Description"><?php echo @$secondary_office->description ?></textarea>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="addesslo">Addess :</label></td>
                                        <td><textarea name="addesslo[]" cols="70" rows="5" placeholder="Addess"
                                                      title="Addess"><?php echo @$secondary_office->address ?></textarea></td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="phonelo">Phone:</label></td>
                                        <td><input name="phonelo[]" type="text" placeholder="Phone" title="Phone"
                                                   value="<?php echo @$secondary_office->phone ?>" size="30" maxlength="255"/>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="faxlo">Fax:</label></td>
                                        <td><input name="faxlo[]" type="text" placeholder="Fax" title="Fax"
                                                   value="<?php echo @$secondary_office->fax ?>" size="30" maxlength="255"/></td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="emaillo">Email:</label></td>
                                        <td><input name="emaillo[]" type="text" placeholder="Email" title="Email"
                                                   value="<?php echo @$secondary_office->email ?>" size="30" maxlength="255"/>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="latlong">Latitude, Longitude:</label></td>
                                        <td>
                                            <input name="latlong[]" type="text" placeholder="Latitude, Longitude" title="Latitude, Longitude"
                                                   value="<?php echo @$secondary_office->latlong ?>" size="30" maxlength="255"/>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="imagelo">Path Image:</label></td>
                                        <td><input name="imagelo[]" type="text" placeholder="Image" title="Image"
                                                   value="<?php echo @$secondary_office->image ?>" size="30"
                                                   maxlength="255"/><input type="button" class="button uploadimgpath"
                                                                           value="Upload Image"/></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div><?php } ?></div>
                        <div class="handle-head-submit">
                            <input type="submit" class="button-primary" value="Save" name="gallery"></div>
                    </form>

                </div>
            </div>
            <!-- /Tabs -->
        </div>
    </div>
<?php
}