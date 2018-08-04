<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$params['usuario'] = $this->session->userdata('usuario_admin');
        if ($params['usuario'] == false) {
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('blog_model');
        $this->load->model('Mensajes_model');
    }
    public function index()
    {
        $this->session->set_flashdata("ok", "usando flash data ok");
        $this->session->set_flashdata("error", "usando flash data error");
        $data['main_content'] = 'dashboard';
        //TODO: Dejar para lo último ya que no es un requisito
        $data['ultimos_mensajes'] = $this->Mensajes_model->get_last_inbox_messages(5);
        $this->load->view('admin/includes/template', $data);
    }
}
