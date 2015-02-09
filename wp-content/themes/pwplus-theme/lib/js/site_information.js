/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/2/2557
 * Time: 2:03 น.
 * To change this template use File | Settings | File Templates.
 */

if (!window.jQuery) {
    var script = document.createElement('script');
    var jqvar = document.getElementById('getjqpath').value;
    script.type = "text/javascript";
    script.src = jqvar;
    document.getElementsByTagName('head')[0].appendChild(script);
}
var $ = jQuery.noConflict(), swithEd = null, tabcurrent = '#tab1', sbasepath, uploadID = '', uploadImg = '', storeSendToEditor = '', newSendToEditor = '', updatestage = false;
$(document).ready(function () {
    $('#show_status').fadeOut('fast');
    $('#frm_post').submit(function () {
        postData();
        return false;
    });
    storeSendToEditor = window.send_to_editor;
    newSendToEditor = function (html) {
        imgurl = jQuery('img', html).attr('src');
        $(uploadID).val(imgurl);
        if (uploadImg) {
            $(uploadImg).attr('src', imgurl);
            uploadImg = '';
        }
        tb_remove();
        window.send_to_editor = storeSendToEditor;
    };
});

function postData() {
    statusUpdate('Loading...', '#0C6');
    $.ajax({
        data: $("#frm_post").serialize(),
        type: 'POST',
        url: $("#base_patch").val(),
        success: function (result) {
            if (result == "add success") {
                statusUpdate('บันทึกข้อมูลเรียบร้อย', '#06C');
                $("#type_post").val('edit');
            } else {
                statusUpdate('ข้อมูลผิดพราดกรุณาลองใหม่', '#F00');
            }
        }
    });
}

function imageUploader(id) {
    window.send_to_editor = newSendToEditor;
    uploadID = id;
    formfield = jQuery('.upload').attr('name');
    tb_show('เลือกไฟล์', 'media-upload.php?type=image&TB_iframe=true');
    return false;
}

function statusUpdate(txt, color) {/*#F00#0C6#06C*/
    $('#show_status').html('<h4 style="color:' + color + '">' + txt + '</h4>');
    $('#show_status').fadeIn('fast', function () {
        setTimeout(function () {
            $('#show_status').fadeOut('fast');
        }, 2000);
    });
}
function scrollToID(id) {
    $("html, body").animate({scrollTop: $(id).offset().top}, 1000);
}