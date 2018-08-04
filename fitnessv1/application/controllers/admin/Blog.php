<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Verificación de usuario
        $params['usuario'] = $this->session->userdata('usuario_admin');
        if ($params['usuario'] == false) {
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('blog_model');
        $this->load->model('categorias_model');
    }

    public function index()
    {
        $data = array(
            'main_content' => 'blog_articulos',
            'articulos' => $this->blog_model->getAll(),
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function nuevo()
    {
        $data = array(
            'categorias' => $this->categorias_model->getAll('blog'),
            'main_content' => 'blog_articulo_agregar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function agregar()
    {
        // Validación de campos
        $this->form_validation->set_rules('titulo', "título", 'trim|required|max_length[200]');
        $this->form_validation->set_rules('contenido', "contenido", 'trim|required');
        $this->form_validation->set_rules('categoria', "categoría", 'trim|required|numeric');
        if (empty($_FILES['imagen']['name'])) {$this->form_validation->set_rules('imagen', 'Imagen', 'required');}
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->form_validation->run() == true) {

            $articulo = $this->input->post();
            $articulo['fecha'] = date("Y/m/d H:i:s");

            if ($file_name = $this->__subir_imagen()) {
                $articulo['imagen'] = $file_name;
            } else {
                $this->session->set_flashdata('error', 'Ocurrió un error al intentar subir la nueva imagen');
            }

            if ($resultado = $this->blog_model->create($articulo)) {
                $this->session->set_flashdata('ok', 'Artículo agregado exitosamente');
                redirect('admin/blog', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No se pudo agregar el artículo');
            }
        }

        $data = array(
            'categorias' => $this->categorias_model->getAll('blog'),
            'main_content' => 'blog_articulo_modificar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    // Carga el formulario de edición
    public function editar($id)
    {
        $data = array(
            'articulo' => $this->blog_model->getById($id),
            'categorias' => $this->categorias_model->getAll('blog'),
            'main_content' => 'blog_articulo_modificar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function modificar()
    {
        // Validación de campos
        $this->form_validation->set_rules('titulo', "título", 'trim|required|max_length[200]');
        $this->form_validation->set_rules('contenido', "contenido", 'trim|required');
        $this->form_validation->set_rules('categoria', "categoría", 'trim|required|numeric');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        // Obtengo los valores ingresados
        $id = $this->input->post('id');
        $titulo = $this->input->post('titulo');
        $contenido = $this->input->post('contenido');
        $categoria = $this->input->post('categoria');
        $imagen = $_FILES['imagen']['name'];

        // Seteo los nuevos valores al artículo actual
        $articulo = $this->blog_model->getById($id);
        $articulo['titulo'] = $titulo;
        $articulo['contenido'] = $contenido;
        $articulo['categoria'] = $categoria;
        $articulo['fecha'] = date("Y/m/d H:i:s");

        if ($this->form_validation->run() == true) {

            // Subo la imagen en caso de que se haya seleccionado
            if (!empty($imagen)) {
                if ($file_name = $this->__subir_imagen()) {
                    $articulo['imagen'] = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Ocurrió un error al intentar subir la nueva imagen');
                }
            }

            if ($resultado = $this->blog_model->update($articulo)) {
                $this->session->set_flashdata('ok', 'Artículo modificado exitosamente');
                redirect('admin/blog', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No se pudo modificar el articulo');
            }

        }

        $data = array(
            'articulo' => $articulo,
            'categorias' => $this->categorias_model->getAll('blog'),
            'main_content' => 'blog_articulo_modificar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function eliminar($id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $data = array(
                'status' => '0',
            );
            $this->blog_model->update($id, $data);
            
            //Redirección desde ajax
            echo "admin/blog";
        }
    }

    public function categorias()
    {
        $data = array(
            "title" => 'Categorías de Blog',
            "main_content" => 'blog_categorias',
            "categorias" => $this->categorias_model->getAll('blog'),
            "controller_name" => "blog",
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function agregar_categoria()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('nombre', "Nombre", 'trim|required|max_length[200]');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if ($this->form_validation->run() == true) {
                $categoria = $this->input->post();
                $resultado = $this->categorias_model->store($categoria, 'blog');
                if ($resultado == true) {
                    $data['flash_message'] = 'Categoría agregada exitosamente';
                    $this->session->set_flashdata("ok", "Categoría agregada exitosamente");
                } else {
                    $data['flash_message'] = 'No se pudo agregar la categoría, error de base de datos';
                    $this->session->set_flashdata("ok", "No se pudo agregar la categoría, error de base de datos");
                }
            }

        }
        $data = array(
            "title" => 'Agregar categoría de blog',
            "main_content" => 'blog_categorias_agregar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function modificar_categoria($id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('nombre', "Nombre", 'trim|required|max_length[200]');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if ($this->form_validation->run() == true) {
                $categoria = $this->input->post();
                $resultado = $this->categorias_model->store($categoria, 'blog');
                if ($resultado == true) {
                    $data['flash_message'] = 'Categoría agregada exitosamente';
                } else {
                    $data['flash_message'] = 'No se pudo agregar la categoría, error de base de datos';
                }
            }

        }
        $data = array(
            "title" => 'Agregar categoría de blog',
            "main_content" => 'blog_categorias_modificar',
            'categoria' => $this->categorias_model->getById($id, 'blog'),
        );
        $this->load->view('admin/includes/template', $data);
    }

    // Funciones privada de uso interno

    private function __get_articulo($id)
    {}

    // Sube la imagen y retorna el nombre asignado
    private function __subir_imagen()
    {
        $file_name = $_FILES['imagen']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = time() . "." . $ext;
        $config['upload_path'] = FCPATH . 'uploads/blog/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '800';
        $config['file_name'] = $new_file_name;

        $this->load->library('upload', $config);
        //TODO: Borrar la imagen actual de la carpeta
        return $this->upload->do_upload('imagen') ? $new_file_name : '';
    }
}
