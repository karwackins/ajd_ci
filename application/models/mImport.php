<?php
/**
 * Created by PhpStorm.
 * User: karwackid
 * Date: 2019-06-29
 * Time: 13:25
 */

class mImport extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function Delete($raport){
        $this->db->empty_table($raport.'_sl_akt');
    }



    public function Upload($raport, $plik) {
        $max_rozmiar = 4024*4024;
        $this->Delete($raport);

        if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
            if ($_FILES['plik']['size'] > $max_rozmiar) {
                echo 'Błąd! Plik jest za duży!';
            } else {
                $plik = $_FILES['plik']['name'];
                $rozmiar =  $_FILES['plik']['size'];
        echo 'Odebrano plik. Początkowa nazwa: '.$_FILES['plik']['name'];
        echo '<br/>';
        if (isset($_FILES['plik']['type'])) {
            echo 'Typ: '.$_FILES['plik']['type'].'<br/>';
            echo $_FILES['plik']['tmp_name'].'<br />';
        }

                move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/files/'.'sl.csv');

                $target_path = $_SERVER['DOCUMENT_ROOT'].'/files/'.'sl.csv';

                //$output = shell_exec('replace.sh '.$target_path.'');
                $output = exec('/bin/sed -i \'s/\(\t[0-9]*\),\([0-9]*\)/\1.\2/g\' '.$target_path.'');

                $sql =
                    ' LOAD DATA LOCAL INFILE \''.$target_path.'\' REPLACE INTO TABLE '.$raport.'_sl_akt'
                    . ' FIELDS TERMINATED BY \'\t\''
                    . ' ESCAPED BY \'\\\\\''
                    . ' LINES TERMINATED BY \'\\n\''
                    . ' IGNORE 1 LINES';

                $this->db->query($sql);
//                unlink($target_path);

                return array($plik, $rozmiar, $raport);

            }
        } else {
            echo 'Błąd przy przesyłaniu danych!';
        }

}
}