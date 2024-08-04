<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs" role="tablist" style="display:inline;">      
            <li class="active">
                <a href="#tab1" role="tab" class="btn-tab-1" data-toggle="tab" aria-expanded="false"  style="cursor:pointer;">
                <span class="fas fa-calendar-alt"></span> Dashboard</a>
            </li>           
            <li class="">
                <a href="#tab2" role="tab" class="btn-tab-2" data-toggle="tab" aria-expanded="true">
                <span class="fas fa-plus-square"></span> Absen</a>
            </li> 
            <!-- 
            <li class="">
                <a href="#tab3" role="tab" class="btn-tab-3" data-toggle="tab" aria-expanded="true">
                <span class="fas fa-plus-square"></span> Post</a>
            </li>
            -->
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div class="row" style="margin-bottom:20px;">
                    <div class="col-md-12 col-xs-12">                    
                        <button id="btn_posting_new" class="btn btn-success btn-lg" type="button" style="width:100%;">
                            <i class="fas fa-image"></i> 
                            Post Gambar
                        </button>
                    </div>                    
                </div>                
                <div class="row" id="activity">
                    <?php #for($a=0;$a<4;$a++){?>
                    <!-- <div class="col-md-3 col-sm-12 col-xs-12 m-b-10">
                        <div class="widget-item" style="border: 1px solid #e5e9ec;">
                            <div class="controller overlay right">
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                            <div class="tiles white p-t-15">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="profile-img-wrapper pull-left m-l-10">
                                            <div class=" p-r-10">
                                            <img src="<?php echo site_url('upload/noimage.png');?>" alt="" data-src="<?php echo site_url('upload/noimage.png');?>" data-src-retina="<?php echo site_url('upload/noimage.png');?>" width="35" height="35"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="user-name text-black bold large-text"> John <span class="semi-bold">Smith</span> </div>
                                        <div class="preview-wrapper">shared a picture with <span class="bold">Jane Smith</span>.</div>
                                    </div>
                                </div>
                                <div id="image-demo-carl" class="m-t-15 owl-carousel owl-theme" style="opacity: 1; display: block;">
                                    <div class="owl-wrapper-outer autoHeight">
                                        <div class="owl-wrapper" style="left: 0px; display: block;">
                                            <div class="owl-item">
                                                <div class="item col-md-12">
                                                    <img src="<?php echo site_url('upload/noimage.png');?>" alt="" class="img-responsive" style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post p-b-15 p-t-15 p-l-15 b-b b-grey" style="border-color:transparent;">
                                    <ul class="action-bar no-margin ">
                                        <li><a href="#" class="muted"><i class="fa fa-comment m-r-5"></i> 24</a> </li>
                                        <li>
                                            <a href="#" class="text-error bold"> <i class="fas fa-heart  m-r-5"></i> 5</a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                                <p class="p-t-10 p-b-10 p-l-15 p-r-15">
                                    <span class="bold">
                                        Jane Smith, John Smith, David Jester, pepper
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div> -->
                    <!-- <?php #} ?> -->
                </div>               
            </div>
            <div class="tab-pane" id="tab2">
                <!-- <div class="col-md-12 col-xs-12 col-sm-12"> -->
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-12 col-xs-12">                    
                            <button id="btn_fetch_location" class="btn btn-success btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-map-marker-alt"></i> 
                                Perbarui Lokasi
                            </button>
                        </div>                    
                    </div>
                    <div class="row" style="margin-bottom:20px;">   
                        <div class="col-md-12 col-xs-12">
                            <div id="map" style="height: 400px; width: 100%;border:1px solid #eaeaea;"></div>
                        </div>
                    </div>                 
                    <!-- <div class="col-md-12 col-xs-12" style="margin-top:20px;margin-bottom:20px;"> 
                        <button id="btn_take_selfie" class="btn btn-primary btn-lg" type="button" style="width:100%;">
                            <i class="fas fa-ban"></i> 
                            Take Selfie
                        </button>
                    </div>          -->
                    <!-- <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-4 col-xs-4 padding-remove-side">
                            <div class="form-group">
                                <div class="controls">
                                    <input name="latlng" id="latlng" type="text" class="form-control input-lg" placeholder="Lat & Lng">
                                </div>
                            </div>
                        </div>                
                        <div class="col-md-4 col-xs-4">                    
                            <button id="btn_move_location" class="btn btn-danger btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-ban"></i> 
                                Move Coordinate
                            </button>
                        </div>   
                    </div> -->
                    <div class="clearfix"></div>
                    <!-- <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-3 col-xs-6">
                            <button id="btn_distance" class="btn btn-danger btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-ban"></i> 
                                Check Distance
                            </button>
                        </div> 
                        <div class="col-md-3 col-xs-6">                    
                            <button id="btn_fetch_circle" class="btn btn-danger btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-ban"></i> 
                                Get Circle Location
                            </button>
                        </div>                     
                        <div class="col-md-3 col-xs-6">
                            <button id="btn_remove_marker" class="btn btn-danger btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-ban"></i> 
                                Hapus Marker
                            </button>
                        </div>  
                        <div class="col-md-3 col-xs-6">
                            <button id="btn_remove_circle" class="btn btn-danger btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-ban"></i> 
                                Hapus Circle
                            </button>
                        </div>  
                    </div> -->
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-6 col-xs-6">
                            <button id="btn_checkin_new" class="btn btn-primary btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-sign-in-alt"></i> 
                                Check In
                            </button>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <button id="btn_checkout_new" class="btn btn-danger btn-lg" type="button" style="width:100%;">
                                <i class="fas fa-sign-out-alt"></i> 
                                Check Out
                            </button>
                        </div>             
                    </div>
                <!-- </div>                 -->
            </div>
            <div class="tab-pane" id="tab3">
            </div>                        
        </div>        
    </div>
