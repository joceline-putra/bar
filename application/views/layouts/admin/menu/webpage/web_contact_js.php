<script>
    $(document).ready(function () {

        var identity = 6;
        var view = 2;
        var url = "<?= base_url('webpage/contact'); ?>";  
        var url_update = "<?= base_url('webpage/contact'); ?>";        
        var url_image = '<?= base_url('upload/noimage.png'); ?>';

        let image_width = "<?= $image_width;?>";
        let image_height = "<?= $image_height;?>"; 

        $(".nav-tabs").find('li[class="active"]').removeClass('active');
        $(".nav-tabs").find('li[data-name="configuration/branch"]').addClass('active');

        //Croppie
        var upload_crop_img = null;
        upload_crop_img = $('#modal-croppie-canvas').croppie({
            enableExif: true,
            viewport: {width: image_width, height: image_height},
            boundary: {width: parseInt(image_width)+10, height: parseInt(image_height)+10},
            url: url_image,
        });

        $('#provinsi').select2({
            placeholder: '--- Pilih Kota / Kabupaten ---',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        source: 'provinces'
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateSelection: function (data, container) {
                // Add custom attributes to the <option> tag for the selected option
                // $(data.element).attr('data-province-id', data.customValue);  
                // $(data.element).attr('data-province-id', data.customValue);      
                // $("input[name='satuan']").val(data.satuan);
                return data.text;
            }
        });
        $('#kota').select2({
            placeholder: '--- Pilih Kota / Kabupaten ---',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var province_id = $("#provinsi").find(':selected').val();
                    if (parseInt(province_id) > 0) {
                        var query = {
                            search: params.term,
                            province_id: $("#provinsi").find(':selected').val(),
                            source: 'cities'
                        }
                        return query;
                    } else {
                        notif(0, 'Masukkan Provinsi terlebih dahulu');
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateSelection: function (data, container) {
                // Add custom attributes to the <option> tag for the selected option
                // $(data.element).attr('data-province-id', data.province_id);  
                // $(data.element).attr('data-province-name', data.province_name);      
                // $("input[name='satuan']").val(data.satuan);
                return data.text;
            }
        });
        $('#kecamatan').select2({
            placeholder: '--- Pilih Kota / Kabupaten ---',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    // var province_id = $("#provinsi").find(':selected').val(),
                    var city_id = $("#kota").find(':selected').val();
                    if (parseInt(city_id) > 0) {
                        var query = {
                            search: params.term,
                            province_id: $("#provinsi").find(':selected').val(),
                            city_id: $("#kota").find(':selected').val(),
                            source: 'districts'
                        }
                        return query;
                    } else {
                        notif(0, 'Masukkan Kota / Kabupaten terlebih dahulu');
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateSelection: function (data, container) {
                // Add custom attributes to the <option> tag for the selected option
                // $(data.element).attr('data-province-id', data.province_id);  
                // $(data.element).attr('data-province-name', data.province_name);    
                // $(data.element).attr('data-city-id', data.city_id);  
                // $(data.element).attr('data-city-name', data.city_name);                 
                // $("input[name='satuan']").val(data.satuan);
                return data.text;
            }
        });

        $(document).on("click", "#btn-update", function (e) {
            e.preventDefault();
            var next = true;
            var id = $("#form-master input[name='id_dokumen']").val();
            var nama = $("#form-master input[name='nama']");

            if (id == '') {
                notif(0, 'ID tidak ditemukan');
                next = false;
            }


            if (nama.val().length == 0) {
                notif(0, 'Nama wajib diisi');
                nama.focus();
                next = false;
            }


            if (next == true) {
                if ($("input[id='telepon_1']").val().length == 0) {
                    notif(0, 'Telepon wajib diisi');
                    $("#telepon_1").focus();
                    next = false;
                }
            }

            if (next == true) {
                if ($("input[id='email_1']").val().length == 0) {
                    notif(0, 'Email wajib diisi');
                    $("#email_1").focus();
                    next = false;
                }
            }

            if (next == true) {
                if ($("textarea[id='alamat']").val().length == 0) {
                    notif(0, 'Alamat wajib diisi');
                    $("#alamat").focus();
                    next = false;
                }
            }

            if (next == true) {
                if ($("select[id='provinsi']").find(":selected").val() == 0) {
                    notif(0, 'Provinsi harus dipilih');
                    next = false;
                }
            }

            if (next == true) {
                if ($("select[id='kota']").find(":selected").val() == 0) {
                    notif(0, 'Kota harus dipilih');
                    next = false;
                }
            }

            if (next == true) {
                if ($("select[id='kecamatan']").find(":selected").val() == 0) {
                    notif(0, 'Kecamatan harus dipilih');
                    next = false;
                }
            }

            if (next == true) {
                var form = new FormData($("#form-master")[0]);
                form.append('action', 'update');
                form.append('id', $('#id_document').val());
                // form.append('upload1', $('#upload1')[0].files[0]);
                // form.append('nama', $('#nama').val());
                // form.append('telepon_1', $('#telepon_1').val());
                // form.append('email_1', $('#email_1').val());
                // form.append('alamat', $('#alamat').val());
                // form.append('provinsi', $('#provinsi').find(':selected').val());
                // form.append('kota', $('#kota').find(':selected').val());
                // form.append('kecamatan', $('#kecamatan').find(':selected').val());
                form.append('upload1', $("#files_preview").attr('data-save-img'));
                $.ajax({
                    type: "POST",
                    url: url_update,
                    data: form,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        notif(1,'Sedang memperbarui');
                    },
                    success: function(d){
                        if (parseInt(d.status) == 1) {
                            notif(1, d.message);
                            index.ajax.reload(null, false);
                        } else {
                            notif(0, d.message);
                        }
                    },
                    error: function (xhr, Status, err) {
                        notif(0, 'Error');
                    }
                });
            }
        });

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
                    $("#modal-croppie").modal("show");
                    setTimeout(function(){$('#modal-croppie-canvas').croppie('bind');}, 300);
                });
            };
            reader.readAsDataURL(this.files[0]);
        });
        $(document).on('click', '#modal-croppie-cancel', function(e){
            e.preventDefault();
            e.stopPropagation();
            $("#files").val('');
            $("#files_preview").attr('data-save-img', '');
            $("#files_preview").attr('src', url_image);
            $("#files_link").attr('href', url_image);
        });
        $(document).on('click', '#modal-croppie-save', function(e){
            e.preventDefault();
            e.stopPropagation();
            upload_crop_img.croppie('result', {
                type: 'canvas',
                size: 'viewport',
            }).then(function (resp) {
                $("#files_preview").attr('src', resp);
                $("#files_link").attr('href', resp);
                $("#files_preview").attr('data-save-img', resp);
                $("#modal-croppie").modal("hide");
            });
        });    

        // Edit Button
        function getData(id){
            var formData = new FormData();
            formData.append('action','read');
            formData.append('id',id);
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function () {
                },
                success: function (d) {
                    if (parseInt(d.status) == 1) { /* Success Message */
                        $("#kode").attr('readonly', true);
                        $("#form-master input[id='id_document']").val(d.result.branch_id);
                        $("#form-master input[name='kode']").val(d.result.branch_code);
                        $("#form-master input[name='nama']").val(d.result.branch_name);
                        $("#form-master input[name='telepon_1']").val(d.result.branch_phone_1);
                        $("#form-master input[name='email_1']").val(d.result.branch_email_1);
                        $("#form-master input[name='telepon_2']").val(d.result.branch_phone_2);
                        $("#form-master input[name='email_2']").val(d.result.branch_email_2);                        
                        $("#form-master textarea[name='alamat']").val(d.result.branch_address);
                        $("#form-master select[name='status']").val(d.result.branch_flag).trigger('change');

                        if (parseInt(d.result.branch_logo) == 0) {
                            $("#files_preview").attr('src',url_image);
                            $(".files_link").attr('href',url_image);                            
                        } else {
                            var image = "<?php echo base_url(); ?>" + d.result.branch_logo;
                            $("#files_preview").attr('src',image);
                            $(".files_link").attr('href',image);                            
                        }

                        $("select[id='provinsi']").append('' +
                                '<option value="' + d.result.branch_province_id + '">' +
                                d.result.branch_province +
                                '</option>');
                        $("select[id='provinsi']").val(d.result.branch_province_id).trigger('change');

                        $("select[id='kota']").append('' +
                                '<option value="' + d.result.branch_city_id + '">' +
                                d.result.branch_city +
                                '</option>');
                        $("select[id='kota']").val(d.result.branch_city_id).trigger('change');

                        // $("select[id='kecamatan']").append('' +
                        //         '<option value="' + d.result.branch_district_id + '">' +
                        //         d.result.branch_district +
                        //         '</option>');
                        // $("select[id='kecamatan']").val(d.result.branch_district_id).trigger('change');

                        var rj = JSON.parse(d.result.branch_note);
                        if (rj.working_hour !== undefined && rj.working_hour !== null) {
                            $("#working_hour").val(rj.working_hour);
                        }

                        if (rj.header_title !== undefined && rj.header_title !== null) {
                            $("#header_title").val(rj.header_title);
                        }                        

                        let sm = rj.social_media;
                        sm.forEach(async (v, i) => {
                            $("#"+v['name']+"").val(v['link']);
                        });

                        if (rj.map.longitude !== undefined && rj.map.longitude !== null) {
                            $("#longitude").val(rj.map.longitude);
                        }                        

                        if (rj.map.latitude !== undefined && rj.map.latitude !== null) {
                            $("#latitude").val(rj.map.latitude);
                        } 
                        if (rj.map.link !== undefined && rj.map.link !== null) {
                            $("#link").val(rj.map.link);
                        }                                                                        
                        // if (rj.facebook !== undefined && rj.facebook !== null) {
                        //     $("#facebook").val(rj.facebook);
                        // } 
                        
                        // if (rj.twitter !== undefined && rj.twitter !== null) {
                        //     $("#twitter").val(rj.twitter);
                        // }           

                        // if (rj.instagram !== undefined && rj.instagram !== null) {
                        //     $("#instagram").val(rj.instagram);
                        // }
                        
                        // if (rj.tiktok !== undefined && rj.tiktok !== null) {
                        //     $("#tiktok").val(rj.tiktok);
                        // }    
                        
                        // if (rj.youtube !== undefined && rj.youtube !== null) {
                        //     $("#youtube").val(rj.youtube);
                        // }                            
                    } else {
                        notif(0, 'Else');
                    }
                },
                error: function (xhr, Status, err) {
                    notif(0, 'Error '+err);
                    console.log(err);
                }
            });
        }
        getData(1);             
    });
</script>