<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$classImageSlide = null;
if (!class_exists('ImageSlide')) {
    include_once("class/ClassImageSlide.php");
    global $wpdb;
    $classImageSlide = new ImageSlide($wpdb);
}
$typePost = isset($_REQUEST['typePost']) ? $_REQUEST['typePost'] : FALSE;
$postPage = isset($_REQUEST['post_page']) ? $_REQUEST['post_page'] : FALSE;
if ($postPage == 'image_slide') {
    if ($typePost == 'add') {
        $callbackName = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $gdesc = isset($_REQUEST['gdesc']) ? $_REQUEST['gdesc'] : '';
            $gsort = isset($_REQUEST['gsort']) ? $_REQUEST['gsort'] : '';
            $gtitle = isset($_REQUEST['gtitle']) ? $_REQUEST['gtitle'] : '';
            $pathimg = isset($_REQUEST['pathimg']) ? $_REQUEST['pathimg'] : '';
            $glink = isset($_REQUEST['glink']) ? $_REQUEST['glink'] : '';
            if ($classImageSlide->addData($gtitle, $glink, $gsort, $pathimg, $gdesc)) {
                $returnSlide = array('data' => 'success');
            } else {
                $returnSlide = array('data' => 'error');
            }
        } else {
            $returnSlide = array('data' => 'none');
        }
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackName, '(', json_encode($returnSlide), ')';
        exit();
    } else if ($typePost == 'json_slide_gallery') {
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $plimit = isset($_REQUEST['plimit']) ? $_REQUEST['plimit'] : 8;
        $callbackName = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        $startpage = 0;
        $pagthis = $page;
        if ($page != 1) {
            $startpage = $plimit * ($page - 1);
        }
        $slidelist = $classImageSlide->getList($plimit, $startpage);
        foreach ($slidelist as $key) {
            $returnSlide['data'][] = $key;
        }
//$p = new pagination();
        $classImageSlide->classPagination->Items($classImageSlide->getCountValue());
        $classImageSlide->classPagination->limit($plimit);
        $classImageSlide->classPagination->target(network_site_url('/') . "?tabPage=tab1&typePost=json_slide_gallery");
        $classImageSlide->classPagination->currentPage($pagthis);
        $classImageSlide->classPagination->adjacents(3);
        $classImageSlide->classPagination->nextLabel('<strong>Next</strong>');
        $classImageSlide->classPagination->prevLabel('<strong>Prev</strong>');
        $classImageSlide->classPagination->nextIcon('');
        $classImageSlide->classPagination->prevIcon('');
        $classImageSlide->classPagination->getOutput();
        $paginate = str_replace('...', '<span class="dot">...</span>', $classImageSlide->classPagination->pagination);
        $returnSlide['pagination'][] = $paginate;
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackName, '(', json_encode($returnSlide), ')';
        exit();
    } else if ($typePost == 'editform') {
        $slideID = isset($_REQUEST['slideid']) ? $_REQUEST['slideid'] : FALSE;
        if ($slideID) {
            $slidRow = $classImageSlide->getByID($slideID);
            ?>
            <form action="" id="slide-post-edit" method="post">
                <div id="div-inner-edit">
                    <input name="typepost" type="hidden" id="typepost" value="edit"/>
                    <input type="hidden" id="slideid" value="<?php echo @$slidRow->id ?>"/>
                    <table class="wp-list-table widefat" cellspacing="0">
                        <tbody id="the-list-edit">
                        <tr class="alternate">
                            <td width="9%" align="right" valign="top"><strong>Title : </strong>
                            </td>
                            <td width="39%" align="left" valign="top">
                                <input name="gtitle"
                                       type="text"
                                       id="gtitle"
                                       placeholder="Enter Title"
                                       title="Title"
                                       value="<?php echo @$slidRow->title ?>"
                                       size="40"
                                       maxlength="255"/>
                            </td>
                            <td width="12%" rowspan="3" class="leftborder" align="left"
                                valign="top"><strong>Description : </strong></td>
                            <td rowspan="3" width="40%" valign="top" align="left"><textarea
                                    name="gsort2" cols="43" rows="5" id="gsort2"
                                    placeholder="Enter Description" style="width: 100%;"
                                    title="Description"><?php echo @$slidRow->description ?></textarea>
                            </td>
                        </tr>
                        <tr class="alternate">
                            <td align="right" valign="middle"><strong>Link : </strong></td>
                            <td align="left" valign="top">
                                <input name="glink" type="text"
                                       id="glink"
                                       placeholder="Enter Link"
                                       title="Enter Link"
                                       value="<?php echo @$slidRow->link ?>"
                                       size="40" maxlength="255"/>
                            </td>
                        </tr>
                        <tr class="alternate">
                            <td align="right" valign="middle"><strong>Sort : </strong></td>
                            <td align="left" valign="top">
                                <input name="gsort" type="text"
                                       id="gsort" placeholder=""
                                       title="Sort"
                                       value="<?php echo @$slidRow->sort ?>"
                                       size="3" maxlength="3"/></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center><img src="<?php echo @$slidRow->image_path ?>"
                                             id="imgchang" width="300" alt="" onerror="defaultImage(this);"/><br/>
                                    <input id="pathImg" type="hidden" name="pathImg" size="100"
                                           placeholder="Path Image"
                                           title="Path Image"
                                           value="<?php echo @$slidRow->image_path ?>"/>
                                    <input id="uploadImageButton" type="button" class="button"
                                           value="Upload Image"
                                           onclick="imageUploaderAll('form#slide-post-edit #pathImg', 'form#slide-post-edit #imgchang');"/>
                                    <br/><font color='red'>**</font>ขนาดที่แนะนำ 1400x400px
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="submit" name="gallery2" value="Update"
                                       class="button-primary"/> &nbsp;<input
                                    type="button" value="Cancel" id="cancelform"
                                    class="button"/></td>
                        </tr>
                        </tbody>
                    </table>
                    <!--        <input type="button" value="New" onclick="document.location.reload(true)" class="button-primary"/>-->
                </div>
            </form>
        <?php
        }
        exit();
    } else if ($typePost == 'edit') {
        $callbackName = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $gdesc = isset($_REQUEST['gdesc']) ? $_REQUEST['gdesc'] : '';
            $gsort = isset($_REQUEST['gsort']) ? $_REQUEST['gsort'] : '';
            $gtitle = isset($_REQUEST['gtitle']) ? $_REQUEST['gtitle'] : '';
            $pathimg = isset($_REQUEST['pathimg']) ? $_REQUEST['pathimg'] : '';
            $glink = isset($_REQUEST['glink']) ? $_REQUEST['glink'] : '';
            $slideID = isset($_REQUEST['slideid']) ? $_REQUEST['slideid'] : FALSE;
            if ($slideID) {
                if ($classImageSlide->editData($slideID, $gtitle, $glink, $gsort, $pathimg, $gdesc)) {
                    $returnSlide = array('data' => 'success');
                } else {
                    $returnSlide = array('data' => 'error');
                }
            } else {
                $returnSlide = array('data' => 'none');
            }
            header('Content-type: text/json');
            header('Content-type: application/json');
            echo $callbackName, '(', json_encode($returnSlide), ')';
        }
        exit();
    } else if ($typePost == 'del') {
        $callbackName = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $slideID = isset($_REQUEST['slideid']) ? $_REQUEST['slideid'] : FALSE;
            if ($classImageSlide->deleteValue($slideID)) {
                $returnSlide = array('data' => 'success');
            } else {
                $returnSlide = array('data' => 'error');
            }
        } else {
            $returnSlide = array('data' => 'none');
        }
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackName, '(', json_encode($returnSlide), ')';
        exit();
    }
}

