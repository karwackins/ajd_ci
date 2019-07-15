<?php
/**
 * Created by PhpStorm.
 * User: karwackid
 * Date: 2019-06-29
 * Time: 13:22
 */

class cImport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mImport');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('admin/vImport');
    }

    public function upload()
    {
        $raport = $_POST['raport'];
        $plik = $_FILES['plik'];
        $this->mImport->upload($raport, $plik);
        header("Location: ../");
    }
}