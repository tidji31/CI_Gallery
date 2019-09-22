// CI_Gallery javascript functions to get, delete , resize   ... images 
function rd(img,name,Id,name) {
    var name = name ;
    var id = Id;
    if (img !== null && name != null )
    {
    document.getElementById('startUpload').style.display='none';
    document.getElementById('dropzone').style.display='none';
    document.getElementById('rd').style.display='block';
    document.getElementById('thum').src = img ;
    document.getElementById('thum').name = name ;
    document.getElementById('thum').alt = Id ;
    document.getElementById('img-name').innerHTML = name ;
    getimagesize(name);
    }else{
    document.getElementById('startUpload').style.display='block';
    document.getElementById('dropzone').style.display='block';
    document.getElementById('rd').style.display='none';
    document.getElementById('img-name').innerHTML ='' ;
    }
    
}

        function deleteimage(){
       
           
          var path= document.getElementById('thum').name;
          var id=  document.getElementById('thum').alt;
              $.ajax(
                    {
                    type:"post",
                    dataType:"text", 
                    url: "Ci_gallery/deletetheimage",
                    data:{path:path,id:id},
                    success:function(response)
                    {
                    window.location.href = "";                     
                    }
                    }
                    );
       
                    }

        function getimagesize(name){
              $.ajax(
                    {
                    type:"post",
                    dataType:"json", 
                    url: "Ci_gallery/getimagesize",
                    data:{name:name},
                    success:function(data)
                    {
                      
                    document.getElementById('sizew').value= data["width"];
                    document.getElementById('sizeh').value= data["heigth"]; 
                  }
                    }
                    );
       
                    }

        function resize(){
       
           
          var path= document.getElementById('thum').name;
          var w= document.getElementById('sizew').value;
          var h= document.getElementById('sizeh').value;
              $.ajax(
                    {
                    type:"post",
                    dataType:"text", 
                    url: "Ci_gallery/resizetheimage",
                    data:{path:path,w:w,h:h},
                    success:function(response)
                    {
                    window.location.href = "";                     
                    }
                    }
                    );
       
                    }
