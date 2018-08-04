<?php defined('BASEPATH') or exit('No direct script access allowed');

class Productos_model extends CI_Model
{
    private $table = 'tienda_productos';

    public function __construct()
    {
        $this->load->database();
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('status', 1);

        return $articulo = $this->db->get()->result_array()[0];
    }

    public function create($data)
    {
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);;
    }
}
