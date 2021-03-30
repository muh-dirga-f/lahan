<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends REST_Controller {

    function __construct()
    {
        parent::__construct();

        $this->output->set_header( "Access-Control-Allow-Origin: *" );
        $this->output->set_header( "Access-Control-Allow-Credentials: true" );
        $this->output->set_header( "Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS" );
        $this->output->set_header( "Access-Control-Max-Age: 604800" );
        $this->output->set_header( "Access-Control-Request-Headers: x-requested-with" );
        $this->output->set_header( "Access-Control-Allow-Headers: x-requested-with, x-requested-by" );
    }

    ///////////////////class-crud///////////////////////
    ////////////////////////////////////////////////////

    public function get_get()
    //example : /api/data/get?table=tes
    {
        $data = $this->db->get($this->get('table'))->result_array();
        $this->response([
            'status' => TRUE,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function get_where_get()
    //example : /api/data/get_where?table=tes&id=1
    {
        $id_table = $this->get('id_table');
        $data = $this->db->get_where($this->get('table'), [$id_table => $this->get('id')])->result_array();
        $this->response([
            'status' => TRUE,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function get_where_str_get()
    //example : /api/data/get_where?table=tes&id=1
    {
        $where = str_replace(":", "='", $this->get('where'));
        $data = $this->db->query("SELECT * FROM ".($this->get('table'))." WHERE ".$where."'")->result_array();
        $this->response([
            'status' => TRUE,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function get_select_get()
    //example : /api/data/get_where?table=tes&id=1
    {
        $this->db->select($this->get('select'));
        $data = $this->db->get($this->get('table'))->result_array();
        $this->response([
            'status' => TRUE,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function get_join_get()
    //example : api/data/get_join?table=barang&table_join=kategori&kolom_join=id_kategori
    {
        $this->db->select('*');
        $this->db->from($this->get('table_join'));
        $this->db->join($this->get('table'), $this->get('table_join').".id = ".$this->get('table').".".$this->get('kolom_join'), "INNER");
        if ($this->get('where_id')!==null) {
            $this->db->where($this->get('table').'.id', $this->get('where_id'));
        }
        if ($this->get('where_custom')!==null) {
            $this->db->where($this->get('where_custom'), $this->get('where_kolom'));
        }
        if ($this->get('where_str')!==null) {
            $where = str_replace(":", "=", $this->get('where_str'));
            $this->db->where($where);
        }
        $data = $this->db->get()->result_array();
        $this->response([
            'status' => TRUE,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function get_join_multiple_get()
    //example : api/data/get_join?table=barang&table_join=kategori&kolom_join=id_kategori
    {
        $this->db->select('*');
        $this->db->from($this->get('table'));
        $this->db->join($this->get('table_join'), $this->get('table_join').".".$this->get('id_join')." = ".$this->get('table').".".$this->get('kolom_join'), "INNER");
        $this->db->join($this->get('table_join2'), $this->get('table_join2').".".$this->get('id_join2')." = ".$this->get('table').".".$this->get('kolom_join2'), "INNER");
        if ($this->get('where_id')!==null) {
            $this->db->where($this->get('table').'.id', $this->get('where_id'));
        }
        if ($this->get('where_custom')!==null) {
            $this->db->where($this->get('where_custom'), $this->get('where_kolom'));
        }
        if ($this->get('where_str')!==null) {
            $where = str_replace(":", "=", $this->get('where_str'));
            $this->db->where($where);
        }
        $data = $this->db->get()->result_array();
        $this->response([
            'status' => TRUE,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function add_post()
    //example : /api/data/add?table=tes&nama=dirga&pass=123
    {
        $id_table = $this->post('id_table');
        $data[$id_table] = NULL;
        foreach ($this->post() as $key => $value) {
            if($key!=="table" && $key!=="id_table" && $key!=="id" && $key!==$id_table)$data[$key] = $value;
        }
        $db = $this->db->insert($this->post('table'), $data);
        if ($this->db->affected_rows() > 0) {
            $message = "data berhasil di tambah";
            $status = true;
        }else{
            $message = "data gagal di tambah";
            $status = false;
        }
        $this->response([
            'status' => $status,
            'tabel' => $this->post('table'),
            'message' => $message,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function edit_post()
    //example : /api/data/edit?table=tes&id=10&nama=oki&pass=999
    {
        $id_table = $this->post('id_table');
        foreach ($this->post() as $key => $value) {
            if($key!=="table" && $key!=="id_table" && $key!=="id")$data[$key] = $value;
        }
        $this->db->where($id_table, $this->post('id'));
        $this->db->update($this->post('table'), $data);
        if ($this->db->affected_rows() > 0) {
            $message = "data berhasil di ubah";
            $status = true;
        }else{
            $message = "data gagal di ubah";
            $status = false;
        }
        $this->response([
            'status' => $status,
            'tabel' => $this->post('table'),
            'message' => $message,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    public function del_get()
    //example : /api/data/del?table=tes&id=1
    {
        $id = $this->get('id_table');
        $db = $this->db->delete($this->get('table'), [$id => $this->get('id')]);

        if ($this->db->affected_rows() > 0)
        {
            $this->set_response([
                'status' => TRUE,'id' => $this->get('id'),
                'message' => 'data terhapus'], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,'id' => $this->get('id'),
                'message' => 'gagal menghapus'], REST_Controller::HTTP_OK);
        }
    }

    public function del_custom_get()
    //example : /api/data/del?table=tes&id=1
    {
        $db = $this->db->delete($this->get('table'), [$this->get('kolom') => $this->get('value')]);

        if ($this->db->affected_rows() > 0)
        {
            $this->set_response([
                'status' => TRUE,'id' => $this->get('id'),
                'message' => 'data terhapus'], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => FALSE,'id' => $this->get('id'),
                'message' => 'gagal menghapus'], REST_Controller::HTTP_OK);
        }
    }

    public function get_sql_get()
    //example : /api/data/get_where?table=tes&id=1
    {
        $data = $this->db->query($this->get('sql'))->result_array();
        $this->response([
            'status' => TRUE,
            'data' => $data], REST_Controller::HTTP_OK);
    }

    ///////////////////////////////// data users //////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    public function users_get() //view data
    {

        $id = $this->get('id');

        if ($id === NULL)
        {
            $users = $this->db->get('user')->result_array();
            if ($users)
            {
                $this->response([
                'status' => TRUE,
                'data' => $users], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                'status' => FALSE,
                'data' => $users,
                'message' => 'user tidak ditemukan'], REST_Controller::HTTP_OK);
            }
        }
        else
        {
            $users = $this->db->get_where('user', ['id' => $id])->result_array();
            if ($users)
            {
                $this->response([
                'status' => TRUE,
                'data' => $users], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                'status' => FALSE,
                'data' => $users,
                'message' => 'user tidak ditemukan'], REST_Controller::HTTP_OK); 
            }
        }
    }

    public function users_post() //add data
    {
        $user = $this->post('user');

        $cek = $this->db->query('SELECT * FROM user WHERE user="'.$user.'"')->num_rows();
        if ($cek > 0) 
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'user sudah ada'], REST_Controller::HTTP_OK);
        } else {
            $data = [
            'id' => NULL,
            'user' => $this->post('user'),
            'fullname' => $this->post('fullname'),
            'pass' => $this->post('pass'),
            'email' => $this->post('email'),
            'level' => $this->post('level')
            ];
            if(!empty($_FILES['photo']['name']))
            {
                $path = 'upload/';
                $type = 'jpeg|jpg|png';
                $name = round(microtime(true) * 1000);
                $field = 'photo';
                $upload = $this->_do_upload($path,$type,$name,$field);
                $data['photo'] = $upload;
            }else{
                $data['photo'] = "";
            }
             
            $this->db->insert('user', $data);
            
            if ($this->db->affected_rows() > 0)
            {
                $this->set_response([
                    'status' => TRUE,
                    'message' => 'user berhasil ditambahkan'], REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'user gagal ditambahkan'], REST_Controller::HTTP_OK);
            }
        }
    }

    public function edit_users_post() //edit data
    {
        $id = $this->post('id');
        $user = $this->post('user');
        
        $cek = $this->db->query('SELECT * FROM user WHERE id<>"'.$id.'" AND id IN (SELECT id FROM user WHERE user="'.$user.'")')->num_rows();
        if ($cek > 0) 
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'user sudah ada'], REST_Controller::HTTP_OK);
        } else {
            $data = [
                'user' => $this->post('user'),
                'fullname' => $this->post('fullname'),
                'pass' => $this->post('pass'),
                'email' => $this->post('email'),
                'level' => $this->post('level')
            ];
            if(!empty($_FILES['photo']['name']))
            {
                $path = 'upload/';
                $type = 'jpeg|jpg|png';
                $name = round(microtime(true) * 1000);
                $field = 'photo';
                $upload = $this->_do_upload($path,$type,$name,$field);
                $data['photo'] = $upload;
            }
            
            $this->db->update('user', $data, ['id' => $id]);
            
            if ($this->db->affected_rows() > 0)
            {
                $this->set_response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'data user berhasil diubah'], REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'data user gagal diubah'], REST_Controller::HTTP_OK);
            }
        }
    }

    public function del_users_post() //delet data
    {
        $id = $this->post('id');
        if ($id === NULL)
        {
            $this->response([
                'status' => FALSE,
                'message' => 'masukkan id'], REST_Controller::HTTP_OK);
        } else {
            $this->db->delete('user', ['id' => $id]);

            if ($this->db->affected_rows() > 0)
            {
                $this->set_response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'data berhasil terhapus'], REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'id' => $id,
                    'message' => 'id tidak ada'], REST_Controller::HTTP_OK);
            }
        }
    }


    /////////////////////////////// fungsi login ///////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    public function login_get() //fungsi login
    {
        
        $user = $this->get('user');
        $pass = $this->get('pass');
        
        if ($user && $pass != NULL)
        {
            $users = $this->db->get_where('user', ['user' => $user, 'pass' => $pass])->result_array();
            
            if ($this->db->affected_rows() > 0)
            {
                $this->db->select('user,fullname,pass,email,level,photo');
                $this->db->from('user');
                $this->db->where('user',$user);
                $this->db->where('pass',$pass);
                
                if ($this->db->affected_rows() > 0)
                {
                    $this->response([
                        'status' => TRUE,
                        'data' => $users,], REST_Controller::HTTP_OK);
                    }else{
                        $this->response([
                            'status' => TRUE,
                            'data' => $users,], REST_Controller::HTTP_OK);
                        }
                    } else {
                        $this->response([
                            'status' => FALSE,
                            'message' => 'username atau password salah'], REST_Controller::HTTP_OK);
                        }
                    } else {
                        $this->response([
                            'status' => FALSE,
                            'message' => 'username atau password tidak boleh kosong'], REST_Controller::HTTP_OK);
                        }
                    }
                    
                    //////////////////////////////// upload /////////////////////////////
                    /////////////////////////////////////////////////////////////////////
                    /////////////////////////////////////////////////////////////////////
                    private function _do_upload($path,$type,$name,$field) //upload
                    {
                        $config['upload_path']          = $path;
                        // $config['upload_path']          = 'upload/';
                        $config['allowed_types']        = $type;
                        // $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 2048; //set max size allowed in Kilobyte
                        // $config['max_width']            = 1000; // set max width image allowed
                        // $config['max_height']           = 1000; // set max height allowed
                        $config['file_name']            = $name; //just milisecond timestamp fot unique name
                        // $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
                        
                        $this->load->library('upload', $config);

                        if(!$this->upload->do_upload($field)) //upload and validate
                        {
                            $data['inputerror'][] = $field;
                            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    
    public function bukti_post() //fungsi login
    {
        $id = $this->post("id_skp");
        if(!empty($_FILES['image']['name']))
        {
            $path = 'assets/img/bukti/';
            $type = 'jpeg|jpg|png';
            $name = round(microtime(true) * 1000);
            $field = 'image';
            $upload = $this->_do_upload($path,$type,$name,$field);
            $data['image'] = $upload;
            $this->db->query("INSERT IGNORE INTO `bukti_pembayaran`(`id`, `id_skp`, `image`) VALUES (null,'".$id."','".$data['image']."')");
            if ($this->db->affected_rows() > 0)
            {
                $this->set_response([
                    'status' => TRUE,
                    'message' => 'berhasil diupload bukti pembayaran'], REST_Controller::HTTP_OK);
            } else {
                $this->db->query("UPDATE `bukti_pembayaran` SET `image` = '".$data['image']."' WHERE `id_skp` = '".$id."';");
                if ($this->db->affected_rows() > 0)
                {
                    $this->set_response([
                        'status' => TRUE,
                        'message' => 'berhasil diupload bukti pembayaran'], REST_Controller::HTTP_OK);
                } else {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'gagal mengupload bukti pembayaran'], REST_Controller::HTTP_OK);
                }
            }
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'gambar masih kosong'], REST_Controller::HTTP_OK);
        }
            
    }

    public function upload_post() //fungsi login
    {
        $id = $this->post("id_skp");
        if(!empty($_FILES['image']['name']))
        {
            $path = 'assets/img/upload/';
            $type = 'jpeg|jpg|png';
            $name = round(microtime(true) * 1000);
            $field = 'image';
            $upload = $this->_do_upload($path,$type,$name,$field);
            $data['image'] = $upload;
            $this->db->query("INSERT IGNORE INTO `bukti_servis`(`id_servis`, `id_skp`, `image`) VALUES (null,'".$id."','".$data['image']."')");
            if ($this->db->affected_rows() > 0)
            {
                $this->set_response([
                    'status' => TRUE,
                    'message' => 'berhasil diupload upload'], REST_Controller::HTTP_OK);
            } else {
                $this->db->query("UPDATE `bukti_servis` SET `image` = '".$data['image']."' WHERE `id_skp` = '".$id."';");
                if ($this->db->affected_rows() > 0)
                {
                    $this->set_response([
                        'status' => TRUE,
                        'message' => 'berhasil diupload upload'], REST_Controller::HTTP_OK);
                } else {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'gagal mengupload upload'], REST_Controller::HTTP_OK);
                }
            }
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'gambar masih kosong'], REST_Controller::HTTP_OK);
        }
            
    }
    
    
}
