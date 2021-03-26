<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

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

    public function hutan_lindung()
    {
        $this->global['pageTitle'] = 'Luas Hutan Lindung';
        
        $this->loadViews("data/hutan_lindung", $this->global, NULL , NULL);
    }
}