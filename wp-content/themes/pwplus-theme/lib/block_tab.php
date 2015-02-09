<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$classBlockTab = null;
if (!class_exists('BlockTab')) {
    include_once("class/ClassBlockTab.php");
    global $wpdb;
    $classBlockTab = new BlockTab($wpdb);
}
$typePost = isset($_REQUEST['type_post']) ? $_REQUEST['type_post'] : FALSE;
$typePost = $typePost ? $typePost : @$_POST['type_post'];
$postPage = isset($_REQUEST['post_page']) ? $_REQUEST['post_page'] : FALSE;
$postPage = $postPage ? $postPage : @$_POST['post_page'];
if ($postPage == 'block_tab') {
    if ($typePost == 'add') {
        $callbackName = isset($_POST['callback']) ? $_POST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $path_image = isset($_POST['path_image_add']) ? $_POST['path_image_add'] : '';
            $link = isset($_POST['link']) ? $_POST['link'] : '';
            if ($classBlockTab->addData($title, $link, $sort, $path_image, $description)) {
                $returnArray = 'success';//array('data' => 'success');
            } else {
                $returnArray = 'error';//array('data' => 'error');
            }
        } else {
            $returnArray = 'none';//array('data' => 'none');
        }
        echo $returnArray;
//        header('Content-type: text/json');
//        header('Content-type: application/json');
//        echo $callbackName, '(', json_encode($returnArray), ')';
        exit();
    } else if ($typePost == 'json_block_tab') {
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $plimit = isset($_REQUEST['plimit']) ? $_REQUEST['plimit'] : 8;
        $callbackName = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        $startpage = 0;
        $pagthis = $page;
        if ($page != 1) {
            $startpage = $plimit * ($page - 1);
        }
        $getList = $classBlockTab->getList($plimit, $startpage);
        foreach ($getList as $key) {
            $returnArray['data'][] = $key;
        }
        
        $classBlockTab->classPagination->Items($classBlockTab->getCountValue());
        $classBlockTab->classPagination->limit($plimit);
        $classBlockTab->classPagination->target(network_site_url('/') . "?tabPage=tab1&typePost=json_block_tab");
        $classBlockTab->classPagination->currentPage($pagthis);
        $classBlockTab->classPagination->adjacents(3);
        $classBlockTab->classPagination->nextLabel('<strong>Next</strong>');
        $classBlockTab->classPagination->prevLabel('<strong>Prev</strong>');
        $classBlockTab->classPagination->nextIcon('');
        $classBlockTab->classPagination->prevIcon('');
        $classBlockTab->classPagination->getOutput();
        $paginate = str_replace('...', '<span class="dot">...</span>', $classBlockTab->classPagination->pagination);
        $returnArray['pagination'][] = $paginate;
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackName, '(', json_encode($returnArray), ')';
        exit();
    } else if ($typePost == 'edit_form') {
        $getID = isset($_REQUEST['id']) ? $_REQUEST['id'] : FALSE;
        if ($getID) {
            $galleryRow = $classBlockTab->getByID($getID);
            ?>
            <form action="" id="form_edit" method="post">
                <div id="div-inner-edit">
                    <input name="type_post" type="hidden" id="type_post" value="edit"/>
                    <input type="hidden" name="id" id="id"
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
                                    placeholder="Enter Description" style="width: 100%; height: 200px;"
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
                            <td colspan="4">
                                <center><img src="<?php echo @$galleryRow->image_path ?>"
                                             id="image_change" width="300" alt="" onerror="defaultImage(this);"/><br/>
                                    <input id="path_image_edit" type="hidden" name="path_image_edit" size="100"
                                           placeholder="Path Image"
                                           title="Path Image"
                                           value="<?php echo @$galleryRow->image_path ?>"/>
                                    <input id="uploadImageButton" type="button" class="button"
                                           value="Upload Image"
                                           onclick="imageUploaderAll('form#form_edit #path_image_edit', 'form#form_edit #image_change');"/>
                                    <br/><font color='red'>**</font>ขนาดที่แนะนำ 460x470px
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
                </div>
            </form>
        <?php
        }
        exit();
    } else if ($typePost == 'edit') {
        $callbackName = isset($_POST['callback']) ? $_POST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $path_image = isset($_POST['path_image_edit']) ? $_POST['path_image_edit'] : '';
            $link = isset($_POST['link']) ? $_POST['link'] : '';
            $getID = isset($_POST['id']) ? $_POST['id'] : FALSE;
            if ($getID) {
                $result = $classBlockTab->editData($getID, $title, $link, $sort, $path_image, $description);
                if ($result) {
                    $returnArray = 'success';//array('data' => 'success');
                } else {
                    $returnArray = 'error';//array('data' => "error");
                }
            } else {
                $returnArray = 'none';//array('data' => "none");
            }
            echo $returnArray;
//            header('Content-type: text/json');
//            header('Content-type: application/json');
//            echo $callbackName, '(', json_encode($returnArray), ')';
        }
        exit();
    } else if ($typePost == 'del') {
        $callbackName = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : 'callback';
        if (is_user_logged_in()) {
            $getID = isset($_REQUEST['id']) ? $_REQUEST['id'] : FALSE;
            if ($classBlockTab->deleteValue($getID)) {
                $returnArray = array('data' => 'success');
            } else {
                $returnArray = array('data' => 'error');
            }
        } else {
            $returnArray = array('data' => 'none');
        }
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo $callbackName, '(', json_encode($returnArray), ')';
        exit();
    } else  if ($typePost == "edit_title"){
        $result = $classBlockTab->saveTitle($_REQUEST['block_title']);
        echo $result;
        exit;
    }
}

