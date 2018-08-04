<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mensajes_model extends CI_Model
{
    private $table = 'mensajes';

    public function __construct()
    {
        $this->load->database();
    }

    // Mensajes recibidos
    public function get_inbox_messages()
    {
        $this->db->from($this->table);
        //$this->db->where('id', $id);
        //$this->db->where('status', 1);
        return $this->db->get()->result_array();
    }

    public function get_last_inbox_messages($limit)
    {
        $this->db->from('mensajes');
        //$this->db->order_by('fecha', 'desc');
        //$this->db->where('status', 1);
        $this->db->limit($limit);
        $query = $this->db->get();

        $mensajes = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                array_push($mensajes, $row);
            }
        }

        return $mensajes;
    }

    // Mensajes enviados
    public function get_sent_messages()
    {}

    // Destinatarios de mensajes los mensajes recibidos
    public function get_destinatarios()
    {}

    // Obtiene mensajes por coincidencia
    public function get_inbox_messages_by($criterio)
    {}

    // Obtiene mensajes sin leer
    public function get_unread_messages($criterio, $limit)
    {}

    public function store($data)
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
