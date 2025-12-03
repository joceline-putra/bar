<input class="hidden" id="iduser" name="iduser" value="<?php echo $session['user_data']['user_id']; ?>">
<script>
    // Start document ready
    $(document).ready(function () {
        var url_approval = "<?= base_url('approval'); ?>";
        var url_dashboard = "<?= base_url('dashboard'); ?>";
        var url_trans = "<?= base_url('transaksi/manage'); ?>";

        // Variable
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            const randomScalingFactor = function () {
                return Math.round(Math.random() * 100 * (Math.random() > 0.5 ? -1 : 1));
            };
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
                console.log('changeDate from .date');
            });

        // Start of Daterange
            var start = moment().subtract(1, 'days');
            var end = moment();
            $('#filter_date').daterangepicker({
                startDate: start, //mm/dd/yyyy
                endDate: end, ////mm/dd/yyyy
                "showDropdowns": true,
                "minYear": 2019,
                // "maxYear": 2020,
                "autoApply": false,
                "alwaysShowCalendars": true,
                "opens": "center",
                "buttonClasses": "btn btn-sms",
                "applyButtonClasses": "btn-primaryd",
                "cancelClass": "btn-defaults",
                "ranges": {
                    'Hari ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "locale": {
                    "format": "MM/DD/YYYY",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": ["Mn", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
                    "monthNames": ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    "firstDay": 1
                }
            }, function (start, end, label) {
                // console.log(start.format('YYYY-MM-DD')+' to '+end.format('YYYY-MM-DD'));
                set_daterangepicker(start, end);
                // checkup_table.ajax.reload();
            });
            $('#filter_date').on('apply.daterangepicker', function (ev, picker) {
                console.log(ev + ', ' + picker);
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                $("#dashboard-notif").html('');
                checkDashboardActivity(1);
            });
            function set_daterangepicker(start, end) {
                $("#filter_date").attr('data-start', start.format('DD-MM-YYYY'));
                $("#filter_date").attr('data-end', end.format('DD-MM-YYYY'));
                $('#filter_date span').html(start.format('D-MMM-YYYY') + '&nbsp;&nbsp;&nbsp;&nbsp;sd&nbsp;&nbsp;&nbsp;&nbsp;' + end.format('D-MMM-YYYY'));
            }        
            set_daterangepicker(start, end);
        // End of Daterange

        // Dashboard Scroll Activities
            var limit_start = 1;
            var next_ = true; // true = data ada dimuat kembali & false = data tidak ada!
            if (next_ == true) { //Start on Refresh Page
                next_ = false;
                checkDashboardActivity(limit_start);
            }
            $(window).on("scroll", function (e) {
                var scrollTop = Math.round($(window).scrollTop());
                var height = Math.round($(window).height());
                var dashboardHeight = Math.round($(document).height());
                if ($(window).scrollTop() + $(window).height() > ($(document).height() - 100) && next_ == true) {
                    next_ = false;
                    limit_start = limit_start + 1;
                    checkDashboardActivity(limit_start);
                }
            });
        // End of Dashboard School

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
                var url = $(this).data('url');
                window.open(url, '_blank');
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
                    // autoClose: 'button_5|60000',
                    closeIcon: true,
                    closeIconClass: 'fas fa-times',
                    animation: 'zoom',
                    closeAnimation: 'bottom',
                    animateFromElement: false,
                    onContentReady: function(e){
                        let self    = this;
                        let content = '';
                        let dsp     = '';
                
                        // dsp += '<div>Content is ready after process !</div>';
                        dsp += '<form id="jc_form">';
                            dsp += '<div class="col-md-12 col-xs-12 col-sm-12 padding-remove-side">';
                            dsp += '    <div class="form-group">';
                            dsp += '    <label class="form-label">Komentar</label>';
                            dsp += '        <textarea id="jc_textarea" name="alamat" class="form-control" rows="1" style="height:48px!important;"></textarea>';
                            dsp += '    </div>';
                            dsp += '</div>';
                        dsp += '</form>';
                        content = dsp;
                        self.setContentAppend(content);
                        // self.buttons.button_1.disable();
                        // self.buttons.button_2.disable();
                
                        // this.$content.find('form').on('submit', function (e) {
                        //      e.preventDefault();
                        //      self.$$formSubmit.trigger('click'); // reference the button and click it
                        // });
                    },                
                    buttons: {
                        button_1: {
                            text: '<i class="fas fa-check-square"></i> Setujui', btnClass: 'btn-primary',
                            action: function () {
                                let self      = this;
                                // let input = self.$content.find("#jc_textarea").val();
                                // if(!input){
                                    // $.alert('Mohon isi komentarnya');
                                    // return false;
                                // }else{
                                    $.ajax({type: "post", url: url_approval,
                                        data: {
                                            action: 'update',
                                            approval_session: approval_session,
                                            approval_flag:1,
                                            approval_comment:input
                                        }, dataType: 'json', cache: 'false',
                                        success: function (d) {
                                            notif(d.status, d.message);
                                            checkApprovalRequest();
                                        }
                                    });
                                // }
                            }
                        },
                        button_3: {
                            text: '<i class="fas fa-times"></i> Tolak', btnClass: 'btn-danger',
                            action: function () {
                                let self      = this;
                                let input = self.$content.find("#jc_textarea").val();
                                if(!input){
                                    $.alert('Mohon isi komentarnya');
                                    self.$content.focus();
                                    return false;
                                }else{
                                    $.ajax({type: "post", url: url_approval,
                                        data: {
                                            action: 'update',
                                            approval_session: approval_session,
                                            approval_flag: 3,
                                            approval_comment:input
                                        }, dataType: 'json', cache: 'false',
                                        success: function (d) {
                                            notif(d.status, d.message);
                                            checkApprovalRequest();
                                        }
                                    });
                                }
                            }
                        }
                    }
                });
            });
            $(document).on("click", ".link", function (e) {
                $.alert('Not Ready');
                var url = $(this).data('url');
                window.open(url, '_blank');
            });
        // Enf of Approval

        var apexOption_1 = {
            title: { 
                text: 'Grafik Pemasukan & Biaya',
                align: 'center',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },
            series: [
                {
                    name: "Pemasukan",
                    type:'area',
                    data: [0, 0, 0, 0]
                },
                {
                    name: "Biaya",
                    data: [0, 0, 0, 0]
                }                  
            ],
            chart: {
                type: 'line',
                height: 250,
                width: "100%",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 900,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }                   
            },
            colors:["#36a6a3", "#f06605"],      
            dataLabels: {
                enabled: true,
                formatter: function (val, opt) {
                    return numberToLabel(val)
                },              
            },
            markers: {
                size: 0,
            },            
            legend: {
                position: 'top',
                horizontalAlign: 'center',
                // floating: true,
                // offsetY: 0,
                // offsetX: -5
            },            
            stroke: {
                curve: 'smooth', //straight, stepline, smooth,
                // curve: ['smooth', 'straight', 'stepline']
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
                column:{
                    colors: undefined,
                    opacity: 0.5
                },
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false
                    }
                },                  
            },
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    horizontal: false,
                }
            },     
            fill: {
                opacity: [0.5, 0.9],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            }, 
            xaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        return value;
                    }
                },                
                title: { text: ''},
                categories: ['A', 'B', 'C', 'D']                
            },
            yaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        return numberToLabel(value);
                    }
                },                
                title: { 
                    text: ''
                },/* min: 5, max: 40*/
            }          
        };

        var apexOption_2 = {
            title: { 
                text: 'Grafik Beli & Jual',
                align: 'center',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },
            series: [
                {
                    name: "Beli",
                    type: "column",
                    data: [0, 0, 0, 0]
                },                
                {
                    name: "Jual",
                    type: 'column',                    
                    data: [0, 0, 0, 0]
                }                              
            ],
            chart: {
                type: 'line',
                height: 250,
                width: "100%",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 900,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }                   
            },
            colors:["#db2e59","#0090d9"],      
            dataLabels: {
                enabled: false,
                formatter: function (val, opt) {
                    return numberToLabel(val);
                },              
            },
            legend: {
                position: 'top',
                horizontalAlign: 'center',
                // floating: true,
                // offsetY: 0,
                // offsetX: -5
            }, 
            markers: {
                size: 6,
                colors: undefined,
                strokeColors: '#fff',
                strokeWidth: 2,
                strokeOpacity: 0.9,
                strokeDashArray: 0,
                fillOpacity: 1,
                discrete: [],
                shape: "circle",
                radius: 2,
                offsetX: 0,
                offsetY: 0,
                onClick: undefined,
                onDblClick: undefined,
                showNullDataPoints: true,
                hover: {
                    size: undefined,
                    sizeOffset: 3
                }
            },                               
            stroke: {
                width:[0,2],
                curve: 'straight', //straight, stepline, smooth,
                // curve: ['smooth', 'straight', 'stepline']
            },
            grid: {
                row: {
                    // colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    // opacity: 0.5
                },
                column:{
                    colors: undefined,
                    opacity: 0.5
                },
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false
                    }
                },                  
            },
            plotOptions: {
                // bar: {
                //     borderRadius: 4,
                //     horizontal: false,
                // }
            },      
            xaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        // return 'X Axis';
                        return value;
                    }
                },                
                title: { text: ''},
                categories: ['A', 'B', 'C', 'D']                
            },
            yaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        return numberToLabel(value);
                    }
                },                
                title: { 
                    text: ''
                },/* min: 5, max: 40*/
            }          
        };

        var apexOption_3 = {
            title: { 
                text: 'Grafik Bisnis',
                align: 'center',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },
            series: [              
                {
                    name: "Jual",          
                    type:'column',     
                    data: [0, 0, 0, 0]
                },
                {
                    name: "Pemasukan",
                    type:'column',                             
                    data: [0, 0, 0, 0]
                }                                                   
            ],
            chart: {
                type: 'line',
                height: 250,
                width: "100%",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 900,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }                
            },    
            colors:["#0090d9","#36a6a3"],                  
            dataLabels: {
                enabled: false,
                formatter: function (val, opt) {
                    return numberToLabel(val);
                },              
            },
            legend: {
                position: 'top',
                horizontalAlign: 'center',
                floating: false,
                // offsetY: ,
                // offsetX: -5,
            },   
            markers: {
                size: 6,
                colors: undefined,
                strokeColors: '#fff',
                strokeWidth: 2,
                strokeOpacity: 0.9,
                strokeDashArray: 0,
                fillOpacity: 1,
                discrete: [],
                shape: "circle",
                radius: 2,
                offsetX: 0,
                offsetY: 0,
                onClick: undefined,
                onDblClick: undefined,
                showNullDataPoints: true,
                hover: {
                    size: undefined,
                    sizeOffset: 3
                }
            },           
            stroke: {
                width: [0,2,2,0],
                curve: 'straight', //straight, stepline, smooth,
                // curve: ['smooth', 'straight', 'stepline']
            },
            grid: {
                row: {
                    // colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    // opacity: 0.5
                },
                column:{
                    colors: undefined,
                    opacity: 0.5
                },
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false
                    }
                },                  
            },
            plotOptions: {
                // bar: {
                //     borderRadius: 4,
                //     horizontal: false,
                // }
            },
            // fill: {
            //     opacity: [0.5, 0.9, 1, 1],
            //     gradient: {
            //         inverseColors: false,
            //         shade: 'light',
            //         type: "vertical",
            //         opacityFrom: 0.85,
            //         opacityTo: 0.55,
            //         stops: [0, 100, 100, 100]
            //     }
            // },
            xaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        // console.log('AS '+value);
                        // return 'X Axis';
                    }
                },                
                title: { text: ''},
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May']                
            },
            yaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        return numberToLabel(value);
                    }
                },                
                title: { 
                    text: ''
                },/* min: 5, max: 40*/
            }          
        };        

        var apexOption_4 = {
            title: { 
                text: 'Biaya Operasional',
                align: 'center',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },
            series: [20,20,20,20,20],
            chart: {
                type: 'pie',
                height: 300,
                width: "100%",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 900,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }    
            },
            labels:['A','B','C','D','E'],
            colors:["#db2e59", "#f06605", "#0090d9", "#36a6a3", "#36a6a3"],     
            dataLabels: {
                enabled: true,
                formatter: function (val, opt) {
                    return val.toFixed(0) + '%';
                },              
            },          
            legend: {
                position: 'top',
                horizontalAlign: 'center',
                floating: false,
                offsetY: 10,
                offsetX: -5
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: false,
                }
            },   
            tooltip: {
                y: {
                    formatter: function(val,opt) {
                    return numberToLabel(val);
                    }
                }
            }
        };

        var apexOption_5 = {
            title: { 
                text: 'Pantauan Akun Realtime',
                align: 'center',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },        
            series: [{
                name:"",
                data: [20, 40, 60, 80, 100]              
            }],
            chart: {
                type: 'bar',
                height: 250,
                width: "100%",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 900,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }    
            },
            colors:['#db2e59', '#f06605', '#0090d9', '#36a6a3', '#36a6a3'],          
            dataLabels: {
                enabled: true,
                formatter: function (val, opt) {
                    return numberToLabel(val)
                },
            },
            markers: {
                size: 0,
            },            
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                // floating: true,
                // offsetY: 0,
                // offsetX: -5
            },            
            stroke: {
                curve: 'smooth', //straight, stepline, smooth,
                // curve: ['smooth', 'straight', 'stepline']
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
                column:{
                    colors: undefined,
                    opacity: 0.5
                },
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false
                    }
                },                  
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },      
            xaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        // return 'X Axis';
                    }
                },                
                title: { text: ''},
                categories: ['A', 'B', 'C', 'D', 'E']                
            },
            yaxis: {
                labels: {
                    show: true,
                    formatter: function (value) {
                        return numberToLabel(value);
                    }
                },                
                title: { 
                    text: ''
                },/* min: 5, max: 40*/
            }          
        };
     

        // var apex_1 = new ApexCharts(document.querySelector("#chart-one"), apexOption_1);
        // var apex_2 = new ApexCharts(document.querySelector("#chart-two"), apexOption_2);        
        var apex_3 = new ApexCharts(document.querySelector("#chart-three"), apexOption_3); 
        var apex_4 = new ApexCharts(document.querySelector("#chart-four"), apexOption_4);      
        var apex_5 = new ApexCharts(document.querySelector("#chart-five"), apexOption_5);                

        // apex_1.render();
        // apex_2.render();        
        apex_3.render();   
        
        apex_4.render();           
        apex_5.render();    

        function chart_recap_all(){
            var data = {
                action: 'chart-trans-last',
            };
            $.ajax({
                url: '<?= base_url('dashboard/manage') ?>',
                data: data,
                type: 'post',
                dataType: 'json',
                cache: 'false',
                success: function (d) {
                    if (parseInt(d.status) === 1) {
                        var res = d.results;

                        var labels          = [];
                        var result_buy      = [];
                        var result_sell     = [];
                        var result_income   = [];
                        var result_expense  = []; 

                        var set_data = [];
                        var set_label = '';
                        for (var i = 0; i < res.length; i++) {
                            set_label = res[i].chart_name;
                            var sl = set_label.split(" ");
                            // labels.push(res[i].chart_name);
                            labels.push(sl[0]);
                            // result_buy.push(parseInt(res[i].chart_buy));
                            result_sell.push(parseInt(res[i].chart_sell));
                            result_income.push(parseInt(res[i].chart_income));
                            // result_expense.push(parseInt(res[i].chart_expense));    
                            
                            // $('#total-buy-month').text('Rp. ' + addCommas(parseInt(res[i].chart_buy)) + '');
                            $('#total-sell-month').text('Rp. ' + addCommas(parseInt(res[i].chart_sell)) + '');   

                            $('#total-cash-in-month').text('Rp. ' + addCommas(parseInt(res[i].chart_income)) + '');
                            // $('#total-cash-out-month').text('Rp. ' + addCommas(parseInt(res[i].chart_expense)) + '');                             
                        }

                        /* Chart 1 */
                        // apexOption_1.series[0].data = result_income;
                        // apexOption_1.series[1].data = result_expense;                        
                        // apex_1.update();
                        // apex_1.updateOptions({
                        //     xaxis: {
                        //       categories: labels
                        //     }
                        // });              
                        // apex_1.updateSeries([
                        //     {
                        //         data: result_income
                        //     },
                        //     {
                        //         data: result_expense
                        //     }                            
                        // ]);                          

                        /* Chart 2 */
                        // apexOption_2.series[0].data = result_buy;
                        // apexOption_2.series[1].data = result_sell;                    
                        // // apex_2.update();
                        // apex_2.updateOptions({
                        //     xaxis: {
                        //       categories: labels
                        //     }
                        // });     
                        // apex_2.updateSeries([
                        //     {
                        //         data: result_buy
                        //     },
                        //     {
                        //         data: result_sell
                        //     }                            
                        // ]);   

                        /* Chart 2 */
                        // apexOption_3.series[0].data = result_buy;
                        // apexOption_3.series[1].data = result_sell;
                        // apexOption_3.series[2].data = result_income;
                        // apexOption_3.series[3].data = result_expense;                                            
                        // apex_3.update();
                        apex_3.updateOptions({
                            xaxis: {
                              categories: labels
                            }
                        });  
                        apex_3.updateSeries([
                            // {
                            //     data: result_buy
                            // },
                            {
                                data: result_sell
                            },
                            // {
                            //     data: result_expense
                            // },
                            {
                                data: result_income
                            }                                                        
                        ]);                                                      
                        // apex_3.updateOptions({
                        //     labels: labels
                        // });      
                    }
                }
            });            
        }
        function chart_account_expense() { //Chart Expense
            var data = {
                action: 'chart-expense',
            };
            $.ajax({
                url: '<?= base_url('dashboard/manage') ?>',
                data: data,
                type: 'post',
                dataType: 'json',
                cache: 'false',
                success: function (d) {
                    var disp = '';
                    $('.expense-no-data').html('');
                    if (parseInt(d.status) === 1) {
                        $("#top_expense").show();
                        // $('.top-expense-data').remove();             
                        var con = 0;
                        $.each(d['results'], function (i, obj) {
                            if(con < 5){
                                disp += '<tr class="data-top-account">';
                                disp += '<td class="v-align-middle btn-account-info" data-id="' + obj.account_id + '"><span class="text-danger" style="cursor:pointer;color:#156397;">' + obj.account_name + '</span></td>';
                                disp += '<td class="" style="text-align:right;"><span class="text-default text-right">Rp. ' + obj.balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</span> </td>';
                                // disp += '<td class="text-left;"><span class="text-default">'+obj.last_insert+'</span> </td>';
                                disp += '</tr>';
                            }
                            con++;
                        });

                        var buy = d.result_buy;
                        var sell = d.result_sell;
                        var res = d.results;

                        var labels = [];
                        var result_buy = [];
                        var result_color = [];

                        var color = '';
                        for (var i = 0; i < res.length; i++) {
                            if(i < 5){
                                labels.push(res[i].account_name);
                                result_buy.push(parseInt(res[i].balance));
                            }
                        }
                        apex_4.updateOptions({
                            labels: labels,
                            series: result_buy
                        });                        
                    }else{
                        $("#top_account").hide();
                        disp = `<tr class="expense-no-data">
                            <td colspan="2" style="text-align: center;">-- Data tidak tersedia --</td>
                        </tr>`;
                    }
                    console.log(disp);
                    $(".top-expense-data").append(disp);
                }
            });
        }
        function chart_account_realtime() { //Chart Account
            var data = {
                action: 'chart-account',
            };
            $.ajax({
                url: '<?= base_url('dashboard/manage') ?>',
                data: data,
                type: 'post',
                dataType: 'json',
                cache: 'false',
                success: function (d) {
                    if (parseInt(d.status) === 1) {
                        $("#top_account").show();
                        $('.account-no-data').remove();
                        $('.data-top-account').remove();
                        var disp = '';
                        var con = 0;                        
                        $.each(d['results'], function (i, obj) {
                            if(con < 5){
                                disp += '<tr class="data-top-account">';
                                disp += '<td class="v-align-middle btn-account-info" data-id="' + obj.account_id + '"><span class="text-danger" style="cursor:pointer;color:#156397;">' + obj.account_name + '</span></td>';
                                disp += '<td class="" style="text-align:right;"><span class="text-default text-right">Rp. ' + obj.balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</span> </td>';
                                // disp += '<td class="text-left;"><span class="text-default">'+obj.last_insert+'</span> </td>';
                                disp += '</tr>';
                            }
                        });

                        var buy = d.result_buy;
                        var sell = d.result_sell;
                        var res = d.results;

                        var labels = [];
                        var result_buy = [];
                        var result_color = [];

                        var color = '';
                        for (var i = 0; i < res.length; i++) {
                            if(i < 5){
                                labels.push(res[i].account_name);
                                result_buy.push(parseInt(res[i].balance));
                                // result_color.push('red');
                            }
                        }
                        apex_5.updateOptions({
                            xaxis: {
                                categories:labels
                            }
                        });  
                        apex_5.updateOptions({
                            labels:labels
                        });                           
                        
                        apex_5.updateSeries([{
                            name:'',
                            data: result_buy
                        }]);                           
                    }else{
                        $("#top_account").hide();
                        disp = `<tr class="expense-no-data">
                            <td colspan="2" style="text-align: center;">-- Data tidak tersedia --</td>
                        </tr>`;
                    }
                    console.log(disp);
                    $(".top-account-data").append(disp);
                }
            });
        }
        
        /* CHART */      
        chart_recap_all();
        // chart_account_expense();
        chart_account_realtime();
            
        /* CARD */
        // total_transaction_month();
        // total_cash_month('2,3','1,4,8');

        /* DISABLED */
        // top_product(1); //top_product(2);
        top_customer();
        // top_trans_overdue(1); top_trans_overdue(2);

        /* NOT USED */
        // get_payment_method(1); 2,3,4,5

        /* Dashboard Activity */
        function checkDashboardActivity(limit_start) {
            // $.playSound("http://www.noiseaddicts.com/samples_1w72b820/3721.mp3");
            var awal = $("#filter_date").attr('data-start');
            var akhir = $("#filter_date").attr('data-end');
            var user = $("#dashboard_user").val();
            var data = {
                action: 'dashboard',
                start: awal,
                end: akhir,
                user: user,
                limit_start: limit_start,
                limit_end: 10,
            };
            $.ajax({
                type: "post",
                url: "<?= base_url('aktivitas/manage/'); ?>",
                data: data,
                dataType: 'json',
                cache: false,
                beforeSend: function () {
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
                        next_ = true;
                    } else {
                        next_ = false;
                        limit_start = 1;
                        $(".loading-pages").remove();
                        // alert('here');
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
        function numberToLabel(num) {
            if (num >= 1000000000) {
                return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + ' M';
            }
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1).replace(/\.0$/, '') + ' JT';
            }
            if (num >= 1000) {
                return (num / 1000).toFixed(1).replace(/\.0$/, '') + ' RB';
            }
            return num;
        }
    });
    // End1 of document ready

    /* Info Selling 19 Load */
    var url = "<?= base_url('dashboard/manage'); ?>";
    var url_trans = "<?= base_url('transaksi/manage'); ?>";

    function top_customer() { console.log('top_customer()');
        var start = $("#start").val();
        var end = $("#end").val();
        var data = {
            action: 'finance-list-top-customer',
            type: [2, 3],
            limit: 5,
            start: start,
            end: end
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: 'json',
            cache: 'false',
            beforeSend: function () {},
            success: function (d) {
                if (parseInt(d.status) === 1) {
                    var datas = d.result;
                    //Prepare List Contact
                    $("#table-top-customer tbody").html('');
                    if (parseInt(datas.length) > 0) {
                        $("#top_customer").show(300);
                        var dsp = '';
                        $.each(datas, function (i, val) {
                            dsp += '<tr>';
                            dsp += '<td class="v-align-middle btn-contact-info" data-id="' + val['contact_id'] + '" data-type="trans" data-trans-type=""><span><a href="#" style="cursor:pointer;color:#156397;">' + val['name'] + '</a></span></td>';
                            dsp += '<td class="text-right"><span>Rp. ' + addCommas(val['total']) + '</span></td>';
                            // dsp += '<td class="v-align-middle">'+val['last_insert']+'</td>';
                            dsp += '</tr>';
                        });
                    } else {
                        $("#top_customer").hide(300);                        
                        dsp += '<tr>';
                        dsp += '<td class="text-center" colspan="2">Tidak ada data</td>';
                        dsp += '</tr>';
                    }
                    $("#table-top-customer tbody").html(dsp);
                } else {
                    notifError(d.message);
                }
            },
            error: function (xhr, Status, err) {
                notifError(err);
            }
        });
    }
    function top_trans_overdue(type) { console.log('top_trans_overdue() 2');
        var data = {
            action: 'trans-unpaid-and-overdue',
            type: type
        };
        $.ajax({
            type: "post",
            url: url_trans,
            data: data,
            dataType: 'json',
            cache: 'false',
            beforeSend: function () {},
            success: function (d) {
                if (parseInt(d.status) === 1) {
                    var datas = d.result;

                    if (type == 1) {
                        $("#table-top-buy-overdue tbody").html('');
                        if (parseInt(datas.length) > 0) {
                            $("#top_buy_overdue").show(300);                                
                            var dsp = '';
                            $.each(datas, function (i, val) {
                                dsp += '<tr>';
                                dsp += '<td class="v-align-middle"><span><a href="#" style="cursor:pointer;color:#156397;">' + val['label'] + '</a></span></td>';
                                dsp += '<td class="text-right"><span>Rp. ' + addCommas(val['total']) + '</span></td>';
                                // dsp += '<td class="v-align-middle">'+val['last_insert']+'</td>';
                                dsp += '</tr>';
                            });
                        } else {
                            $("#top_buy_overdue").hide(300);                                
                            dsp += '<tr>';
                            dsp += '<td class="text-center" colspan="2">Tidak ada data</td>';
                            dsp += '</tr>';
                        }
                        $("#table-top-buy-overdue tbody").html(dsp);
                    } else if (type == 2) {
                        $("#table-top-sell-overdue tbody").html('');
                        if (parseInt(datas.length) > 0) {
                            $("#top_sell_overdue").show(300);                                      
                            var dsp = '';
                            $.each(datas, function (i, val) {
                                dsp += '<tr>';
                                dsp += '<td class="v-align-middle"><span><a href="#" style="cursor:pointer;color:#156397;">' + val['label'] + '</a></span></td>';
                                dsp += '<td class="text-right"><span>Rp. ' + addCommas(val['total']) + '</span></td>';
                                // dsp += '<td class="v-align-middle">'+val['last_insert']+'</td>';
                                dsp += '</tr>';
                            });
                        } else {
                            $("#top_sell_overdue").hide(300);                                  
                            dsp += '<tr>';
                            dsp += '<td class="text-center" colspan="2">Tidak ada data</td>';
                            dsp += '</tr>';
                        }
                        $("#table-top-sell-overdue tbody").html(dsp);
                    }
                } else {
                    notifError(d.message);
                }
            },
            error: function (xhr, Status, err) {
                notifError(err);
            }
        });
    }
    function top_product(type) { console.log('top_product() 2');
        var request = 'top-product';
        var data = {
            action: request,
            type: type
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            success: function (d) {

                if (parseInt(type) == 1) {
                    $('.buy-no-data').remove();
                    $('.data-top-buy').remove();
                    var disp = '';
                    if (d['result'].length > 0) {
                        $("#top_buy_data").show(300);
                        $.each(d['result'], function (i, obj) {
                            disp += '<tr class="data-top-buy">';
                            disp += '<td class="v-align-middle btn-header-product-stock-min-track" data-id="' + obj.product_id + '" data-name="' + obj.product_name + '"><span class="text-danger" style="cursor:pointer;">' + obj.product_name + '</span></td>';
                            // disp += '<td><span>Rp. '+obj.trans_item_in_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'</span> </td>';
                            disp += '<td class="text-right"><span>' + addCommas(obj.total_item_qty) + ' ' + obj.trans_item_unit + '</span> </td>';
                            // disp += '<td><span>'+obj.time_ago+'</span> </td>';
                            disp += '</tr>';
                        });
                    } else {
                        $("#top_buy_data").css('display','none');
                        disp += '<tr class="buy-no-data"><td colspan="3" style="text-align: center;">-- Data tidak tersedia --</td></tr>';
                    }
                    $(".top-buy-data").append(disp);
                } else if (parseInt(type) == 2) {
                    $('.sell-no-data').remove();
                    $('.data-top-sell').remove();
                    var disp = '';
                    if (d['result'].length > 0) {
                        $("#top_sell_data").hide(300);                        
                        $.each(d['result'], function (i, obj) {
                            disp += '<tr class="data-top-sell">';
                            disp += '<td class="v-align-middle btn-header-product-stock-min-track" data-id="' + obj.product_id + '" data-name="' + obj.product_name + '"><span class="text-success" style="cursor:pointer;">' + obj.product_name + '</span></td>';
                            // disp += '<td><span>Rp. '+obj.trans_item_sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'</span> </td>';
                            disp += '<td class="text-right"><span>' + addCommas(obj.total_item_qty) + ' ' + obj.trans_item_unit + '</span> </td>';
                            // disp += '<td><span>'+obj.time_ago+'</span> </td>';
                            disp += '</tr>';
                        });
                    } else {
                        $("#top_sell_data").css('display','none');                        
                        disp += '<tr class="sell-no-data"><td colspan="3" style="text-align: center;">-- Data tidak tersedia --</td></tr>';
                    }
                    $(".top-sell-data").append(disp);
                }
            },
            error: function (data) {
            }
        });
    }    
    function total_cash_month(type_in, type_out) { console.log('total_cash_month() 1');
        var request = 'total-cash-month';
        var data = {
            action: request,
            type_in: type_in,
            type_out: type_out
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            asynch: true,
            success: function (d) {
                var total = '';
                if (d.result[0].total_month == 'undefined') {
                    total = 0;
                } else {
                    // total = d['result'].total_cash_out.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    total = addCommas(d.result[0].total_cash_in);
                }

                $('#total-cash-in-month').text('Rp. ' + total + '');

                if (d.result[1].total_month == 'undefined') {
                    total = 0;
                } else {
                    // total = d['result'].total_cash_out.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    total = addCommas(d.result[1].total_cash_out);
                }

                $('#total-cash-out-month').text('Rp. ' + total + '');                
            },
            error: function (data) {
            }
        });
    }    
    function total_transaction_month() { console.log('total_transaction_month() 2');
        var request = 'total-transaction-month';
        var data = {
            action: request
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            asynch: true,
            success: function (d) {
                var total_records = d.result;
                for(let a=0; a < total_records.length; a++) {
                    $('#total-buy-month').text('Rp. ' + addCommas(d.result[0].total_month) + '');
                    $('#total-sell-month').text('Rp. ' + addCommas(d.result[1].total_month) + '');
                }
            },
            error: function (data) {
            }
        });
    }
    /*
        function get_payment_method($payment_method){
            var request = 'get-payment-method';
            var data = {
                request: request,
                payment_method: $payment_method
            };
            $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            success: function(d){
                if(d.method == 1){
                $('.payment.cash').text(d.result.total_paid_type);
                }else if(d.method == 2){
                $('.payment.card').text(d.result.total_paid_type);
                }else if(d.method == 3){
                $('.payment.dana').text(d.result.total_paid_type);
                }else if(d.method == 4){
                $('.payment.gopay').text(d.result.total_paid_type);
                }else if(d.method == 5){
                $('.payment.ovo').text(d.result.total_paid_type);
                }else if(d.method == 6){
                $('.payment.shopeepay').text(d.result.total_paid_type);
                }
            },
            error : function(data){
            }
        });
    }*/
    function checkApprovalRequest() { console.log('checkApprovalRequest() 1');
        $.ajax({
            type: "post",
            data: {
                action: 'load-approval-list'
            },
            // url : "http://localhost:8888/git/gps/services/controls/Approval.php?action=load-data-by-user-session",
            url: "<?= base_url('approval'); ?>",
            success: function (d) {
                var dsp = '';
                var result = JSON.parse(d);
                // Jumlah Permintaan
                var total = result['total_records'];
                $("#badge-permintaan-approval").html(total);

                // Tampilkan Element jika ada
                if (total > 0) {
                    $("#panel-zero").show('slow');
                    $.each(result['result'], function (i, item) {
                        
                        if(item.approval_from_table == 'orders'){
                            var dtype = 'order';
                            var binfo = "btn-contact-info";
                            var surl = '<?php echo base_url('order/prints/'); ?>';
                        }else if(item.approval_from_table == 'trans'){
                            var dtype = 'trans';
                            var surl = '<?php echo base_url('transaksi/prints/'); ?>';
                            var binfo = "btn-contact-info";                                                        
                        }
                        dsp += '<tr>';
                            dsp += '<td>';
                            dsp += '<b><a href="#" class="btn-approval-user" data-user-id="' + item.user_from_id + '" data-user-name="' + item.user_from_username + '">' + item.user_from_username + '</a></b>';
                            dsp += '' + item.text_short + '';
                            dsp += '<b><a href="#" target="_blank" style="cursor:pointer;padding-top:4px;color:#0d638f;" class="btn-approval-print" data-url="' + surl + item.trans_id + '">';
                            dsp += '<i class="fas fa-file-signature"></i>&nbsp;' + item.trans_number + '</a></b>';
                            dsp += ' untuk <a href="#" class="btn-contact-info" data-id="'+item.contact_id+'" data-type="'+dtype+'" style="cursor:pointer;"><b>@' + item.contact_name + '</b></a>';
                            dsp += ' total <b>Rp' + addCommas(item.trans_total) + '</b>';
                            dsp += '&nbsp;<button class="btn btn-mini btn-primary btn-approval-action" data-approval-session="' + item.approval_session + '" data-trans-session="' + item.approval_from_session + '" data-trans-number="' + item.trans_number + '" data-trans-total="' + item.trans_total + '" data-contact-name="' + item.contact_name + '"><i class="fas fa-check"></i>Konfirmasi</button>';
                            dsp += '</td>';
                            dsp += '<td style="text-align:right;">';
                            dsp += item.time_ago + '';
                            dsp += '</td>';
                        dsp += '</tr>';
                    });
                    $("#table-request-approval tbody").html(dsp);
                } else {
                    $("#panel-zero").hide('slow');
                    $("#table-request-approval tbody").html('');
                }
            }
        });
        // var waktu = setTimeout("checkApprovalRequest()",6000000);
    }

    //Additional
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
    function modal_form(params) {
        $("#modal-form .modal-title").html(params['title']);
        $("#modal-form #modal-size").addClass('modal-' + params['size']);
        var button = params['button'].length;
        console.log(button);
        for (var i = 0; i < parseInt(button); i++) {
            console.log(params.button[i]);
        }
        $("#modal-form").modal({backdrop: 'static', keyboard: false});
    }

    // checkApprovalRequest();

</script>