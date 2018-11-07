<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model{

    /*
     * Notes
     * -----------------
     * Type
     * 0 -> Capital Bazar
     * 1 -> Royal DC
     */

    /*
     * Capital Bazar
     */
    public function getCapiatlData()
    {
        $start = date('Y-m-d 00:00:00');
        error_log("<<<<<<<<<".$start);
        $end = date('Y-m-d 23:59:00');
        $query = $this->db->query("SELECT * FROM video WHERE `type` = 0 AND is_delete=0  AND datetime >= '$start' and datetime <= '$end'  ORDER BY datetime LIMIT 5");
        //error_log("SELECT * FROM video WHERE `type` = 0 AND is_delete=0  AND datetime >= '$start' and datetime <= '$end'  ORDER BY datetime LIMIT 5");
        $result = $query->result_array();
        //error_log(">>>>>>>>>>".print_r($result, true));
        return $result;
    }
    public function getCPlay($now)
    {
        $query = $this->db->query("SELECT * FROM video WHERE `type`=0 AND is_delete=0 AND datetime >= '$now'  ORDER BY datetime LIMIT 1");
        $result = $query->result_array();
        return $result;
    }
    public function getCPlayNext($now)
    {
        $query = $this->db->query("SELECT * FROM video WHERE datetime > '$now' AND `type`=0 AND is_delete=0  AND datetime < CAST(DATE('$now') + INTERVAL 1 DAY AS DATETIME)   LIMIT 1");
        $result = $query->result_array();

        return $result;

    }

    /*
     * Royal DC
    */

    public function getRoyalData()
    {
        $start = date('Y-m-d 00:00:00');
        $end = date('Y-m-d 23:59:00');
        $query = $this->db->query("SELECT * FROM video WHERE `type` = 1 AND is_delete=0 AND datetime >= '$start' and datetime <= '$end' ORDER BY datetime LIMIT 5");
        $result = $query->result_array();
        return $result;
    }
    public function getRPlay($now)
    {
        $query = $this->db->query("SELECT * FROM video WHERE `type`=1 AND is_delete=0 AND datetime >= '$now'  ORDER BY datetime LIMIT 1");
        $result = $query->result_array();
        return $result;
    }
    public function getRPlayNext($now)
    {
        $query = $this->db->query("SELECT * FROM video WHERE datetime > '$now' AND `type`=1 AND is_delete=0  AND datetime < CAST(DATE('$now') + INTERVAL 1 DAY AS DATETIME)   LIMIT 1");
        $result = $query->result_array();

        return $result;

    }


    /*
     * Ajax Search
     */

    public function functCapital($date)
    {
        $start = date($date .' 00:00:00');
        $end = date($date.' 23:59:00');

        $query = $this->db->query("SELECT * FROM video WHERE `type` = 0 AND is_delete=0  AND datetime >= '$start' and datetime <= '$end'  ORDER BY datetime LIMIT 5");
        $result = $query->result_array();
        return $result;
    }

    public function getAjaxRoyal($date)
    {
        $start = date($date .' 00:00:00');
        $end = date($date.' 23:59:00');

        $query = $this->db->query("SELECT * FROM video WHERE `type` = 1 AND is_delete=0  AND datetime >= '$start' and datetime <= '$end'  ORDER BY datetime LIMIT 5");
        $result = $query->result_array();
        return $result;
    }
    
    public function test()
    {
        $result = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
        return $result;
    }
}