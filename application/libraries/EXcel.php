<?php
/**
 * Created by PhpStorm.
 * User: karwackid
 * Date: 2019-06-21
 * Time: 08:46
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}