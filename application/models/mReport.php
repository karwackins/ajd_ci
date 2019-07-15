<?php

class mReport extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

//-------------------------------------------------------------tworzenie raportu-----------------------------------//
    public function create($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function getReports()
    {
       $query = $this->db->get('raporty')->result();

       return $query;
    }

    public function get($inf_schema_table)
    {
            $this->db->select('TABLE_NAME');
            $this->db->where('TABLE_SCHEMA', 'lsi-ajd' );
            $query = $this->db->get($inf_schema_table);
            return $query->result();
    }

    public function getCols($inf_schema_col, $table_1, $table_2)
    {
        $this->db->select('COLUMN_NAME');
        $this->db->where('TABLE_SCHEMA', 'lsi-ajd');
        $this->db->where('TABLE_NAME', $table_1);
        $this->db->or_where('TABLE_NAME', $table_2);
        $query = $this->db->get($inf_schema_col);
        return $query->result();
    }
//-------------------------------------------------------------testowanie raportu-----------------------------------//
    public function test($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('raporty');
        $raportInfo = $query->row();
        $queryTest = $this->queryTest($raportInfo);
        $arr = array(
            'queryTest' => $queryTest,
            'raportInfo' => $raportInfo,
        );
        return $arr;
    }


    public function queryTest($data)
    {
        $rel = json_decode($data->relations);
        $num = count($rel);
        $join = '';

        for($i=0; $i<$num; $i=$i+2)
        {
            if($i < $num)
            {
                $join .= $data->table_1.'.'.$rel[$i] .'='. $data->table_2.'.'.$rel[$i+1];
                $join .= ' AND ';
            }
        }

        $this->db->select($data->cols);
        $this->db->from($data->table_1);

        $this->db->join($data->table_2, substr($join,0,-5), 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    //-------------------------------------------------------------generowanie raportu-----------------------------------//

    public function generateQuery($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('raporty');
        $raportInfo = $query->row();
        $report = $this->generateReport($raportInfo);
        $diff = $this->generateDiff($report, $id);



        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++przygotowanie kolumn+++++++++++++++++++++//

        $col2 = array();
        $stan_arr = array();
        for($s = $raportInfo->conf_from+1; $s <= $raportInfo->conf; $s=$s+2)
        {
            $stan_arr[] = $s;
        }

        $cols = explode(',',$raportInfo->cols);
        $stan =0;
        foreach ($cols as $col)
        {
            $col2[] = $col;
            if(in_array($stan, $stan_arr))
            {
                $col2[] = 'STAN';
            }
            $stan++;
        }

        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++end_przygotowanie kolumn+++++++++++++++++++++//

        return array($diff, $raportInfo, $col2);
    }

    public function generateReport($data)
    {

        $rel = json_decode($data->relations);
        $num = count($rel);
        $join = '';

        for($i=0; $i<$num; $i=$i+2)
        {
            if($i < $num)
            {
                $join .= $data->table_1.'.'.$rel[$i] .'='. $data->table_2.'.'.$rel[$i+1];
                $join .= ' AND ';
            }
        }

        $this->db->select($data->cols);
        $this->db->from($data->table_1);

        $this->db->join($data->table_2, substr($join,0,-5), 'left');
        $this->db->where($data->table_1.'.sl_instytucja', $this->session->userdata('unit'));
        $report = $this->db->get();

        return($report->result_array());
    }

    public function generateDiff($data, $id)
    {
        $this->db->select('conf, conf_from');
        $this->db->from('raporty');
        $this->db->where('id',$id);
        $conf = $this->db->get()->row();


        $err = array();
        $diff = array();
        $good = array();
        $val = array();
        foreach ($data as $item)
        {
            $val[] = array_values($item);
        }

        $c = 0;
        $arr = array();
        $index = 0;

        foreach ($val as $v)
        {
            $i = 0;
            $i_diff = $conf->conf_from;
            while($i < sizeof($v))
            {
                while($i < $i_diff)
                {
                    $arr[$index][] = $v[$i];
                    $i++;
                }

                while($i_diff <= $conf->conf)
                {
                    $arr[$index][] = $v[$i_diff];
                    $arr[$index][] = $v[$i_diff+1];
                    if($v[$i_diff+1] == '')
                    {
                        $arr[$index][] = 'BRAK';
                        $err[] = 1;

                    } elseif ($v[$i_diff] != $v[$i_diff+1])
                    {
                        $arr[$index][] = 'BŁĄD';
                        $err[] = 1;
                    }
                    else
                    {
                        $arr[$index][] = 'OK';
                        $err[] = 0;
                    }
                    $i_diff = $i_diff+2;
                    $i = $i_diff;
                }
                   $arr[$index][] = $v[$i];

                    $i++;
            }

            if(in_array(1, $err))
            {
                $diff[] = $v;
            }else
            {
                $good[] = $v;
            }
            $err = array();
            $c++;
            $index++;
        }
        return $arr;
    }
}