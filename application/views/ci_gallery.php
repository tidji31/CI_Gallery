<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/Dropzone/dropzone.css">
    <script src="assets/Dropzone/dropzone.js"></script>
    <script src="https://kit.fontawesome.com/bae0b397aa.js"></script>
    <script>
    // Add restrictions
    Dropzone.options.fileupload = {
      acceptedFiles: 'image/*',
      maxFilesize: 4 // MB
    };
    </script>
    <title>CI_Gallery</title>
</head>
<body>
<div class="d-md-flex h-md-100 align-items-center">


<!-- First Half -->

<div class="col-md-6 p-0  h-md-100">
    <div class="text-white d-md-flex align-items-center h-md-100 p-5   justify-content-center">
        <div class="logoarea pt-5 pb-5 ">
        
       
   
       <!-- Dropzone -->
       <form action="<?= base_url('uploadimg') ?>" class="dropzone" id="fileupload">
      </form> 
        <input type="button" id="fileSubmit" name="fileSubmit" value="Add" class="btn btn-primary mt-3">
   
        </div>
    </div>
</div>

<!-- Second Half -->

<div class="col-md-6 p-0 bg-white h-md-100 ">
    <div class="d-md-flex align-items-center h-md-100 p-5 justify-content-center">
    <?php foreach ($result as $val) {             
             echo " 
                  <div class='gallery'>   
                  <ul class='nav nav-pills'>
                  <li id='image_li_".$val->id."' class='ui-sortable-handle mr-2 mt-2'>
                  <div><a href='' class='img-link'><img src='assets/uploads/".$val->img_name." ' alt='' class='img-thumbnail' width='200' height='200'></a></div>
                  </li>
                  </ul>
                  </div>
               " ;}
             ?> 
    </div>
</div>
    
</div>


    
    
</body>

</html>