<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Training_model');

        $params['usuario'] = $this->session->userdata('usuario_admin');
        if ($params['usuario'] == false) {
            redirect('admin/auth', 'refresh');
        }
    }

    public function index()
    {
        $data = array(
            'main_content' => 'training_videos',
            'imagenes' => $this->galeria_model->getAll()
        );
        $this->load->view('admin/includes/template', $data);
    }
}