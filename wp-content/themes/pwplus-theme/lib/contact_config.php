<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
if (!class_exists('ContactMap')) {
    include_once('class/ClassContactMap.php');
    global $wpdb;
    $classContactMap = new ContactMap($wpdb);
    if (isset($_POST['update_contact_map'])) {
        $classContactMap->latitude_Update();
        $classContactMap->contact_Update();
    }
}

add_action('admin_menu', 'theme_contact_config_add');
function theme_contact_config_add()
{
    add_submenu_page(
        'ics_theme_settings',
        'Site Contact',
        'Site Contact',
        'manage_options',
        'site-contact',
        'theme_contact_config_page'
    );
}

function theme_contact_config_page()
{
    global $classContactMap;
    global $webSiteName;
    ?>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/tytabs.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo includes_url(); ?>css/editor.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/contact_config.js"></script>
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
                    <h2>Site Contact</h2>
                    <style type="text/css">
                        #mapapi {
                            height: 360px;
                            width: 100%
                        }
                    </style>
                    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
                    <script type="text/javascript"
                            src="<?php bloginfo('template_directory'); ?>/lib/plugin/googleMap/gmap3.min.js"></script>
                    <?php
                    $jsstr = '';
                    $objMapData = $classContactMap->getAlldataMap('publish');
                    $ci = 0;
                    $firstlat = '';
                    if (sizeof($objMapData)) {
                        foreach ($objMapData as $mapData) {
                            if ($ci) {
                                $jsstr .= ',';
                            } else {
                                $firstlat = $mapData->latitude;
                            }
                            $ci++;
                            $jsstr .= '{latLng: [' . $mapData->latitude . '], data: "<img class=\'maginleft\' src=\'' . $mapData->image_path . '\' width=\'64\' height=\'64\' align=\'left\' /><strong class=\'mtitle\'>' . $mapData->title . '</strong><p class=\'mtitle\'>' . $mapData->description . '</p>",tag:"' . $ci . '"}';
                        }

                        ?>
                        <script type="text/javascript">

                            $(function () {
                                $('#mapapi').gmap3({
                                    map: {
                                        options: {
                                            center: [<?php echo @$firstlat?>],
                                            zoom: 7
                                        }
                                    },
                                    marker: {
                                        values: [
                                            <?php echo @$jsstr?>
                                        ],
                                        options: {
                                            draggable: false
                                        },
                                        events: {
                                            mouseover: function (marker, event, context) {
                                                var map = $(this).gmap3("get"),
                                                    infowindow = $(this).gmap3({get: {name: "infowindow"}});
                                                if (infowindow) {
                                                    infowindow.open(map, marker);
                                                    infowindow.setContent(context.data);
                                                } else {
                                                    $(this).gmap3({
                                                        infowindow: {
                                                            anchor: marker,
                                                            options: {content: context.data}
                                                        }
                                                    });
                                                }
                                            },
                                            dragend: function (mark, event, context) {
                                                $('input#latitude' + context.tag).val(parseFloat(mark.position.lb).toFixed(2) + ',' + parseFloat(mark.position.mb).toFixed(2));
                                            },
                                            mouseout: function () {
                                                var infowindow = $(this).gmap3({get: {name: "infowindow"}});
                                                if (infowindow) {
                                                    infowindow.close();
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        </script><?php } ?>
                    <div id="mapapi" class="gmap3"></div>
                    <h3>Latitude, Longitude</h3>
                    <button class="button" id="addformtb"><i class="icon-plus-2"></i> Add Lat, Long</button>
                    <form action="" method="post" id="contact-map">
                        <input type="hidden" value="1" name="update_contact_map" id="update_contact_map"/>

                        <div id="lat-long-stage">
                            <?php
                            $objMapData = $classContactMap->getAlldataMap('publish');
                            $countIndex = 1;
                            foreach ($objMapData as $mapData) {
                                ?>
                                <div class="tb-insert">
                                    <div class="handle-head-tb">
                                        <a href="#" class="close-tb"><i class="icon-cancel"></i></a></div>
                                    <table class="wp-list-table widefat" cellspacing="0" width="100%">
                                        <tbody id="the-list-edit">
                                        <tr class="alternate">
                                            <td><label for="linkurl">Title:</label></td>
                                            <td><input name="title[]" type="text" placeholder="Title" title="Title"
                                                       value="<?php echo @$mapData->title ?>" size="25"
                                                       maxlength="255"/></td>
                                            <td><label for="latitude">Lat, Long:</label></td>
                                            <td><input name="latitude[]" id="latitude<?php echo @$countIndex ?>"
                                                       type="text" placeholder="Latitude" title="Latitude"
                                                       value="<?php echo @$mapData->latitude ?>" size="25"
                                                       maxlength="255"/><br/><span>Exam: 13.0, 100.0</span></td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="latitude">Description:</label></td>
                                            <td colspan="3"><textarea name="desc[]" cols="70" id="latitude"
                                                                      placeholder="Description"
                                                                      title="Description"><?php echo @$mapData->description ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="imgpath">Path Image:</label></td>
                                            <td colspan="3"><input name="imgpath[]" type="text"
                                                                   placeholder="Image upload" class="mappath"
                                                                   title="Image upload"
                                                                   value="<?php echo @$mapData->image_path ?>" size="57"
                                                                   maxlength="255"/><input type="button"
                                                                                           class="button uploadimgpath"
                                                                                           value="Upload Image"/></td>
                                        </tr>
                                        <tr class="alternate">
                                            <td><label for="linkurl">Link:</label></td>
                                            <td colspan="3"><input name="linkurl[]" type="text" placeholder="Link"
                                                                   title="Link" value="<?php echo @$mapData->link ?>"
                                                                   size="70" maxlength="255" id="linkurl"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php $countIndex++;
                            } ?>
                        </div>
                        <h3>Location</h3>
                        <button class="button" id="addlocalformtb"><i class="icon-plus-2"></i> Add Location</button>
                        <div id="location-stage">
                            <?php $contacts = $classContactMap->getAlldataContact('publish');
                            foreach ($contacts as $contact) {
                                ?>
                                <div class="tb-insert">
                                <div class="handle-head-tb">
                                    <a href="#" class="close-tb"><i class="icon-cancel"></i></a></div>
                                <table class="wp-list-table widefat" cellspacing="0" width="100%">
                                    <tr class="alternate">
                                        <td><label for="titlelo">Title:</label></td>
                                        <td><input name="titlelo[]" type="text" placeholder="Title" title="Title"
                                                   value="<?php echo @$contact->title ?>" size="30" maxlength="255"/>
                                        </td>
                                    </tr>
                                    <tbody id="the-list-edit">
                                    <tr class="alternate">
                                        <td><label for="desclo">Description:</label></td>
                                        <td><textarea name="desclo[]" cols="70" rows="5" placeholder="Description"
                                                      title="Description"><?php echo @$contact->description ?></textarea>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="addesslo">Addess :</label></td>
                                        <td><textarea name="addesslo[]" cols="70" rows="5" placeholder="Addess"
                                                      title="Addess"><?php echo @$contact->address ?></textarea></td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="phonelo">Phone:</label></td>
                                        <td><input name="phonelo[]" type="text" placeholder="Phone" title="Phone"
                                                   value="<?php echo @$contact->phone ?>" size="30" maxlength="255"/>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="faxlo">Fax:</label></td>
                                        <td><input name="faxlo[]" type="text" placeholder="Fax" title="Fax"
                                                   value="<?php echo @$contact->fax ?>" size="30" maxlength="255"/></td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="emaillo">Emai:</label></td>
                                        <td><input name="emaillo[]" type="text" placeholder="Email" title="Email"
                                                   value="<?php echo @$contact->email ?>" size="30" maxlength="255"/>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td><label for="imagelo">Path Image:</label></td>
                                        <td><input name="imagelo[]" type="text" placeholder="Image" title="Image"
                                                   value="<?php echo @$contact->image ?>" size="30"
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