<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$classVideoGallery = null;
if (!class_exists('VideoGallery')) {
    include_once("class/ClassVideoGallery.php");
    global $wpdb;
    $classVideoGallery = new VideoGallery($wpdb);
}
$typePost = isset($_REQUEST['typePost']) ? $_REQUEST['typePost'] : FALSE;
$postPage = isset($_REQUEST['post_page']) ? $_REQUEST['post_page'] : FALSE;
if ($postPage == 'video_gallery') {
    if ($typePost == 'add') {
        $callbackname = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
            $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '';
            $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
            $path_image = isset($_REQUEST['path_image']) ? $_REQUEST['path_image'] : '';
            $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
            $video_script = isset($_REQUEST['video_script']) ? $_REQUEST['video_script'] : '';
            if ($classVideoGallery->addData($title, $link, $sort, $path_image, $description, $video_script)) {
                $returnGallery = array('data' => 'success');
            } else {
                $returnGallery = array('data' => 'error');
            }
        } else {
            $returnGallery = array('data' => 'none');
        }
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackname, '(', json_encode($returnGallery), ')';
        exit();
    } else if ($typePost == 'json_video_gallery') {
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $plimit = isset($_REQUEST['plimit']) ? $_REQUEST['plimit'] : 8;
        $callbackname = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        $startpage = 0;
        $pagthis = $page;
        if ($page != 1) {
            $startpage = $plimit * ($page - 1);
        }
        $gallerylist = $classVideoGallery->getList($plimit, $startpage);
        foreach ($gallerylist as $key) {
            $returnGallery['data'][] = $key;
        }
//$p = new pagination();
        $classVideoGallery->classPagination->Items($classVideoGallery->getCountValue());
        $classVideoGallery->classPagination->limit($plimit);
        $classVideoGallery->classPagination->target(network_site_url('/') . "?tabPage=tab1&typePost=json_video_gallery");
        $classVideoGallery->classPagination->currentPage($pagthis);
        $classVideoGallery->classPagination->adjacents(3);
        $classVideoGallery->classPagination->nextLabel('<strong>Next</strong>');
        $classVideoGallery->classPagination->prevLabel('<strong>Prev</strong>');
        $classVideoGallery->classPagination->nextIcon('');
        $classVideoGallery->classPagination->prevIcon('');
        $classVideoGallery->classPagination->getOutput();
        $paginate = str_replace('...', '<span class="dot">...</span>', $classVideoGallery->classPagination->pagination);
        $returnGallery['pagination'][] = $paginate;
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackname, '(', json_encode($returnGallery), ')';
        exit();
    } else if ($typePost == 'editform') {
        $galleryID = isset($_REQUEST['video_gallery_id']) ? $_REQUEST['video_gallery_id'] : FALSE;
        if ($galleryID) {
            $galleryRow = $classVideoGallery->getByID($galleryID);
            ?>
            <form action="" id="form_edit" method="post">
                <div id="div-inner-edit">
                    <input name="typepost" type="hidden" id="typepost" value="edit"/>
                    <input type="hidden" name="video_gallery_id" id="video_gallery_id"
                           value="<?php echo @$galleryRow->id ?>"/>
                    <table class="wp-list-table widefat" cellspacing="0">
                        <tbody id="the-list-edit">
                        <tr class="alternate">
                            <td width="9%" align="right" valign="top"><strong>Title : </strong>
                            </td>
                            <td width="39%" align="left" valign="top">
                                <input name="title"
                                       type="text"
                                       id="title"
                                       placeholder="Enter Title"
                                       title="Title"
                                       value="<?php echo @$galleryRow->title ?>"
                                       size="40"
                                       maxlength="255"/>
                            </td>
                            <td width="12%" rowspan="3" class="leftborder" align="left"
                                valign="top"><strong>Description : </strong></td>
                            <td rowspan="3" width="40%" valign="top" align="left"><textarea
                                    name="description" cols="43" rows="5" id="description"
                                    placeholder="Enter Description"
                                    title="Description"><?php echo @$galleryRow->description ?></textarea>
                            </td>
                        </tr>
                        <tr class="alternate">
                            <td align="right" valign="middle"><strong>Link : </strong></td>
                            <td align="left" valign="top">
                                <input name="link" type="text"
                                       id="link"
                                       placeholder="Enter Link"
                                       title="Enter Link"
                                       value="<?php echo @$galleryRow->link ?>"
                                       size="40" maxlength="255"/>
                            </td>
                        </tr>
                        <tr class="alternate">
                            <td align="right" valign="middle"><strong>Sort : </strong></td>
                            <td align="left" valign="top">
                                <input name="sort" type="text"
                                       id="sort" placeholder=""
                                       title="Sort"
                                       value="<?php echo @$galleryRow->sort ?>"
                                       size="3" maxlength="3"/></td>
                        </tr>
                        <tr>
                            <td width="9%" align="right" valign="top"><strong>Script: </strong></td>
                            <td colspan="3">
                                <textarea name="video_script"
                                          id="video_script"
                                          cols="43" rows="5"
                                          placeholder="Enter Video Script"
                                          title="Enter Video Script"><?php echo @$galleryRow->video_script ?></textarea>
                                <?php if (!empty($galleryRow->video_script)):?>
                                    <iframe width="300" height="250"
                                            src="<?php echo $classVideoGallery->getPathImageFromVideo($galleryRow->video_script, 'play'); ?>"
                                            frameborder="0" allowfullscreen></iframe>
                                <?php endif; ?>
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
        $callbackname = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
            $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '';
            $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
            $path_image = isset($_REQUEST['path_image']) ? $_REQUEST['path_image'] : '';
            $link = isset($_REQUEST['link']) ? $_REQUEST['link'] : '';
            $galleryID = isset($_REQUEST['video_gallery_id']) ? $_REQUEST['video_gallery_id'] : FALSE;
            $video_script = isset($_REQUEST['video_script']) ? $_REQUEST['video_script'] : '';
            if ($galleryID) {
                $result = $classVideoGallery->editData($galleryID, $title, $link, $sort, $path_image, $description, $video_script);
                if ($result) {
                    $returnGallery = array('data' => 'success');
                } else {
                    $returnGallery = array('data' => "error");
                }
            } else {
                $returnGallery = array('data' => "none");
            }
            header('Content-type: text/json');
            header('Content-type: application/json');
            echo $callbackname, '(', json_encode($returnGallery), ')';
        }
        exit();
    } else if ($typePost == 'del') {
        $callbackname = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $galleryID = isset($_REQUEST['video_gallery_id']) ? $_REQUEST['video_gallery_id'] : FALSE;
            if ($classVideoGallery->deleteValue($galleryID)) {
                $returnGallery = array('data' => 'success');
            } else {
                $returnGallery = array('data' => 'error');
            }
        } else {
            $returnGallery = array('data' => 'none');
        }
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackname, '(', json_encode($returnGallery), ')';
        exit();
    }
}

