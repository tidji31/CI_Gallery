<?php
class Ci_galleryM extends CI_Model
{
    public function getGallery(){
        return $this->db->get('images')->result();
    }

    public function photoupload($imagename){
     
        $data = array( 
            'img_name'	=>  $imagename, 
            'created'=> date("Y-m-d H:i:s")
           
        );
    $this-> db->insert_string('images', $data);

    }
 /*
    public function save($param){
        $data = array(
            'path' => $param['name'],
            'thumb_path' => $param['thumb']
        );
        $this->db->insert('gallery', $data);
    }

    public function reset(){
        $this->db->empty_table('gallery');
    }
    */
}