<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prestasi_model');
    }
    public function index()
    {
        $data['judul2']= "Halaman Pencatan Prestasi";
        $data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['prestasi'] = $this->Prestasi_model->get();
        $this->load->view("layout/header", $data);
        $this->load->view("prestasi/vw_prestasi", $data);
        $this->load->view("layout/footer", $data);
    }
    public function tambah()
    {
        $data['judul']="Halaman Tambah Pencatatan Prestasi";
        $data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['prestasi'] = $this->Prestasi_model->get();
        $this->form_validation->set_rules('judul_kegiatan','Judul Kegiatan','required',[
            'required'=> 'Judul Kegiatan Wajib di isi'
        ]);
        $this->form_validation->set_rules('aktifitas','Aktifitas','required',[
            'required'=> 'Aktifitas Wajib di isi'
        ]);
        $this->form_validation->set_rules('penilai_kegiatan','Penilai Kegiatan','required',[
            'required'=> 'Penilai Kegiatan Wajib di isi'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view("layout/header", $data);
            $this->load->view("Prestasi/vw_tambah_prestasi", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data=[
                'judul_kegiatan' => $this->input->post('judul_kegiatan'),
                'aktifitas' => $this->input->post('aktifitas'),
                'penilai_kegiatan' => $this->input->post('penilai_kegiatan'),
            ];
            $upload_image = $_FILES['gambar']['name'];
            $ext = pathinfo($upload_image, PATHINFO_EXTENSION);
            if ($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']='2048';
                $config['upload_path'] = './assets/img/prestasi/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')){
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->Prestasi_model->insert($data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Data Pencatatan Berhasil Ditambah!</div>');
            redirect('Prestasi');
        }
    }
    public function hapus($id)
    {
        $this->Prestasi_model->delete($id);
        $error = $this->db->error();
        if($error['code']!=0){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon
            fas fa-info-circle"></i>Data Prodi tidak dapat dihapus (sudah berelasi)!</div>');
        } else{
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i
            class="icon fas fa-check-circle"></i>Data Pengajuan TAK Berhasil Dihapus!</div>');
        }
        redirect('Prestasi');
    }
    public function edit($id)
    {
        $data['judul']="Halaman Edit Pencatatan Prestasi";
        $data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['prestasi'] = $this->Prestasi_model->get();
        $data['prestasi'] = $this->Prestasi_model->getById($id);
        $this->form_validation->set_rules('judul_kegiatan','Judul Kegiatan','required',[
            'required'=> 'Judul Kegiatan Wajib di isi'
        ]);
        $this->form_validation->set_rules('aktifitas','Aktifitas','required',[
            'required'=> 'Aktifitas Wajib di isi'
        ]);
        $this->form_validation->set_rules('penilai_kegiatan','Penilai Kegiatan','required',[
            'required'=> 'Penilai Kegiatan Wajib di isi'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view("layout/header", $data);
            $this->load->view("Prestasi/vw_ubah_prestasi", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data=[
                'judul_kegiatan' => $this->input->post('judul_kegiatan'),
                'aktifitas' => $this->input->post('aktifitas'),
                'penilai_kegiatan' => $this->input->post('penilai_kegiatan'),
            ];
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']='2048';
                $config['upload_path'] = './assets/img/prestasi/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')){
                    $old_image = $data['prodi']['gambar'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/prestasi/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $id = $this->input->post('id');
            $this->Prestasi_model->update(['id' => $id], $data, $upload_image);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Data Pencatatacn Prestasi Berhasil Diubah!</div>');
            redirect('Prestasi');
        }
    }
}