add_action('admin_menu', 'theme_block_tab_add');
function theme_block_tab_add()
{
    add_submenu_page(
        'ics_theme_settings',
        'Block Tab',
        'Block Tab',
        'manage_options',
        'block-tab',
        'theme_block_tab_page'
    );
}

function theme_block_tab_page()
{
    global $webSiteName, $classBlockTab;
    ?>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/tytabs.css" rel="stylesheet" type="text/css"/>
    <link href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo includes_url(); ?>css/editor.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/block_tab.js"></script>
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
                    <input type="hidden" id="siteurl" value="<?php echo network_site_url('/'); ?>"/>

                    <h3>Block Tab</h3>
                    <hr/>
                    <form method="post" id="block_title">
                        <input type="hidden" name="type_post" value="edit_title">
                        <input type="hidden" name="post_page" value="block_tab">
                        <table>
                            <tr class="alternate">
                                <td><strong>Block Title: </strong></td>
                                <td><textarea name="block_title"><?php echo $classBlockTab->getTitle(); ?></textarea></td>
                                <td><input type="submit" class="button-primary" value="save"/></td>
                            </tr>
                        </table>
                    </form>
                    <hr/>
                    <div id="slidelist-stage">

                    </div>

                    <center><div class="update-nag" id="show_status"></div></center>
                    <div id="div_edit"></div>
                    <div id="div_add">
                        <form action="" id="form_add" method="post">
                            <div id="div-inner">
                                <input name="type_post" type="hidden" id="type_post" value="add"/>
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
                                                      id="description" style="width: 100%; height: 200px;"
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
                                        <td width="9%" align="right" valign="top"><strong>Image: </strong></td>
                                        <td colspan="3">

                                            <input id="path_image_add" type="text" name="path_image_add" size="100"
                                                   placeholder="Path Image"
                                                   title="Path Image"/>
                                            <input id="uploadImageButton" type="button" class="button"
                                                   value="Upload Image"
                                                   onclick="imageUploader('#path_image_add');"/>
                                            <br/><font color='red'>**</font>ขนาดที่แนะนำ 460x470px
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