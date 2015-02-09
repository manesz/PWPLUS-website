<?php
class SiteInformation
{
    private $wpdb;
    public $tableName = "ics_site_information";

    public function __construct($wpdb)
    {
        $this->wpdb = $wpdb;
        //$this->createDB();
    }

    function createDB()
    {
        $sql = "
        CREATE TABLE `$this->tableName` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `path_image_logo` text,
          `logo_description` text,
          `path_image_fav_icon` text,
          `facebook_script` text,
          `twitter_script` text,
          `google_plus_script` text,
          `google_analytic_script` text,
          `create_datetime` datetime DEFAULT '0000-00-00 00:00:00',
          `update_datetime` datetime DEFAULT '0000-00-00 00:00:00',
          `publish` int(1) DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";
        dbDelta($sql);
    }
    //---------------------------------------Site Information----------------------------------//
    public function getSiteInformation()
    {
        $sql = "
            SELECT
              *
            FROM `$this->tableName`
            WHERE 1
            AND publish = 1
            LIMIT 1
        ";
        $rows = $this->wpdb->get_results($sql);
        return $rows;
    }

    public function addSiteInformation($post)
    {
        extract($post);
        $path_image_logo = trim(@$path_image_logo);
        $logo_description = trim(@$logo_description);
        $path_image_fav_icon = trim(@$path_image_fav_icon);
        $facebook_script = trim(@$facebook_script);
        $twitter_script = trim(@$twitter_script);
        $google_plus_script = trim(@$google_plus_script);
        $google_analytic_script = trim(@$google_analytic_script);
        $sql = "
            INSERT INTO `$this->tableName`
            (
             `path_image_logo`,
             `logo_description`,
             `path_image_fav_icon`,
             `facebook_script`,
             `twitter_script`,
             `google_plus_script`,
             `google_analytic_script`,
             `create_datetime`,
             `publish`
             )
            VALUES (
                '$path_image_logo',
                '$logo_description',
                '$path_image_fav_icon',
                '$facebook_script',
                '$twitter_script',
                '$google_plus_script',
                '$google_analytic_script',
                NOW(),
                1
            );
        ";
        $this->wpdb->query($sql);
    }

    public function editSiteInformation($post)
    {
        extract($post);
        $path_image_logo = trim(@$path_image_logo);
        $logo_description = trim(@$logo_description);
        $path_image_fav_icon = trim(@$path_image_fav_icon);
        $facebook_script = trim(@$facebook_script);
        $twitter_script = trim(@$twitter_script);
        $google_plus_script = trim(@$google_plus_script);
        $google_analytic_script = trim(@$google_analytic_script);
        $sql = "
            UPDATE `$this->tableName`
            SET
              `path_image_logo` = '$path_image_logo',
              `logo_description` = '$logo_description',
              `path_image_fav_icon` = '$path_image_fav_icon',
              `facebook_script` = '$facebook_script',
              `twitter_script` = '$twitter_script',
              `google_plus_script` = '$google_plus_script',
              `google_analytic_script` = '$google_analytic_script',
              `update_datetime` = NOW()
            WHERE 1
            AND id = 1;
        ";
        $this->wpdb->query($sql);
    }


}