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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="assets/Dropzone/dropzone.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    <script src="assets/Dropzone/dropzone.js"></script>
   
    <script src="https://kit.fontawesome.com/bae0b397aa.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
    <script src="assets/js/ci_gallery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.2.5/jquery.bootstrap-touchspin.min.js"></script>
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
		maxFiles: 3,
		acceptedFiles: "image/*",
		autoProcessQueue: false,
    success: function (response) {
    window.location.href = "<?php echo site_url(); ?>";          
            }
	});
    
	$('#startUpload').click(function(){           
		myDropzone.processQueue();
        
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
        <div class="logoarea  mw-100 pt-5 pl-5 pr-5">
        
       
   
       <!-- Dropzone -->
       <div id ="dropzone"class="dropzone mw-100"></div>
       <br>
       <div class="">
       
       <button id="startUpload" class="btn btn-success col-md-3"><i class="fas fa-upload"></i> Upload</button>
       
       <blockquote contenteditable="true" style="font-size: 32px;">
       <p id="img-name"></p>
       </blockquote>
       </div>
       <div id="rd" class="pl-md-5  pt-5 pb-5 TH" style="display: none;">
       
       <img id="thum" name="" alt="" src="" class=" pb-5 ">  
       <button id="rename" class="RE" onclick="resize()" title='resize this image'><i class="fas fa-expand"></i></button>
       <button id="delete" class="DE" onclick="deleteimage()" title='delete this image' ><i class="far fa-trash-alt"></i></button>
       <button id="close" alt="close" onclick="rd()" class="CL" title='close this image'><i class="fas fa-window-close" ></i></button>
       
       <div class="SIZE">Width: <input id="sizew" name="size" alt="" type="text" class="form-control"  value=""> Heigth: <input id="sizeh" alt=""  name="size" type="text" class="form-control" value=""></div>
       
      </div>

       

        </div>
    </div>
</div>

<!-- Second Half -->

<div class="col-md-6 p-0 bg-white h-md-100 ">
    <?php echo $this->session->flashdata('msg'); ?> 
    <div class="d-md-flex align-items-center h-md-100 p-5 justify-content-center">
            <!-- Swiper -->
            <div class="swiper-container ">
          <div class="swiper-wrapper">
      <?php if (!(isset($result))) { 
      echo"<img src='assets/images/no_image_available.jpg'>" ;}
        
        else{
            foreach ($result as $val) {
     echo " <div class='swiper-slide'  >
            <img id='".$val->id."' name='".$val->img_name."' src='assets/uploads/".$val->img_name."' onclick='rd(this.src,this.alt,this.id,this.name)'' alt='".$val->img_name."'   style='heught:100%; width:100%'>
            </div>";
        }
            } ?> 
    </div>
      <!-- Add Pagination -->
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>        
      </div>
      <!-- If we need navigation buttons -->
      <!-- navigation buttons -->
      <div id="js-prev1" class="swiper-button-prev"></div>
     <div id="js-next1" class="swiper-button-next"></div>
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
      preventClicks: true,
      preventClicksPropagation: false ,
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
        clickable: true,
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
       onClick: function(sw, e) {
       e.preventDefault();
       alert('clickSlide');
                                },
       onTap: function(sw, e) {
       e.preventDefault();
       sw.allowClick = false;
                      },  
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
var mySwiper = document.querySelector('.swiper-container').swiper

$(".swiper-container").mouseenter(function() {
  mySwiper.autoplay.stop();
  //console.log('slider stopped');
});

$(".swiper-container").mouseleave(function() {
  mySwiper.autoplay.start();
 // console.log('slider started again');
})

  </script>

<script>
            $("input[name='size']").TouchSpin({
                min: 100,
                max: 6000,
                step: 1,              
                boostat: 5,
                maxboostedstep: 10,
                postfix: 'PX'
            });
        </script>
</body>

</html>