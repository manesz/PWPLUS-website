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

get_header();

if(is_front_page()) {
    get_template_part( 'front', 'page' );
} else if(is_page( 'contact' )){
    get_template_part( 'content', 'contact' );
} else if(is_page( 'image-gallery' )){
    get_template_part( 'content', 'gallery' );
} else if(is_page( 'video-gallery' )){
    get_template_part( 'content', 'video', 'gallery' );
} else {
    get_template_part( 'index' );
 }

get_footer();

?>