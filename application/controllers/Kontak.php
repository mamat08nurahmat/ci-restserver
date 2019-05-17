<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    // public function index_get()
    // {
    //     // Users from a data store e.g. database
        
    //     $kontaks = $this->db->get('telepon')->result();

    //     $id = $this->get('id');

    //     // If the id parameter doesn't exist return all the users

    //     if ($id === NULL)
    //     {
    //         // Check if the users data store contains users (in case the database result returns NULL)
    //         if ($kontaks)
    //         {
    //             // Set the response and exit
    //             $this->response($kontaks, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    //         }
    //         else
    //         {
    //             // Set the response and exit
    //             $this->response([
    //                 'status' => FALSE,
    //                 'message' => 'No users were found'
    //             ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    //         }
    //     }

    //     // Find and return a single record for a particular user.
    //     else {
    //         $id = (int) $id;

    //         // Validate the id.
    //         if ($id <= 0)
    //         {
    //             // Invalid id, set the response and exit.
    //             $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
    //         }

    //         // Get the user from the array, using the id as key for retrieval.
    //         // Usually a model is to be used for this.

    //         $kontak = NULL;

    //         if (!empty($kontak))
    //         {
    //             foreach ($kontak as $key => $value)
    //             {
    //                 if (isset($value['id']) && $value['id'] === $id)
    //                 {
    //                     $kontak = $value;
    //                 }
    //             }
    //         }

    //         if (!empty($kontak))
    //         {
    //             $this->set_response($kontak, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    //         }
    //         else
    //         {
    //             $this->set_response([
    //                 'status' => FALSE,
    //                 'message' => 'Kontak could not be found'
    //             ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    //         }
    //     }
    // }


    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        $this->response($kontak, 200);
    }

//Mengirim atau menambah data kontak baru
function index_post() {
    $data = array(
                'id'           => $this->post('id'),
                'nama'          => $this->post('nama'),
                'nomor'    => $this->post('nomor'));
    $insert = $this->db->insert('telepon', $data);
    if ($insert) {
        $this->response($data, 200);
    } else {
        $this->response(array('status' => 'fail', 502));
    }
}


//Memperbarui data kontak yang telah ada
function index_put() {
    $id = $this->put('id');
    $data = array(
                'id'       => $this->put('id'),
                'nama'          => $this->put('nama'),
                'nomor'    => $this->put('nomor'));
    $this->db->where('id', $id);
    $update = $this->db->update('telepon', $data);
    if ($update) {
        $this->response($data, 200);
    } else {
        $this->response(array('status' => 'fail', 502));
    }
}

//Menghapus salah satu data kontak
function index_delete() {
    $id = $this->delete('id');
    $this->db->where('id', $id);
    $delete = $this->db->delete('telepon');
    if ($delete) {
        $this->response(array('status' => 'success'), 201);
    } else {
        $this->response(array('status' => 'fail', 502));
    }
}

    //Masukan function selanjutnya disini

}
?>