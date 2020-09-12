<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("mahasiswa_model", 'mhs_m');
    }
    public function index_get()
    {
        // cek apakah req by id
        $id = $this->get('id');
        if ($id === null) {
            $mahasiswa = $this->mhs_m->get_Mhs();
        } else {
            $mahasiswa = $this->mhs_m->get_Mhs($id);
        }
        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil',
                'data' => $mahasiswa
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak Ada Data yang Relevan'
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'Tidak Ada ID'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->mhs_m->delete_Mhs($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Delete Berhasil',
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Delete Gagal'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan'),
        ];
        if ($this->mhs_m->create_Mhs($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Ditambah',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal Ditambah',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan'),
        ];
        $id = $this->put('id');

        if ($this->mhs_m->edit_Mhs($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Berhasil Diedit',
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal update data',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
