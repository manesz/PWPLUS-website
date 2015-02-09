<?php get_header(); ?>

<?php
if(is_page('Image gallery')){
    get_template_part('content', 'gallery');
}else if(is_page('Video gallery')){
    get_template_part('content', 'video');
}else if(is_page('Contact us')){
    get_template_part('content', 'contact');
}else{
    get_template_part( 'content', 'page' );
}
?>

<?php get_footer(); ?>