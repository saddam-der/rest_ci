<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class ct_ngadu extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $ngadu = $this->db->get('ngaduin')->result();
        } else {
            $this->db->where('id', $id);
            $ngadu = $this->db->get('ngaduin')->result();
        }
        $this->response($ngadu, 200);
    }

    function index_post()
    {
        $data = array(
            'id'           => $this->post('id'),
            'nama'          => $this->post('nama'),
            'laporan'    => $this->post('laporan')
        );
        $insert = $this->db->insert('ngaduin', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'id'       => $this->put('id'),
            'nama'          => $this->put('nama'),
            'laporan'    => $this->put('laporan')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('ngaduin', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('ngaduin');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Masukan function selanjutnya disini
}
