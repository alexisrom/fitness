<?php defined('BASEPATH') or exit('No direct script access allowed');

// Modelo genérico para todas las categorías
//TODO: renombrar tablas
class Categorias_model extends CI_Model
{
    private $tables_names;

    public function __construct()
    {
        $this->load->database();
        $this->tables_names = array(
            'blog' => 'blog_categorias',
            'imagenes' => 'imagenes_categorias',
            'videos' => 'videos_categorias',
            'productos' => 'tienda_categoria',
        );;
    }

    public function getAll($nombre)
    {
        $this->db->from($this->tables_names[$nombre]);
        $query = $this->db->get();
        return $query->result();
    }

    public function store($data, $tipo)
    {
        $insert = $this->db->insert($this->tables_names[$tipo], $data);
        return $insert;
    }

    public function getById($id, $tipo)
    {
        $this->db->from($this->tables_names[$tipo]);
        $this->db->where('id', $id);
        return $this->db->get()->result_array()[0];
        //return $this->db->get()->row();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update($this->tables_name[$nombre], $data);
    }
}
