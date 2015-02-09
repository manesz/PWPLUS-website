<?php

class PriceTable
{
    private $wpdb;

    public function __construct($wpdb)
    {
        $this->wpdb = $wpdb;
    }

    public function getListMapPriceTable($priceTableID)
    {
        $strSql = "
            SELECT
              *
            FROM
              map_price_table
            WHERE public = 1
            AND price_table_id = $priceTableID
        ";
        $myrows = $this->wpdb->get_results($strSql);
        return $myrows;
    }

    public function loadListPriceTable($id = null)
    {
        if ($id == null) {
            $strSql = "
                SELECT
                  i.`id` AS i_id,
                  p.`id` AS p_id,
                  p.price,
                  i.`path`,
                  i.title
                FROM
                  price_table p
                  INNER JOIN image i
                    ON (p.image_id = i.id)
                WHERE p.public = 1
                  AND i.public = 1
                ORDER BY p.id DESC
            ";
        } else {
            $strSql = "
                SELECT
                  i.`id` AS i_id,
                  p.`id` AS p_id,
                  p.price,
                  i.`path`,
                  i.title
                FROM
                  price_table p
                  INNER JOIN image i
                    ON (p.image_id = i.id)
                WHERE p.public = 1
                  AND i.public = 1
                  AND p.id = $id
            ";
        }
        $myrows = $this->wpdb->get_results($strSql);
        return $myrows;
    }

    public function addPriceTable($post)
    {
        $path = $post['pathImg'];
        $title = $post['priceTableTitle'];
        $price = $post['priceTablePrice'];
        $arrayValue = $post['priceTableValue'];
        $imageID = addImage($path, $title);
        $priceTableID = $this->insertPriceTable($imageID, $title, $price);
        foreach ($arrayValue as $key => $value) {
            $this->insertMapPriceTable($priceTableID, $value);
        }
        return $priceTableID;
    }

    public function insertMapPriceTable($priceTableID, $value)
    {
        $this->wpdb->insert(
            'map_price_table',
            array(
                'price_table_id' => $priceTableID,
                'value' => $value,
                'public' => 1
            ),
            array(
                '%d',
                '%s',
                '%d'
            )
        );
        return $this->wpdb->insert_id;
    }

    public function insertPriceTable($imageID, $title, $price)
    {
        $this->wpdb->insert(
            'price_table',
            array(
                'image_id' => $imageID,
                'title' => $title,
                'price' => $price,
                'public' => 1
            ),
            array(
                '%d',
                '%s',
                '%s',
                '%d'
            )
        );
        return $this->wpdb->insert_id;
    }

    public function updatePriceTable($post)
    {
        $priceTableID = $post['priceTableID'];
        $title = $post['priceTableTitle'];
        $price = $post['priceTablePrice'];
        $imageID = $post['imageID'];
        $pathImage = $post['pathImg'];
        $arrayValue = $post['priceTableValue'];

        $this->updateValuePriceTable($priceTableID, $title, $price);

        updateDataImage($imageID, $pathImage, $title);
        $this->deleteMapPriceTable($priceTableID);

        foreach ($arrayValue as $key => $value) {
            $this->insertMapPriceTable($priceTableID, $value);
        }
        return true;
    }

    public function deleteMapPriceTable($priceTableID)
    {
        $strSql = "
            DELETE
            FROM `map_price_table`
            WHERE `price_table_id` = $priceTableID
        ";
        $this->wpdb->query($strSql);
        return true;
    }

    public function updateValuePriceTable($priceTableID, $title, $price)
    {
        $this->wpdb->update(
            'price_table',
            array(
                'title' => $title,
                'price' => $price
            ),
            array('id' => intval($priceTableID)),
            array(
                '%s', // value2
                '%s' // value2
            ),
            array('%d')
        );
        return true;
    }

    public function deletePriceTable($priceTableID, $public)
    {
        $this->updateMapPriceTable($priceTableID, $public);
        $imageID = $this->loadListPriceTable($priceTableID);
        updateImage($imageID[0]->i_id, $public);
        $this->updatePriceTableByID($priceTableID, $public);
        return true;
    }

    public function updatePriceTableByID($priceTableID, $public)
    {
        $this->wpdb->update(
            'price_table',
            array(
                'public' => $public // integer (number)
            ),
            array('id' => $priceTableID),
            array(
                '%d' // value2
            ),
            array('%d')
        );
        return true;
    }

    public function updateMapPriceTable($priceTableID, $public)
    {
        $this->wpdb->update(
            'map_price_table',
            array(
                'public' => $public // integer (number)
            ),
            array('price_table_id' => $priceTableID),
            array(
                '%d' // value2
            ),
            array('%d')
        );
        return true;
    }
}