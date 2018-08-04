<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $usr = 'admin';
    private $psw = 'd55c5d0633d62619867abc761318067aac6bf7d7';

    public function index()
    {
        $params['usuario'] = $this->session->userdata('usuario_admin');
        if ($params['usuario'] == "") {
            //TODO: provar si redirect corta el método
            //redirect('admin', 'refresh');
            $this->load->view('admin/pages/login');
        } else {
            $data['main_content'] = 'admin/pages/admin/dashboard';
            $this->load->view('admin/pages/admin/dashboard/dashboard');
            //$this->load->view('admin/includes/template', $data);
        }

    }

    public function login()
    {
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');

        $this->form_validation->set_rules('user', "Usuario", 'required|max_length[20]');
        $this->form_validation->set_rules('pass', "Contraseña", 'required');

        if ($this->form_validation->run()) {
            if ($this->validate_credentials($user, $pass)) {
                redirect('admin/dashboard/', 'refresh');
            } else {
                $data['error'] = "El usuario y la contraseña que ingresaste no coinciden";
            }
        } else {
            $data['error'] = "Error al validar Ingreso";
        }
        $this->load->view('admin/pages/login', $data);
    }

    private function validate_credentials($usr, $psw)
    {
        $validated = $this->usr == $usr && $this->psw == sha1($psw);

        if ($validated) {
            $datasession = array(
                'usuario_admin' => true,
                'login_ok' => true,
            );
            $this->session->set_userdata($datasession);
        }

        return $validated;
    }

    public function logout()
    {
        $datasession = array(
            'usuario_admin' => false,
            'login_ok' => false,
        );
        $this->session->unset_userdata($datasession);
        $this->session->sess_destroy();
        redirect('admin/auth', 'refresh');
    }
}
