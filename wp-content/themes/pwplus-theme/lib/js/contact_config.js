/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 19/2/2557
 * Time: 2:07 น.
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
    sbasepath = $('#getbasepath').val();
    reloadByHash();
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
    getEventTabClick();
    $("#contact-map").submit(function(){
        $.post("", $(this).serialize(),
            function (result) {
                scrollToID("#mapapi");
                window.location.reload();
            }
        );
        return false;
    });
    scrollToID("#mapapi");
});
function getEventTabClick() {
    $('li#tab1').click(function () {
        window.location.hash = '#tab1';
        reloadByHash();
        return false;
    });
    $('li#tab2').click(function () {
        window.location.hash = '#tab2';
        reloadByHash();
        return false;
    });
    $('li#tab3').click(function () {
        window.location.hash = '#tab3';
        reloadByHash();
        return false;
    });
}
function reloadByHash() {
    checkEventTab();
}
/* Contact Map */
function getEventContactMap() {
    addFormtabEvent();
    $('button#addformtb').click(function () {
        $('div#lat-long-stage').append(getFormTab());
        $('input[name="title[]"]').last().focus();
        addFormtabEvent();
        return false
    });
    $('button#addlocalformtb').click(function () {
        $('div#location-stage').append(getFormLoTab());
        $('input[name="titlelo[]"]').last().focus();
        addFormtabEvent();
        return false
    });
}
function getFormTab() {
    var formtxt = '<div class="tb-insert"><div class="handle-head-tb">' +
        '<a href="#" class="close-tb"><i class="icon-cancel"></i></a></div>' +
        '<table class="wp-list-table widefat" cellspacing="0" width="100%">' +
        '<tbody id="the-list-edit">' +
        '<tr class="alternate">' +
        '<td><label for="linkurl">Title:</label></td>' +
        '<td><input name="title[]" type="text" placeholder="Title"  title="Latitude" value="" size="30" maxlength="255"/></td>' +
        '<td><label for="latitude">Lat, Long:</label></td>' +
        '<td><input name="latitude[]" type="text" placeholder="Latitude"  title="Latitude" value="" size="30" maxlength="255"/><br/>' +
        '<span>Exam : 13.0, 100.0</span></td></tr>' +
        '<tr class="alternate"><td><label for="latitude">Description:</label></td>' +
        '<td colspan="3"><textarea name="desc[]" cols="70" id="latitude" placeholder="Description" title="Description"></textarea></td>' +
        '</tr><tr class="alternate">' +
        '<td><label for="imgpath">Image upload:</label></td>' +
        '<td colspan="3"><input name="imgpath[]" type="text" placeholder="Image upload" class="mappath"  title="Image upload" value="" size="30" maxlength="255"/><input id="uploadImageButton" type="button" class="button uploadimgpath" value="Upload Image"/></td></tr>' +
        '<tr class="alternate"><td><label for="linkurl">Link :</label></td>' +
        '<td colspan="3"><input name="linkurl[]" type="text" placeholder="Link"  title="Link" value="" size="70" maxlength="255" id="linkurl"/></td>  </tr>' +
        '</tbody></table></div>';
    return formtxt;
}
function getFormLoTab() {
    var formtxt = '<div class="tb-insert"><div class="handle-head-tb"><a href="#" class="close-tb"><i class="icon-cancel"></i></a></div><table class="wp-list-table widefat" cellspacing="0" width="100%"><tr class="alternate"><td><label for="titlelo">Title :</label></td><td><input name="titlelo[]" type="text" placeholder="Title"  title="Title" value="" size="30" maxlength="255" /></td></tr><tbody id="the-list-edit"><tr class="alternate"><td><label for="desclo">Description :</label></td><td><textarea name="desclo[]" cols="70" rows="5" placeholder="Description" title="Description"></textarea></td></tr><tr class="alternate"><td><label for="addesslo">Addess :</label></td><td><textarea name="addesslo[]" cols="70" rows="5" placeholder="Addess" title="Addess"></textarea></td></tr><tr class="alternate"><td><label for="phonelo">Phone :</label></td><td><input name="phonelo[]" type="text" placeholder="Phone"  title="Phone" value="" size="30" maxlength="255" /></td></tr><tr class="alternate"><td><label for="faxlo">Fax :</label></td><td><input name="faxlo[]" type="text" placeholder="Fax"  title="Fax" value="" size="30" maxlength="255" /></td></tr><tr class="alternate"><td><label for="emaillo">Email :</label></td><td><input name="emaillo[]" type="text" placeholder="Email"  title="Email" value="" size="30" maxlength="255" /></td></tr><tr class="alternate"><td><label for="imagelo">Image :</label></td><td><input name="imagelo[]" type="text" placeholder="Image"  title="Image" value="" size="30" maxlength="255" /><input type="button" class="button uploadimgpath" value="Upload Image"/></td></tr></tbody></table></div>';
    return formtxt;
}
function addFormtabEvent() {
    $('a.close-tb').unbind('click');
    $('input.uploadimgpath').unbind('click');
    $('a.close-tb').click(function () {
        $(this).parent().parent().remove();
        return false;
    });
    $('input.uploadimgpath').click(function () {
        var myagr = $(this).parent().find('input[type="text"]');
        window.send_to_editor = function (html) {
            imgurl = jQuery('img', html).attr('src');
            myagr.val(imgurl);
            tb_remove();
            window.send_to_editor = storeSendToEditor;
        };
        formfield = jQuery('.upload').attr('name');
        tb_show('เลือกไฟล์', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
}
/* Tool function*/
function checkEventTab() {
    getEventContactMap();
}
function getLoadingPage() {
    return '<center><img src="' + sbasepath + '/lib/images/332.gif" alt="Loading" /></center>';
}
function imageUploader(id) {
    window.send_to_editor = newSendToEditor;
    uploadID = id;
    formfield = jQuery('.upload').attr('name');
    tb_show('เลือกไฟล์', 'media-upload.php?type=image&TB_iframe=true');
    return false;
}
function imageUploaderAll(id, img) {
    window.send_to_editor = newSendToEditor;
    uploadID = id;
    uploadImg = img;
    formfield = jQuery('.upload').attr('name');
    tb_show('เลือกไฟล์', 'media-upload.php?type=image&TB_iframe=true');
    return false;
}
function statusUpdate(txt, color) {/*#F00#0C6#06C*/
    $('#showstatus').html('<h4 style="color:' + color + '">' + txt + '</h4>');
    $('#showstatus').fadeIn('fast', function () {
        setTimeout(function () {
            $('#showstatus').fadeOut('fast');
        }, 2000);
    });
}
function scrollToID(id) {
//    $("html, body").animate({scrollTop: $(id).offset().top}, 1000);
    $("body, html").animate({
            scrollTop: $(id).position().top
        },
        1000,
        function () {
        });
}
