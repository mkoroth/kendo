<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author by Max M
 * Date: 2017-11-18
 */

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Packages extends REST_Controller {


    function __construct() {
        // Construct the parent class
        parent::__construct();

        //load  models
        $this->load->model('package');
        $this->load->model('trailerpallet');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        //TODO
//        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
//        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
//        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }



    public function index_get() {
        $sku = (isset($_REQUEST['SKU']) ? $_REQUEST['SKU'] : NULL);
        //returns all rows if the id parameter doesn't exist,
        //otherwise single row will be returned
        $packages = $this->package->getRows($sku);

        //check if the package data exists
        if(!empty($packages)){
            //set the response and exit
            $this->response($packages, REST_Controller::HTTP_OK);
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No packages were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put() {
        $packageData = array();

        $json_body = file_get_contents('php://input');
        parse_str($json_body, $packageData);

        if(!empty($packageData['SKU']) && !empty($packageData['DestinationCode'])){
            //insert package data
            $insert = $this->package->insert($packageData);
            //check if the package data inserted
            if($insert){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Package has been added successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Failed to create record, please try again.'
                ], REST_Controller::HTTP_OK);
            }
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Provide complete package information to create.'.$packageData['SKU'].$packageData['DestinationCode']
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_post() {
        $packageData = array();

        $json_body = file_get_contents('php://input');
        parse_str($json_body, $packageData);
        $sku = $packageData["SKU"];
        unset($packageData['SKU']); //TODO - change this to proper

//        $sku = (isset($_REQUEST['SKU']) ? $_REQUEST['SKU'] : NULL);
//        $json['PalletNum'] = (isset($_REQUEST['PalletNum']) ? $_REQUEST['PalletNum'] : NULL);
//        $json['DestinationCode'] = (isset($_REQUEST['DestinationCode']) ? $_REQUEST['DestinationCode'] : NULL);

        if(!empty($sku) && !empty($packageData["PalletNum"]) && !empty($packageData["DestinationCode"])){
            $insert = true;
            //insert package data
            $update = $this->package->update($packageData, $sku);

            // add pallet to the pallettrailer table
            if(!$this->trailerpallet->pallet_exist($packageData["PalletNum"])){
                $insert = $this->trailerpallet->insert($packageData);
            }

            //check if the package data inserted
            if($update && $insert){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Package has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Failed to update record, please try again.'
                ], REST_Controller::HTTP_OK);
            }
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'Provide complete package information to update.'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_delete() {
        // Not applicable for this project
        $this->response([
            'status' => FALSE,
            'message' => 'Not applicable for this project.'
        ], REST_Controller::HTTP_OK);

//        $sku = $_REQUEST['SKU'];
//
//        if($sku){
//            //delete post
//            $delete = $this->package->delete($sku);
//
//            if($delete){
//                //set the response and exit
//                $this->response([
//                    'status' => TRUE,
//                    'message' => 'Package has been removed successfully.'
//                ], REST_Controller::HTTP_OK);
//            }else{
//                //set the response and exit
//                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
//            }
//        }else{
//            //set the response and exit
//            $this->response([
//                'status' => FALSE,
//                'message' => 'No SKU were provided.'
//            ], REST_Controller::HTTP_NOT_FOUND);
//        }

    }

}