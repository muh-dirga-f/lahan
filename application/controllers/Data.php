<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Data extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
    }

    public function kecamatan()
    {
        $this->global['pageTitle'] = 'Kecamatan';
        $this->global['list_kecamatan'] = $this->db->get('kecamatan')->result_array();

        $this->loadViews("data/kecamatan", $this->global, NULL, NULL);
    }

    public function perkebunan()
    {
        $this->global['pageTitle'] = 'Perkebunan';
        $this->global['list_perkebunan'] = $this->db->from('perkebunan as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->get()->result_array();

        $this->loadViews("data/perkebunan", $this->global, NULL, NULL);
    }

    public function perkebunan_view()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Detail Perkebunan';
        $this->global['list_perkebunan'] = $this->db->from('perkebunan as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_perkebunan', $id)->get()->result_array();
        $this->global['list_perkebunan_data'] = $this->db->get('perkebunan_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_perkebunan'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/perkebunan');
        $this->global['id'] = $id;

        $this->loadViews("data/perkebunan_view", $this->global, NULL, NULL);
    }

    public function perkebunan_add()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Tambah Perkebunan';
        $this->global['list_perkebunan'] = $this->db->from('perkebunan as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_perkebunan', $id)->get()->result_array();
        $this->global['list_perkebunan_data'] = $this->db->get('perkebunan_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_perkebunan'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/perkebunan_view?id='.$id);
        $this->global['id'] = $id;

        $this->loadViews("data/perkebunan_add", $this->global, NULL, NULL);
    }

    public function pertanian()
    {
        $this->global['pageTitle'] = 'Pertanian';
        $this->global['list_pertanian'] = $this->db->from('pertanian as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->get()->result_array();

        $this->loadViews("data/pertanian", $this->global, NULL, NULL);
    }

    public function pertanian_view()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Detail Pertanian';
        $this->global['list_pertanian'] = $this->db->from('pertanian as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_pertanian', $id)->get()->result_array();
        $this->global['list_pertanian_data'] = $this->db->get('pertanian_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_pertanian'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/pertanian');
        $this->global['id'] = $id;

        $this->loadViews("data/pertanian_view", $this->global, NULL, NULL);
    }

    public function pertanian_add()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Tambah Pertanian';
        $this->global['list_pertanian'] = $this->db->from('pertanian as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_pertanian', $id)->get()->result_array();
        $this->global['list_pertanian_data'] = $this->db->get('pertanian_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_pertanian'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/pertanian_view?id='.$id);
        $this->global['id'] = $id;

        $this->loadViews("data/pertanian_add", $this->global, NULL, NULL);
    }

    public function perikanan()
    {
        $this->global['pageTitle'] = 'Perikanan';
        $this->global['list_perikanan'] = $this->db->from('perikanan as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->get()->result_array();

        $this->loadViews("data/perikanan", $this->global, NULL, NULL);
    }

    public function perikanan_view()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Detail Perikanan';
        $this->global['list_perikanan'] = $this->db->from('perikanan as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_perikanan', $id)->get()->result_array();
        $this->global['list_perikanan_data'] = $this->db->get('perikanan_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_perikanan'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/perikanan');
        $this->global['id'] = $id;

        $this->loadViews("data/perikanan_view", $this->global, NULL, NULL);
    }

    public function perikanan_add()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Tambah Perikanan';
        $this->global['list_perikanan'] = $this->db->from('perikanan as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_perikanan', $id)->get()->result_array();
        $this->global['list_perikanan_data'] = $this->db->get('perikanan_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_perikanan'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/perikanan_view?id='.$id);
        $this->global['id'] = $id;

        $this->loadViews("data/perikanan_add", $this->global, NULL, NULL);
    }

    public function industri()
    {
        $this->global['pageTitle'] = 'Industri';
        $this->global['list_industri'] = $this->db->from('industri as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->get()->result_array();

        $this->loadViews("data/industri", $this->global, NULL, NULL);
    }

    public function industri_view()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Detail Industri';
        $this->global['list_industri'] = $this->db->from('industri as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_industri', $id)->get()->result_array();
        $this->global['list_industri_data'] = $this->db->get('industri_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_industri'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/industri');
        $this->global['id'] = $id;

        $this->loadViews("data/industri_view", $this->global, NULL, NULL);
    }

    public function industri_add()
    {
        $id = $this->input->get('id');
        $this->global['pageTitle'] = 'Tambah Industri';
        $this->global['list_industri'] = $this->db->from('industri as t1')->join('kecamatan as t2', 't1.id_kecamatan = t2.id_kec', 'LEFT')->where('t1.id_industri', $id)->get()->result_array();
        $this->global['list_industri_data'] = $this->db->get('industri_data')->result_array();
        $this->global['kecamatan'] = $this->db->get_where('kecamatan', ['id_kec' => $this->global['list_industri'][0]['id_kecamatan']])->result_array();
        $this->global['url_back'] = base_url('data/industri_view?id='.$id);
        $this->global['id'] = $id;

        $this->loadViews("data/industri_add", $this->global, NULL, NULL);
    }
}
