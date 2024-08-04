<input class="hidden" id="iduser" name="iduser" value="<?php echo $session['user_data']['user_id']; ?>">
<script>
    // Start document ready
    $(document).ready(function () {
        var url_approval = "<?= base_url('approval'); ?>";
        var url_dashboard = "<?= base_url('dashboard'); ?>";
        var url_trans = "<?= base_url('transaksi/manage'); ?>";

        //Dashboard Scroll
        var limit_start = 1;
        var next_ = true; // true = data ada dimuat kembali & false = data tidak ada!
        if (next_ == true) { //Start on Refresh Page
            next_ = false;
            checkDashboardActivity(limit_start);
        }

        $(window).on("scroll", function (e) {
            var scrollTop       = Math.round($(window).scrollTop());
            var height          = Math.round($(window).height());
            var dashboardHeight = Math.round($(document).height());

            let window_height   = $(window).height();
            let document_height = $(document).height();
            let scroll_top      = $(window).scrollTop();

            console.log('Win Height => '+window_height+', Doc Height => '+document_height+', Scrool => '+ scroll_top);

            if (scroll_top + window_height > (document_height - 100) && next_ == true) {
                // next_ = false;
                // limit_start = limit_start + 1;
                // checkDashboardActivity(limit_start);
            }
        });

        $('#dashboard_user').select2();
        $('.date').datepicker({
            // defaultDate: new Date(),
            format: 'dd-mm-yyyy',
            autoclose: true,
            enableOnReadOnly: true,
            language: "id",
            todayHighlight: true,
            weekStart: 1
        }).on("changeDate", function (e) {
        });
        $("#tgl_2").val("<?php echo $end_date; ?>");
        $("#tgl_awal, #tgl_akhir, #dashboard_user").on('change', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $("#dashboard-notif").html('');
            checkDashboardActivity(1);
        });


        /* Dashboard Activity */
        function checkDashboardActivity(limit_start) {
            // $.playSound("http://www.noiseaddicts.com/samples_1w72b820/3721.mp3");
            $.ajax({
                type: "post",
                url: "<?= base_url('aktivitas/manage/'); ?>",
                data: {
                    action: 'dashboard',
                    start: $("#tgl_awal").val(),
                    end: $("#tgl_akhir").val(),
                    user: $("#dashboard_user").val(),
                    limit_start: limit_start,
                    limit_end: 10,
                },
                dataType: 'json', cache: false,
                beforeSend: function () {
                    console.log('LIMIT '+limit_start+', '+10);
                    $("#dashboard-notif").append("<div class='loading-pages text-center' style='color: black;padding-top:10px'><i class='fas fa-spinner fa-spin m-2'></i> Sedang Memuat...</div>");
                },
                success: function (d) {
                    if (parseInt(d.total_records) > 0) {
                        $(".loading-pages").remove();
                        $.each(d.result, function (i, val) {

                            var teks = '';
                            if (val.act_action == 1) {
                                teks += '<a href="#">';
                                teks += '<span class="label label-success" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_action_name + '</span>';
                                teks += '</a>';
                                // teks += '<a href="#" style="color:#54BAB9;cursor:default;">'+val.act_action_name;
                                // teks += '</a>';                            
                            } else if (val.act_action == 2) {
                                // var teks_1 = 'membuat';
                                // var teks_2 = '<span class="label label-inverse">'+ val.text2 +'</span>&nbsp;';
                                // var teks_3 = '<span class="label label-success">'+ val.nomor_dokumen +'</span>&nbsp;';
                                // var teks_4 = '<span class="label label-purple"></span>&nbsp;</a>';
                                // var teks_5 = '<span class="label label-red">'+ val.kontak_nama +'</span>&nbsp;';
                                // var teks_6 = '<b>'+ val.text3 +'</b>';
                                teks += val.act_action_name + '&nbsp;';

                                if (val.act_type == 1) {
                                    var color = '#ef6238';
                                } else if (val.act_type == 2) {
                                    var color = '#9465ec';
                                }

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-inverse" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-primary" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-success" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                                // teks += '<a href="#" style="color:#54BAB9;cursor:default;">'+val.act_action_name;
                                // teks += '</a>';              
                            } else if (val.act_action == 3) {
                                // var teks_1 = 'membuat';
                                // var teks_2 = '<span class="label label-inverse">'+ val.text2 +'</span>&nbsp;';
                                // var teks_3 = '<span class="label label-success">'+ val.nomor_dokumen +'</span>&nbsp;';
                                // var teks_4 = '<span class="label label-purple"></span>&nbsp;</a>';
                                // var teks_5 = '<span class="label label-red">'+ val.kontak_nama +'</span>&nbsp;';
                                // var teks_6 = '<b>'+ val.text3 +'</b>';
                                teks += val.act_action_name + '&nbsp;';

                                if (val.act_type == 1) {
                                    var color = '#ef6238';
                                } else if (val.act_type == 2) {
                                    var color = '#9465ec';
                                } else {
                                    var color = '#c0216e';
                                }

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label" style="background-color:' + color + ';color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-success" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-inverse" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                                // teks += '<a href="#" style="color:#54BAB9;cursor:default;">'+val.act_action_name;
                                // teks += '</a>';              
                            } else if (val.act_action == 4) {
                                teks += val.act_action_name + '&nbsp;';

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-inverse" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-primary" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-success" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                            } else if (val.act_action == 5) {
                                teks += val.act_action_name + '&nbsp;';

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label" style="background-color:' + color + ';color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-danger" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-inverse" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                            } else if (val.act_action == 6) {
                                teks += val.act_action_name + '&nbsp;';

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label" style="background-color:#ff6384;color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-danger" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-inverse" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                            } else if (val.act_action == 7) {
                                teks += val.act_action_name + '&nbsp;';

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-success" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-success" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-success" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                            } else if (val.act_action == 8) {
                                teks += val.act_action_name + '&nbsp;';

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-danger" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-danger" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-danger" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                            } else if (val.act_action == 9) {
                                // teks += val.act_action_name + '&nbsp;';
                                teks += val.act_action_name;
                                // if(val.act_text_1 !== 0){
                                // 	teks += val.act_text_1+'&nbsp;';
                                // }

                                if (val.act_text_1 !== 0) {
                                    // teks += '<a href="#">';
                                    // teks += '<span class="label" style="background-color:#ef6605;color:white;padding:1px 6px;">' + val.act_text_1 + '</span>';
                                    // teks += '</a>&nbsp';
                                    // teks += val.act_text_1;
                                    teks += val.act_text_1.toLowerCase()+'&nbsp;';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label" style="padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label" style="padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                                
                                if (val.act_text_4 !== 0) {
                                    var si = '';
                                    if(val.act_text_4 == "Approve"){
                                        si = '<span class="label" style="background-color:#008dd5;color:white;padding:1px 6px;"><i class="fas fa-check" style="font-size:12px;"></i> ' + val.act_text_4 + '</span>';                                        
                                    }else if(val.act_text_4 == "Tolak"){
                                        si = '<span class="label" style="background-color:#d72d57;color:white;padding:1px 6px;"><i class="fas fa-times" style="font-size:12px;"></i> ' + val.act_text_4 + '</span>';
                                    }else if(val.act_text_4 == "Tunda"){
                                        si = '<span class="label" style="background-color:#ee6605;color:white;padding:1px 6px;"><i class="fas fa-hand-paper" style="font-size:12px;"></i> ' + val.act_text_4 + '</span>';
                                    }else if(val.act_text_4 == "Hapus"){
                                        si = '<span class="label" style="background-color:#d72d57;color:white;padding:1px 6px;"><i class="fas fa-trash" style="font-size:12px;"></i> ' + val.act_text_4 + '</span>';
                                    }else{
                                        si = 'Error';
                                    }                                    
                                    teks += '&nbsp;<a href="#">';
                                    teks += si;
                                    teks += '</a>';
                                    teks += '&nbsp; '+val.act_text_5;                                    
                                }            
                            } else if (val.act_action == 10) {
                                teks += val.act_action_name + '&nbsp;';

                                // if(val.act_text_1 !== 0){
                                // 	teks += val.act_text_1+'&nbsp;';
                                // }

                                if (val.act_text_1 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label" style="color:black;padding:1px 6px;"><i class="' + val.act_icon + '"></i>&nbsp;' + val.act_text_1 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_2 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-inverse" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_2 + '</span>';
                                    teks += '</a>&nbsp';
                                }

                                if (val.act_text_3 !== 0) {
                                    teks += '<a href="#">';
                                    teks += '<span class="label label-danger" style="background-color:#54BAB9;color:white;padding:1px 6px;">' + val.act_text_3 + '</span>';
                                    teks += '</a>';
                                }
                            }
                            // else if(val.text1 == "menerbitkan"){
                            //   var teks_1 = 'menerbitkan';
                            //   var teks_2 = '<span class="label label-inverse">'+ val.text2 +'</span>&nbsp;';
                            //   var teks_3 = '<span class="label label-success">'+ val.nomor_dokumen +'</span>&nbsp;';
                            //   var teks_4 = '<span class="label label-purple"></span>&nbsp;</a>';
                            //   var teks_5 = '<span class="label label-red">'+ val.kontak_nama +'</span>&nbsp;';
                            //   var teks_6 = '<b>'+ val.text3 +'</b>';
                            // }else if(val.text1 == "menambahkan"){
                            //   var teks_1 = 'menambahkan';
                            //   var teks_2 = '<span class="label label-success">'+ val.text2 +'</span>&nbsp;';
                            //   var teks_3 = '<span class="label label-default">'+ val.text3 +'</span>&nbsp;';
                            //   var teks_4 = '<span class="label label-inverse">'+ val.text4 +'</span>&nbsp;</a>';
                            //   var teks_5 = '<span class="label label-red"></span>&nbsp;';
                            //   var teks_6 = '<b></b>';
                            // }else if(val.text1 == "APPROVE"){
                            //   var teks_1 = '<span class="label label-success"><i class="fa fa-check"></i> Approved</span></a>';
                            //   var teks_2 = '<span class="label label-inverse">'+ val.text2 +'</span>&nbsp;';
                            //   var teks_3 = '<span class="label label-primary">'+ val.nomor_dokumen +'</span>&nbsp;';
                            //   var teks_4 = '<span class="label label-primary"></span>&nbsp;</a>';
                            //   var teks_5 = '<span class="label label-red"></span>&nbsp;';
                            //   var teks_6 = '<b></b>';
                            // }else if(val.text1 == "TOLAK"){
                            //   var teks_1 = '<span class="label label-danger"><i class="fa hand-paper-o"></i> Tolak</span></a>';
                            //   var teks_2 = '<span class="label label-inverse">'+ val.text2 +'</span>&nbsp;';
                            //   var teks_3 = '<span class="label label-primary">'+ val.nomor_dokumen +'</span>&nbsp;';
                            //   var teks_4 = '<span class="label label-primary"></span>&nbsp;</a>';
                            //   var teks_5 = '<span class="label label-red"></span>&nbsp;';
                            //   var teks_6 = '<b></b>';
                            // }else if(val.text1 == "membatalkan"){
                            //   var teks_1 = 'membatalkan';
                            //   var teks_2 = '<span class="label label-inverse">'+ val.text2 +'</span>&nbsp;';
                            //   var teks_3 = '<span class="label label-success">'+ val.nomor_dokumen +'</span>&nbsp;';
                            //   var teks_4 = ''+ val.text4 +'&nbsp';
                            //   var teks_5 = '<span class="label label-default">'+ val.karyawan_nama +'</span>&nbsp;';
                            //   var teks_6 = '';
                            // }
                            else {
                                teks += 'error fetch the content';
                            }

                            if (val.user_firstname == "") {
                                var display_name = val.user_username;
                            } else {
                                var display_name = val.user_firstname;
                            }

                            $("#dashboard-notif").append('' +
                                '<div class="p-t-10 b-b b-grey">' +
                                '<div class="post overlap-left-10">' +
                                '<div class="user-profile-pic-wrapper">' +
                                '<div class="user-profile-pic-2x tiles label-black white-border">' +
                                '<div class="text-white inherit-size p-t-10 p-l-15">' +
                                '<i class="fa fa-user fa-lg"></i> ' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="info-wrapper small-width">' +
                                '<div class="info text-black">' +
                                '<p>' +
                                '<a href="#"><b>' + val.user + '&nbsp;</b></a>&nbsp;' +
                                teks +
                                // '<span>'+teks +'</span>'+
                                // teks_3 +
                                '<span class="label" style="background-color:#7484e6;color:white;"></span>' +
                                '<a href="#"><span class="label label-primary"></span></a>' +
                                '</p>' +
                                '<p class="muted small-text">' + val.date_time + '</p>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '<div class="clearfix"></div>' +
                                '</div>' +
                                '');
                            });
                            // $("#dashboard-notif").append("<div class='loading-pages text-center' style='color: black;padding-top:10px'><i class='fas fa-spinner fa-spin m-2'></i> Load more ...</div>");                                
                        next_ = true;
                    } else {
                        next_ = false;
                        limit_start = 1;
                        $(".loading-pages").remove();
                        $("#dashboard-notif").append("<div class='loading-pages text-center' style='color: black;padding-top:10px'>Tidak ada aktifitas</div>");
                    }
                    // console.log('checkDashboardActivity => '+limit_start+','+data.limit_end+' Next : '+next_);
                    // }
                },
                error: function (data) {
                    // checkInternet('offline');
                }
            });
            var waktu = setTimeout("checkDashboardActivity()", 6000000);
        }

        /* Info Selling */
        var url_dash         = "<?= base_url('dashboard/manage'); ?>";
        function top_product(type) {
            var request = 'top-product';
            var data = {
                action: request,
                type: type
            };
            $.ajax({
                type: "post",
                url: url_dash,
                data: data,
                dataType: 'json',
                cache: false,
                success: function (d) {

                    if (parseInt(type) == 1) {
                        $('.buy-no-data').remove();
                        $('.data-top-buy').remove();
                        var disp = '';
                        if (d['result'].length > 0) {
                            $.each(d['result'], function (i, obj) {
                                disp += '<tr class="data-top-buy">';
                                disp += '<td class="v-align-middle btn-header-product-stock-min-track" data-id="' + obj.product_id + '" data-name="' + obj.product_name + '"><span class="text-danger" style="cursor:pointer;">' + obj.product_name + '</span></td>';
                                // disp += '<td><span>Rp. '+obj.trans_item_in_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'</span> </td>';
                                disp += '<td class="text-right"><span>' + addCommas(obj.total_item_qty) + ' ' + obj.trans_item_unit + '</span> </td>';
                                // disp += '<td><span>'+obj.time_ago+'</span> </td>';
                                disp += '</tr>';
                            });
                        } else {
                            disp += '<tr class="buy-no-data"><td colspan="3" style="text-align: center;">-- Data tidak tersedia --</td></tr>';
                        }
                        $(".top-buy-data").append(disp);
                    } else if (parseInt(type) == 2) {
                        $('.sell-no-data').remove();
                        $('.data-top-sell').remove();
                        var disp = '';
                        if (d['result'].length > 0) {
                            $.each(d['result'], function (i, obj) {
                                disp += '<tr class="data-top-sell">';
                                disp += '<td class="v-align-middle btn-header-product-stock-min-track" data-id="' + obj.product_id + '" data-name="' + obj.product_name + '"><span class="text-success" style="cursor:pointer;">' + obj.product_name + '</span></td>';
                                // disp += '<td><span>Rp. '+obj.trans_item_sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'</span> </td>';
                                disp += '<td class="text-right"><span>' + addCommas(obj.total_item_qty) + ' ' + obj.trans_item_unit + '</span> </td>';
                                // disp += '<td><span>'+obj.time_ago+'</span> </td>';
                                disp += '</tr>';
                            });
                        } else {
                            disp += '<tr class="sell-no-data"><td colspan="3" style="text-align: center;">-- Data tidak tersedia --</td></tr>';
                        }
                        $(".top-sell-data").append(disp);
                    }
                },
                error: function (data) {
                }
            });
        }
        function notif($type,$msg) {
            if (parseInt($type) === 1) {
                //Toastr.success($msg);
                Toast.fire({
                type: 'success',
                title: $msg
                });
            } else if (parseInt($type) === 0) {
                //Toastr.error($msg);
                Toast.fire({
                type: 'error',
                title: $msg
                });
            }
        }    
        function loader($stat) {
            if ($stat == 1) {
                swal({
                    title: '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>',
                    html: '<span style="font-size: 14px;">Loading...</span>',
                    width: '20%',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
            } else if ($stat == 0) {
                swal.close();
            }
        }      

        // Link
        $(document).on("click", ".link", function (e) {
            var url = $(this).data('url');
            window.open(url, '_blank');
        });

        // Approval
        $(document).on("click", ".btn-approvel-user", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).attr('data-user-id');
            var name = $(this).attr('data-user-name');
            $.alert('Function belum tersedia');
        });
        $(document).on("click", ".btn-approval-print", function (e) {
            e.preventDefault();
            e.stopPropagation();
            // var id = $(this).attr('data-user-id');
            // var name = $(this).attr('data-user-name');
            $.alert('Function belum tersedia');
        });
        $(document).on("click", ".btn-approval-action", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var approval_session = $(this).attr('data-approval-session');
            var trans_session = $(this).attr('data-trans-session');
            var trans_number = $(this).attr('data-trans-number');
            var trans_total = $(this).attr('data-trans-total');
            var contact_name = $(this).attr('data-contact-name');
            // $.alert('Function belum tersedia'+session+', '+trans_number);
            $.confirm({
                title: 'Konfirmasi Persetujuan',
                content: 'Apakah anda ingin menindaklanjuti dokumen <b>' + trans_number + '</b> @' + contact_name + ' senilai <b>IDR ' + addCommas(trans_total) + '</b> ?',
                columnClass: 'col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',
                autoClose: 'button_5|15000',
                closeIcon: true,
                closeIconClass: 'fas fa-times',
                animation: 'zoom',
                closeAnimation: 'bottom',
                animateFromElement: false,
                buttons: {
                    button_1: {
                        text: '<i class="fas fa-check-square"></i> Setujui', btnClass: 'btn-primary',
                        action: function () {
                            $.ajax({type: "post", url: url_approval,
                                data: {
                                    action: 'update',
                                    approval_session: approval_session,
                                    approval_flag: 1
                                }, dataType: 'json', cache: 'false',
                                success: function (d) {
                                    notif(d.status, d.message);
                                    checkApprovalRequest();
                                }
                            });
                        }
                    },
                    button_2: {
                        text: '<i class="fas fa-hand-paper"></i> Tunda', btnClass: 'btn-danger',
                        action: function () {
                            $.ajax({type: "post", url: url_approval,
                                data: {
                                    action: 'update',
                                    approval_session: approval_session,
                                    approval_flag: 2
                                }, dataType: 'json', cache: 'false',
                                success: function (d) {
                                    notif(d.status, d.message);
                                    checkApprovalRequest();
                                }
                            });
                        }
                    },
                    button_3: {
                        text: '<i class="fas fa-times"></i> Tolak', btnClass: 'btn-danger',
                        action: function () {
                            $.ajax({type: "post", url: url_approval,
                                data: {
                                    action: 'update',
                                    approval_session: approval_session,
                                    approval_flag: 3
                                }, dataType: 'json', cache: 'false',
                                success: function (d) {
                                    notif(d.status, d.message);
                                    checkApprovalRequest();
                                }
                            });
                        }
                    },
                    button_4: {
                        text: '<i class="fas fa-trash"></i> Hapus Permintaan', btnClass: 'btn-danger',
                        action: function () {
                            $.ajax({type: "post", url: url_approval,
                                data: {
                                    action: 'update',
                                    approval_session: approval_session,
                                    approval_flag: 4
                                }, dataType: 'json', cache: 'false',
                                success: function (d) {
                                    notif(d.status, d.message);
                                    checkApprovalRequest();
                                }
                            });
                        }
                    },
                    button_5: {
                        text: 'Tutup', btnClass: 'btn-danger',
                        action: function () {
                            //Close
                        }
                    }
                }
            });
        });

        top_product(1);
        top_product(2);          
        // checkApprovalRequest();
    });
    // End1 of document ready
</script>