add_action('admin_menu', 'theme_video_gallery_add');
function theme_video_gallery_add()
{
    add_submenu_page(
        'ics_theme_settings',
        'Video Gallery',
        'Video Gallery',
        'manage_options',
        'video-gallery',
        'theme_video_gallery_page'
    );
}

function theme_video_gallery_page()
{
    global $webSiteName;
    ?>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/tytabs.css" rel="stylesheet" type="text/css"/>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo includes_url(); ?>css/editor.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/video_gallery.js"></script>
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

                    <h3>Upload Video Gallery</h3>

                    <center><div class="update-nag" id="show_status"></div></center>
                    <div id="div_edit"></div>
                    <div id="div_add">
                        <form action="" id="form_add" method="post">
                            <div id="div-inner">
                                <input name="typepost" type="hidden" id="typepost" value="add"/>
                                <input type="hidden" id="galleryID" value="0"/>
                                <table class="wp-list-table widefat" cellspacing="0">
                                    <tbody id="the-list">
                                    <tr class="alternate">
                                        <td width="9%" align="right" valign="top"><strong>Title: </strong></td>
                                        <td width="39%" align="left" valign="top">
                                            <input name="title" type="text"
                                                   id="title"
                                                   placeholder="Enter Title"
                                                   title="Title" value=""
                                                   size="40" maxlength="255"/></td>
                                        <td width="12%" rowspan="3" class="leftborder" align="left" valign="top">
                                            <strong>Description: </strong></td>
                                        <td rowspan="3" width="40%" valign="top" align="left">
                                            <textarea name="description"
                                                      cols="43" rows="5"
                                                      id="description"
                                                      placeholder="Enter Description"
                                                      title="Description"></textarea>
                                        </td>
                                    </tr>
                                    <tr class="alternate">
                                        <td align="right" valign="middle"><strong>Link: </strong></td>
                                        <td align="left" valign="top">
                                            <input name="link" type="text" id="link"
                                                   placeholder="Enter Link"
                                                   title="Enter Link" value="" size="40"
                                                   maxlength="255"/></td>
                                    </tr>
                                    <tr class="alternate">
                                        <td align="right" valign="middle"><strong>Sort: </strong></td>
                                        <td align="left" valign="top">
                                            <input name="sort" type="text" id="sort"
                                                   placeholder="" title="Sort"
                                                   value="1" size="3" maxlength="3"/></td>
                                    </tr>
                                    <tr>
                                        <td width="9%" align="right" valign="top"><strong>Script: </strong></td>
                                        <td colspan="3">
                                            <textarea name="video_script"
                                                      cols="43" rows="5"
                                                      id="video_script"
                                                      placeholder="Enter Video Script"
                                                      title="Enter Video Script"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <input type="submit" name="gallery" value="Save" class="button-primary"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Tabs -->
    </div>
    <script>
    </script>
<?php
}