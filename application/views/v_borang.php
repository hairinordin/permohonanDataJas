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
        
        <script>

            $(document).ready(function () {

                $('.captcha-refresh').on('click', function () {

                    $.get('<?php echo base_url() . 'captcha/refresh'; ?>', function (data) {

                        $('#image_captcha').html(data);

                    });

                });

            });

        </script>
    </head>
    <body>

        <div class="container">

            <h2>Borang PeDAS</h2>
            <?= $this->session->flashdata('err'); ?>
            <?php echo validation_errors(); ?>
            <form action="<?= base_url("borang/hantar") ?>" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" value="<?php echo set_value('nama'); ?>" required >
                </div>
                <div class="form-group">
                    <label for="ic_no">No KP / Passport:</label>
                    <input type="text" class="form-control" id="ic_no" placeholder="Masukkan No KP / Passport" name="ic_no" value="<?php echo set_value('ic_no'); ?>" required  >
                </div>
                <div class="form-group">
                    <label for="no_tel">No Telefon:</label>
                    <input type="text" class="form-control" id="no_tel" placeholder="Masukkan No Telefon" name="no_tel" value="<?php echo set_value('no_tel'); ?>" required >
                </div>
                <div class="form-group">
                    <label for="emel">Emel:</label>
                    <input type="email" class="form-control" id="emel" placeholder="Masukkan Emel" name="emel" value="<?php echo set_value('emel'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="comment">Tujuan permohonan:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment" value="<?php echo set_value('comment'); ?>" required></textarea>
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

                <input type='file' name='files[]' accept="image/*" multiple required>

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
                <p id="image_captcha"><?php echo $captchaImg; ?></p>
                <a href="javascript:void(0);" class="captcha-refresh" ><img src="<?php echo base_url() . 'assets/images/refresh.png'; ?>"/></a>
                <br>
                <input type="text" name="captcha" value="" required/>
                <input type="submit" class="btn btn-primary" value="Hantar">
            </form>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>




</html>