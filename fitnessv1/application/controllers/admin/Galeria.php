<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galeria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('galeria_model');

        $params['usuario'] = $this->session->userdata('usuario_admin');
        if ($params['usuario'] == false) {
            redirect('admin/auth', 'refresh');
        }
    }

    public function index()
    {
        $data = array(
            'main_content' => 'galeria',
            'imagenes' => $this->galeria_model->getAll()
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function agregar(){
        if ($this->Galeria_model->save($data)) {
            redirect(base_url()."galeria");
        } else {
            redirect(base_url()."galeria/agregar");
            $this->session->set_flashdata("error", "No se pudo guardar la información");
        }
        
    }
}