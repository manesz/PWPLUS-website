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


if (!class_exists('SiteInformation')) {
    include_once("lib/class/ClassBlockTab.php");
}
$classSiteInformation = new SiteInformation($wpdb);
$listSiteInformation = $classSiteInformation->getSiteInformation();
$listSiteInformation = @$listSiteInformation[0];
extract((array)$listSiteInformation);


if (!class_exists('ContactMap')) {
    include_once('lib/class/ClassContactMap.php');
}
$classContactMap = new ContactMap($wpdb);
$contacts = $classContactMap->getAlldataContact('publish');

if (!class_exists('SecondaryOffice')) {
    include_once('lib/class/ClassSecondaryOffice.php');
}
$classSecondaryOffice = new SecondaryOffice($wpdb);
$secondaryOffice = $classSecondaryOffice->getAlldataSecondaryOffice('publish');
?>

    <div id="white_content" style="margin-top: 10px;" xmlns="http://www.w3.org/1999/html"> <!-- begin white-content -->
        <div id="wrapper"> <!-- begin wrapper -->
            <div class="container"> <!-- begin container -->

                <div class="post"> <!-- begin post -->

                    <div class="entry">

                        <div class="main_cols container">
                            <div class="sixteen columns">
                                <br/>

                                <h1 style="font-size: 38px !important; font-weight: normal; color: #ccc; top: -20px; position: relative;">
                                    Contact us</h1>

                                <div class="des-sc-dots-divider" style="top:-10px; position:relative;"></div>
                            </div>
                        </div>

                        <div class="main_cols container">
                            <div class="five columns">

                                <!--                                ผู้ผลิต : <br/><h4>บริษัท พีดับบลิว พลัส จำกัด</h4>-->
                                <!--                                <p>-->
                                <!--                                    <strong>Address: </strong> 110 หมู่ 2 ถนนหอมเกร็ด อ.สามพราน จ.นครปฐม 73110<br/>-->
                                <!--                                    <strong>Phone:</strong> (123) 456-7890<br/>-->
                                <!--                                    <strong>Fax:</strong> +08 (123) 456-7890<br/>-->
                                <!--                                    <strong>Email:</strong>-->
                                <!--                                    <a class="inlineAdmedialink" href="#">info@freshlook.com</a><br/>-->
                                <!--                                </p>-->
                                <!---->
                                <!--                                <div class="des-sc-dots-divider" style="top:-10px; position:relative;"></div>-->
                                <!--                                ผู้จัดจำหน่าย : <br/><h4>บริษัท พีดับบลิวเอสอี จำกัด</h4>-->
                                <!--                                <p>-->
                                <!--                                    <strong>Address: </strong> 388 ถนนรามคำแหง แขวงสะพานสูง เขตสะพานสูง กรุงเทพฯ-->
                                <!--                                    10240<br/>-->
                                <!--                                    <strong>Phone:</strong> 02-372-2897-8<br/>-->
                                <!--                                    <strong>Fax:</strong> 02-372-2899<br/>-->
                                <!--                                    <strong>Email:</strong>-->
                                <!--                                    <a class="inlineAdmedialink" href="#">sales@pwplus.co.th, webmaster@pwplus.co.th</a><br/>-->
                                <!--                                </p>-->
                                <?php foreach ($contacts as $contact) : ?>
                                    <?php echo $contact->description; ?> <br/><h4><?php echo $contact->title; ?></h4>
									<?php if(!empty($contact->address)){?>
                                    <p>
                                        <?php if(!empty($contact->address)){ echo "<strong>Address: </strong>".$contact->address."<br/>"; }?>
                                        <?php if(!empty($contact->phone)){ echo "<strong>Phone:</strong>".$contact->phone."<br/>"; }?>
                                        <?php if(!empty($contact->fax)){ echo "<strong>Fax:</strong>".$contact->fax."<br/>"; }?>
                                        
                                        <?php $arrEmail = explode(",", $contact->email); ?>
										<?php if(!empty($contact->email)){ echo "<strong>Email:</strong>"; }?>
                                        <?php foreach ($arrEmail as $valueMail) :
                                            ?>
                                            <a class="inlineAdmedialink"
                                               href="mailto:<?php echo trim($valueMail); ?>"><?php echo trim($valueMail); ?></a>
                                            <!--<br/>-->
                                        <?php endforeach; ?>
                                    </p>
                                    <!--<div class="des-sc-dots-divider" style="top:-10px; position:relative;"></div>-->
									<?php } ?>
                                <?php  endforeach; ?>

                                <div class='socialdiv'>
                                    <br/>
                                    <ul>
                                        <!--                                    <li>-->
                                        <!--                                        <a href=http://www.facebook.com target='_blank' class='facebook' title='Facebook'></a>-->
                                        <!--                                    </li>-->
                                        <!--                                    <li>-->
                                        <!--                                        <a href=http://www.twitter.com target='_blank' class='twitter' title='Twitter'></a>-->
                                        <!--                                    </li>-->
                                        <!--                                    <li>-->
                                        <!--                                        <a href=http://www.stumbleupon.com target='_blank' class='linkedin' title='LinkedIn'></a>-->
                                        <!--                                    </li>-->
                                        <!--                                    <li>-->
                                        <!--                                        <a href=http://www.twitter.com target='_blank' class='vimeo' title='Vimeo'></a>-->
                                        <!--                                    </li>-->
                                        <!--                                    <li>-->
                                        <!--                                        <a href=http://www.stumbleupon.com target='_blank' class='picasa' title='Picasa'></a>-->
                                        <!--                                    </li>-->

                                        <?php if ($facebook_script): ?>
                                            <li><a href="<?php echo $facebook_script ? $facebook_script : "#"; ?>"
                                                   target='_blank'
                                                   class='facebook' title='Facebook'></a></li>
                                        <?php endif; ?>
                                        <?php if ($twitter_script): ?>
                                            <li><a href="<?php echo $twitter_script ? $twitter_script : "#"; ?>"
                                                   target='_blank'
                                                   class='twitter' title='Twitter'></a></li>
                                        <?php endif; ?>
                                        <?php if ($google_plus_script): ?>
                                            <li><a href="<?php echo $google_plus_script ? $google_plus_script : "#"; ?>"
                                                   target='_blank' class='google' title='Google Plus'></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <br/><br/>
                                <!--<h4>Secondary Office</h4>-->
                                <?php foreach ($secondaryOffice as $key => $value): ?>
                                    <p>
                                        <?php if ($value->title): ?>
                                            <strong><?php echo $value->title; ?></strong><br/>
                                        <?php endif;
                                        if ($value->address):?>
                                            <strong>Address:</strong> <?php echo $value->address; ?><br/>
                                        <?php endif; ?>
                                        <strong>Phone:</strong> <?php echo $value->phone; ?><br/>
                                        <strong>Fax:</strong> <?php echo $value->fax; ?><br/>
                                        <strong>Email:</strong>
                                        <a class="inlineAdmedialink"
                                           href="mailto:<?php echo $value->email; ?>"><?php echo $value->email; ?></a><br/>
                                        <br/>
                                    </p>
                                    <?php if ($value->latlong):
                                        list($lat, $long) = explode(',', $value->latlong);
                                        ?>
                                        <div class="mapelas" id="map-contact-<?php echo $key; ?>"
                                             style="width: 240px; height: 140px; border: 3px solid #eee"></div>
                                        <input type="hidden" id="gm_lat" value="<?php echo trim($lat); ?>"/>
                                        <input type="hidden" id="gm_lng" value="<?php echo trim($long); ?>"/>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div>

                            <div class="eleven columns">
                                <h4>Drop us a line</h4>

                                <div class="contact-form">
                                    <div class="message_success form_success"></div>
                                    <form method="post" action="#" class="validateform" id="">
                                        <ul class="forms">
                                            <li>
                                                <label for="line_name">Name</label>
                                                <input type="text" name="name" id="line_name"
                                                       class="yourname txt corner-input"
                                                       onfocus="checkerror(this)"
                                                       onblur="var v = $(this).val(); $('.yourname_val').html(v);">

                                                <div class="yourname_val" style="display:none"></div>
                                            </li>
                                            <li>
                                                <label for="line_email">Email </label>
                                                <input style="margin: 10px 0;"
                                                       type="text" name="email" id="line_email"
                                                       class="youremail txt corner-input"
                                                       onfocus="checkerror(this)"
                                                       onblur="var v = $(this).val(); $('.youremail_val').html(v);">

                                                <div class="youremail_val" style="display:none"></div>
                                            </li>
                                            <li>
                                                <label>Message<textarea name="message"
                                                                        class="yourmessage textarea message corner-input"
                                                                        rows=20 cols=30
                                                                        onfocus="checkerror(this)"
                                                                        onblur="var v = $(this).val(); $('.yourmessage_val').html(v);"></textarea>
                                                </label>

                                                <div class="yourmessage_val" style="display:none"></div>
                                            </li>
                                            <li>
                                                <a style="font-family: Arial, sans-serif;" id="send-comment"
                                                   href="javascript:;"
                                                   onclick="sendemail($(this),'sales@pwplus.co.th', 'Drop us a line', 'Please enter a name.', 'Please enter a valid email.', 'Please give us a message.', 'Thanks! We will back to you soon...', 'Ups! Something wrong. Try again.')"
                                                   class="submit button medium yellow">Send</a>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

<?php
get_footer();
?>