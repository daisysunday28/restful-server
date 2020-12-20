<?php

class Pesanan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pesanan_model1');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['judul'] = 'Daftar Pesanan';
    $data['pesan'] = $this->Pesanan_model1->getAllPesan();
    if ($this->input->post('keyword')) {
      $data['bus'] = $this->Bus_model->cariDataBus();
    }
    $this->load->view('templates/header', $data);
    $this->load->view('pesan/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah()
  {
    $data['judul'] = 'Form Tambah Data Pesanan';

    $this->form_validation->set_rules('nama_team', 'Nama Team', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('tanggal_berangkat', 'Tanggal Berangkat', 'required');
    $this->form_validation->set_rules('tanggal_pulang', 'Tanggal Pulang', 'required');
    $this->form_validation->set_rules('no_hp', 'no hp', 'required');


    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('pesan/tambah');
      $this->load->view('templates/footer');
    } else {
      $this->Pesanan_model1->tambahDataPesan();
      // $this->session->set_flashdata('flash', 'Ditambahkan');
      redirect('pesanan');
    }
  }

  public function hapus($id_pesan)
  {
    $this->Pesanan_model1->hapusDataPesan($id_pesan);
    // $this->session->set_flashdata('flash', 'Dihapus');
    redirect('pesanan');
  }

  public function detail($id_pesan)
  {
    $data['judul'] = 'Detail Data Pesanan';
    $data['pesan'] = $this->Pesanan_model1->getPesanById($id_pesan);
    $this->load->view('templates/header', $data);
    $this->load->view('pesan/detail', $data);
    $this->load->view('templates/footer');
  }

  public function ubah($id_pesan)
  {
    $data['judul'] = 'Form Ubah Data Pesanan';
    $data['pesan'] = $this->Pesanan_model1->getPesanById($id_pesan);

    $this->form_validation->set_rules('nama_team', 'Nama Team', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('tanggal_berangkat', 'Tanggal Berangkat', 'required');
    $this->form_validation->set_rules('tanggal_pulang', 'Tanggal Pulang', 'required');
    $this->form_validation->set_rules('no_hp', 'no hp', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('pesan/ubah', $data);
      $this->load->view('templates/footer');
    } else {
      $this->Pesanan_model1->ubahDataPesan();
      // $this->session->set_flashdata('flash', 'Diubah');
      redirect('pesanan');
    }
  }
}
