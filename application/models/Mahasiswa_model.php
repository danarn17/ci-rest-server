<?php
class Mahasiswa_model extends CI_Model
{
    public function get_Mhs($id = null)
    {
        if ($id === null) {
            return $this->db->get('mahasiswa')->result_array();
        } else {
            return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
        }
    }
    public function delete_Mhs($id)
    {
        $this->db->delete('mahasiswa', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function create_Mhs($data)
    {
        $this->db->insert('mahasiswa', $data);
        return $this->db->affected_rows();
    }
    public function edit_Mhs($data, $id)
    {
        $this->db->update('mahasiswa', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
