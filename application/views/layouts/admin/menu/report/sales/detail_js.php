
<script>
    $(document).ready(function () {
        var url = "<?= base_url('transaksi/manage'); ?>";
        //var url_print = "<?= base_url('report/prints'); ?>"; 
        var url_print_trans = "<?= base_url('transaksi/print'); ?>";
        var url_print = "<?= base_url('report'); ?>";
        $(".nav-tabs").find('li[class="active"]').removeClass('active');
        $(".nav-tabs").find('li[data-name="report/sales/sell/detail"]').addClass('active');

        var url_print_sales_order = "<?= base_url('sales_order/print_order/'); ?>";
        var url_print_penjualan = "<?= base_url('sales_order/print_payment/'); ?>";
        var url_print_pembelian = "<?= base_url('beli/print_beli/'); ?>";
        
        var product_alias = "<?php echo $product_alias; ?>";
        var contact_alias = "<?php echo $customer_alias; ?>";
        
        const autoNumericOption = {
            digitGroupSeparator: '.',
            decimalCharacter: ',',
            decimalCharacterAlternative: ',',
            decimalPlaces: 0,
            watchExternalChanges: true //!!!        
        };

        // new AutoNumeric('#harga_jual', autoNumericOption);
        // new AutoNumeric('#harga_beli', autoNumericOption);
        // console.log(identity+' - '+type);
        var index = $("#table-data").DataTable({
            // "processing": true,
            "serverSide": true,
            "ajax": {
                url: url,
                type: 'post',
                dataType: 'json',
                cache: 'false',
                data: function (d) {
                    d.action = 'load-trans-items-for-report';
                    d.tipe = 2;
                    d.date_start = $("#start").val();
                    d.date_end = $("#end").val();
                    // d.start = $("#table-data").attr('data-limit-start');
                    // d.length = $("#table-data").attr('data-limit-end'); 
                    d.length = $("#filter_length").find(':selected').val();
                    d.kontak = $("#filter_kontak").find(':selected').val();
                    d.product = $("#filter_produk").find(':selected').val();
                    d.sales = $("#filter_sales").find(':selected').val();                    
                    d.order[0]['column'] = $("#filter_order").find(':selected').val();
                    d.order[0]['dir'] = $("#filter_dir").find(':selected').val();
                    // d.search = {
                    // value:$("#filter_search").val()
                    // };               
                    // d.user_role =  $("#select_role").val();
                },
                dataSrc: function (data) {
                    return data.result;
                }
            },
            "columnDefs": [
                {"targets": 0, "title": "Tanggal", "searchable": false, "orderable": false},
                {"targets": 1, "title": "Nomor", "searchable": false, "orderable": false},
                {"targets": 2, "title": contact_alias, "searchable": false, "orderable": false},
                {"targets": 3, "title": "Kode", "searchable": false, "orderable": false},
                {"targets": 4, "title": "Nama "+product_alias, "searchable": false, "orderable": false},
                {"targets": 5, "title": "Qty", "searchable": false, "orderable": false},
                {"targets": 6, "title": "Total Nilai", "searchable": false, "orderable": false}
            ],
            // "order": [
            //   [0, 'asc']
            // ],
            "columns": [{
                    'data': 'trans_date'
                }, {
                    'data': 'trans_number',
                    render: function (data, meta, row) {
                        var dsp = '';
                        // dsp += row.trans_number;
                        dsp += '<a class="btn-print" data-id="' + row.trans_id + '" data-session="' + row.trans_session + '" style="cursor:pointer;">';
                        dsp += '<span class="fas fa-file-alt"></span>&nbsp;' + row.trans_number;
                        dsp += '</a>';
                        return dsp;
                    }
                }, {
                    'data': 'contact_name'
                }, {
                    'data': 'product_code'
                }, {
                    'data': 'product_name',
                    render: function (data, meta, row) {
                        var dsp = '';
                        dsp += row.product_name;
                        // dsp += '<a class="btn-edit" data-id="'+ row.trans_id +'" style="cursor:pointer;">';
                        // dsp += '<span class="fas fa-file-alt"></span>&nbsp;'+row.trans_number;
                        // dsp += '</a>';
                        return dsp;
                    }
                }, {
                    'data': 'trans_item_unit', className: 'text-right',
                    render: function (data, meta, row) {
                        var dsp = '';
                        dsp += addCommas(row.trans_item_out_qty) + ' ' + row.trans_item_unit;
                        return dsp;
                    }
                }, {
                    'data': 'trans_item_sell_total',
                    className: 'text-right',
                    render: function (data, meta, row) {
                        var dsp = '';
                        dsp += addCommas(row.trans_item_sell_total);
                        // dsp += '<button class="btn-pay btn btn-mini btn-info" data-contact-id="'+ row.contact_id +'">';
                        // dsp += '<span class="fas fa-money-bill"></span> Bayar';
                        // dsp += '</button>';          
                        // dsp += '&nbsp;<button class="btn-delete btn btn-mini btn-danger" data-id="'+ data +'" data-number="'+row.trans_number+'">';
                        // dsp += '<span class="fas fa-trash"></span> Hapus';
                        // dsp += '</button>';  
                        return dsp;
                    }
                }]
        });

        //Datatable Config  
        $("#table-data_info").css('display', 'none');
        $("#table-data_paginate").css('display', 'none');
        $("#table-data_filter").css('display', 'none');
        $("#table-data_length").css('display', 'none');
        $('#table-data').on('page.dt', function () {
            var info = index.page.info();
            // console.log( 'Showing page: '+info.page+' of '+info.pages);
            var limit_start = info.start;
            var limit_end = info.end;
            var length = info.length;
            var page = info.page;
            var pages = info.pages;
            console.log(limit_start, limit_end);
            $("#table-data").attr('data-limit-start', limit_start);
            $("#table-data").attr('data-limit-end', limit_end);
        });

        $("#start, #end").datepicker({
            // defaultDate: new Date(),
            format: 'dd-mm-yyyy',
            autoclose: true,
            enableOnReadOnly: true,
            language: "id",
            todayHighlight: true,
            weekStart: 1
        }).on('change', function () {
            index.ajax.reload();
        });

        $('#filter_kontak').select2({
            //dropdownParent:$("#modal-id"), //If Select2 Inside Modal
            placeholder: '<i class="fas fa-search"></i> Search',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        tipe: 2, //1=Supplier, 2=Asuransi
                        source: 'contacts'
                    }
                    return query;
                },
                processResults: function (datas, params) {
                    params.page = params.page || 1;
                    return {
                        results: datas,
                        pagination: {
                            more: (params.page * 10) < datas.count_filtered
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            templateResult: function (datas) { //When Select on Click
                if (!datas.id) {
                    return datas.text;
                }
                if ($.isNumeric(datas.id) == true) {
                    // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                    return datas.text;
                }
            },
            templateSelection: function (datas) { //When Option on Click
                if (!datas.id) {
                    return datas.text;
                }
                //Custom Data Attribute
                $(datas.element).attr('data-alamat', datas.alamat);
                $(datas.element).attr('data-telepon', datas.telepon);
                $(datas.element).attr('data-email', datas.email);
                if ($.isNumeric(datas.id) == true) {
                    return '<i class="fas fa-user-check ' + datas.id.toLowerCase() + '"></i> ' + datas.text;
                }
            }
        });        
        $('#filter_produk').select2({
            //dropdownParent:$("#modal-id"), //If Select2 Inside Modal
            placeholder: '<i class="fas fa-search"></i> Search',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        tipe: 2, //1=Supplier, 2=Asuransi
                        category: 1,
                        source: 'products'
                    }
                    return query;
                },
                processResults: function (datas, params) {
                    params.page = params.page || 1;
                    return {
                        results: datas,
                        pagination: {
                            more: (params.page * 10) < datas.count_filtered
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            templateResult: function (datas) { //When Select on Click
                if (!datas.id) {
                    return datas.text;
                }
                if ($.isNumeric(datas.id) == true) {
                    // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                    return datas.text;
                }
            },
            templateSelection: function (datas) { //When Option on Click
                if (!datas.id) {
                    return datas.text;
                }
                //Custom Data Attribute
                $(datas.element).attr('data-alamat', datas.alamat);
                $(datas.element).attr('data-telepon', datas.telepon);
                $(datas.element).attr('data-email', datas.email);
                if ($.isNumeric(datas.id) == true) {
                    return '<i class="fas fa-boxes ' + datas.id.toLowerCase() + '"></i> ' + datas.text;
                }
            }
        });
        $('#filter_sales').select2({
            //dropdownParent:$("#modal-id"), //If Select2 Inside Modal
            placeholder: '<i class="fas fa-search"></i> Search',
            minimumInputLength: 0,
            ajax: {
                type: "get",
                url: "<?= base_url('search/manage'); ?>",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        tipe: 3, //1=Supplier, 2=Asuransi
                        source: 'contacts'
                    }
                    return query;
                },
                processResults: function (datas, params) {
                    params.page = params.page || 1;
                    return {
                        results: datas,
                        pagination: {
                            more: (params.page * 10) < datas.count_filtered
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            templateResult: function (datas) { //When Select on Click
                if (!datas.id) {
                    return datas.text;
                }
                if ($.isNumeric(datas.id) == true) {
                    // return '<i class="fas fa-user-check '+datas.id.toLowerCase()+'"></i> '+datas.text;
                    return datas.text;
                }
            },
            templateSelection: function (datas) { //When Option on Click
                if (!datas.id) {
                    return datas.text;
                }
                //Custom Data Attribute
                // $(datas.element).attr('data-alamat', datas.alamat);
                // $(datas.element).attr('data-telepon', datas.telepon);
                // $(datas.element).attr('data-email', datas.email);
                if ($.isNumeric(datas.id) == true) {
                    return '<i class="fas fa-user-check ' + datas.id.toLowerCase() + '"></i> ' + datas.text;
                }
            }
        });          
        $(document).on("change", "#filter_kontak, #filter_produk, #filter_order, #filter_dir, #filter_sales", function (e) {
            index.ajax.reload();
        });

        // Print Button
        $(document).on("click", ".btn-print", function () {
            var id = $(this).attr("data-session");
            var x = screen.width / 2 - 700 / 2;
            var y = screen.height / 2 - 450 / 2;
            var print_url = url_print_trans + '/' + id;
            var win = window.open(print_url, 'Print', 'width=700,height=485,left=' + x + ',top=' + y + '').print();
        });
        $(document).on("click", ".btn-print-all", function () {
            var id = $(this).attr("data-id");
            var action = $(this).attr('data-action'); //1,2
            var request = $(this).attr('data-request'); //report_purchase_buy_recap
            var format = $(this).attr('data-format'); //html, xls
            var contact = $("#filter_kontak").find(':selected').val();
            var sales = $("#filter_sales").find(':selected').val();            
            var product = $("#filter_produk").find(':selected').val();

            var order = $("#filter_order").find(':selected').val();
            if (order == 0) {
                order = 'trans_date';
            } else if (order == 1) {
                order = 'trans_number';
            } else if (order == 3) {
                order = 'trans_total';
            }

            var dir = $("#filter_dir").find(':selected').val();
            //alert('#btn-print-all on Click'+action+','+request);
            // var x = screen.width / 2 - 700 / 2;
            // var y = screen.height / 2 - 450 / 2;
            // var print_url = url_print +'/'+ action + '/' +request+ '/' +contact+ '/' + $("#start").val() + '/' + $("#end").val();
            var print_url = url_print + '/'
                    + request + '/'
                    + $("#start").val() + '/'
                    + $("#end").val() + '/'
                    + contact + "?product=" + product + "&format=" + format + "&order=" + order + "&dir=" + dir + "&sales=" + sales;
            window.open(print_url, '_blank');
            // var request = $('.btn-print-all').data('request');
            // var print_url = url_print +'/'+ request + '/'+ $("#start").val() +'/'+ $("#end").val();
            // var win = window.open(print_url,'Print','width=700,height=485,left=' + x + ',top=' + y + '').print();   
        });
    });
</script>