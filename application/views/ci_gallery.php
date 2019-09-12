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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    <script src="assets/Dropzone/dropzone.js"></script>
    <script src="https://kit.fontawesome.com/bae0b397aa.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
    <script>
//Disabling autoDiscover
Dropzone.autoDiscover = false;

$(function() {
    //Dropzone class
    var myDropzone = new Dropzone(".dropzone", {
		url: "uploadimg",
        addRemoveLinks: true,
		paramName: "file",
		maxFilesize: 60,
		maxFiles: 10,
		acceptedFiles: "image/*",
		autoProcessQueue: false
	});
    
	$('#startUpload').click(function(){           
		myDropzone.processQueue();
        window.location.href = "<?php echo site_url('Ci_gallery'); ?>";
	});
    
        myDropzone.on("error", function (data) {
        $("#msg").html('<div class="alert alert-danger"></div>');
    });
        
   

});
</script>

    <title>CI_Gallery</title>
</head>
<body>
<?php $msg = $this->session->flashdata('msg'); ?> 
<div class="d-md-flex h-md-100 align-items-center">


<!-- First Half -->

<div class="col-md-6 p-0  h-md-100">
    <div class="col-md-12 justify-content-center">
        <div class="logoarea pt-5 pb-5 ">
        
       
   
       <!-- Dropzone -->
       <div class="dropzone mw-100"></div>
       <br>
       <button id="startUpload" class="btn btn-success col-md-3"><i class="fas fa-upload"></i> UPLOAD</button>
   
        </div>
    </div>
</div>

<!-- Second Half -->

<div class="col-md-6 p-0 bg-white h-md-100 ">
    <?php echo $msg ; ?> 
    <div class="d-md-flex align-items-center h-md-100 p-5 justify-content-center">
            <!-- Swiper -->
            <div class="swiper-container">
          <div class="swiper-wrapper">
      <?php if (!(isset($result))) { 
      echo"<img src='assets/images/no_image_available.jpg'>" ;}
        
        else{
            foreach ($result as $val) {
     echo " <div class='swiper-slide' >
            <img src='assets/uploads/".$val->img_name."' alt=''  style='heught:100%; width:100%'>
            </div>";
        }
            } ?> 
    </div>
      <!-- Add Pagination -->
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>        
      </div>
      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev swiper-button-white"></div>
      <div class="swiper-button-next swiper-button-white"></div>
    </div>

    
</div>
    
</div>


  <!--to close messages in 3"  -->
  <script>
    window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
    }, 3000); 
    </script>
    <!--    -->   
    <script>
 // Params
var sliderSelector = '.swiper-container',
    options = {
      init: false,
      loop: true,
      speed:800,
      slidesPerView: 2, // or 'auto'
      // spaceBetween: 10,
      centeredSlides : true,
      effect: 'coverflow', // 'cube', 'fade', 'coverflow',
      coverflowEffect: {
        rotate: 50, // Slide rotate in degrees
        stretch: 0, // Stretch space between slides (in px)
        depth: 100, // Depth offset in px (slides translate in Z axis)
        modifier: 1, // Effect multipler
        slideShadows : true, // Enables slides shadows
      },
      grabCursor: true,
      parallax: true,
      pagination: 
		{
			el: '.swiper-pagination',
			dynamicBullets: true,
		},
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      autoplay: 
    {
      delay: 2000,
    },
      breakpoints: {
        1023: {
          slidesPerView: 1,
          spaceBetween: 0
        }
      },
      loop: true,
      // Events
      on: {
        imagesReady: function(){
          this.el.classList.remove('loading');
        }
      }
    };
var mySwiper = new Swiper(sliderSelector, options);

// Initialize slider
mySwiper.init();
  </script>
    
</body>

</html>