<?php

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
    
      
    public function uploadimg()  {
        
        if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
        
        // File upload configuration
        $uploadPath = 'assets/upload/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // Uploaded file data
        if ( ! $this->upload->do_upload('file'))
                                                    {
                                                     //vérifier les erreurs
                                                    $error = array('error' => $this->upload->display_errors());
                                                    $this->session->set_flashdata('verifier_photo', '<div class="alert alert-danger text-center">'.$this->upload->display_errors().'</div>');
                                                    redirect('Ci_gallery');
                                                    }
       else
                                                    {
                                                    //télécharger la photo
                                                    $upload_data = $this->upload->data();
                                                    $image_name = $upload_data['file_name'];
                                                    $this->Ci_galleryM->photoupload($imagename);
                                                    $this->session->set_flashdata('verifier_photo', '<div class="alert alert-success text-center">votre photo de profile a été ajouté</div>');
                                                    redirect('Ci_gallery');
                                                    }
   
                                        }
                                    }


                              
    
    
    




}