add_action('admin_menu', 'theme_image_slide_add');
function theme_image_slide_add()
{
    add_submenu_page(
        'ics_theme_settings',
        'Image Banner Slide',
        'Image Banner Slide',
        'manage_options',
        'image-slide',
        'theme_image_slide_page'
    );
}

function theme_image_slide_page()
{
    global $webSiteName;
    ?>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/tytabs.css" rel="stylesheet" type="text/css"/>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo includes_url(); ?>css/editor.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/image_slide.js"></script>
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
    <div>
        <!-- Tabs -->
        <div id="tabsholder">
            <div class="contents marginbot">
                <div class="tabscontent">
                    <link rel="stylesheet" type="text/css"
                          href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css"/>
                    <div id="slidelist-stage">

                    </div>
                    <input type="hidden" id="siteurl" value="<?php echo network_site_url('/'); ?>"/>

                    <h3>Upload Slide</h3>

                    <div class="update-nag" id="showstatus"></div>
                    <div id="formstage">
                        <form action="" id="slide-post" method="post">
                            <div id="div-inner">
                                <input name="typepost" type="hidden" id="typepost" value="add"/>
                                <input type="hidden" id="slideID" value="0"/>
                                <table class="wp-list-table widefat" cellspacing="0">
                                    <tbody id="the-list">
                                    <tr class="alternate">
                                        <td width="9%" align="right" valign="top"><strong>Title: </strong></td>
                                        <td width="39%" align="left" valign="top">
                                            <input name="gtitle" type="text"
                                                   id="gtitle"
                                                   placeholder="Enter Title"
                                                   title="Title" value=""
                                                   size="40" maxlength="255"/></td>
                                        <td width="12%" rowspan="3" class="leftborder" align="left" valign="top">
                                            <strong>Description: </strong></td>
                                        <td rowspan="3" width="40%" valign="top" align="left">
                                            <textarea name="gsort2"
                                                      cols="43" rows="5"
                                                      id="gsort2" style="width: 100%;"
                                                      placeholder="Enter Description"
                                                      title="Description"></textarea>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td align="right" valign="middle"><strong>Link: </strong></td>
                                        <td align="left" valign="top">
                                            <input name="glink" type="text" id="glink"
                                                   placeholder="Enter Link"
                                                   title="Enter Link" value="" size="40"
                                                   maxlength="255"/></td>
                                    </tr>
                                    <tr class="alternate">
                                        <td align="right" valign="middle"><strong>Sort: </strong></td>
                                        <td align="left" valign="top">
                                            <input name="gsort" type="text" id="gsort"
                                                   placeholder="" title="Sort"
                                                   value="1" size="3" maxlength="3"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <input id="pathImg" type="text" name="pathImg" size="100"
                                                   placeholder="Path Image"
                                                   title="Path Image"/>
                                            <input id="uploadImageButton" type="button" class="button"
                                                   value="Upload Image"
                                                   onclick="imageUploader('#pathImg');"/>
                                            <input type="submit" name="gallery" value="Save" class="button-primary"/>
                                            <br/><font color='red'>**</font>ขนาดที่แนะนำ 1400x400px
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--        <input type="button" value="New" onclick="document.location.reload(true)" class="button-primary"/>-->
                            </div>
                        </form>
                    </div>
                    <div id="formupdate"></div>
                </div>
            </div>
        </div>
        <!-- /Tabs -->
    </div>
    <script>
    </script>
<?php
}