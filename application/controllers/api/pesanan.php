<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class pesanan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pesanan_Model', 'pesanan');
        $this->methods['index_get']['limit'] = 1000;
    }

    public function index_get()
    {
        $id_pesan = $this->get('id_pesan');
        if ($id_pesan === null) {
            $pesanan = $this->pesanan->getPesanan();
        } else {
            $pesanan = $this->pesanan->getPesanan($id_pesan);
        }



        if ($pesanan) {
            $this->response([
                'status' => true,
                'data' => $pesanan
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'team tidak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id_pesan = $this->delete('id_pesan');
        if ($id_pesan === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->pesanan->deletepesanan($id_pesan) > 0) {
                //oke
                $this->response([
                    'status' => true,
                    'id_bus' => $id_pesan,
                    'message' => 'team berhasil dihapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                //id not found
                $this->response([
                    'status' => false,
                    'message' => 'not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [

            'nama_team' => $this->post('nama_team'),
            'alamat' => $this->post('alamat'),
            'tanggal_berangkat' => $this->post('tanggal_berangkat'),
            'tanggal_pulang' => $this->post('tanggal_pulang'),
            'no_hp' => $this->post('no_hp'),
        ];

        if ($this->pesanan->createpesanan($data) > 0) {
            //oke
            $this->response([
                'status' => true,
                'message' => 'team berhasil ditambahkan.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan team'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id_pesan = $this->put('id_pesan');
        $data = [
            'nama_team' => $this->put('nama_team'),
            'alamat' => $this->put('alamat'),
            'tanggal_berangkat' => $this->put('tanggal_berangkat'),
            'tanggal_pulang' => $this->put('tanggal_pulang'),
            'no_hp' => $this->put('no_hp'),
        ];

        if ($this->pesanan->updatepesanan($data, $id_pesan) > 0) {
            //oke
            $this->response([
                'status' => true,
                'message' => 'data team berhasil diubah'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            //id not found
            $this->response([
                'status' => false,
                'message' => 'gagal merubah data team!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
