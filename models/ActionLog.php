<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author by Max M
 * Date: 2017-11-18
 */

class ActionLog extends CI_Model{

    public function __construct() {
        parent::__construct();

        //load database library
        $this->load->database();
    }

    /*
     * Fetch Log data
     */
    function getRows($device_id = ""){
        if(!empty($device_id)){
            $query = $this->db->get_where('logs', array('deviceId' => $device_id));
            return $query->row_array();
        }else{
            $query = $this->db->get('logs');
            return $query->result_array();
        }
    }

    /*
     * Insert Log data
     */
    public function insert($data = array()) {
        $data['dateCreated'] = date("Y-m-d H:i:s");
        $insert = $this->db->insert('logs', $data);
        return $insert?true:false;
    }

    /*
     * Update Log data
     */
    public function update() {

    }

    /*
     * Delete Log data
     */
    public function delete(){

    }


}