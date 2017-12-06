<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author by Max M
 * Date: 2017-11-18
 */

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Logs extends REST_Controller {


    function __construct() {
        // Construct the parent class
        parent::__construct();

        //load user model
        $this->load->model('ActionLog');
    }



    public function index_get() {

    }

    public function index_put() {

    }

    public function index_post() {
        $pallet = (isset($_REQUEST['PalletNum']) ? $_REQUEST['PalletNum'] : NULL);
        $trailer_id = (isset($_REQUEST['TrailerId']) ? $_REQUEST['TrailerId'] : NULL);

        if($pallet && $trailer_id){

        }


    }

    public function index_delete() {
        // Not applicable for this project
        $this->response("Not applicable for this project.", REST_Controller::HTTP_BAD_REQUEST);

    }

}