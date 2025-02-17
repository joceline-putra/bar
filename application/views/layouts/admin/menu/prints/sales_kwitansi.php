<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="description" content="Webpage description goes here" />
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">
        <!-- <link href="https://fonts.cdnfonts.com/css/dot-matrix" rel="stylesheet"> -->
        <link href="<?php echo base_url(); ?>assets/core/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        /* @import url('https://fonts.cdnfonts.com/css/dot-matrix'); */
        body{
            font-family: monospace;
            /* font-family: 'Dot Matrix', sans-serif!important; */
        }
        .title{
            font-weight: 800;
            text-transform: uppercase;
            text-align: left;
        }
        .mrk > thead > tr > th {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        .mrk > tbody > tr > td {
            padding-top: 4px;
            padding-bottom: 0px;
        }  
        .footer-box{
            margin-top: 24px;
            margin-bottom: 4px;
        }
        .footer-box > div{
            border: 1px solid white;
            height: 120px;
        }
        .footer-box > div > div > h5{
            text-align: center;
            margin-top:4px;
            margin-bottom:2px;
        }  
        .no-border > tbody > tr > td{
            border-top:0px;
        }     

        .table-kwi td{
            border:0px;
            border-top:1px solid white!important;
        }
    </style>
    <body>
        <!--<div class="container-fluid" style="width:24cm;height: 14cm;margin-top:25px!important;"> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12" style="">       
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <img src="<?php echo $branch_logo; ?>" class="img-responsive" style="width: 100%;">
                    </div>                        
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p>
                        <div class="col-xs-2">
                          <!-- <img src="<?php echo $branch_logo; ?>" class="img-responsive" style="width: 134px;"> -->
                        </div>
                        <div class="col-xs-6">
                            <p style="text-align:center;">
                                <b style="font-size:20px;">KWITANSI</b><br>
                            </p>
                        </div>
                        <div class="col-xs-3 text-right">
                            <b onclick="window.print();" style="cursor:pointer;">No. KW.<?php echo $header['trans_number']; ?></b><br>
                        </div>          
                        </p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:0px;">
                        <table class="mrk table table-kwi" style="border: none;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:220px;border: none;"></th>
                                    <th class="text-left" style="width:2px;border: none;"></th>      
                                    <th class="text-right" style="border: none;"></th>        
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Telah terima dari</td>
                                    <td>:</td>                                    
                                    <td><b style="letter-spacing:1px;"><?php echo $header['contact_name']; ?></b></td>                                                                        
                                </tr>
                                <tr>
                                    <td>Uang sebanyak</td>
                                    <td>:</td>                                    
                                    <td><b style="letter-spacing:1px;"><?php echo $say_number;?> RUPIAH</b></td>                                                                        
                                </tr>
                                <tr>
                                    <td>Untuk pembayaran</td>
                                    <td>:</td>                                    
                                    <td><b style="letter-spacing:1px;"><?php echo $header['trans_note']; ?></b></td>                                                                        
                                </tr>                                                                
                            </tbody>
                        </table>
                    </div>  
                    <div class="col-md-12 col-sm-12 col-xs-12 footer-box">
                        <div class="col-md-6 col-xs-6">
                            <div class="col-md-12 col-xs-12"><h5 stye="text-align:left;">&nbsp;</h5></div>
                            <div class="col-md-12 col-xs-12">
                                <p style="text-align: left;margin-top:20px;">
                                    Terbilang (Rp)<br><b><?php echo number_format($result['header']['trans_total'],0,'.',','); ?></b>
                                </p>            
                            </div>          
                        </div>
                        <!-- <div class="col-md-2 col-xs-4">
                            <div class="col-md-12 col-xs-12"><h5>&nbsp;</h5></div>
                            <div class="col-md-12 col-xs-12">
                                <p style="text-align: center;margin-top:20px;"></p>
                            </div>          
                        </div>                 -->
                        <div class="col-md-6 col-xs-6">
                            <div class="col-md-12 col-xs-12"><h5>Semarang, <?php echo date("d-M-Y", strtotime($header['trans_date'])); ?></h5></div>
                            <div class="col-md-12 col-xs-12">
                                <p style="text-align: center;margin-top:50px;"><br><br><br>
                                    (Beny Samodra Triambodo, ST, SH, MH,)
                                </p>
                            </div>         
                        </div>
                        <!-- <div class="col-md-3 col-xs-4"> -->
                        <!-- <div class="col-md-12 col-xs-12"><h5>Scan</h5></div> -->
                        <!-- <div class="col-md-12 col-xs-12"> -->
                        <?php
                        // $set_qrcode = base_url('prints/print_history/').$header['trans_session'];
                        ?>
                        <!-- <img src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=<?php echo $set_qrcode; ?>&choe=UTF-8" title="Link to Google.com" /> -->
                        <!-- </div>           -->
                        <!-- </div>         -->
                    </div>          
                </div>
            </div>
        </div>
    </body>
</html>