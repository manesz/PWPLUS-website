if (!window.jQuery) {
    var script = document.createElement('script');
    var jqvar = document.getElementById('getjqpath').value;
    script.type = "text/javascript";
    script.src = jqvar;
    document.getElementsByTagName('head')[0].appendChild(script);
}
var $ = jQuery.noConflict(),swithEd=null,tabcurrent = '#tab1', sbasepath, uploadID = '', uploadImg = '', storeSendToEditor = '', newSendToEditor = '', updatestage = false;
$(document).ready(function() {
    sbasepath = $('#getbasepath').val();
    reloadByHash();
    storeSendToEditor = window.send_to_editor;
    newSendToEditor = function(html) {
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
});
function getEventTabClick() {
    $('li#tab1').click(function() {
        window.location.hash = '#tab1';
        reloadByHash();
        return false;
    });
    $('li#tab2').click(function() {
        window.location.hash = '#tab2';
        reloadByHash();
        return false;
    });
    $('li#tab3').click(function() {
        window.location.hash = '#tab3';
        reloadByHash();
        return false;
    });
}
function reloadByHash() {
    checkEventTab();
}
/* Event Image Slide function */
function getEventImageSlide() {
    getSlideList();
    $('#slide-post').submit(function() {
        if (checkFormInput()) {
            getJsonAdd();
        }
        return false;
    });
}
function getJsonAdd() {
    statusUpdate('Loading...', '#0C6');
    $.ajax({
        url: $('input#siteurl').val() + '?tabPage=tab1',
        async: false,
        jsonpCallback: 'jsonCallback',
        contentType: "application/json",
        dataType: 'jsonp',
        data: {ran: Math.random(), gtitle: $('div#formstage input#gtitle').val(), glink: $('div#formstage input#glink').val(), pathimg: $('div#formstage input#pathImg').val(), gsort: $('div#formstage input#gsort').val(), gdesc: $('div#formstage textarea#gsort2').val(), typePost: 'add', callback: 'jsonCallback'},
        success: function(data) {
            if (data.data == 'success') {
                statusUpdate('เพิ่มเรียบร้อย', '#06C');
                clearTab1();
            } else {
                statusUpdate('ข้อมูลผิดพราดกรุณาลองใหม่', '#F00');
            }
        }
    });
}
function clearTab1() {
    $('form#slide-post input[type="text"],textarea').val('');
    $('form#slide-post input#gsort').val('1');
    enableTab1Input();
}
function disibleTab1Input() {
    $('form#slide-post input,form#slide-post textarea').prop('disabled', false);
}
function enableTab1Input() {
    $('form#slide-post input,form#slide-post textarea').removeAttr('disabled');
    getSlideList();
}
function checkFormInput() {
    var validate = true;
    if ($('input#gtitle').val() == '') {
        alert('ยังไม่ได้กรอกข้อมูล Title');
        $('input#gtitle').focus();
        return false;
    }
    if ($('input#glink').val() == '') {
        alert('ยังไม่ได้ใส่ Link');
        $('input#glink').focus();
        return false;
    }
    if ($('input#pathImg').val() == '') {
        alert('ยังไม่ได้เลือกรูป');
        $('input#pathImg').focus();
        return false;
    }
    return validate;
}
function getSlideList(url) {
    var myurl = url ? url : $('input#siteurl').val() + '?tabPage=tab1';
    $('div#slidelist-stage').html(getLoadingPage());
    $.ajax({
        url: myurl,
        async: false,
        jsonpCallback: 'jsonCallback',
        contentType: "application/json",
        dataType: 'jsonp',
        data: {ran: Math.random(), typePost: 'jsonslide', callback: 'jsonCallback'},
        success: function(data) {
            if (data.data) {
                var mytxt = '<ul>';
                $.each(data.data, function(index, value) {
                    mytxt += listMenuSlide(value.image_path, value.id);
                });
                mytxt += '</ul><div class="clear"></div><div class="pagination">' + data.pagination + '</div>';
                $('div#slidelist-stage').html(mytxt);
                delete mytxt;
                getSlideEvent();
            } else {
                $('div#slidelist-stage').html('<h3 style="text-align:center">ยังไม่มีข้อมูล</h3>');
            }
        }
    });
    return;
}
function listMenuSlide(img, id) {
    var listtxt = '<li><a href="#" class="img-edit" rel="' + id + '"><img src="' + img + '" alt="" width="165" height="110" /></a><a href="#" class="remove-slide" rel="' + id + '"><i class="icon-cancel-2"></i></a></li>';
    return listtxt;
}
function getSlideEvent() {
    $('div#slidelist-stage ul li a.img-edit').click(function() {
        geEditForm($(this).attr('rel'));
        return false
    });
    $('div#slidelist-stage ul li a.remove-slide').click(function() {
        if (confirm('ต้องการลบรูปนี้หรือไม่')) {
            $.ajax({
                url: $('input#siteurl').val() + '?tabPage=tab1',
                async: false,
                jsonpCallback: 'jsonCallback',
                contentType: "application/json",
                dataType: 'jsonp',
                data: {ran: Math.random(), typePost: 'del', slideid: $(this).attr('rel'), callback: 'jsonCallback'},
                success: function(data) {
                    if (data.data == 'success') {
                        alert('ลบข้อมูลเรียบร้อย');
                        getSlideList();
                    } else {
                        alert('ข้อมูลผิดพราดกรุณาลองใหม่');
                    }
                }
            });
        }
        return false
    });
    $('div.pagination a').click(function() {
        getSlideList($(this).attr('href'));
        return false;
    });
}
function geEditForm(sid) {
    $('div#formupdate').html(getLoadingPage());
    $.ajax({
        url: $('input#siteurl').val() + '?tabPage=tab1', type: 'POST',
        data: {ran: Math.random(), typePost: 'editform', slideid: sid, callback: 'jsonCallback'},
        success: function(data) {
            $('div#formupdate').html(data);
            $('div#formstage').slideUp('fast', function() {
                $('div#formupdate').slideDown('fast');
                scrollToID('div#formupdate');
            });
            updatestage = true;
            togleSlideDel();
            getEventEditForm();
        }
    });
}
function togleSlideDel() {
    if (updatestage) {
        $('a.remove-slide i').css('display', 'none');
    } else {
        $('a.remove-slide i').css('display', 'block');
    }
}
function getEventEditForm() {
    $('form#slide-post-edit').submit(function() {
        getJsonEdit();
        return false;
    });
    $('input#cancelform').click(function() {
        $('div#formupdate').slideUp('fast', function() {
            $('div#formupdate').html('');
            $('div#formstage').slideDown('fast');
            updatestage = false;
            togleSlideDel();
            scrollToID('#formstage');
        });
        return false;
    });
}
function getJsonEdit() {
    statusUpdate('Loading...', '#0C6');
    $.ajax({
        url: $('input#siteurl').val() + '?tabPage=tab1',
        async: false,
        jsonpCallback: 'jsonCallback',
        contentType: "application/json",
        dataType: 'jsonp',
        data: {ran: Math.random(), gtitle: $('div#formupdate input#gtitle').val(), glink: $('div#formupdate input#glink').val(), pathimg: $('div#formupdate input#pathImg').val(), gsort: $('div#formupdate input#gsort').val(), gdesc: $('div#formupdate textarea#gsort2').val(), typePost: 'edit', slideid: $('div#formupdate input#slideid').val(), callback: 'jsonCallback'},
        success: function(data) {
            if (data.data == 'success') {
                statusUpdate('แก้ไขข้อมูลเรียบร้อย', '#06C');
                getSlideList();
                $('div#formupdate').slideUp('fast', function() {
                    $('div#formupdate').html('');
                    $('div#formstage').slideDown('fast');
                    scrollToID('#formstage');
                });
            } else {
                statusUpdate('ข้อมูลผิดพราดกรุณาลองใหม่', '#F00');
            }
        }
    });
}
/* Siteconfig function */
function getEventSiteconfig() {
    if(swithEd){
        $('div#tabsholder div.tabscontent').html(getLoadingPage());
        window.location.reload();
    }
    swithEd = switchEditors;
    swithEd.switchto(document.getElementById('foo-tmce'));
    $('#configsite').submit(function(){
        $.ajax({
            url: $('input#siteurl').val() + '?tabPage=tab3',
            type:'POST',
            data: {ran: Math.random(),siteaction:'updateconfig',icon:$('#logo-img').val(),fav:$('#logo-fav').val(),foo:$('#foo').val(),fbtxt:$('#fbtxt').val(),twtxt:$('#twtxt').val() },
            success: function(data) {
                if(data=='success'){
                    alert('แก้ไขข้อมูลเรียบร้อย');
                    window.location.reload();
                }else{
                    alert('เกิดข้อผิดพราดบางอย่างกรุณาลองใหม่');
                }
            }
        });
        return false;
    });
}
function updateSiteconfig(){

}
/* Contact Map */
function getEventContactMap(){
    addFormtabEvent();
    $('button#addformtb').click(function(){
        $('div#lat-long-stage').append(getFormTab());
        addFormtabEvent();
        return false
    });
    $('button#addlocalformtb').click(function(){
        $('div#location-stage').append(getFormLoTab());
        addFormtabEvent();
        return false
    });
}
function getFormTab(){
    var formtxt = '<div class="tb-insert"><div class="handle-head-tb"><a href="#" class="close-tb"><i class="icon-cancel"></i></a></div><table class="wp-list-table widefat" cellspacing="0" width="100%"><tbody id="the-list-edit"><tr class="alternate"><td><label for="linkurl">title :</label></td><td><input name="title[]" type="text" placeholder="Title"  title="Latitude" value="" size="30" maxlength="255"/></td><td><label for="latitude">Lat, Long :</label></td><td><input name="latitude[]" type="text" placeholder="Latitude"  title="Latitude" value="" size="30" maxlength="255"/><br/><span>Exam : 13.0, 100.0</span></td></tr><tr class="alternate"><td><label for="latitude">Description :</label></td><td colspan="3"><textarea name="desc[]" cols="70" id="latitude" placeholder="Description" title="Description"></textarea></td></tr><tr class="alternate"><td><label for="imgpath">Image upload :</label></td><td colspan="3"><input name="imgpath[]" type="text" placeholder="Image upload" class="mappath"  title="Image upload" value="" size="30" maxlength="255"/>     <input id="uploadImageButton" type="button" class="button uploadimgpath" value="Upload Image"/></td></tr><tr class="alternate"><td><label for="linkurl">Link :</label></td><td colspan="3"><input name="linkurl[]" type="text" placeholder="Link"  title="Link" value="" size="70" maxlength="255" id="linkurl"/></td>  </tr></tbody></table></div>';
    return formtxt;
}
function getFormLoTab(){
    var formtxt = '<div class="tb-insert"><div class="handle-head-tb"><a href="#" class="close-tb"><i class="icon-cancel"></i></a></div><table class="wp-list-table widefat" cellspacing="0" width="100%"><tr class="alternate"><td><label for="titlelo">Title :</label></td><td><input name="titlelo[]" type="text" placeholder="Title"  title="Title" value="" size="30" maxlength="255" /></td></tr><tbody id="the-list-edit"><tr class="alternate"><td><label for="desclo">Description :</label></td><td><textarea name="desclo[]" cols="70" rows="5" placeholder="Description" title="Description"></textarea></td></tr><tr class="alternate"><td><label for="addesslo">Addess :</label></td><td><textarea name="addesslo[]" cols="70" rows="5" placeholder="Addess" title="Addess"></textarea></td></tr><tr class="alternate"><td><label for="phonelo">Phone :</label></td><td><input name="phonelo[]" type="text" placeholder="Phone"  title="Phone" value="" size="30" maxlength="255" /></td></tr><tr class="alternate"><td><label for="faxlo">Fax :</label></td><td><input name="faxlo[]" type="text" placeholder="Fax"  title="Fax" value="" size="30" maxlength="255" /></td></tr><tr class="alternate"><td><label for="emaillo">Email :</label></td><td><input name="emaillo[]" type="text" placeholder="Email"  title="Email" value="" size="30" maxlength="255" /></td></tr><tr class="alternate"><td><label for="imagelo">Image :</label></td><td><input name="imagelo[]" type="text" placeholder="Image"  title="Image" value="" size="30" maxlength="255" /><input type="button" class="button uploadimgpath" value="Upload Image"/></td></tr></tbody></table></div>';
    return formtxt;
}
function addFormtabEvent(){
    $('a.close-tb').unbind('click');
    $('input.uploadimgpath').unbind('click');
    $('a.close-tb').click(function(){
        $(this).parent().parent().remove();
        return false;
    });
    $('input.uploadimgpath').click(function(){
        var myagr = $(this).parent().find('input[type="text"]');
        window.send_to_editor = function(html){
            imgurl = jQuery('img', html).attr('src');
            myagr.val(imgurl);
            tb_remove();
            window.send_to_editor = storeSendToEditor;
        };
        formfield = jQuery('.upload').attr('name');
        tb_show('เลือกไฟล์', 'media-upload.php?type=image&TB_iframe=true');
        return false;
        return false;
    });
}
/* Tool function*/
function checkEventTab(tabid) {
    getEventSiteconfig();
}
function getLoadingPage() {
    return '<center><img src="' + sbasepath + '/theme-option-controller/images/332.gif" alt="Loading" /></center>';
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
    $('#showstatus').fadeIn('fast', function() {
        setTimeout(function() {
            $('#showstatus').fadeOut('fast');
        }, 2000);
    });
}
function scrollToID(id) {
    $("html, body").animate({scrollTop: $(id).offset().top}, 1000);
}