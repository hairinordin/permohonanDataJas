<!DOCTYPE html>

<html>

<head>

   <title>Implement Captcha in Codeigniter using helper</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
   <script>

       $(document).ready(function(){

           $('.captcha-refresh').on('click', function(){

               $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){

                   $('#image_captcha').html(data);

               });

           });

       });

   </script>

  

</head>

<body>

<p id="image_captcha"><?php echo $captchaImg; ?></p>

<a href="javascript:void(0);" class="captcha-refresh" ><img src="<?php echo base_url().'assets/images/refresh.png'; ?>"/></a>

<form method="post">

   <input type="text" name="captcha" value=""/>

   <input type="submit" name="submit" value="SUBMIT"/>

</form>

</body>

</html>