<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Verificación de usuario
        $params['usuario'] = $this->session->userdata('usuario_admin');
        if ($params['usuario'] == false) {
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('productos_model');
        $this->load->model('categorias_model');
    }

    public function index()
    {
        $data = array(
            'main_content' => 'productos',
            'productos' => $this->productos_model->getAll(),
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function nuevo()
    {
        $data = array(
            'categorias' => $this->categorias_model->getAll('productos'),
            'main_content' => 'producto_agregar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function agregar()
    {
        // Validación de campos
        $this->form_validation->set_rules('nombre', "nombre", 'trim|required|max_length[200]');
        $this->form_validation->set_rules('descripcion', "descripción", 'trim|required');
        $this->form_validation->set_rules('precio', "precio", 'trim|required|numeric');
        $this->form_validation->set_rules('categoria', "categoría", 'trim|required|numeric');
        if (empty($_FILES['imagen']['name'])) {$this->form_validation->set_rules('imagen', 'Imagen', 'required');}
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        if ($this->form_validation->run() == true) {

            $producto = $this->input->post();

            if ($file_name = $this->__subir_imagen()) {
                $producto['imagen'] = $file_name;
            } else {
                $this->session->set_flashdata('error', 'Ocurrió un error al intentar subir la imagen');
            }

            if ($resultado = $this->productos_model->create($producto)) {
                $this->session->set_flashdata('ok', 'Producto agregado exitosamente');
                redirect('admin/productos', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No se pudo agregar el producto');
            }
        }

        $data = array(
            'categorias' => $this->productos_model->getAll('productos'),
            'main_content' => 'producto_agregar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    // Carga el formulario de edición
    public function editar($id)
    {
        $data = array(
            'producto' => $this->productos_model->getById($id),
            'categorias' => $this->categorias_model->getAll('productos'),
            'main_content' => 'producto_modificar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function modificar()
    {
        // Validación de campos
        $this->form_validation->set_rules('nombre', "nombre", 'trim|required|max_length[200]');
        $this->form_validation->set_rules('descripcion', "descripción", 'trim|required');
        $this->form_validation->set_rules('precio', "precio", 'trim|required|numeric');
        $this->form_validation->set_rules('categoria', "categoría", 'trim|required|numeric');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

        // Obtengo los valores ingresados
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $categoria = $this->input->post('categoria');
        $imagen = $_FILES['imagen']['name'];

        // Seteo los nuevos valores al Producto actual
        $producto = $this->productos_model->getById($id);
        $producto['nombre'] = $nombre;
        $producto['descripcion'] = $descripcion;
        $producto['precio'] = $precio;
        $producto['categoria'] = $categoria;

        if ($this->form_validation->run() == true) {

            // Subo la imagen en caso de que se haya seleccionado
            if (!empty($imagen)) {
                if ($file_name = $this->__subir_imagen()) {
                    $producto['imagen'] = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Ocurrió un error al intentar subir la nueva imagen');
                }
            }

            if ($resultado = $this->productos_model->update($id, $producto)) {
                $this->session->set_flashdata('ok', 'Producto modificado exitosamente');
                //redirect('admin/productos', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'No se pudo modificar el producto');
            }

        }

        $data = array(
            'producto' => $producto,
            'categorias' => $this->categorias_model->getAll('productos'),
            'main_content' => 'producto_modificar',
        );
        $this->load->view('admin/includes/template', $data);
    }

    public function eliminar($id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $data = array(
                'status' => '0',
            );
            $this->productos_model->update($id, $data);
            
            //Redirección desde ajax
            echo "admin/productos";
        }
    }

    public function categorias()
    {
        $data = array(
            "title" => 'Categorías de productos',
            "main_content" => 'productos_categorias',
            "categorias" => $this->categorias_model->getAll('productos'),
            "controller_name" => "productos",
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
                $resultado = $this->categorias_model->store($categoria, 'productos');
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
            "title" => 'Agregar categoría de producto',
            "main_content" => 'productos_categorias_agregar',
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
                $resultado = $this->categorias_model->store($categoria, 'productos');
                if ($resultado == true) {
                    $data['flash_message'] = 'Categoría agregada exitosamente';
                } else {
                    $data['flash_message'] = 'No se pudo agregar la categoría, error de base de datos';
                }
            }

        }
        $data = array(
            "title" => 'Agregar categoría de producto',
            "main_content" => 'productos_categorias_modificar',
            'categoria' => $this->categorias_model->getById($id, 'productos'),
        );
        $this->load->view('admin/includes/template', $data);
    }

    // Funciones privada de uso interno


    // Sube la imagen y retorna el nombre asignado
    private function __subir_imagen()
    {
        $file_name = $_FILES['imagen']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = time() . "." . $ext;
        $config['upload_path'] = FCPATH . 'uploads/productos/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '800';
        $config['file_name'] = $new_file_name;

        $this->load->library('upload', $config);
        //TODO: Borrar la imagen actual de la carpeta
        return $this->upload->do_upload('imagen') ? $new_file_name : '';
    }
}
