<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: karwackid
 * Date: 2019-05-05
 * Time: 20:12
 */

class My_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $where = FALSE, $single = FALSE)
    {

        if($where == TRUE)
        {
            $this->db->where($where);
            $query = $this->db->get($table);
            return $query->row();
        } else
        {
            $query = $this->db->get($table);
            return $query->result();
        }


    }

    public function create($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function update($table, $where, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function unique_email($where)
    {
        $this->db->where($where);
        $query = $this->db->get('users');
        $query->row();
    }
}