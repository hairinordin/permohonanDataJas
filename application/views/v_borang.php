
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
                <div class="form-group">
                    
                </div>
                <p id="image_captcha"><?php echo $captchaImg; ?></p>
                <a href="javascript:void(0);" class="captcha-refresh" ><img src="<?php echo base_url() . 'assets/images/refresh.png'; ?>"/></a>
                <br>
                <input type="text" name="captcha" value="" required/>
                <input type="submit" class="btn btn-primary" value="Hantar">
            </form>
       