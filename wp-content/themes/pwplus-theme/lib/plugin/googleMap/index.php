<?php
include_once('../../../../../../wp-load.php');
if (!class_exists('ContactMap')) {
    include_once(TEMPLATEPATH . '/theme-option-controller/class/class_contact_map.php');
    $contactMap = new ContactMap($wpdb);
}
?>
<html>    
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="jquery/jquery-1.4.4.min.js"></script>        
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
        <script type="text/javascript" src="gmap3.min.js"></script> 
        <style>
            *{margin:0;padding:0}body{height:320px}.gmap3{margin:0;border:1px dashed #C0C0C0;width:100%;height:340px}img.maginleft{margin-left:5px}.mtitle{margin-left:5px}
        </style>
        <?php
        $jsstr = '';
        $mapdatas = $contactMap->getAlldataMap('publish');
        $ci = 0;
        $firstlat = '';
        foreach ($mapdatas as $mapdata) {
            if ($ci) {
                $jsstr .= ',';
            } else {
                $firstlat = $mapdata->latitude;
            }
            $jsstr .= '{latLng: [' . $mapdata->latitude . '], data: "<img class=\'maginleft\' src=\'' . $mapdata->image_path . '\' width=\'32\' height=\'32\' align=\'left\' /><strong class=\'mtitle\'>' . $mapdata->title . '</strong><p class=\'mtitle\'>' . $mapdata->description . '</p>",tag:"' . $mapdata->link . '"}';
            $ci = 1;
        }
        ?>
        <script type="text/javascript">

            $(function() {
                $('div.gmap3').css('height', $(window).height() + 'px');
                $('#test1').gmap3({
                    map: {
                        options: {
                            center: [<?= $firstlat ?>],
                            zoom: 7
                        }
                    },
                    marker: {
                        values: [
<?= $jsstr ?>
                        ],
                        options: {
                            draggable: false
                        },
                        events: {
                            mouseover: function(marker, event, context) {
                                var map = $(this).gmap3("get"),
                                        infowindow = $(this).gmap3({get: {name: "infowindow"}});
                                if (infowindow) {
                                    infowindow.open(map, marker);
                                    infowindow.setContent(context.data);
                                } else {
                                    $(this).gmap3({
                                        infowindow: {
                                            anchor: marker,
                                            options: {content: context.data}
                                        }
                                    });
                                }
                            },
                            mouseout: function() {
                                var infowindow = $(this).gmap3({get: {name: "infowindow"}});
                                if (infowindow) {
                                    infowindow.close();
                                }
                            }, click: function(marker, event, context) {
                                window.location.href = context.tag;
                            }
                        }
                    }
                });
            });
        </script>
    <body>
        <div id="test1" class="gmap3"></div>
    </body>
</html>