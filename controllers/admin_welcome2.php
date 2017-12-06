<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_welcome2 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('admin/welcome_message2');
//		$this->load->view('welcome_message');
	}

    public function get_skus() {
        $this->load->model('package');
        $pallet_num = (isset($_REQUEST['PalletNum']) ? $_REQUEST['PalletNum'] : NULL);
        //check if the pallet data exists
        if(!empty($pallet_num)){
            $packages = $this->package->get_pallet_skus($pallet_num);
            //set the response and exit
            $ret['data'] = $packages;
            echo json_encode($ret);
        }else{
            //set the response and exit
            echo 'Pallet number not provided.';
        }
    }
}
