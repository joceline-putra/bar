
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js" type="text/javascript"></script> -->
<script type="text/javascript">
$(document).ready(function() {
    let identity = 1;
    let url = "<?php base_url('webpage/faq'); ?>";
    let url_print = "<?php base_url('faq'); ?>";
    let url_tool = "<?php base_url('search/manage'); ?>";
    var url_image = "<?php site_url('upload/noimage.png'); ?>";

    let image_width = "<?= $image_width;?>";
    let image_height = "<?= $image_height;?>";

    let faqID = 0;
    let faqItemID = 0;

    $(function() {
        setInterval(function(){ 
            /*
            //SummerNote
            $('#faq_note').summernote({
                placeholder: 'Tulis keterangan disini!',
                tabsize: 4,
                height: 350
            });  
            */
        }, 3000);
    });


    //Croppie
    var upload_crop_img = $('#modal_croppie_canvas').croppie({
        enableExif: true,
        viewport: {width: image_width, height: image_height},
        boundary: {width: parseInt(image_width)+10, height: parseInt(image_height)+10},
        url: url_image,
    });
    $('.files_link').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it
                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function
                // The "opener" function should return the element from which popup will be zoomed in
                // and to which popup will be scaled down
                // By defailt it looks for an image tag:
                opener: function (openerElement) {
                    // openerElement is the element on which popup was initialized, in this case its <a> tag
                    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
    });
    //Select2
    /*
    $('#select').select2({
        //dropdownParent:$("#modal-id"), //If Select2 Inside Modal
        //placeholder: '<i class="fas fa-search"></i> Search',
        //width:'100%',
        placeholder: {
            id: '0',
            text: '-- Pilih --'
        },
        minimumInputLength: 0,
        allowClear: true,
        ajax: {
            type: "get",
            url: url_tool,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search: params.term,
                    action:'search',
                    type: 1,
                    source: 'select_source'
                };
                return query;
            },
            processResults: function (data){
                var datas = [];
                $.each(data, function(key, val){
                    datas.push({
                        'id' : val.id,
                        'text' : val.text
                    });
                });
                return {
                    results: datas
                };
            },
        cache: true
        },
        escapeMarkup: function(markup){ 
            return markup; 
        },
        templateResult: function(datas){ //When Select on Click
            if (!datas.id) { return datas.text; }
            if($.isNumeric(datas.id) == true){
                // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            }else{
                // return '<i class="fas fa-plus '+datas.id.toLowerCase()+'"></i> '+datas.text;
                return datas.text;
            }
        },
        templateSelection: function(datas) { //When Option on Click
            if (!datas.id) { return datas.text; }
            //Custom Data Attribute
            $(datas.element).attr('data-alamat', datas.alamat);
            return datas.text;
        }
    });
    $("#select").on('change', function(e){
        // Do Something
    });
    */
    // $("select").select2();

    //Date Clock Picker
    $("#faq_date").datepicker({
        // defaultDate: new Date(),
        format: 'dd-mm-yyyy',
        autoclose: true,
        enableOnReadOnly: true,
        language: "id",
        todayHighlight: true,
        weekStart: 1 
    }).on('change', function(e){
    });
    $('.clockpicker').clockpicker({
        default: 'now',
        placement: 'bottom',
        align: 'left',
        donetext: 'Done',
        autoclose: true
    }).on('change', function(e){
    });
    $("#filter_start_date, #filter_end_date").datepicker({
        // defaultDate: new Date(),
        format: 'dd-mm-yyyy',
        autoclose: true,
        enableOnReadOnly: true,
        language: "id",
        todayHighlight: true,
        weekStart: 1 
    }).on('change', function(e){
        e.stopImmediatePropagation();
        faq_table.ajax.reload();
    });

    //Autonumeric
    const autoNumericOption = {
        digitGroupSeparator : ',', 
        decimalCharacter  : '.',
        decimalCharacterAlternative: '.', 
        decimalPlaces: 0,
        watchExternalChanges: true
    };
    // new AutoNumeric('#some_id', autoNumericOption);

    //Datatable
    let faq_table = $("#table_faq").DataTable({
        // "processing": true,
        // "rowReorder": { selector: 'td:nth-child(1)'},
        "responsive": true,
        "serverSide": true,
        "ajax": {
            url: url,
            type: 'post',
            dataType: 'json',
            cache: 'false',
            data: function(d) {
                d.action = 'load';
                d.length = $("#filter_length").find(':selected').val();
                // d.date_start = $("#filter_start_date").val();
                // d.date_end = $("#filter_end_date").val();
                d.filter_flag = $("#filter_flag").find(':selected').val();
                d.search = {value:$("#filter_search").val()};
            },
            dataSrc: function(data) {
                return data.result;
            }
        },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "columnDefs": [
            {"targets":0, "width":"30%", "title":"Question & Answer", "searchable":true, "orderable":true},
            {"targets":1, "width":"20%", "title":"Flag", "searchable":true, "orderable":true},
        ],
        "order": [[0, 'ASC']],
        "columns": [
            {
                'data': 'faq_id',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = '';
                    dsp += '<b>'+row.faq_question+'</b>';
                    dsp += '<br>';
                    dsp += row.faq_answer
                    return dsp;
                }
            },{
                'data': 'faq_id',
                className: 'text-left',
                render: function(data, meta, row) {
                    var dsp = ''; var label = 'Error Status'; var icon = 'fas fa-cog'; var color = 'white'; var bgcolor = '#d1dade';
                    if(parseInt(row.faq_flag) == 1){
                    //  dsp += '<label style="color:#6273df;">Aktif</label>';
                       label = 'Aktif';
                       icon = 'fas fa-lock';
                       bgcolor = '#0aa699';
                    }else if(parseInt(row.faq_flag) == 4){
                       //  dsp += '<label style="color:#ff194f;">Terhapus</label>';
                       label = 'Terhapus';
                       icon = 'fas fa-trash';
                       bgcolor = '#f35958';
                    }else if(parseInt(row.faq_flag) == 0){
                       //   dsp += '<label style="color:#ff9019;">Nonaktif</label>';
                       label = 'Nonaktif';
                       icon = 'fas fa-unlock';
                       // color = 'green';
                       bgcolor = '#ff9019';
                    }

                        /* Button Action Concept 1 */
                        // dsp += '&nbsp;<button class="btn btn_edit_faq btn-mini btn-primary"';
                        // dsp += 'data-faq-id="'+data+'" data-faq-name="'+row.faq_name+'" data-faq-flag="'+row.faq_flag+'" data-faq-session="'+row.faq_session+'">';
                        // dsp += '<span class="fas fa-edit primary"></span> Edit</button>';

                        // dsp += '&nbsp;<button class="btn btn_delete_faq btn-mini btn-danger"';
                        // dsp += 'data-faq-id="'+data+'" data-faq-name="'+row.faq_name+'" data-faq-flag="4" data-faq-session="'+row.faq_session+'">';
                        // dsp += '<span class="fas fa-trash danger"></span> Hapus</button>';

                        // if (parseInt(row.faq_flag) === 1) {
                        //   dsp += '&nbsp;<button class="btn btn_update_flag_faq btn-mini btn-primary" style="background-color:#ff9019;"';
                        //   dsp += 'data-faq-id="'+data+'" data-faq-name="'+row.faq_name+'" data-faq-flag="0" data-faq-session="'+row.faq_session+'">';
                        //   dsp += '<span class="fas fa-ban"></span> Nonaktifkan</button>';                      
                        // }else if (parseInt(row.faq_flag) === 0) {
                        //   dsp += '&nbsp;<button class="btn btn_update_flag_faq btn-mini btn-primary" style="background-color:#6273df;"';
                        //   dsp += 'data-faq-id="'+data+'" data-faq-name="'+row.faq_name+'" data-faq-flag="1" data-faq-session="'+row.faq_session+'">';
                        //   dsp += '<span class="fas fa-check primary"></span> Aktifkan</button>';
                        // }

                       /* Button Action Concept 2 */
                       dsp += '&nbsp;<div class="btn-group">';
                       // dsp += '    <button class="btn btn-mini btn-default"><span class="fas fa-cog"></span></button>';
                       dsp += '    <button class="btn btn-mini btn-default dropdown-toggle btn-demo-space" data-toggle="dropdown" aria-expanded="true"><span class="fas fa-cog"></span><span class="caret"></span> </button>';
                       dsp += '    <ul class="dropdown-menu">';
                       dsp += '        <li>';
                       dsp += '            <a class="btn_edit_faq" style="cursor:pointer;"';
                       dsp += '                data-faq-id="'+data+'" data-faq-name="'+row.faq_question+'" data-faq-flag="'+row.faq_flag+'">';
                       dsp += '                <span class="fas fa-edit"></span> Edit';
                       dsp += '            </a>';
                       dsp += '        </li>';
                       // if(parseInt(row.faq_flag) === 0) {
                               dsp += '<li>'; 
                               dsp += '    <a class="btn_update_flag_faq" style="cursor:pointer;"';
                               dsp += '        data-faq-id="'+data+'" data-faq-name="'+row.faq_question+'" data-faq-flag="1">';
                               dsp += '        <span class="fas fa-lock"></span> Aktifkan';
                               dsp += '    </a>';
                               dsp += '</li>';
                       // }else if(parseInt(row.faq_flag) === 1){
                               dsp += '<li>';
                               dsp += '    <a class="btn_update_flag_faq" style="cursor:pointer;"';
                               dsp += '        data-faq-id="'+data+'" data-faq-name="'+row.faq_question+'" data-faq-flag="0">';
                               dsp += '        <span class="fas fa-ban"></span> Nonaktifkan';
                               dsp += '    </a>';
                               dsp += '</li>';
                       // }
                       if((parseInt(row.faq_flag) < 1) || (parseInt(row.faq_flag) == 4)) {
                               dsp += '<li>';
                               dsp += '    <a class="btn_update_flag_faq" style="cursor:pointer;"';
                               dsp += '        data-faq-id="'+data+'" data-faq-name="'+row.faq_question+'" data-faq-flag="4">';
                               dsp += '        <span class="fas fa-trash"></span> Hapus';
                               dsp += '    </a>';
                               dsp += '</li>';
                       }
                       dsp += '        <li class="divider"></li>';
                       dsp += '        <li>';
                       dsp += '            <a class="btn_print_faq" style="cursor:pointer;" data-faq="'+ data +'">';
                       dsp += '                <span class="fas fa-print"></span> Print';
                       dsp += '            </a>';
                       dsp += '        </li>';
                       dsp += '    </ul>';
                       dsp += '</div>';

                       /* Button Action Concept 2 */
                       dsp += '&nbsp;<div class="btn-group">';
                       // dsp += '    <button class="btn btn-mini btn-default" style="background-color:'+bgcolor+';color:'+color+'"><span class="'+icon+'"></span> '+label+'</button>';
                       dsp += '    <button class="btn btn-mini btn-default dropdown-toggle btn-demo-space" style="background-color:'+bgcolor+';color:'+color+';" data-toggle="dropdown" aria-expanded="true"><span class="'+icon+'"></span> '+label+'</button>';
                    //    dsp += '    <ul class="dropdown-menu">';
                       if(parseInt(row.faq_flag) == 1){
                            //    dsp += '<li>';
                            //    dsp += '    <a class="btn_update_flag_faq" style="cursor:pointer;"';
                            //    dsp += '        data-faq-id="'+data+'" data-faq-name="'+row.faq_question+'" data-faq-flag="'+row.faq_flag+'">';
                            //    dsp += '        <span class="fas fa-ban"></span> Nonaktifkan';
                            //    dsp += '    </a>';
                            //    dsp += '</li>';
                       }else if(parseInt(row.faq_flag) == 0) {
                            //    dsp += '<li>'; 
                            //    dsp += '    <a class="btn_update_flag_faq" style="cursor:pointer;"';
                            //    dsp += '        data-faq-id="'+data+'" data-faq-name="'+row.faq_question+'" data-faq-flag="'+row.faq_flag+'">';
                            //    dsp += '        <span class="fas fa-lock"></span> Aktifkan';
                            //    dsp += '    </a>';
                            //    dsp += '</li>';
                       }
                    //    dsp += '    </ul>';
                       dsp += '</div>';
                    return dsp;
                }
            }
        ],
        "language": {
            "sProcessing":    "Sedang memuat",
            "sLengthMenu":    "Tampil _MENU_ data",
            "sZeroRecords":   "Data tidak ada",
            "sEmptyTable":    "Data tidak ada",
            "sInfo":          "Data _START_ sampai _END_ dari _TOTAL_ data",
            "sInfoEmpty":     "Data 0 sampai 0 dari 0 data",
            "sInfoFiltered":  "(saring total _MAX_ data)",
            "sInfoPostFix":   "",
            "sSearch":        "Cari:",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Loading...",
            "oPaginate": {
                "sFirst":    "Pertama",
                "sLast":    "Terakhir",
                "sNext":    "Selanjutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending":  ": Mengurutkan A-Z / 0-9",
                "sSortDescending": ": Mengurutkan Z-A / 9-0"
            }
        }
    });
    $("#table_faq_filter").css('display','none');
    $("#table_faq_length").css('display','none');
    $("#filter_length").on('change', function(e){
        var value = $(this).find(':selected').val(); 
        $('select[name="table_faq_length"]').val(value).trigger('change');
        faq_table.ajax.reload();
    });
    $("#filter_flag").on('change', function(e){ faq_table.ajax.reload(); });
    $("#filter_search").on('input', function(e){ var ln = $(this).val().length; if(parseInt(ln) > 3){ faq_table.ajax.reload(); }else if(parseInt(ln) < 1){ faq_table.ajax.reload();} });

    //CRUD
    $(document).on("click","#btn_save_faq",function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var next =true;
        if($("#faq_question").val().length == 0){
            notif(0,'Question wajib diisi');
            $("#faq_question").focus();
            next=false;
        }else if($("#faq_answer").val().length == 0){
            notif(0,'Answer wajib diisi');
            $("#faq_answer").focus();
            next=false;
        }else{
            var form = new FormData($("#form_faq")[0]);
            // var form = new FormData();
            form.append('action', 'create_update');
            // form.append('upload1', $("#faq_preview").attr('data-save-img'));
            if(faqID > 0){
                form.append('faq_id',faqID);
            }
            $.ajax({
                type: "POST",
                url: url,
                data: form, dataType:"json",
                cache: false, contentType: false, processData: false,
                beforeSend:function(){},
                success:function(d){
                    var s = d.status;
                    var m = d.message;
                    var r = d.result;
                    if(parseInt(s) == 1){
                        notif(s,m);
                        // formfaqReset();
                        /* hint zz_for or zz_each */
                        faq_table.ajax.reload();
                    }else{
                        notif(s,m);
                    }
                },
                error:function(xhr,status,err){
                    notif(0,err);
                }
            });
        }
    });
    $(document).on("click",".btn_edit_faq",function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var id       = $(this).attr('data-faq-id');
        var name     = $(this).attr('data-faq-name');

        var form = new FormData();
        form.append('action', 'read');
        form.append('faq_id', id);
        // form.append('faq_session', session);
        // form.append('faq_name', name);
        $.ajax({
            type: "post",
            url: url,
            data: form, dataType:"json",
            cache: false, contentType: false, processData: false,
            beforeSend:function(){},
            success:function(d){
                var s = d.status;
                var m = d.message;
                var r = d.result;
                if(parseInt(s)==1){ /* Success Message */
                    faqID = d.result.faq_id;
                    $("#modal_faq").modal('show');       
                    $("#faq_id").val(d.result.faq_id);
                    // $("#faq_session").val(d.result.faq_session);
                    // $("#faq_type").val(d.result.faq_type).trigger('change');
                    $("#faq_question").val(d.result.faq_question);
                    $("#faq_answer").val(d.result.faq_answer);                    
                    // $("#faq_note").val(d.result.faq_note);
                    // $('#faq_note').summernote('code', d.result.faq_note);
                    $("#faq_flag").val(d.result.faq_flag).trigger('change');
                    // $("#faq_date_created").val(d.result.faq_date_created);

                    // $("#files_preview").attr('src',d.result.faq_image);
                    // $(".files_link").attr('href',d.result.faq_image);

                    // scrollUp('content');
                    //loadfaqItem(r.faq_id);
                }else{
                    $("#div_form_faq").hide(300);
                    notif(0,d.message);
                }
            },
            error:function(xhr, Status, err){
                notif(0,'Error');
            }
        });
    });
    $(document).on("click",".btn_delete_faq",function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var next     = true;
        var id       = $(this).attr('data-faq-id');
        // var session  = $(this).attr('data-faq-session');
        var name     = $(this).attr('data-faq-name');

        $.confirm({
            title: 'Hapus!',
            content: 'Apakah anda ingin menghapus <b>'+name+'</b> ?',
            buttons: {
                confirm:{ 
                    btnClass: 'btn-danger',
                    text: 'Ya',
                    action: function () {
                        
                        var form = new FormData();
                        form.append('action', 'delete');
                        form.append('faq_id', id);
                        // form.append('faq_session', session);
                        form.append('faq_name', name);
                        form.append('faq_flag', 4);

                        $.ajax({
                            type: "POST",
                            url : url,
                            data: form,
                            dataType:'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(d){
                                if(parseInt(d.status)==1){ 
                                    notif(d.status,d.message); 
                                    faq_table.ajax.reload(null,false);
                                }else{ 
                                    notif(d.status,d.message); 
                                }
                            }
                        });
                    }
                },
                cancel:{
                    btnClass: 'btn-success',
                    text: 'Batal', 
                    action: function () {
                        // $.alert('Canceled!');
                    }
                }
            }
        });
    });

    $(document).on("click",".btn_update_flag_faq",function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var next     = true;
        var id       = $(this).attr('data-faq-id');
        // var session  = $(this).attr('data-faq-session');
        var name     = $(this).attr('data-faq-name');
        var flag     = $(this).attr('data-faq-flag');

        if(parseInt(flag) == 0){
            var set_flag = 0;
            var msg = 'menonaktifkan';
        }else if(parseInt(flag) == 1){
            var set_flag = 1;
            var msg = 'mengaktifkan';
        }else{
            var set_flag = 4;
            var msg = 'menghapus';
        }

        $.confirm({
            title: 'Konfirmasi!',
            content: 'Apakah anda ingin '+msg+' <b>'+name+'</b> ?',
            buttons: {
                confirm:{ 
                    btnClass: 'btn-danger',
                    text: 'Ya',
                    action: function () {
                        
                        var form = new FormData();
                        form.append('action', 'update_flag');
                        form.append('faq_id', id);
                        // form.append('faq_session', session);
                        form.append('faq_name', name);
                        form.append('faq_flag', set_flag);

                        $.ajax({
                            type: "POST",
                            url : url,
                            data: form,
                            dataType:'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(d){
                                if(parseInt(d.status)==1){ 
                                    notif(d.status,d.message); 
                                    faq_table.ajax.reload(null,false);
                                }else{ 
                                    notif(d.status,d.message); 
                                }
                            }
                        });
                    }
                },
                cancel:{
                    btnClass: 'btn-success',
                    text: 'Batal', 
                    action: function () {
                        // $.alert('Canceled!');
                    }
                }
            }
        });
    });


    //Additional
    $(document).on("click","#btn_new_faq",function(e) {
        formfaqReset();
        $("#modal_faq").modal('show');
        faqID = 0;
    });
    $(document).on("click","#btn_cancel_faq",function(e) {
        formfaqReset();
        $("#modal_faq").modal('hide');        
    });
    $(document).on("click",".btn_print_faq",function(e) {
        e.preventDefault();
        e.stopPropagation();
        var id = $(this).attr('data-faq-id');
        var session = $(this).attr('data-faq-session');
        if(parseInt(id) > 0){
            var x = screen.width / 2 - 700 / 2;
            var y = screen.height / 2 - 450 / 2;
            var print_url = url_print+'?action=print&data='+session;
            var win = window.open(print_url,'Print','width=700,height=485,left=' + x + ',top=' + y + '').print();
            //var win = window.open(print_url,'_blank');
        }else{
            notif(0,'Dokumen belum di buka');
        }
    });
    $(document).on("click","#btn_export_faq",function(e) {
        e.stopPropagation();
        $.alert('Fungsi belum dibuat');
    });
    $(document).on("click","#btn_print_faq",function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log($(this));
        // var id = $(this).attr('data-faq-id');
        $.alert('Fungsi belum dibuat');
    });
    /*
    $('#files').change(function(e) {
        var fileName = e.target.files[0].name;
        var fileReader = new FileReader();
        fileReader.onload = function(e) {
            $('#files_preview').attr('src', e.target.result).width(150).height(150);
            $('.files_link').attr('href', e.target.result);
        };
        fileReader.readAsDataURL(this.files[0]);
    });
    */

    //Image Croppie
    $(document).on('change', '#files', function(e) {
        if($("#files").val() == ''){
            $("#files_preview").attr('src', url_image);
            $("#files_link").attr('href', url_image);
            $("#files_preview").attr('data-save-img', '');
            return;
        }
        var reader = new FileReader();
        reader.onload = function(e) {
        upload_crop_img.croppie('bind', {
            url: e.target.result
            }).then(function () {
                $("#modal_croppie").modal("show");
                    setTimeout(function(){$('#modal_croppie_canvas').croppie('bind');}, 300);
            });
        };
        reader.readAsDataURL(this.files[0]);
    });
    $(document).on('click', '#modal_croppie_cancel', function(e){
        e.preventDefault(); e.stopPropagation();
        $("#files").val('');
        $("#files_preview").attr('data-save-img', '');
        $("#files_preview").attr('src', url_image);
        $("#files_link").attr('href', url_image);
    });
    $(document).on('click', '#modal_croppie_save', function(e){
        e.preventDefault(); e.stopPropagation();
        upload_crop_img.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function (resp) {
            $("#files_preview").attr('src', resp);
            $("#files_link").attr('href', resp);
            $("#files_preview").attr('data-save-img', resp);
            $("#modal_croppie").modal("hide");
        });
    });

    // window.setInterval(loadPlugin(),3000);
    function loadPlugin(){
    }
    function formfaqReset(){
        $("#form_faq input")
        .not("input[id='faq_hour']")
        .not("input[id='faq_date']")
        .not("input[id='faq_date_start']")
        .not("input[id='faq_date_end']").val('');
        $("#form_faq textarea").val('');

        $("#files_link").attr('href',url_image);
        $("#files_preview").attr('src',url_image);
        $("#files_preview").attr('data-save-img',url_image);
    } 
}); //End of Document Ready
</script>