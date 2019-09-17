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
    
      public function watermarking($image_name){
                                  
          $config['source_image'] = 'assets/uploads/'.$image_name;
          $config['wm_text'] = 'CI_Gallery';
          $config['wm_type'] = 'text';
          $config['wm_font_path'] = './system/fonts/texb.ttf';
          $config['wm_font_size'] = '64';
          $config['wm_font_color'] = '343a40';
          $config['wm_vrt_alignment'] = 'middle';
          $config['wm_hor_alignment'] = 'center';
          $config['wm_padding'] = '20';

          $this->image_lib->initialize($config);
          
          if ( ! $this->image_lib->watermark())
        {
        echo $this->image_lib->display_errors();
        }
                                      

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
      
 
        
        //check if image exist
        $chek=$this->Ci_galleryM->chek($_FILES['file']['name']);
        if ($chek === FALSE){
            //Load upload library
        $this->load->library('upload',$config);
           // File upload
        if($this->upload->do_upload('file')){    
          // Get data about the file
          $uploadData = $this->upload->data();
          $image_name = $uploadData['file_name'];
          
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


      public function deletetheimage(){
        $path='assets/uploads/'.$this->input->post('path');
        $id=$this->input->post('id');
        if (!unlink($path)) {
          echo ("Error deleting $path");
        } else {
          $this->Ci_galleryM->delete($id);
          $this->session->set_flashdata('msg', '<div class="alert alert-warning col-md-6"> The image has bean deleted <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          
        }

      }           
    
    
    




}