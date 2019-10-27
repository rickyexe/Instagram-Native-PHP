<?php 
include("connect.php");
session_start();
if($_SESSION["user"] != true){
       
       header("Location: login.php");
       echo "<script>alert('Anda Harus Login');</script>";
       exit;
    }


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Tambah Posting</title>
 </head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"> </script>

 <script>

    $(document).ready(function(){
     
     $("#btnupload").click(function(){

            var form_data = new FormData();
            var fileLength = document.getElementById('file').files.length;
        

            for (var i = 0; i < fileLength; i++) {
                form_data.append("file[]", document.getElementById('file').files[i]);
            }

            $.ajax({
                url: 'imageupload.php',
                type: 'POST',
                dataType : 'text',
                data: form_data,
                async: false,
                cache : false,
                contentType : false,
                enctype : 'multipart/form-data',
                processData: false,
                success: function (response){
                    alert(response);
                }

            })

            

            



         })

     $('#btnupload').click(function(){
        var caption = document.getElementById('caption').value;
        $.ajax({
                url: 'updatekomen.php',
                type: 'POST',
                data: {caption:caption},
                success: function (response){
                     window.history.back();
                }

            })
     })
 })


</script>

 <body>
 	<form id="#formData" method='post' enctype='multipart/form-data'>
	
	Select images : <input type="file" name="file[]" id="file" accept="image/*" multiple>
	<br>
	Caption : <input type="text" name="caption" id="caption">
	<br>
	<input type="button" name="btnupload" id="btnupload" value="UPLOAD" >

</form>

<?php 
  
?>


 </body>
 </html>