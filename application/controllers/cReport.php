<?php

class cReport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mReport');
        $this->load->library('form_validation');
    }

    /**
     * @return object
     */
    public function index()
    {

        $this->load->view('vIndex');
    }
    public function getReports()
    {
        $this->session->userdata('logged') == 1 || redirect('admin/cReport/login');
        $data['reports'] = $this->mReport->getReports();

        $this->load->view('vReports', $data);
    }

    public function generateReport()
    {
        $id = $this->uri->segment(3);
        $data['report'] = $this->mReport->generateQuery($id);
        $report = $data['report'][0];
        $report_info = $data['report'][1];
        $report_cols = $data['report'][2];
        $count = count($report[0]);
        $err = 0;




        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('AJD');

        // read data to active sheet
//        $this->excel->getActiveSheet()->fromArray($raport);

//---------------------------------------------------------------------------------------------------------------------

        $c = 0;

        foreach ($report_cols as $col )
        {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($c, 1, $col);
            $c++;
        }

        $row = 2;

        foreach ($report as $r)
        {
            $err++;
            for ($i=0; $i<$count; $i++ )
            {
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, $row, $r[$i]);
            }
            $row++;
        }

//---------------------------------------------------------------------------------------------------------------------
        $filename='just_some_random_name.xls'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel'); //mime type

        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name

        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as.XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

//        $this->load->view('vReport', $data);
    }
}

