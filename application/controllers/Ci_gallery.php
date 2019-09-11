<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ci_gallery extends CI_Controller{ 
    
    public function index() {
    
             // Page title
             $data['title']="CI_Gallery";

             //Fetch all images from database
             $query = $this->Ci_galleryM->getGallery();
             if(!empty($query)){
             $data['result'] = $query;
                               }
        /*
             $this->form_validation->set_rules('email','email', 'trim|required');
             $this->form_validation->set_rules('pwd','mot de passe', 'trim|required');
       */
      
          
             $this->load->view('ci_gallery',$data);

                               }
    
      
    
        
        // File upload
  public function uploadimg(){

    if(!empty($_FILES['file']['name'])){
 
      // Set preference
      $config['upload_path'] = 'assets/uploads/'; 
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['max_size'] = '30720'; // max_size in kb 30m
      $config['file_name'] = $_FILES['file']['name'];
 
      //Load upload library
      $this->load->library('upload',$config); 
 
      // File upload
      if($this->upload->do_upload('file')){
        // Get data about the file
        $uploadData = $this->upload->data();
        $image_name = $uploadData['file_name'];
        $this->Ci_galleryM->photoupload($image_name);
      }
    }
 
  }


                              
    
    
    




}