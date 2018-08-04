<?php defined('BASEPATH') or exit('No direct script access allowed');

class Blog_model extends CI_Model
{
    private $table = 'blog_articulos';

    public function __construct()
    {
        $this->load->database();
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function create($data)
    {
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function getById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('status', 1);

        return $this->db->get()->result_array();
    }

    public function update($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update($this->table, $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
