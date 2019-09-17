<?php
class Ci_galleryM extends CI_Model
{
    public function getGallery(){
    return $this->db->get('images')->result();
                                }



    public function photoupload($imagename){
    $data = array(
    'img_name'	=>  $imagename      
                 );
    $this->db->insert('images', $data);
    

                                          }
    public function chek($imagename){
        $this->db->where('img_name',$imagename);
        $query = $this->db->get('images');
        if ($query->num_rows() > 0){
        return true;
                                   }
        else{
        return false;
            }
                                     }
    public function delete($id){
               $this->db->where('id', $id);
        return $this->db->delete('images');
   

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