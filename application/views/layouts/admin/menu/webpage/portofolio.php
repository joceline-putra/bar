<div class="row">
    <div class="col-md-12">
        <?php #include '_navigation_article.php'; ?>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="#grid-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div class="col-md-8 col-xs-12 col-sm-12 padding-remove-left">
                    <div class="grid simple">
                        <div class="hidden grid-title">
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#grid-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="grid-body">        
                            <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                <div class="col-md-6 col-xs-12 col-sm-12" style="padding-left: 0;">
                                    <h5><b>Data <?php echo $title; ?></b></h5>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12 padding-remove-right">
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side" style="padding-top:8px;">
                                <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12 form-group padding-remove-left">
                                    <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">
                                        <label class="form-label">Status</label>
                                        <select id="filter_flag" name="filter_flag" class="form-control">
                                            <option value="1">Aktif</option>
                                            <option value="0">Nonaktif</option>
                                            <option value="All">Semua</option>
                                        </select>
                                    </div>
                                </div>                
                                <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12 form-group padding-remove-left">
                                    <label class="form-label">Cari</label>
                                    <input id="filter_search" name="filter_search" type="text" value="" class="form-control" placeholder="Pencarian" />
                                </div>                                 
                                <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12 form-group padding-remove-side">
                                    <label class="form-label">Tampil</label>
                                    <select id="filter_length" name="filter_length" class="form-control">
                                        <option value="10">10 Baris</option>
                                        <option value="25">25 Baris</option>
                                        <option value="50">50 Baris</option>
                                        <option value="100">100 Baris</option>
                                    </select>
                                </div>                   
                            </div>              
                            <div class="col-md-12 col-xs-12 col-sm-12 table-responsive padding-remove-side">                    
                                <table id="table-data" class="table table-bordered">
                                </table>
                            </div>              
                        </div>
                    </div>
                </div>  
                <div class="col-md-4 col-xs-12 col-sm-12 padding-remove-side">
                    <div class="grid simple">
                        <div class="hidden grid-title">
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#grid-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="grid-body">
                            <h5><b>Form <?php echo $title; ?></b></h5>                            
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-remove-side">
                                    <form id="form-master" name="form-master" method="" action="">    
                                        <input id="tipe" type="hidden" value="<?php echo $identity; ?>">
                                        <div class="col-md-12">
                                            <input id="id_document" name="id_document" type="hidden" value="" placeholder="id" readonly>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Gambar <?php echo $title; ?> <?php echo $portofolio_width; ?> x <?php echo $portofolio_height; ?> px</label>
                                                <a class="files_link" href="<?= site_url('upload/noimage.png'); ?>">
                                                    <img id="files_preview" src="<?= site_url('upload/noimage.png'); ?>" class="img-responsive" height="120px" width="240px" style="margin-bottom:5px;"/>
                                                </a>
                                                <div class="custom-file">
                                                    <input class="form-control" id="files" name="files" type="file" tabindex="1">
                                                    <!-- <label class="custom-file-label">Pilih Gambar</label> -->
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12">                               
                                            <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                                <div class="form-group">
                                                    <label>Nama *</label>
                                                    <input id="nama" name="nama" type="text" value="" class="form-control" readonly='true'/>
                                                </div>
                                            </div> 
                                            <!--
                                            <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                              <div class="form-group">
                                                <label>Parent Category</label>
                                                <select id="parent_category" name="parent_category" class="form-control" disabled readonly>
                                                  <option value="0">No Parent Category</option>
                                            <?php
                                            foreach ($parent_category as $v) {
                                                echo '<option value="' . $v['product_category_id'] . '">' . $v['product_category_name'] . '</option>';
                                            }
                                            ?>
                                                </select>
                                              </div>
                                            </div>
                                            -->
                                            <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                                <div class="form-group">
                                                    <label>Url</label>
                                                    <input id="url" name="url" type="text" value="" class="form-control" readonly='true'/>
                                                </div>
                                            </div>
                                            <!--
                                            <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                              <div class="form-group">
                                                <label>Icon</label>
                                                <input id="icon" name="icon" type="text" value="" class="form-control" readonly='true'/>
                                              </div>
                                            </div>
                                            -->
                                            <div class="col-lg-12 col-md-12 col-xs-12 padding-remove-side">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select id="status" name="status" class="form-control" disabled readonly>
                                                        <!-- <option value="">select</option> -->
                                                        <?php
                                                        $status_values = array(
                                                            '1' => 'Aktif',
                                                            '0' => 'Nonaktif',
                                                        );

                                                        foreach ($status_values as $value => $display_text) {
                                                            echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>         
                                            </div>

                                            <div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side" style="margin-top: 22px;">
                                                <div class="form-group">
                                                    <div class="pull-right">

                                                        <button id="btn-new" class="btn btn-success btn-small" type="button">
                                                            <i class="fas fa-file-medical"></i> 
                                                            Buat Baru
                                                        </button>
                                                        <button id="btn-cancel" class="btn btn-warning btn-small" type="reset" style="display: none;">
                                                            <i class="fas fa-ban"></i> 
                                                            Cancel
                                                        </button>                                                                  
                                                        <button id="btn-save" onClick="" class="btn btn-primary btn-small" type="button" style="display:none;">
                                                            <i class="fas fa-save"></i>                                 
                                                            Save
                                                        </button>                                        
                                                        <button id="btn-update" class="btn btn-info btn-small" type="button" style="display: none;">
                                                            <i class="fas fa-edit"></i> 
                                                            Update
                                                        </button> 
                                                        <button id="btn-delete" class="btn btn-danger btn-small" type="button" style="display: none;">
                                                            <i class="fas fa-trash"></i> 
                                                            Delete
                                                        </button>                                   
                                                    </div>
                                                </div>
                                            </div>                                                                                                                       
                                        </div>

                                        <div class="clearfix"></div>

                                    </form>                  
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