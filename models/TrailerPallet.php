<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author by Max M
 * Date: 2017-11-18
 */

class TrailerPallet extends CI_Model{

    public function __construct() {
        parent::__construct();

        //load database library
        $this->load->database();
    }

    /*
     * Fetch Trailer/Pallet data
     */
    function getRows($trailer_id = ""){
        if(!empty($trailer_id)){
            $query = $this->db->get_where('trailerpallets', array('TrailerId' => $trailer_id));
            return $query->result();
        }else{
            // TODO - possibly need paging here and need to know filter parameters
            $query = $this->db->get('trailerpallets');
            return $query->result_array();
        }
    }

    /*
     * Insert Package data
     */
    public function insert($data = array()) {
        $data['TimeCreated'] = date("Y-m-d H:i:s");
        $insert = $this->db->insert('trailerpallets', $data);
        return $insert?true:false;
    }

    /*
     * Update Package data
     */
    public function update($data, $pallet_num) {
        $data['TimeLoaded'] = date("Y-m-d H:i:s");
        $update = $this->db->update('trailerpallets', $data, array('PalletNum'=>$pallet_num));
        return $update?true:false;
    }

    /*
     * Delete Package data
     */
    public function delete($pallet_num){
        $delete = $this->db->delete('trailerpallets',array('PalletNum'=>$pallet_num));
        return $delete?true:false;
    }

    /*
     * Check id pallet number already exist
     */
    public function pallet_exist($pallet_num){
        $query = $this->db->get_where('trailerpallets', array('PalletNum' => $pallet_num));
        $pallet = $query->row_array();
        return $pallet?true:false;
    }


    /*
     * Fetch Trailer/Pallet data for the admin grid - need limits and pages data
     */
    function getAdminRows(){
        $this->db->from('trailerpallets');
        $this->db->order_by("TimeCreated", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function admin_update($trailer_id, $pallet_num) {
        $update = $this->db->update('trailerpallets', ["TrailerId"=>$trailer_id], array('PalletNum'=>$pallet_num));
        return $update?true:false;
    }
}