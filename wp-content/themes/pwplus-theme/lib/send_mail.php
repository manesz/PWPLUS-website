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

if (isset($_POST['send_email'])) {
    $callBackName = isset($_POST['callback']) ? $_POST['callback'] : 'callback';
    $to = @$_POST['sendTo'];
    $name = @$_POST['name'];
    $message = @$_POST['message'];
    $subject = @$_POST['subject'];
    $email = @$_POST['email'];
    $headers = "From: My Name $name <$email>\r\n";
    $message = "From: $name '$email', Massage: $message";
    $result = wp_mail($to, $subject, $message, $headers);

    if ($result) {
        echo "send";
    } else {
        echo "error";
    }
    exit;
}