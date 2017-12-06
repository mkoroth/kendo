<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author by Max M
 * Date: 2017-11-18
 */

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class TrailerPallets extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        //load user model
        $this->load->model('trailerpallet');
    }

    public function index_get() {
        $trailer_id =(isset($_REQUEST['TrailerId']) ? $_REQUEST['TrailerId'] : NULL);
        if($trailer_id){
            //For the mobile device return trailer pallet
            $trailerpallets = $this->trailerpallet->getRows($trailer_id);

            //check if the user data exists
            if(!empty($trailerpallets)){
                //set the response and exit
				$responce = new stdClass();
				$responce->results = $trailerpallets;
                $this->response($responce, REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No trailer pallets were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }

        } else {
            // this is for the ADMIN display
            $trailerpallets = $this->trailerpallet->getAdminRows();
            $ret['data'] = $trailerpallets;
            echo json_encode($ret);
        }

    }

    public function index_put() {
        // Not applicable for this project
        $this->response([
            'status' => TRUE,
            'message' => 'Not applicable for this project.'
        ], REST_Controller::HTTP_OK);
    }

    /*
     * Load pallet onto a trailer
     */
    public function index_post() {
        $trailerpalletData = array();
        $json_body = file_get_contents('php://input');
        parse_str($json_body, $trailerpalletData);
        $pallet_num = $trailerpalletData['PalletNum'];
        unset($trailerpalletData['PalletNum']); // TODO - change to proper REST

        if(!empty($pallet_num) && !empty($trailerpalletData['TrailerId'])){
            //insert user data
            $update = $this->trailerpallet->update($trailerpalletData, $pallet_num);

            //check if the user data inserted
            if($update){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Pallet has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Failed to update record, please try again.'
                ], REST_Controller::HTTP_OK);
            }
        }else{
            //set the response and exit
            $this->response([
                'status' => TRUE,
                'message' => 'Provide complete Pallet/Trailer information to update.'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_delete() {
        // Not applicable for this project
        $this->response([
            'status' => TRUE,
            'message' => 'Not applicable for this project.'
        ], REST_Controller::HTTP_OK);
    }


}