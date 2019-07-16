<?php
/**
 * Created by PhpStorm.
 * cUser: karwackid
 * Date: 2019-05-04
 * Time: 08:20
 */

class cReport extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mReport');
        $this->load->model('mUser');
        $this->load->library('form_validation');
    }

    /**
     * @return object
     */
    public function index()
    {
// jezeli jestem zalogowany idzie dalej jezeli nie to przekierowuje na admin/cReport/login
        $this->loggedin() == 1 || redirect('admin/cReport/login');

        $data['reports'] = $this->mReport->getReports();

        $this->load->view('admin/vReports', $data);
    }

    public function create()
    {
        $data['tables'] = $this->mReport->get('information_schema.tables');
        if($_POST)
        {
            $rel = $this->input->post('rel');
            $relations = json_encode($rel);
            $name = $this->input->post('name');
            $cols = $this->input->post('cols');
            $table_1 = $this->input->post('table_1');
            $table_2 = $this->input->post('table_2');

            $table = 'raporty';
            $data = array(
                'name' => $name,
                'cols' => $cols,
                'table_1' => $table_1,
                'table_2' => $table_2,
                'relations' => $relations
            );
            $this->mReport->create($table, $data);
            redirect('http://ajd-ci.com/admin/cReport/');
        }

        $this->load->view('admin/vReport_create', $data);
    }

//    public function get($id)
//    {
//        $where = array('id' => $id);
//        $data['user'] = $this->mUser->get('users', $where);
//        $this->load->view('admin/vUser_edit', $data);
//    }

    public function getCols()
    {

        $table_1 = $this->input->post('table_name_1');
        $table_2 = $this->input->post('table_name_2');
        $data['tables'] = $this->mReport->get('information_schema.tables');
        $data['cols'] = $this->mReport->getCols('information_schema.columns', $table_1, $table_2);
        $data['table_1'] = $table_1;
        $data['table_2'] = $table_2;
        $this->load->view('admin/vReport_create', $data);
    }

    public function ajax()
    {
        $arr = array();
        $items = $this->input->post('items');
        $max = sizeof($items);
        $i = 1;

        foreach($items as $item)
        {
            if($i < $max)
            {
                $arr[] = $item.',';
            } else
            {
                $arr[] = $item;
            }
            $i++;
        }
        array_shift($arr); //usuwa pierwszy przecinek z tablicy
        foreach ($arr as $a)
        {
            echo $a;
        }

    }

    public function test()
    {
        $id = $this->uri->segment(4);
        $data['report'] = $this->mReport->test($id);
        $data['report']['last_query'] = $this->db->last_query();
        $this->load->view('admin/vReport_test', $data);
    }

    public function login()
    {
        //jezeli nie jest zalogowany to idzie dalej a jak jest przechodzi do panelu
        $this->loggedin() != 1 || redirect('admin/cReport');
        if(!empty($_POST)) {

            $config = array(
                'required' => 'Pole %s jest wymagane',
                'valid_email' => 'Niepoprawny format adresu email',

            );

            $this->form_validation->set_message($config);


            if ($this->form_validation->run('report_login') == TRUE)
            {
                $data = array(
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                );

//                $data['password'] = pass_hash($data['password']);

                $user = $this->mUser->get('users', $data);
                if(!empty($user))
                {
                    $data = array(
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'logged' => TRUE,
                        'unit' => $user->unit,
                    );

                    $this->session->set_userdata($data);
                    redirect('admin/cReport');
                }
                else
                {
                    echo 'nie jest ok';
                }
            }

        }
        $this->load->view('admin/login');

    }

    public function loggedin()
    {
        return $this->session->userdata('logged'); //jak jestem zalogowany zwraca 1, jak nie nic
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('admin/cReport/login');
    }



//    public function edit()
//    {
//        $id = $this->uri->segment(4);
//
//        $where = array('id' => $id);
//
//        $data['user'] = $this->mUser->get('users', $where);
//
//        if(!empty($_POST))
//        {
//            if ($this->form_validation->run('users_edit') == TRUE) {
//                $data = array(
//                    'name' => $_POST['name'],
//                    'email' => $_POST['email'],
//                    'role' => $_POST['role']
//                );
//                $where = array('id' => $id);
//                $this->mUser->update('users', $where, $data);
//                redirect('http://cms.local/Admin/cUser/');
//            }
//        }
//
//        $this->load->view('admin/vUser_edit', $data);
//    }
//
//    public function delete($id)
//    {
//        $where = array('id' => $id);
//        $this->mUser->delete('users', $where);
//        redirect('http://cms.local/Admin/cUser/');
//    }

}