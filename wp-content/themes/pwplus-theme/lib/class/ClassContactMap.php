<?php
class ContactMap
{
    private $wpdb, $long_id = 0, $cont_id = 0;
    public $tableLatLong = "ics_lat_long";
    public $tableLocation = "ics_location";

    public function __construct($wpdb)
    {
        $this->wpdb = $wpdb;
        //$this->createDB();
    }

    function createDB()
    {
        $sql1 = "
            CREATE TABLE IF NOT EXISTS `$this->tableLatLong` (
              `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `title` VARCHAR (255) NULL,
              `latitude` VARCHAR (255) NULL,
              `description` TEXT NULL,
              `image_path` TEXT NULL,
              `link` TEXT NULL,
              `create_datetime` DATETIME NULL,
              `update_datetime` DATETIME NULL,
              `publish` VARCHAR (255) DEFAULT 'draft'
            ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
        ";
        $sql2 = "
            CREATE TABLE IF NOT EXISTS `$this->tableLocation` (
              `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `title` VARCHAR (255) NULL,
              `description` TEXT NULL,
              `address` TEXT NULL,
              `phone` VARCHAR (20) NULL,
              `fax` VARCHAR (20) NULL,
              `email` VARCHAR (150) NULL,
              `image` TEXT NULL,
              `create_datetime` DATETIME NULL,
              `update_datetime` DATETIME NULL,
              `publish` VARCHAR (255) DEFAULT 'draft'
            ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
        ";
        dbDelta($sql1);
        dbDelta($sql2);
    }

    public function updateLatitudePublish($mid, $publish = 'publish')
    {
        $this->wpdb->query(
            "UPDATE $this->tableLatLong
				SET publish='{$publish}'
				WHERE id = {$mid}
				"
        );
    }

    public function updateLatitude($mid, $title = '', $desc = '', $img = '', $link = '', $latitude = '', $publish = 'publish')
    {
        $this->wpdb->query(
            "UPDATE $this->tableLatLong
				SET title='{$title}',description='{$desc}',image_path='{$img}',link='{$link}',update_datetime=NOW(),publish='{$publish}',latitude='{$latitude}'
				WHERE id = {$mid}
				"
        );
    }

    public function getAlldataMap($status = 'ALL')
    {
        $wherestatus = '';
        if ($status != 'ALL') {
            $wherestatus = ' WHERE publish="' . $status . '"';
        }
        $myresult = $this->wpdb->get_results("SELECT * FROM $this->tableLatLong{$wherestatus}");
        return $myresult;
    }

    public function getAlldataContact($status = 'ALL')
    {
        $wherestatus = '';
        if ($status != 'ALL') {
            $wherestatus = ' WHERE publish="' . $status . '"';
        }
        $myresult = $this->wpdb->get_results("SELECT * FROM $this->tableLocation{$wherestatus}");
        return $myresult;
    }

    public function getcountAll()
    {
        if (!$this->long_id) {
            $this->long_id = $this->wpdb->get_var("select count(id) from $this->tableLatLong");
        }
        return $this->long_id ? $this->long_id : 0;
    }

    public function getcountContaceAll()
    {
        if (!$this->cont_id) {
            $this->cont_id = $this->wpdb->get_var("select count(id) from $this->tableLocation");
        }
        return $this->cont_id ? $this->cont_id : 0;
    }

    public function contact_Update()
    {
        $insertcount = count($_POST['titlelo']);
        $title = isset($_POST['titlelo']) ? $_POST['titlelo'] : '';
        $addess = isset($_POST['addesslo']) ? $_POST['addesslo'] : '';
        $desc = isset($_POST['desclo']) ? $_POST['desclo'] : '';
        $imgpath = isset($_POST['imagelo']) ? $_POST['imagelo'] : '';
        $phone = isset($_POST['phonelo']) ? $_POST['phonelo'] : '';
        $fax = isset($_POST['faxlo']) ? $_POST['faxlo'] : '';
        $email = isset($_POST['emaillo']) ? $_POST['emaillo'] : '';
        $latitude = $title; /*Array ( [title] => Array ( [0] => ) [latitude] => Array ( [0] => ) [desc] => Array ( [0] => ) [imgpath] => Array ( [0] => ) [linkurl] => Array ( [0] => ) [titlelo] => Array ( [0] => ) [desclo] => Array ( [0] => ) [addesslo] => Array ( [0] => ) [phonelo] => Array ( [0] => ) [faxlo] => Array ( [0] => ) [emaillo] => Array ( [0] => ) [imagelo] => Array ( [0] => ) [gallery] => Save ) */
        if ($this->getcountContaceAll() < $insertcount && $this->getcountContaceAll() != 0) {
            $cindex = 0;
            for ($i = 0; $i < $this->getcountContaceAll(); $i++) {
                if ($latitude[$i] != '') {
                    $this->updateContact($i + 1, $title[$i], $desc[$i], $addess[$i], $phone[$i], $imgpath[$i], $fax[$i], $email[$i], 'publish');
                    $cindex++;
                }
            }
            for ($i = $cindex; $i < $insertcount; $i++) {
                if ($latitude[$i] != '') {
                    $this->addContact($title[$i], $desc[$i], $addess[$i], $phone[$i], $imgpath[$i], $fax[$i], $email[$i], 'publish');
                    $cindex++;
                }
            }
        } else if ($this->getcountContaceAll() == 0) {
            for ($i = 0; $i < $insertcount; $i++) {
                if ($latitude[$i] != '') {
                    $this->addContact($title[$i], $desc[$i], $addess[$i], $phone[$i], $imgpath[$i], $fax[$i], $email[$i], 'publish');
                }
            }
        } else if ($this->getcountContaceAll() > $insertcount && $this->getcountContaceAll() != 0) {
            $cindex = 0;
            for ($i = 0; $i < $insertcount; $i++) {
                if ($latitude[$i] != '') {
                    $this->updateContact($i + 1, $title[$i], $desc[$i], $addess[$i], $phone[$i], $imgpath[$i], $fax[$i], $email[$i], 'publish');
                }
                $cindex++;
            }
            for ($i = $cindex; $i < $this->getcountContaceAll(); $i++) {
                $this->updateContact($i + 1, '', '', '', '', '', '', '', 'draft');
            }
        } else if ($this->getcountContaceAll() == $insertcount) {
            for ($i = 0; $i < $this->getcountContaceAll(); $i++) {
                if ($latitude[$i] != '') {
                    $this->updateContact($i + 1, $title[$i], $desc[$i], $addess[$i], $phone[$i], $imgpath[$i], $fax[$i], $email[$i], 'publish');
                }
            }
        }
    }

    public function latitude_Update()
    {
        $insertcount = count($_POST['latitude']);
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
        $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
        $imgpath = isset($_POST['imgpath']) ? $_POST['imgpath'] : '';
        $linkurl = isset($_POST['linkurl']) ? $_POST['linkurl'] : ''; /*Array ( [title] => Array ( [0] => ) [latitude] => Array ( [0] => ) [desc] => Array ( [0] => ) [imgpath] => Array ( [0] => ) [linkurl] => Array ( [0] => ) [titlelo] => Array ( [0] => ) [desclo] => Array ( [0] => ) [addesslo] => Array ( [0] => ) [phonelo] => Array ( [0] => ) [faxlo] => Array ( [0] => ) [emaillo] => Array ( [0] => ) [imagelo] => Array ( [0] => ) [gallery] => Save ) */
        if ($this->getcountAll() < $insertcount && $this->getcountAll() != 0) {
            $cindex = 0;
            for ($i = 0; $i < $this->getcountAll(); $i++) {
                if ($latitude[$i] != '') {
                    $this->updateLatitude($i + 1, $title[$i], $desc[$i], $imgpath[$i], $linkurl[$i], $latitude[$i], 'publish');
                    $cindex++;
                }
            }
            for ($i = $cindex; $i < $insertcount; $i++) {
                if ($latitude[$i] != '') {
                    $this->addLatitude($title[$i], $desc[$i], $imgpath[$i], $linkurl[$i], $latitude[$i], 'publish');
                    $cindex++;
                }
            }
        } else if ($this->getcountAll() == 0) {
            for ($i = 0; $i < $insertcount; $i++) {
                if ($latitude[$i] != '') {
                    $this->addLatitude($title[$i], $desc[$i], $imgpath[$i], $linkurl[$i], $latitude[$i], 'publish');
                }
            }
        } else if ($this->getcountAll() > $insertcount && $this->getcountAll() != 0) {
            $cindex = 0;
            for ($i = 0; $i < $insertcount; $i++) {
                if ($latitude[$i] != '') {
                    $this->updateLatitude($i + 1, $title[$i], $desc[$i], $imgpath[$i], $linkurl[$i], $latitude[$i], 'publish');
                }
                $cindex++;
            }
            for ($i = $cindex; $i < $this->getcountAll(); $i++) {
                $this->updateLatitude($i + 1, '', '', '', '', '', 'draft');
            }
        } else if ($this->getcountAll() == $insertcount) {
            for ($i = 0; $i < $this->getcountAll(); $i++) {
                if ($latitude[$i] != '') {
                    $this->updateLatitude($i + 1, $title[$i], $desc[$i], $imgpath[$i], $linkurl[$i], $latitude[$i], 'publish');
                }
            }
        }
    }

    public function addLatitude($title = '', $desc = '', $img = '', $link = '', $latitude = '', $publish = 'publish')
    { /*id title description image_path
link create_datetime update_datetime publish latitude*/
        $this->wpdb->query("INSERT INTO $this->tableLatLong (title, description, image_path, link, create_datetime, update_datetime, publish, latitude)
					VALUES ('{$title}','{$desc}','{$img}','{$link}',NOW(),NOW(),'{$publish}','{$latitude}')");
    }

    public function addContact($title = '', $desc = '', $address = '', $phone = '', $img = '', $fax = '', $email = '', $publish = 'publish')
    { /*id,title,description,address,phone,fax,email,image,create_datetime
update_datetime,publish
*/
        $this->wpdb->query("INSERT INTO  $this->tableLocation (title,description,address,phone,fax,email,image,create_datetime,update_datetime,publish)
					VALUES ('{$title}','{$desc}','{$address}','{$phone}','{$fax}','{$email}','{$img}',NOW(),NOW(),'{$publish}')");
    }

    public function updateContact($cid, $title = '', $desc = '', $address = '', $phone = '', $img = '', $fax = '', $email = '', $publish = 'publish')
    { /*id title description image_path
link create_datetime update_datetime publish latitude*/
        $this->wpdb->query(
            "UPDATE $this->tableLocation
				SET title='{$title}',description='{$desc}',address='{$address}',phone='{$phone}',fax='{$fax}',email='{$email}',image='{$img}',
update_datetime=NOW(),publish='{$publish}'
				WHERE id = {$cid}
				"
        );
    }
}