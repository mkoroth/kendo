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
        $device_id = (isset($_REQUEST['deviceId']) ? $_REQUEST['deviceId'] : NULL);

        if(!empty($device_id)) {
            $packages = $this->ActionLog->getRows($device_id);

            //check if the user data exists
            if (!empty($packages)) {
                //set the response and exit
                $this->response($packages, REST_Controller::HTTP_OK);
            } else {
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No Logs were found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->response("DeviceId is required.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put() {
        $logData = array();
        $logData['deviceId'] = (isset($_REQUEST['deviceId']) ? $_REQUEST['deviceId'] : NULL);
        $logData['msg'] = (isset($_REQUEST['msg']) ? $_REQUEST['msg'] : NULL);

        if(!empty($logData['deviceId']) && !empty($logData['msg'])){
            //insert user data
            $insert = $this->ActionLog->insert($logData);
            //check if the user data inserted
            if($insert){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Log entry has been added successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Failed to create record, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete log information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_post() {
        // Not applicable for this project
        $this->response("Not applicable for this project.", REST_Controller::HTTP_BAD_REQUEST);
    }

    public function index_delete() {
        // Not applicable for this project
        $this->response("Not applicable for this project.", REST_Controller::HTTP_BAD_REQUEST);

    }

}