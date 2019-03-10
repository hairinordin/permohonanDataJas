<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Dropzone CSS & JS -->
  <link href='<?=base_url()?>resources/dropzone.css' type='text/css' rel='stylesheet'>
  <script src='<?=base_url()?>resources/dropzone.js' type='text/javascript'></script>

  <style>
    .content{
      width: 50%;
      padding: 5px;
      margin: 0 auto;
    }
    .content span{
      width: 250px;
    }
    .dz-message{
      text-align: center;
      font-size: 28px;
    }
    </style>
    <script>
// Add restrictions
Dropzone.options.fileupload = {
      acceptedFiles: 'image/*',
      maxFilesize: 1, // MB,

    };


    </script>

</head>
<body>

<div class="container">

  <h2>Borang PeDAS</h2>
  <form action="<?=base_url("borang/hantar")?>" method="post">
    <div class="form-group">
      <label for="nama">Nama:</label>
      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required >
    </div>
    <div class="form-group">
      <label for="ic_no">No KP / Passport:</label>
      <input type="text" class="form-control" id="ic_no" placeholder="Masukkan No KP / Passport" name="ic_no" required  >
    </div>
    <div class="form-group">
      <label for="no_tel">No Telefon:</label>
      <input type="text" class="form-control" id="no_tel" placeholder="Masukkan No Telefon" name="no_tel" required >
    </div>
    <div class="form-group">
      <label for="emel">Emel:</label>
      <input type="email" class="form-control" id="emel" placeholder="Masukkan Emel" name="emel" required>
    </div>
   <div class="form-group">
  <label for="comment">Tujuan permohonan:</label>
  <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
</div>

<label>Jenis permohonan:</label>

<div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="jenis_permohonan" value="Awam" required>Awam
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="jenis_permohonan" value="Swasta" required>Swasta
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="jenis_permohonan" value="Pelajar" required>Pelajar
  </label>
</div>
<br>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
  Lampiran
</button>

<br>
<br>
<label>Jenis Data:</label>
<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name='jenis_data_chkbox[]' value="Data Kualiti Air" >Data Kualiti Air
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name='jenis_data_chkbox[]'value="Data Kualiti Tanah">Data Kualiti Tanah
  </label>
</div>
<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name='jenis_data_chkbox[]' value="Data Kualiti Udara">Data Kualiti Udara
  </label>
</div>

    <br>
    <input type="submit" class="btn btn-primary" value="Hantar">
  </form>
</div>


      <!-- Dropzone
        -->



<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <div class="content">
        <form action="<?=base_url('borang/fileupload')?>" class="dropzone" id="fileupload">
      </form>
      </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
</div>


















<script type='text/javascript'>

        Dropzone.autoDiscover = false;
        $(".dropzone").dropzone({
            addRemoveLinks: true,
            removedfile: function(file) {
                var name = file.name;

                $.ajax({
                    type: 'POST',
                    url: '<?=base_url('borang/fileupload')?>',
                    data: {name: name,request: 2},
                    sucess: function(data){
                        console.log('success: ' + data);
                    }
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>




</html>