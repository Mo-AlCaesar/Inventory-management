<?php


if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );


######################################################

#head Css 


if(!defined('head')) define('head',<<<EOD
        <meta charset="utf-8">
        <title>Inventory Management</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link rel="shortcut icon" href="public/assets/img/inventoryIcon.png"/>
        <link href="public/assets/css/style.css" rel="stylesheet">
        <link href="vendor/datatables/css/datatables.css" rel="stylesheet" >
        <script src="public/assets/js/jquery-3.6.3.min.js"></script>
EOD);


######################################################

#head Js File

#<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/js/all.min.js" crossorigin="anonymous"></script>

if(!defined('Js_file')) define('Js_file',<<<EOD


        <script src="vendor/datatables/js/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/js/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="vendor/datatables/js/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="vendor/datatables/js/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="vendor/datatables/js/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendor/datatables/js/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="vendor/datatables/js/jszip/jszip.min.js"></script>
        <script src="vendor/datatables/js/pdfmake/pdfmake.min.js"></script>
        <script src="vendor/datatables/js/pdfmake/vfs_fonts.js"></script>
        <script src="vendor/datatables/js/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="vendor/datatables/js/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="vendor/datatables/js/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src='vendor/datatables/js/datatables.col/jquery.dataTables.colResize.js' ></script>
        <script src='vendor/datatables/js/datatables.col/dataTables.colReorder.min.js' ></script>
        <script src='vendor/datatables/js/datatables.fixedHeader/dataTables.fixedHeader.min.js' ></script>
        <script src='vendor/datatables/js/dataTables.select/dataTables.select.min.js' ></script>
        <script src='vendor/datatables/js/dataTables.sum/sum.js' ></script>
        <script src="public/assets/js/bootstrap.bundle.min.js"></script>
        <script src="public/assets/js/select2.min.js"></script>
        <script src="public/assets/js/sweetalert.js"></script>
        <script src="public/assets/js/main.js"></script>
EOD);




######################################################

# Modal

if(!defined('Modal')) define('Modal',<<<EOD


<div class="modal animated--grow-in" id="uni_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-primary">
<h5 class="modal-title text-white" id="exampleModalLabel"> </h5>											
<a type="button" class="text-white" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-window-close fa-2x"></i></a>
</div>
<div class="modal-body"> ... </div>
</div>
</div>
</div>

EOD);



######################################################







?>

