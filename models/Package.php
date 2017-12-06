<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author by Max M
 * Date: 2017-11-18
 */

class Package extends CI_Model{

    public function __construct() {
        parent::__construct();

        //load database library
        $this->load->database();
    }

    /*
     * Fetch Package data
     */
    function getRows($sku = ""){
        if(!empty($sku)){
            $query = $this->db->get_where('packages', array('SKU' => $sku));
            return $query->row_array();
        }else{
            $query = $this->db->get('packages');
            return $query->result_array();
        }
    }

    /*
     * Insert Package data
     */
    public function insert($data = array()) {
        $data['TimeOffTrailer'] = date("Y-m-d H:i:s");
        $insert = $this->db->insert('packages', $data);
        return $insert?true:false;
    }

    /*
     * Update Package data
     */
    public function update($data, $sku) {
        $data['TimeOnPallet'] = date("Y-m-d H:i:s");
//        print_r($data);
        $update = $this->db->update('packages', $data, array('SKU'=>$sku));
        return $update?true:false;

    }

    /*
     * Delete Package data
     */
    public function delete($sku){
        $delete = $this->db->delete('packages',array('SKU'=>$sku));
        return $delete?true:false;
    }

    function get_pallet_skus($pallet_num = ""){
        if(!empty($pallet_num)){
            $query = $this->db->get_where('packages', array('PalletNum' => $pallet_num));
            return $query->row_array();
        }else{
            return [];
        }
    }


}