<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manesz
 * Date: 10/21/13
 * Time: 9:52 PM
 * To change this template use File | Settings | File Templates.
 */

if (!class_exists('ImageSlide')) {
    include_once("lib/class/ClassImageSlide.php");
}
$classImageSlide = new ImageSlide($wpdb);
$listImageSlide = $classImageSlide->getList();
?>
<?php if ($listImageSlide): ?>
    <!-- START: CAMERA SLIDER -->
    <div id="slider_container">
        <?php
        foreach ($listImageSlide as $key => $value):
            ?>
            <div data-thumb="<?php echo $value->image_path; ?>"
                 data-src="<?php echo $value->image_path; ?>">
                <div class="camera_caption">
                    <div class="container" style="display:none; opacity: 0; filter: alpha(opacity=0);">
                        <div class="eight columns" style="text-align: left; height: 100%;">

                            <div class="title des_moveFromLeft"><h1><?php echo $value->title; ?></h1></div>

                            <div class="text des_moveFromRight"><?php echo $value->description; ?></div>

                            <a class="button medium yellow des_moveFromRight"
                               href="<?php echo $value->link; ?>">Click</a>
                        </div>

                        <!--                <div class="eight columns" style="height: 100%;">-->
                        <!--                    <img class="image des_moveFromLeft"-->
                        <!--                         src="http://pagead2.googlesyndication.com/pagead/images/nessie_icon_chevron_white.png" alt="">-->
                        <!--                </div>-->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- END: CAMERA SLIDER -->
<?php endif; ?>