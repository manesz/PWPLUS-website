<?php
/**
 * The Function for our theme.
 *
 * @package Business Theme by IdeaCorners Developer
 * @subpackage ic-business
 * @author Business Themes - www.ideacorners.com
 */

/* Fire our meta box setup function on the post editor screen. */
add_action('load-post.php', 'bestsellers_post_meta_boxes_setup');
add_action('load-post-new.php', 'bestsellers_post_meta_boxes_setup');
add_action('load-post.php', 'image_post_meta_boxes_setup');
add_action('load-post-new.php', 'image_post_meta_boxes_setup');

/* Meta box setup function. */
function bestsellers_post_meta_boxes_setup()
{
    /* Add meta boxes on the 'add_meta_boxes' hook. */
//    add_action('add_meta_boxes', 'bestsellers_add_post_meta_boxes');
    add_action('save_post', 'bestsellers_save_post_class_meta');
}

function image_post_meta_boxes_setup()
{
    add_action('add_meta_boxes', 'image_post_slide_meta_box');
    add_action('save_post', 'image_post_slide_save_meta_box');
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function image_post_slide_meta_box()
{
    add_meta_box(
        'image-post-ui', // Unique ID
        esc_html__('Image'), // Title
        'image_post_slide_meta_box_ui', // Callback function
        'post', // Admin page (or post type)
        'normal', // Context
        'default' // Priority
    );
}

function image_post_slide_meta_box_ui($object, $box)
{
    global $post;
    ?>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/lib/js/image-post-metabox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/lib/css/icon.css"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/lib/css/imgslidlist.css"/>
    <div class="misc-pub-section">
        <input type="text" title="Path Image" placeholder="Path Image" size="40" name="pathImg" id="pathImg">
        <input type="button" value="Upload Image" class="button" id="uploadImageButton">
        <button id="imgaddlist" class="button-primary"><i class="icon-plus-2"></i> เพิ่มรูป</button>
    </div>
    <?php $meta_values = get_post_meta($post->ID, 'imgslide', true); ?>
    <div class="tabs-panel" id="imglist-stage" <?php if (!count($meta_values)){ ?>style="display:none"<?php } ?>>
        <ul id="sortable">
            <?php
            if (count($meta_values)) {
                for ($i = 0; $i < count($meta_values); $i++) {
                    if ($meta_values[$i] != '') {
                        ?>
                        <li>
                            <input type="hidden" value="<?php echo @$meta_values[$i]; ?>" name="imgurl[]"/>
                            <a href="#" class="" title="ลากเพื่อเรียงใหม่">
                                <img src="<?php echo @$meta_values[$i]; ?>" width="200" onerror="defaultImage(this);"/></a>
                            <a href="#" class="delimgsrc" title="ลบรูปนี้"><i class="icon-cancel-2"></i></a>
                        </li>
                    <?php
                    }
                }
            } ?>
        </ul>
        <div class="clear"></div>
    </div>
<?php
}

function image_post_slide_save_meta_box()
{
    global $post;
    $post_type = get_post_type_object($post->post_type);
    $new_meta_value = (isset($_POST['imgurl']) ? $_POST['imgurl'] : FALSE);
    if (!current_user_can($post_type->cap->edit_post, $post->ID))
        return $post->ID;
    $meta_key = 'imgslide';
    $meta_value = get_post_meta($post->ID, $meta_key, true);
    if ($new_meta_value && '' == $meta_value)
        add_post_meta($post->ID, $meta_key, $new_meta_value, true);
    elseif ($new_meta_value && $new_meta_value != $meta_value)
        update_post_meta($post->ID, $meta_key, $new_meta_value); elseif ('' == $new_meta_value && $meta_value)
        delete_post_meta($post->ID, $meta_key, $meta_value);
    return true;
}

function bestsellers_save_post_class_meta()
{
    global $post;
    $post_type = get_post_type_object($post->post_type);
    $new_meta_value = (isset($_POST['bestsellcheck']) ? sanitize_html_class($_POST['bestsellcheck']) : FALSE);
    $new_price_value = (isset($_POST['pricepro']) ? sanitize_html_class($_POST['pricepro']) : 0);
    $new_pricenew_value = (isset($_POST['pricenew']) ? sanitize_html_class($_POST['pricenew']) : 0);
    if (!current_user_can($post_type->cap->edit_post, $post->ID))
        return $post->ID;
    $meta_key = 'bestsellers_post';
    $meta_key2 = 'price_post';
    $meta_key3 = 'pricenew_post';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post->ID, $meta_key, true);
    $price_value = get_post_meta($post->ID, $meta_key2, true);
    $pricenew_value = get_post_meta($post->ID, $meta_key3, true);

    /* If a new meta value was added and there was no previous value, add it. */
    if ($new_meta_value && '' == $meta_value)
        add_post_meta($post->ID, $meta_key, $new_meta_value, true);
    /* If the new meta value does not match the old value, update it. */
    elseif ($new_meta_value && $new_meta_value != $meta_value)
        update_post_meta($post->ID, $meta_key, $new_meta_value); /* If there is no new meta value but an old value exists, delete it. */
    elseif ('' == $new_meta_value && $meta_value)
        delete_post_meta($post->ID, $meta_key, $meta_value);
    if ($new_price_value && '' == $price_value)
        add_post_meta($post->ID, $meta_key2, $new_price_value, true);
    elseif ($new_price_value && $new_price_value != $price_value)
        update_post_meta($post->ID, $meta_key2, $new_price_value); elseif ('' == $new_price_value && $price_value)
        delete_post_meta($post->ID, $meta_key2, $price_value);
    if ($new_pricenew_value && '' == $pricenew_value)
        add_post_meta($post->ID, $meta_key3, $new_pricenew_value, true);
    elseif ($new_pricenew_value && $new_pricenew_value != $pricenew_value)
        update_post_meta($post->ID, $meta_key3, $new_pricenew_value); elseif ('' == $new_pricenew_value && $pricenew_value)
        delete_post_meta($post->ID, $meta_key3, $pricenew_value);
    return true;
}