<?php
if (!class_exists('pagination')) {
    include_once('pagination.class.php');
}
class VideoGallery
{
    private $wpdb;
    public $tableName = "ics_video_gallery";
    public $countValue = 0;
    public $classPagination = null;

    public function __construct($wpdb)
    {
        $this->wpdb = $wpdb;
        $this->classPagination = new pagination();
        //$this->createDB();
    }

    public function createDB()
    {
        $sql = "
            CREATE TABLE `$this->tableName` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `title` varchar(255) DEFAULT NULL,
              `description` text,
              `link` text,
              `sort` int(11) DEFAULT NULL,
              `image_path` text,
              `video_script` text,
              `create_datetime` datetime DEFAULT NULL,
              `update_datetime` datetime DEFAULT NULL,
              `publish` int(1) DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ";
        dbDelta($sql);
    }

    public function getCountValue()
    {
        if (!$this->countValue) {
            $sql = "SELECT COUNT(id) FROM $this->tableName WHERE 1 AND `publish` = 1";
            $this->countValue = $this->wpdb->get_var($sql);
        }
        return $this->countValue ? $this->countValue : 0;
    }

    public function getByID($sid)
    {
        $sql ="
        SELECT * FROM $this->tableName WHERE id={$sid} AND `publish` = 1
        ";
        $result = $this->wpdb->get_row($sql);
        return $result;
    }

    public function getList($plimit = 0, $pbegin = 0)
    {
        if ($plimit != 0 && $pbegin != 0) {
            $strLimit = " LIMIT $pbegin, $plimit ";
        } else if ($plimit != 0){
            $strLimit = " LIMIT $plimit ";
        }else {
            $strLimit = "";
        }

        $sql = "
            SELECT
              *
            FROM
              $this->tableName
            WHERE 1
            AND `publish` = 1
            ORDER BY sort ASC,
              update_datetime DESC
            $strLimit
        ";
        $result = $this->wpdb->get_results($sql);
        return $result;
    }

    public function addData($title = '', $link = '', $sort = '', $path_image = '', $description = '', $script = "")
    {
        $script = trim($script);
        $path_image = $this->getPathImageFromVideo($script);
        $sql = "
            INSERT INTO $this->tableName
            (
                 title,
                 description,
                 sort,
                 image_path,
                 create_datetime,
                 update_datetime,
                 publish,
                 link,
                 video_script
             )
            VALUES (
                '{$title}',
                '{$description}',
                '{$sort}',
                '{$path_image}',
                NOW(),
                NOW(),
                '1',
                '{$link}',
                '$script'
             );
        ";
        $qinsert = $this->wpdb->query($sql);
        return $qinsert;
    }

    public function editData($id = FALSE, $title = '', $link = '', $sort = '', $path_image = '', $description = '', $script = "")
    {
        $script = trim($script);
        $path_image = $this->getPathImageFromVideo($script);
        $sql = "
            UPDATE $this->tableName
            SET title = '{$title}',
                description='{$description}',
                sort='{$sort}',
                image_path='{$path_image}',
                update_datetime=NOW(),
                link='{$link}',
                video_script='$script'
            WHERE 1
            AND id = {$id};
        ";
        if ($id) {
            $result = $this->wpdb->query($sql);
            return $result;
        } else {
            return FALSE;
        }
    }

    public function getPathImageFromVideo($script, $urlType = "image")
    {
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $script, $id)) {
            $values = $id[1];
        } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $script, $id)) {
            $values = $id[1];
        } elseif (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $script, $id)) {
            $values = $id[1];
        } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $script, $id)) {
            $values = $id[1];
        } else {
            $values = "";
        }
        /*
          http://img.youtube.com/vi/<insert-youtube-video-id-here>/default.jpg
          For the high quality version of the thumbnail use a url similar to this:
          http://img.youtube.com/vi/<insert-youtube-video-id-here>/hqdefault.jpg
          There is also a medium quality version of the thumbnail, using a url similar to the HQ:
          http://img.youtube.com/vi/<insert-youtube-video-id-here>/mqdefault.jpg
          For the maximum resolution version of the thumbnail use a url similar to this:
          http://img.youtube.com/vi/<insert-youtube-video-id-here>/maxresdefault.jpg
          */
        if ($urlType == "image") {
            return "http://img.youtube.com/vi/$values/default.jpg";
        } else {
            return "//www.youtube.com/embed/$values";
        }
    }

    public function deleteValue($id)
    {
        $sql = "
            UPDATE $this->tableName
            SET publish = 0
            WHERE 1
            AND id = {$id};
        ";
        if ($id) {
            $result = $this->wpdb->query($sql);
            return $result;
        } else {
            return FALSE;
        }
        
//        if ($id) {
//            $this->wpdb->delete($this->tableName, array('id' => $id));
//            return TRUE;
//        } else {
//            return FALSE;
//        }
    }
}