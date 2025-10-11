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
        .mariska > thead > tr > th {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        .mariska > tbody > tr > td {
            padding-top: 0px;
            padding-bottom: 0px;
        }  
        .footer-box{
            margin-top: 32px;
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
                        <div class="col-xs-3">
                          <!-- <img src="<?php echo $branch_logo; ?>" class="img-responsive" style="width: 134px;"> -->
                        </div>
                        <div class="col-xs-6">
                            <p style="text-align:center;">
                                <b style="font-size:20px;">INVOICE</b><br>
                                <b onclick="window.print();" style="cursor:pointer;"><?php echo $header['trans_number']; ?></b><br>
                            </p>
                        </div>
                        <div class="col-xs-3 text-right">
                            <!-- <b onclick="window.print();" style="cursor:pointer;"><?php #echo $header['trans_number']; ?></b><br> -->
                        </div>          
                        </p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:4px;">
                        <p>
                        <div class="col-xs-6" style="padding-left:0;">
                            <b>Customer:</b><br>
                            <?php echo $header['contact_name']; ?><br>
                            <?php echo $header['contact_address']; ?><br>
                            <?php echo $header['contact_phone_1']; ?><br>
                            <?php echo $header['contact_email_1']; ?><br>                                              
                        </div>
                        <div class="col-xs-6">
                            <table class="mariska table no-border" style="margin-bottom: 0px;">
                                <tr><td>Tanggal</td><td class="text-right"><?php echo date("d-M-Y", strtotime($header['trans_date'])); ?></td></tr>
                                <!-- <tr><td>Tanggal Jth Tempo</td><td class="text-right"><?php #echo date("d-M-Y", strtotime($header['trans_date_due'])); ?></td></tr> -->
                                <!-- <tr><td>Sales</td><td>:</td></tr> -->
                                <tr><td>Proyek</td><td class="text-right"><?php echo $header['trans_ref_number']; ?></td></tr>
                                <!-- <tr><td>Plat Nomor</td><td class="text-right"><?php echo $header['trans_vehicle_plate_number']; ?></td></tr>               -->
                                <!-- <tr><td>Pembayaran</td><td class="text-right"><?php echo ($header['contact_termin'] == 0) ? ' Cash (COD)' : ' ' . $header['contact_termin'] . ' Hari'; ?></td></tr>                                        -->
                                <!-- <tr><td>Salesman</td><td class="text-right"><?php echo $header['sales_fullname']; ?></td></tr>  
                                               -->
                                <tr>
                                    <td>
                                        <?php 
                                        if($header['trans_wafu'] == 1){
                                            echo 'WP';
                                        }else if($header['trans_wafu'] == 2){
                                            echo 'NW';
                                        }else{
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>          
                        </p>
                    </div>      
                    <div class="col-md-12 col-xs-12" style="">
                        Keterangan:<?php echo $header['trans_note']; ?><br><br>
                    </div>                    
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:0px;">
                        <table class="mariska table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-left">Produk</th>
                                    <th class="text-right">Qty</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Diskon</th>            
                                    <!--<th class="text-left">Pajak</th>-->
                                    <th class="text-right">Total</th>            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                $total_sub = 0;
                                $total_ppn = 0;
                                $total_discount = 0;
                                $total_discount_row = 0;
                                $total_grand = 0;
                                $total_voucher = ($header['trans_voucher'] > 0) ? $header['trans_voucher'] : 0;
                                foreach ($content as $v) {
                                    $ppn = 0;

                                    //Trans Note
                                    $trans_note = '-';
                                    if (!empty($v['trans_item_note'])) {
                                        $trans_note = '<br><b><i>' . $v['trans_item_note'] . '</i></b>';
                                    }

                                    //Pajak
                                    $price_qty = ($v['trans_item_sell_price'] * $v['trans_item_out_qty']) - $v['trans_item_discount'];
                                    $ppn_label = $v['trans_item_ppn'] == 1 ? 'P' : 'N';
                                    if ($v['trans_item_ppn'] == 1) {
                                        // $ppn = $price_qty * 0.1;
                                        $ppn = $price_qty * ($v['trans_item_ppn_value'] / 100);
                                        // $price_qty = ($v['trans_item_in_price']*$v['trans_item_in_qty']) + $ppn;
                                    }

                                    $total_sub = $total_sub + $price_qty;
                                    $total_ppn = $total_ppn + $ppn;
                                    $total_discount_row = $total_discount_row + $v['trans_item_discount'];
                                    echo '<tr>';
                                    echo '<td class="text-center">' . $num++ . '</td>';
                                    echo '<td>' . $v['product_name'] . '</td>';
                                    echo '<td style="text-align:right;">' . number_format($v['trans_item_out_qty'], 2, '.', ',') . ' ' . $v['trans_item_unit'] . '</td>';
                                    echo '<td style="text-align:right;">' . number_format($v['trans_item_sell_price'], 2, '.', ',') . '</td>';
                                    echo '<td style="text-align:right;">' . number_format($v['trans_item_discount'], 2, '.', ',') . '</td>';
                                    //echo '<td style="text-align:left;">'.$ppn_label.'</td>';              
                                    echo '<td style="text-align:right;">' . number_format($price_qty, 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                }

                                // $total_grand = $total_sub + $total_ppn + $total_discount;
                                $total_discount = $header['trans_discount'];
                                // $total_grand = (($total_sub + $total_ppn) - $total_discount) + $total_discount_row;
                                // $total_grand = $total_grand - $total_voucher;
                                $total_grand = $total_sub;                                    
                                // if ((floatval($header['trans_total_ppn']) > 0) or floatval($header['trans_discount']) > 0) {
                                //     echo '<tr>';
                                //     echo '<td colspan="4"></td>';
                                //     echo '<td style="text-align:left"><b>(a) Jumslah</b></td>';
                                //     echo '<td style="text-align:right">' . number_format($total_sub, 2, '.', ',') . '</td>';
                                //     echo '</tr>';
                                // }
                                // if (floatval($header['trans_total_ppn']) > 0) {
                                    // echo '<tr>';
                                    // echo '<td colspan="4"></td>';
                                    // echo '<td style="text-align:left"><b>Ppn</b></td>';
                                    // echo '<td style="text-align:right">' . number_format($total_ppn, 2, '.', ',') . '</td>';
                                    // echo '</tr>';
                                // }
                                // if (floatval($header['trans_discount']) > 0) {
                                    // echo '<tr>';
                                    // echo '<td colspan="4"></td>';
                                    // echo '<td style="text-align:right"><b>Diskon Nota</b></td>';
                                    // echo '<td style="text-align:right"> -' . number_format($total_discount, 2, '.', ',') . '</td>';
                                    // echo '</tr>';
                                // }
                                // if (floatval($header['trans_voucher']) > 0) {
                                //     echo '<tr>';
                                //     echo '<td colspan="4"></td>';
                                //     echo '<td style="text-align:right"><b>Voucher</b></td>';
                                //     echo '<td style="text-align:right"> -' . number_format($total_voucher, 2, '.', ',') . '</td>';
                                //     echo '</tr>';
                                // }                                
                                // echo '<tr>';
                                //   echo '<td colspan="4"></td>';
                                //   echo '<td style="text-align:right"><b>Total Discount</b></td>';
                                //   echo '<td style="text-align:right">'.number_format($total_discount,2,'.',',').'</td>';
                                // echo '</tr>';
                                echo '<tr>';
                                echo '<td colspan="4"></td>';
                                echo '<td style="text-align:left"><b>Tagihan Saat Ini</b></td>';
                                echo '<td style="text-align:right">' . number_format($total_grand, 2, '.', ',') . '</td>';
                                echo '</tr>';

                                // echo '<tr>';
                                // echo '<td colspan="6">Terbilang: ' . $say_number . ' RUPIAH</td>';
                                // echo '</tr>';
                                // if (floatval($header['trans_note_dpp']) > 0) {
                                    echo '<tr style="display:none;">';
                                    echo '<td colspan="4"></td>';
                                    echo '<td style="text-align:left"><b>(b) DPP (11/12xa)</b></td>';
                                    echo '<td style="text-align:right">' . number_format($header['trans_note_dpp'], 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                    // if (floatval($header['trans_note_ppn']) > 0) {
                                        echo '<tr>';
                                        echo '<td colspan="4"></td>';
                                        echo '<td style="text-align:left"><b>PPN</b></td>';
                                        echo '<td style="text-align:right">' . number_format($header['trans_note_ppn'], 2, '.', ',') . '</td>';
                                        echo '</tr>';
                                    // }                                             
                                // }         
                                // trans_discount
                                if (floatval($header['trans_discount']) > 0) {
                                    echo '<tr>';
                                    echo '<td colspan="4"></td>';
                                    echo '<td style="text-align:left"><b>PPh (2%)</b></td>';
                                    echo '<td style="text-align:right">' . number_format($total_discount, 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                }                                
                                $sppn = !empty($header['trans_note_ppn']) ? $header['trans_note_ppn'] : 0;
                                $spph = !empty($header['trans_discount']) ? $header['trans_discount'] : 0;
                                $tt = ($total_grand + $sppn) - $spph;
                                echo '<tr>';
                                echo '<td colspan="4"></td>';
                                echo '<td style="text-align:left"><b>Total</b></td>';
                                echo '<td style="text-align:right">' . number_format($tt, 2, '.', ',') . '</td>';
                                echo '</tr>';                                                            
                                ?>
                            </tbody>
                        </table>
                    </div>  
                    <div class="col-md-12 col-sm-12 col-xs-12 footer-box">
                        <!-- <div class="col-md-3 col-xs-3">
                            <div class="col-md-12 col-xs-12"><h5>Dibuat Oleh</h5></div>
                            <div class="col-md-12 col-xs-12">
                                <p style="text-align: center;margin-top:20px;">
                                    <?php #echo ucwords($result['footer']['user_creator']['user_name']); ?><br>
                                    <?php #echo date("d-M-Y, H:i", strtotime($result['header']['trans_date_created'])); ?>
                                </p>            
                            </div>          
                        </div> -->
                        <div class="col-md-6 col-xs-6" style="padding-left:0px;">
                            <div class="col-md-12 col-xs-12" style="padding-left:0px;"><b>Rekening Pembayaran</b></div>
                            <div class="col-md-12 col-xs-12" style="padding-left:0px;">
                                <p style="text-align: left;margin-top:20px;">
                                    <i>
                                        Pembayaran dapat di transfer ke:<br>
                                        Bank BNI Cabang Ahmad Yani Semarang<br>
                                        a/n CV. Barokah Abadi<br>
                                        a/c 194.902.0919
                                    </i><br>
                                    <i> atau<br>
                                        Bank Mandiri Cabang Kepodang Semarang<br>
                                        a/n CV. Barokah Abadi<br>
                                        a/c 135.00.1295054.7
                                    </i>
                                </p>
                            </div>          
                        </div>                
                        <div class="col-md-6 col-xs-6">
                            <div class="col-md-12 col-xs-12"><h5>Semarang, <?php echo date("d-M-Y", strtotime($header['trans_date'])); ?></h5></div>
                            <div class="col-md-12 col-xs-12">
                                <p style="text-align: center;margin-top:28px;"><br><br><br>
                                    (Adv. Beny Samodra Triambodo, ST, SH, MH,)
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