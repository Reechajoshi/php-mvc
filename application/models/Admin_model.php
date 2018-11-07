<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{


    public function disable($id)
    {
        $data = array(
            'is_delete' => 1
        );

        $this->db->where('id', $id);
        $this->db->update('video', $data);
    }
    public function active($id)
    {
        $data = array(
            'is_delete' => 0
        );

        $this->db->where('id', $id);
        $this->db->update('video', $data);
    }
    public function check_login($name,$pass)
    {
        $query = $this->db->query("SELECT * FROM users WHERE username= '$name' AND password = '$pass' AND is_delete=0 ");
        $result = $query->result_array();

        $count = count($result);

        if(empty($count) || $count > 1)
        {
            return FALSE;
        }
        else{
            $newdata = array(
                'username'  => $name,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);
        }
        return TRUE;

    }

    public function add_video($data)
    {
        $this->db->insert('video', $data);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    public function update_video($data,$id)
    {

        $this->db->where('id', $id);
        $this->db->update('video', $data);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function getList($category)
    {
        $query = $this->db->query("SELECT * FROM video WHERE `type`=$category ORDER BY datetime ");
        $result = $query->result_array();
        return $result;

    }
    public function getItem($id)
    {
        $query = $this->db->query("SELECT * FROM video WHERE id=$id ");
        $result = $query->result_array();
        return $result;

    }
}