</div>

<div class="modal fade" id="modal_checkin" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Check IN</h4>
            </div>            
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                    <form id="form_checkin" name="form_checkin" method="" action="" enctype="multipart/form-data">   
                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side" style="margin-bottom:14px;">    
                            <div class="form-group">
                                <a id="btn_take_selfie" href="#" style="cursor:pointer;">
                                    <img id="files_preview" src="<?= site_url('upload/click_to_selfie.png'); ?>" class="img-responsive" height="120px" width="100%" style="margin-bottom:5px;"/>
                                </a>
                                <div class="custom-file">
                                    <input type="file" id="camera_input" name ="file" accept="image/*;capture=camera" style="display:none;"> 
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>                
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <button id="btn_checkin" type="button" class="btn btn-primary btn-lg" style="width:100%;"><span class="fas fa-sign-in-alt"></span> Check IN</button>                
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button id="btn_checkin_close" type="button" class="btn btn-secondary btn-lg" style="width:100%;" data-dismiss="modal"><span class="fas fa-times"></span> Tutup</button>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_checkout" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Check OUT</h4>
            </div>            
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                    <form id="form_checkout" name="form_checkout" method="" action="" enctype="multipart/form-data">       
                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side" style="margin-bottom:14px;">
                            <div class="form-group">
                                <a id="btn_take_checkout" href="#" style="cursor:pointer;">
                                    <img id="files_preview_checkout" src="<?= site_url('upload/click_to_photo.png'); ?>" class="img-responsive" height="120px" width="100%" style="margin-bottom:5px;"/>
                                </a>
                                <div class="custom-file">
                                    <input type="file" id="camera_input_checkout" name ="file" accept="image/*;capture=camera" style="display:none;"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side" style="margin-bottom:14px;">
                            <div class="form-group">
                                <label class="form-label">Catatan</label>
                                <textarea id="keterangan" name="keterangan" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>                           
                    </form> 
                </div>                
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <button id="btn_checkout" type="button" class="btn btn-primary btn-lg" style="width:100%;"><span class="fas fa-sign-out-alt"></span> Check OUT</button>                
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button id="btn_checkout_close" type="button" class="btn btn-secondary btn-lg" style="width:100%;" data-dismiss="modal"><span class="fas fa-times"></span> Tutup</button>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_posting" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Post Gambar</h4>
            </div>            
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                    <form id="form_posting" name="form_posting" method="" action="" enctype="multipart/form-data">       
                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side" style="margin-bottom:14px;">
                            <div class="form-group">
                                <a id="btn_take_posting" href="#" style="cursor:pointer;">
                                    <img id="files_preview_posting" src="<?= site_url('upload/click_to_photo.png'); ?>" class="img-responsive" height="120px" width="100%" style="margin-bottom:5px;"/>
                                </a>
                                <div class="custom-file">
                                    <input type="file" id="camera_input_posting" name="file" accept="image/*;capture=camera" style="display:none;"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side" style="margin-bottom:14px;">
                            <div class="form-group">
                                <label class="form-label">Catatan</label>
                                <textarea id="keterangan_posting" name="keterangan_posting" type="text" class="form-control" rows="4"></textarea>
                            </div>
                        </div>                           
                    </form> 
                </div>                
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <button id="btn_posting" type="button" class="btn btn-primary btn-lg" style="width:100%;"><span class="fas fa-sign-out-alt"></span> Kirim</button>                
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button id="btn_posting_close" type="button" class="btn btn-secondary btn-lg" style="width:100%;" data-dismiss="modal"><span class="fas fa-times"></span> Tutup</button>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/compressorjs@1.1.1/dist/compressor.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGrJzgnYt1MWEtvYpBXGYxTR_EPNl7gjE&libraries=places" type="text/javascript"></script>
