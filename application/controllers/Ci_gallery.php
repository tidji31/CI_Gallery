<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class                          Ci_gallery extends CI_Controller{ 
   
                               //function to get the application view
                               public function index() {
    
                               // Page title
                               $data['title']="CI_Gallery";

                               //Fetch all images from database
                               $query                   = $this->Ci_galleryM->getGallery();
                               if(!empty($query)){
                               $data['result']          = $query;
                               }

                               $this->load->view('ci_gallery',$data);

                               }

                               //function to matermark the image
                               public function watermarking($image_name){
                                  
                               $config['source_image']     = 'assets/uploads/'.$image_name;
                               $config['wm_text']          = 'CI_Gallery';
                               $config['wm_type']          = 'text';
                               $config['wm_font_path']     = './system/fonts/texb.ttf';
                               $config['wm_font_size']     = '64';
                               $config['wm_font_color']    = '343a40';
                               $config['wm_vrt_alignment'] = 'middle';
                               $config['wm_hor_alignment'] = 'center';
                               $config['wm_padding']       = '20';

                               $this->image_lib->initialize($config);
          
                               if ( ! $this->image_lib->watermark())
                               {
                               echo $this->image_lib->display_errors();
                               }
                                      

                               }
    
        
                               // function to uppload the image and add  row image in database
                               public function uploadimg(){

                               if(!empty($_FILES['file']['name'])){
                               // Set preference
                               $config['upload_path']         = FCPATH .'assets/uploads/'; 
                               $config['allowed_types']       = 'jpg|jpeg|png|gif';
                               $config['max_size']            = '61440'; // max_size in kb 30m
                               $config['file_name']           = $_FILES['file']['name'];
                               //check if image exist
                               $chek=$this->Ci_galleryM->chek($_FILES['file']['name']);
                               if ($chek                      === FALSE){
                               //Load upload library
                               $this->load->library('upload',$config);
                               // File upload
                               if($this->upload->do_upload('file')){    
                               // Get data about the file
                               $uploadData                    = $this->upload->data();
                               $image_name                    = $uploadData['file_name'];
          
                               //Insert image name in database  
                               $this->Ci_galleryM->photoupload($image_name);
                               //watermarking image 
                               $this->watermarking($image_name);

                               $this->session->set_flashdata('msg', '<div class="alert alert-success col-md-6">Your image has been uploaded successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          
                               }
                               else{
                               $this->session->set_flashdata('msg', '<div class="alert alert-danger col-md-6">Image not uploaded  !! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          
                               }
                               }else{
                               $this->session->set_flashdata('msg', '<div class="alert alert-danger col-md-6">this file already exists !! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      
                               }

       


                               }
 
                               }

                               // function to delete the image selected from upload repertory and database
                               public function deletetheimage(){
                               $path='assets/uploads/'.$this->input->post('path');
                               $id=$this->input->post('id');
                               if (!unlink($path)) {
                               echo ("Error deleting $path");
                               $this->session->set_flashdata('msg', '<div class="alert alert-warning col-md-6"> Error deleting  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                               } else {
                               $this->Ci_galleryM->delete($id);
                               $this->session->set_flashdata('msg', '<div class="alert alert-warning col-md-6"> The image has bean deleted <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          
                               }

                               } 


                               // function to resize the image selected           
                               public function resizetheimage(){
                               $path=$this->input->post('path');
                               $w=$this->input->post('w');
                               $h=$this->input->post('h');
                               if (!isset($w) && !isset($h) && !isset($path)  ) 
                               {
                               echo ("Error resizing ");
                               $this->session->set_flashdata('msg', '<div class="alert alert-danger col-md-6"> Error resizing !! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                               }else{
                               $config['image_library']      = 'gd2';
                               $config['source_image']       = 'assets/uploads/'.$path;
                               $config['create_thumb']       = FALSE;
                               $config['maintain_ratio']     = FALSE;
                               $config['width']              = $w;
                               $config['height']             = $h;
    
                               $this->image_lib->clear();
                               $this->image_lib->initialize($config);
                               $this->image_lib->resize();
                               $this->session->set_flashdata('msg', '<div class="alert alert-warning col-md-6"> The image has bean resized <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                               }
     
                               }

                               //function to get width and height from image selected 
                               public function getimagesize(){
    
                               $path='assets/uploads/'.$this->input->post('name');;
                               if (!file_exists($path)) {
                               echo ("Error deleting $path");
                               } else {
                               list($width, $heigth)=getimagesize($path);
                               $response=array('width'=>$width,'heigth'=>$heigth);
                               echo json_encode($response);
                               }
      


                               }
    




}