<?php
/**
 * Created by PhpStorm.
 * cUser: karwackid
 * Date: 2019-05-04
 * Time: 08:20
 */

class cUser extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mUser');
        $this->load->library('form_validation');
    }

    /**
     * @return object
     */
    public function index()
    {
       $data['users'] = $this->mUser->get('users');
       $this->load->view('admin/vUsers', $data);


    }

    public function create()
    {

        if(!empty($_POST)) {

            $config = array(
                'required' => 'Pole %s jest wymagane',
                'matches' => 'Hasła muszą być identyczne',
                'valid_email' => 'Niepoprawny format adresu email',
                'is_unique' => 'Podany adres email juz istnieje w bazie'

            );

            $this->form_validation->set_message($config);


            if ($this->form_validation->run('users_create') == TRUE)
            {
                $data = array(
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role' => $_POST['role']
                );

                $data['password'] = pass_hash($data['password']);

                $this->mUser->create('users', $data);
                redirect('http://cms.local/admin/cUser/');
            }
        }
        $this->load->view('admin/vUser_create');
    }

    public function get($id)
    {
        $where = array('id' => $id);
       $data['user'] = $this->mUser->get('users', $where);
       $this->load->view('admin/vUser_edit', $data);
    }

    public function edit()
    {
        $id = $this->uri->segment(4);

        $where = array('id' => $id);

        $data['user'] = $this->mUser->get('users', $where);

        if(!empty($_POST))
        {
            if ($this->form_validation->run('users_edit') == TRUE) {
                $data = array(
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'role' => $_POST['role']
                );
                $where = array('id' => $id);
                $this->mUser->update('users', $where, $data);
                redirect('http://cms.local/admin/cUser/');
            }
        }

        $this->load->view('admin/vUser_edit', $data);
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $this->mUser->delete('users', $where);
        redirect('http://cms.local/admin/cUser/');
    }

    function _unique_email()
    {
        $id = $this->uri->segment(4);
        $email = $this->input->post('email');
        $where = array(
          'id !=' => $id,
          'email' => $email
        );

        if($this->mUser->unique_email($where))
        {
            echo 'jest juz taki e-mail w bazie';
        }
    }
}