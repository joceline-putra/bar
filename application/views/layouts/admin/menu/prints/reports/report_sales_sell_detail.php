<link href="<?php echo base_url();?>assets/core/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/core/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/core/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />   
<link href="<?php echo base_url();?>assets/core/css/_print.css?_=<?php echo date('d-m-Y');?>" rel="stylesheet" type="text/css" />   
<style>
    body{
        font-family: monospace;
    }
</style>
<div class="container-fluid">
    <title><?php echo $title; ?></title>      
    <div id="print-paper" class="col-md-20" style="">
        <!-- Header -->
        <!--<div id="print-header" class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side">   
                <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                    <?php echo $title2;?><br>
                    <a href='#' onclick="window.print();">
                        <?php echo $title3;?>
                    </a>
                </div>                               
                <div class="col-md-5 col-xs-5 col-xs-5 padding-remove-left">
                  PERIODE : <?php echo $periode_awal.' sd '.$periode_akhir;?>
                </div>
          </div>
      </div>-->

    <div class="col-md-12 col-xs-12">
        <div class="col-md-2 col-sm-2 col-xs-2" style="padding-left:0px;">
            <img src="<?php echo $branch_logo;?>" style="width:150px;" class="img-responsive">
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left:0px;">
        <a href='#' onclick="window.print();">
            <?php echo $title; ?>
        </a>
        <br>
        Periode : <?php echo $periode; ?>
        <br>
        <?php 
            if(!empty($contact)){
                echo $contact_alias.' : ' . $contact['contact_name'].'<br>';
                // echo 'Alamat : ' . $contact['contact_address'];                
            }
            
            if(!empty($product)){
                echo $product_alias.' : ' . $product['product_code'].', '.$product['product_name'].', '.$product['product_unit'];                
            }                        
        ?>
        </div>
    </div>
      <!-- Content -->
     <!-- <div id="print-content" class="col-md-12 col-sm-12 col-xs-12">-->
        <!--<div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side">-->

            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color:#eaeaea;">
                        <td><b>No</b></td>
                        <td><b>Tanggal</b></td>
                        <td><b>Nomor</b></td>
                        <td><b><?php echo $contact_alias;?></b></td>
                        <td><b>Kode <?php echo $product_alias;?></b></td>   
                        <td><b>Nama <?php echo $product_alias;?></b></td>
                        <td style="text-align: right;"><b>Harga Jual</b></td>                          
                        <td style="text-align:right;"><b>Qty</b></td>                     
                        <td style="text-align: right;"><b>Total Nilai</b></td>   
                    </tr>
                </thead>
            <tbody>
                <?php 
                $num=1;
                $total_qty = 0;
                $total_trans=0;
                foreach($content as $v):

                $persentase = ($v['trans_item_sell_total'] - $v['trans_item_total']) / $v['trans_item_total'] * 100;
                ?>
                <tr data-trans-id="<?php echo $v['trans_id'];?>">
                    <td class="text-right"><?php echo $num++; ?></td>
                    <td><?php echo date("d-M-Y, H:i", strtotime($v['trans_date']));?></td>
                    <td><?php echo $v['trans_number'];?></td>                     
                    <td><?php echo $v['contact_name'];?></td>  
                    <td><?php echo $v['product_code'];?></td>                                     
                    <td><?php echo $v['product_name'];?></td>     
                    <td style="text-align:right;"><?php echo number_format($v['trans_item_sell_price']);?></td>                                                                          
                    <td class="text-right"><?php echo $v['trans_item_out_qty'].' '.$v['trans_item_unit'];?></td>                                                                               
                    <td style="text-align:right;">
                        <span class="btn_price_detail" style="cursor:pointer;" data-price-in="<?php echo number_format($v['trans_item_out_price']);?>" 
                        data-price-in-total="<?php echo number_format($v['trans_item_out_price']*$v['trans_item_out_qty']);?>"
                        data-percentage="<?php echo number_format($persentase);?>%"><?php echo number_format($v['trans_item_sell_total']);?></span>
                    </td>                                   
                 </tr>    
                <?php 
                $total_qty = $total_qty + $v['trans_item_out_qty'];
                $total_trans = $total_trans + $v['trans_item_sell_total'];                  
                endforeach;
                ?>      
                <tr>
                    <td colspan="7"><b>Total</b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_qty,2,'.',',');?></b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_trans);?></b></td>                                        
                </tr>
            </tbody>
        </table> 
        <!-- </div> -->
    <!-- </div>    -->

        <!-- Footer -->
        <!--<div id="print-footer" class="col-md-12 col-sm-12 col-xs-12">
          <div>Dicetak :  <?php #echo ucfirst($session['user_data']['user_name']);?> | <?php #echo date("d-m-Y H:i:s");?></div>
      </div> -->                           
  </div>    

</div>