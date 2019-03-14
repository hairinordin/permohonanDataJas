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
        <style>
        body {
        background-color: #343a40
        }
        </style>
    </head>
    <body>

        <div class="container">

            <h2>Senarai PeDAS</h2>

            <table class="table table-dark table-hover">
                <thead>
                    <th>Nama</th>
                    <th>Emel</th>
                    <th>Jenis Permohonan</th>
                    <th>Tarikh Permohonan</th>
                </thead>
                <tbody>
                <?php foreach($pemohon as $p): ?>
                <tr>
                    <td><?= $p['nama'] ?></td>
                    <td><?= $p['emel'] ?></td>
                    <td><?= $p['jenis_permohonan'] ?></td>
                    <td><?= $p['tarikh_permohonan'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            
           
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>




</html>