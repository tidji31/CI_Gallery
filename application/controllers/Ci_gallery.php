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
      $config['upload_path'] = FCPATH .'assets/uploads/'; 
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['max_size'] = '61440'; // max_size in kb 30m
      $config['file_name'] = $_FILES['file']['name'];
      //whatermarked
      
 
        //Load upload library
        $this->load->library('upload',$config); 
        $this->session->set_flashdata('msg', '<div class="alert alert-success col-md-6">Your image has been uploaded successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        // File upload
        if($this->upload->do_upload('file')){    
        // Get data about the file
        $uploadData = $this->upload->data();
        $image_name = $uploadData['file_name'];
        //Insert image name in database  
        $this->Ci_galleryM->photoupload($image_name);
        redirect('Ci_gallery');
    
        }else{
        $this->session->set_flashdata('msg', '<div class="alert alert-danger col-md-6">Image not uploaded 2 !! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('Ci_gallery');
             }
    }
 
  }


                              
    
    
    




}