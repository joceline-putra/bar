<style>
    .scroll {
        margin-top: 4px;
        margin-bottom: 8px;
        margin-left: 4px;
        margin-right: 4px;
        padding: 4px;
        /*background-color: green; */
        width: 100%;
        height: 200px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: justify;
    }
    /* Large desktops and laptops */
    @media (min-width: 1200px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Landscape tablets and medium desktops */
    @media (min-width: 992px) and (max-width: 1199px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Portrait tablets and small desktops */
    @media (min-width: 768px) and (max-width: 991px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Landscape phones and portrait tablets */
    @media (max-width: 767px) {
        .table-responsive{
            overflow-x: unset;
        }
    }

    /* Portrait phones and smaller */
    @media (max-width: 480px) {
        .tab-content > .active{
            padding: 8px!important;
        }  
        .padding-remove-left, .padding-remove-right{
            padding-left:0px!important;
            padding-right:0px!important;    
        }
        .padding-remove-side{
            padding-left: 5px!important;
            padding-right: 5px!important;
        }
        .form-label{
            /*padding-left: 5px!important;*/
        }
        .prs-0{
            padding-left: 0px!important;
            padding-right: 0px!important;    
        }
        .prs-0 > label{
            padding-left: 5px!important;
            padding-right: 5px!important;    
        }
        .prs-0 > div{
            /*padding-left: 5px!important;*/
            /*padding-right: 5px!important;    */
        }
        .prs-0 > input{
            margin-left: 0px!important;
            margin-right: 0px!important;    
        }
        .prs-0 > select{
            margin-left: 5px!important;
            margin-right: 5px!important;    
        }

        .prs-5{
            padding-left: 5px!important;
            padding-right: 5px!important;    
        }
        .prs-5 > label{
            padding-left: 5px!important;
            padding-right: 5px!important;    
        }
        .prs-5 > div{
            /*padding-left: 5px!important;*/
            /*padding-right: 5px!important;    */
        }
        .prs-5 > input{
            margin-left: 5px!important;
            margin-right: 5px!important;    
        }
        .prs-5 > select{
            margin-left: 5px!important;
            margin-right: 5px!important;    
        }    

        .prl-2{
            padding-left: 2.5px!important;
        }
        .prr-2{
            padding-right: 2.5px!important;
        }    
    }    
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php #include '_navigation.php'; ?>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                    <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side prs-0">
                        <div class="grid simple">
                            <div class="grid-body">            
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side">
                                    <h5><b><?php echo $title; ?></b></h5>  
                                    <div class="row">        
                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side"> 
                                            <form id="form-master" name="form-master" method="" action="">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <input id="id_document" name="id_document" type="hidden" value="" placeholder="id" readonly>                            
                                                    </div>
                                                </div>    
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-lg-4 col-md-4 col-xs-12 padding-remove-left">
                                                        <div class="col-md-12 col-xs-12 padding-remove-side">
                                                            <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                                                <div class="form-group">
                                                                    <label class="form-label">Gambar <?php echo $title; ?> <?php echo $image_width; ?> x <?php echo $image_height; ?> px</label>
                                                                    <a class="files_link" href="<?= site_url('upload/noimage.png'); ?>">
                                                                        <img id="files_preview" src="<?= site_url('upload/noimage.png'); ?>" class="img-responsive" height="120px" width="240px" style="margin-bottom:5px;"/>
                                                                    </a>
                                                                    <div class="custom-file">
                                                                        <input class="form-control" id="files" name="files" type="file" tabindex="1">
                                                                        <!-- <label class="custom-file-label">Pilih Gambar</label> -->
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-12 col-xs-12 padding-remove-side">                            
                                                            <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                                                <div class="form-group">
                                                                    <label class="form-label">Nama Website</label>
                                                                    <input id="nama" name="nama" type="text" value="" class="form-control">
                                                                </div>
                                                            </div>                                                        
                                                        </div> 
                                                        <div class="col-md-12 col-xs-12 padding-remove-side">                
                                                            <div class="form-group">
                                                                <label class="form-label">Header Title</label>
                                                                <input id="header_title" name="header_title" type="text" value="" class="form-control">
                                                            </div>                                                
                                                        </div>                                                           
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">                                                       
                                                            <div class="col-md-6 col-xs-6 col-sm-6 padding-remove-left">
                                                                <div class="form-group">
                                                                    <label class="form-label">Telepon *</label>
                                                                    <input id="telepon_1" name="telepon_1" type="text" value="" class="form-control">
                                                                </div>                          
                                                            </div>
                                                            <div class="col-md-6 col-xs-6 col-sm-6 padding-remove-right">
                                                                <div class="form-group">
                                                                    <label class="form-label">Email</label>
                                                                    <input id="email_1" name="email_1" type="text" value="" class="form-control">
                                                                </div>                          
                                                            </div>   
                                                        </div>  
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">                                                       
                                                            <div class="col-md-6 col-xs-6 col-sm-6 padding-remove-left">
                                                                <div class="form-group">
                                                                    <label class="form-label">Telepon 2</label>
                                                                    <input id="telepon_2" name="telepon_2" type="text" value="" class="form-control">
                                                                </div>                          
                                                            </div>
                                                            <div class="col-md-6 col-xs-6 col-sm-6 padding-remove-right">
                                                                <div class="form-group">
                                                                    <label class="form-label">Email 2</label>
                                                                    <input id="email_2" name="email_2" type="text" value="" class="form-control">
                                                                </div>                          
                                                            </div>   
                                                        </div>                                                          
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                            <div class="form-group">
                                                                <label class="form-label">Jam Kerja</label>
                                                                <input id="working_hour" name="working_hour" type="text" value="" class="form-control">
                                                            </div>                          
                                                        </div>                                                                                                                                       
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-xs-12 padding-remove-right">                          
                                                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                                            <div class="form-group">
                                                                <label class="form-label">Alamat *</label>
                                                                <textarea id="alamat" name="alamat" type="text" value="" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div> 
                                                        <div class="col-lg-12 col-md-12 col-xs-12 form-group padding-remove-side">
                                                            <label class="form-label">Provinsi *</label>
                                                            <select id="provinsi" name="provinsi" class="form-control">
                                                                <option value="0">-- Pilih --</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-xs-12 form-group padding-remove-side">
                                                            <label class="form-label">Kota / Kabupaten *</label>
                                                            <select id="kota" name="kota" class="form-control">
                                                                <option value="0">-- Pilih --</option>
                                                            </select>
                                                        </div>
                                                        <!-- <div class="col-lg-12 col-md-12 col-xs-12 form-group padding-remove-side">
                                                            <label class="form-label">Kecamatan *</label>
                                                            <select id="kecamatan" name="kecamatan" class="form-control">
                                                                <option value="0">-- Pilih --</option>
                                                            </select>
                                                        </div>                                                                             -->
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">                                                       
                                                            <div class="col-md-6 col-xs-6 col-sm-6 padding-remove-left">
                                                                <div class="form-group">
                                                                    <label class="form-label">Longitude</label>
                                                                    <input id="longitude" name="longitude" type="text" value="" class="form-control">
                                                                </div>                          
                                                            </div>
                                                            <div class="col-md-6 col-xs-6 col-sm-6 padding-remove-right">
                                                                <div class="form-group">
                                                                    <label class="form-label">Latitude</label>
                                                                    <input id="latitude" name="latitude" type="text" value="" class="form-control">
                                                                </div>                          
                                                            </div>   
                                                        </div>  
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                            <div class="form-group">
                                                                <label class="form-label">Map Link</label>
                                                                <input id="link" name="link" type="text" value="" class="form-control">
                                                            </div>                          
                                                        </div>                                                            
                                                    </div>
                                                    <div class="col-md-4 col-xs-12 col-sm-12 padding-remove-right">                                                       
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                            <div class="form-group">
                                                                <label class="form-label">Facebook</label>
                                                                <input id="facebook" name="facebook" type="text" value="" class="form-control">
                                                            </div>                          
                                                        </div>
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                            <div class="form-group">
                                                                <label class="form-label">Instagram</label>
                                                                <input id="instagram" name="instagram" type="text" value="" class="form-control">
                                                            </div>                          
                                                        </div>                                     
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                            <div class="form-group">
                                                                <label class="form-label">Youtube</label>
                                                                <input id="youtube" name="youtube" type="text" value="" class="form-control">
                                                            </div>                          
                                                        </div>                    
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                            <div class="form-group">
                                                                <label class="form-label">Twitter</label>
                                                                <input id="twitter" name="twitter" type="text" value="" class="form-control">
                                                            </div>                          
                                                        </div>                    
                                                        <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-left">
                                                            <div class="form-group">
                                                                <label class="form-label">Tiktok</label>
                                                                <input id="tiktok" name="tiktok" type="text" value="" class="form-control">
                                                            </div>                          
                                                        </div>                                                                                                                                                                                                                                
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top: 10px;">
                                                    <div class="form-group">
                                                        <div class="pull-right">
                                                            <button id="btn-cancel" class="btn btn-warning btn-small" type="reset" style="display: inline;">
                                                                <i class="fas fa-ban"></i> 
                                                                Batal
                                                            </button>                                          
                                                            <button id="btn-update" class="btn btn-info btn-small" type="button" style="display: inline;">
                                                                <i class="fas fa-edit""></i> 
                                                                Update
                                                            </button>                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>      
                                </div>                    
                            </div>
                        </div>  
                    </div>
                </div>    
            </div>
            <div class="tab-pane" id="tab2">      
            </div>
        </div>  
    </div>
</div>
<div class="modal fade" id="modal-croppie" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="modal-croppie-canvas"></div>
            </div>
            <div class="modal-footer">
                <button id="modal-croppie-save" type="button" class="btn btn-primary"><span class="fas fa-crop"></span> Crop Gambar</button>                
                <button id="modal-croppie-cancel" type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-times"></span> Tutup</button>
            </div>
        </div>
    </div>
</div>