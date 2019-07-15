<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

	'users_create' => array(
	   	array(
			 'field'   => 'name', 
			 'label'   => 'Imię', 
			 'rules'   => 'trim|required'
		),
	   	array(
			 'field'   => 'email', 
			 'label'   => 'Email', 
			 'rules'   => 'trim|required|valid_email|is_unique[users.email]'
		),
	   	array(
			 'field'   => 'password', 
			 'label'   => 'Hasło', 
			 'rules'   => 'trim|required|matches[passconf]'
		),   
	   	array(
			 'field'   => 'passconf', 
			 'label'   => 'Potwierdzenie hasła', 
			 'rules'   => 'trim|required'
		),
	),

	'users_edit' => array(
	    array(
			 'field'   => 'name', 
			 'label'   => 'Imię', 
			 'rules'   => 'trim|required'
		),
	    array(
			 'field'   => 'email', 
			 'label'   => 'Email', 
			 'rules'   => 'trim|required|valid_email|callback__unique_email'
		),
	    array(
			 'field'   => 'password', 
			 'label'   => 'Hasło', 
			 'rules'   => 'trim|required'
		),
	),

    'report_login' => array(
        array(
            'field'   => 'email',
            'label'   => 'Email',
            'rules'   => 'trim|required|valid_email'
        ),
        array(
            'field'   => 'password',
            'label'   => 'Hasło',
            'rules'   => 'trim|required'
        ),
    ),
);