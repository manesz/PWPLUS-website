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
var post_page = "block_information";
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
    hideWaitingImage();
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
/* Event Video  function */
function getEventVideo() {
    getList();
    $('#form_add').submit(function () {
        if (checkFormInput(this)) {
            getJsonAdd();
        }
        return false;
    });
}
function getJsonAdd() {
    statusUpdate('Loading...', '#0C6');
    var data = $("#form_add").serialize();
    data = data + '&' + $.param({
        post_page: post_page,
        ran: Math.random(),
        type_post: 'add',
        callback: 'jsonCallback'
    });
    /*$.ajax({
     //url: $('input#siteurl').val() + '?tabPage=tab1',
     url: "",
     async: false,
     jsonpCallback: 'jsonCallback',
     contentType: "application/json",
     dataType: 'jsonp',
     data: data,
     success: function (data) {
     if (data.data == 'success') {
     statusUpdate('เพิ่มเรียบร้อย', '#06C');
     clearTab1();
     } else {
     statusUpdate('ข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
     }
     }
     });*/
    $.post("", data, function (result) {
        if (result == "success") {
            statusUpdate('เพิ่มเรียบร้อย', '#06C');
            clearTab1();
        } else {
            statusUpdate('ข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
        }
    })
        .done(function () {
            //alert("second success");
        })
        .fail(function () {
            statusUpdate('ข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
        })
        .always(function () {
            //alert("finished");
        });
}
function clearTab1() {
    $('#form_add #title').val('');
    $('#form_add #link').val('');
    $('#form_add #sort').val('1');
    $('#form_add #description').val('');
    $('#form_add #path_image_add').val('');
    $("#form_add #title").focus();
    enableTab1Input();
}
function disibleTab1Input() {
    $('form#gallery-post input,form#gallery-post textarea').prop('disabled', false);
}
function enableTab1Input() {
//    $('form#gallery-post input,form#gallery-post textarea').removeAttr('disabled');
    getList();
}
function checkFormInput(frm) {
    var validate = true;
    if (frm.title.value == '') {
        alert('ยังไม่ได้กรอกข้อมูล Title');
        frm.title.focus();
        return false;
    }
    if (frm.link.value == '') {
        alert('ยังไม่ได้ใส่ Link');
        frm.link.focus();
        return false;
    }
    if (frm.sort.value == '') {
        alert('ยังไม่ได้ใส่ Sort    ');
        frm.sort.focus();
        return false;
    }
    if (frm.type_post.value == "add") {
        if (frm.path_image_add.value == "") {
            alert('ยังไม่ได้เลือกรูป');
            frm.path_image_add.focus();
            return false;
        }
    }else if (frm.type_post.value == "edit") {
        if (frm.path_image_edit.value == "") {
            alert('ยังไม่ได้เลือกรูป');
            frm.path_image_edit.focus();
            return false;
        }
    }
    return validate;
}
function getList(url) {
    var myurl = url ? url : $('input#siteurl').val() + '?tabPage=tab1';
    $('div#slidelist-stage').html(getLoadingPage());
    $.ajax({
        url: myurl,
        async: false,
        jsonpCallback: 'jsonCallback',
        contentType: "application/json",
        dataType: 'jsonp',
        data: {
            post_page: post_page,
            ran: Math.random(),
            type_post: 'json_block_information',
            callback: 'jsonCallback'
        },
        success: function (data) {
            if (data.data) {
                var mytxt = '<ul>';
                $.each(data.data, function (index, value) {
                    mytxt += listMenu(value.image_path, value.id, value.title);
                });
                mytxt += '</ul><div class="clear"></div><div class="pagination">' + data.pagination + '</div>';
                $('div#slidelist-stage').html(mytxt);
                delete mytxt;
                getEvent();
                $("#title").focus();
            } else {
                $('div#slidelist-stage').html('<h3 style="text-align:center">ยังไม่มีข้อมูล</h3>');
            }
        }
    });
    return false;
}
function checkImg(src) {
    var jqxhr = $.get(src,function () {
        return true;
    }).fail(function () {
            return false;
        });
}
function listMenu(img, id, title) {
    if (checkImg(img)) {
        img = sbasepath + '/lib/images/no_image.jpg';
    }
    var returnText = '<li><a href="#" class="img-edit" rel="' + id + '"><img title="' + title +
        '" src="' + img + '" alt="" width="165" height="110" onerror="defaultImage(this);"/></a>' +
        '<a href="#" class="remove-slide" rel="' + id + '"><i class="icon-cancel-2"></i></a></li>';
    return returnText;
}
function getEvent() {
    $('div#slidelist-stage ul li a.img-edit').click(function () {
        getDataForEdit($(this).attr('rel'));
        return false
    });
    $('div#slidelist-stage ul li a.remove-slide').click(function () {
        if (confirm('ต้องการลบรูปนี้หรือไม่')) {
            showWaitingImage();
            $.ajax({
                url: $('input#siteurl').val() + '?tabPage=tab1',
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                data: {
                    post_page: post_page,
                    ran: Math.random(),
                    type_post: 'del',
                    id: $(this).attr('rel'),
                    callback: 'jsonCallback'
                },
                success: function (data) {
                    hideWaitingImage();
                    if (data.data == 'success') {
                        statusUpdate('ลบข้อมูลเรียบร้อย', '#06C');
                        getList();
                    } else {
                        statusUpdate('ข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
                    }
                }
            });
        }
        return false
    });
    $('div.pagination a').click(function () {
        getList($(this).attr('href'));
        return false;
    });
}
function getDataForEdit(sid) {
    showWaitingImage();
    $.ajax({
        url: $('input#siteurl').val() + '?tabPage=tab1',
        type: 'POST',
        data: {
            post_page: post_page,
            ran: Math.random(),
            type_post: 'edit_form',
            id: sid,
            callback: 'jsonCallback'
        },
        success: function (data) {
            hideWaitingImage();
            $('div#div_edit').html(data);
            $('div#div_add').slideUp('fast', function () {
                $('div#div_edit').slideDown('fast', function(){
                    $("#title").focus();
                });
                scrollToID('div#div_edit');
            });
            updatestage = true;
            togleDel();
            getEventEditForm();
            $("#title").focus();
        }
    });
}
function togleDel() {
    if (updatestage) {
        $('a.remove-slide i').css('display', 'none');
    } else {
        $('a.remove-slide i').css('display', 'block');
    }
}
function getEventEditForm() {
    $('form#form_edit').submit(function () {
        if (checkFormInput(this)) {
            postEditData(this);
        }
        return false;
    });
    $('input#cancelform').click(function () {
        $('div#div_edit').slideUp('fast', function () {
            $('div#div_add').slideDown('fast',function(){
                $("#title").focus();
            });
            updatestage = false;
            togleDel();
            scrollToID('#div_add');
        });
        return false;
    });
}
function postEditData(frm) {
    showWaitingImage();
    var data = $(frm).serialize();
    data = data + '&' + $.param({
        post_page: post_page,
        ran: Math.random(),
        type_post: 'edit',
        callback: 'jsonCallback'
    });
    /*$.ajax({
        url: $('input#siteurl').val() + '?tabPage=tab1',
        async: false,
        jsonpCallback: 'jsonCallback',
        contentType: "application/json",
        dataType: 'jsonp',
        data: data,
        success: function (data) {
            hideWaitingImage();
            if (data.data == 'success') {
                statusUpdate('แก้ไขข้อมูลเรียบร้อย', '#06C');
                getList();
                $('div#div_edit').slideUp('fast', function () {
                    $('div#div_edit').html('');
                    $('div#div_add').slideDown('fast');
                    scrollToID('#div_add');
                    clearTab1();
                });
            } else if (data.data == "none") {
                statusUpdate('ไม่พบ ID', '#F00');
            }
            else {
                statusUpdate('ข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
            }
        }
    });*/
/*
    $.post("", data, function (result) {
        hideWaitingImage();
        if (result == 'success') {
            statusUpdate('แก้ไขข้อมูลเรียบร้อย', '#06C');
            getList();
            $('div#div_edit').slideUp('fast', function () {
                $('div#div_edit').html('');
                $('div#div_add').slideDown('fast');
                scrollToID('#div_add');
                clearTab1();
            });
        } else if (result == "none") {
            statusUpdate('ไม่พบ ID', '#F00');
        }
        else {
            statusUpdate('ข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
        }
    })
        .done(function () {
            //alert("second success");
        })
        .fail(function () {
            hideWaitingImage();
            statusUpdate('ข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
        })
        .always(function () {
            //alert("finished");
        });*///alert(data)
    $.ajax({
        type: "POST",
        url: '',
        data: data,
        success: function (result) {
            hideWaitingImage();
            if (result == 'success') {
                statusUpdate('แก้ไขข้อมูลเรียบร้อย', '#06C');
                getList();
                $('div#div_edit').slideUp('fast', function () {
                    $('div#div_edit').html('');
                    $('div#div_add').slideDown('fast');
                    scrollToID('#div_add');
                    clearTab1();
                });
            } else if (result == "none") {
                statusUpdate('ไม่พบ ID', '#F00');
            }
            else {
                statusUpdate(result + '\nข้อมูลผิดพลาดกรุณาลองใหม่', '#F00');
            }
        },
        error: function (result) {
            hideWaitingImage();
            statusUpdate(result.responseText, '#F00');
        }
    });
}
/* Tool function*/
function checkEventTab(tabid) {
    getEventVideo();
}
function getLoadingPage() {
    return '<center><img src="' + sbasepath + '/lib/images/332.gif" alt="Loading" /></center>';
}
function imageUploader(id) {
    window.send_to_editor = newSendToEditor;
    uploadID = id;
    formfield = jQuery('.upload').attr('name');
    tb_show('เลือกไฟล์', 'media-upload.php?type=video&TB_iframe=true');
    return false;
}
function imageUploaderAll(id, img) {
    window.send_to_editor = newSendToEditor;
    uploadID = id;
    uploadImg = img;
    formfield = jQuery('.upload').attr('name');
    tb_show('เลือกไฟล์', 'media-upload.php?type=video&TB_iframe=true');
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

function showWaitingImage() {
    $('#show_status').html(getLoadingPage());
    $('#show_status').fadeIn('fast');
}

function hideWaitingImage() {
    $('#show_status').html('');
    $('#show_status').fadeOut('fast');
}
function scrollToID(id) {
    $("html, body").animate({scrollTop: $(id).offset().top}, 300);
}
function defaultImage(img)
{
    img.onerror = "";
    img.src = sbasepath + '/lib/images/no_image.jpg';
}