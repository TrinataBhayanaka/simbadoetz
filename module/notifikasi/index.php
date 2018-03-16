<?php
include "../../config/config.php";

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

?>

<section id="main">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
        <li class="active">Notifikasi</li>
        <?php SignInOut();?>
    </ul>
    <div class="breadcrumb">
        <div class="title">Notifikasi</div>
        <div class="subtitle">Daftar Notifikasi Perubahan Data</div>
    </div>

    <div style="height:5px;width:100%;clear:both"></div>
    <section class="formLegend">
        <div id="demo">
            <table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="notif">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Satker</th>
                        <th>Table</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="spacer"></div>
        
    </section>
</section>

<script>
    $(document).ready(function() {
        $('#notif').dataTable(
            {
                "aoColumnDefs": [
                    { "aTargets": [2] }
                ],
                "aoColumns":[
                    {"bSortable": false},
                    {"bSortable": true},
                    {"bSortable": true},
                    {"bSortable": true}],
                "sPaginationType": "full_numbers"
            });
    });
</script>


