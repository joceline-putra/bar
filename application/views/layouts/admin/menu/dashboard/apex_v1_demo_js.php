<input class="hidden" id="iduser" name="iduser" value="<?php echo $session['user_data']['user_id']; ?>">
<script>
    // Start document ready
    $(document).ready(function () {
        var url_approval = "<?= base_url('approval'); ?>";
        var url_dashboard = "<?= base_url('dashboard/manage'); ?>";
        var url_trans = "<?= base_url('transaksi/manage'); ?>";

        // Variable
            let branchID = 0;
            
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
            const randomScalingFactor0 = function () {
                // return Math.round(Math.random() * 100 * (Math.random() > 0.5 ? -1 : 1));
                return Math.ceil(Math.random() * 1000);
            };
            const randomHumanName = function () {
                const names = ["John", "Alice", "Robert", "Maria", "Michael", "Emma", "David", "Olivia", "James", "Sophia"];
                const randomIndex = Math.floor(Math.random() * names.length);
                return names[randomIndex];
            };                        
            const randomScalingFactor = function () {
                const possibleEndings = [0, 250, 500];
                const ending = possibleEndings[Math.floor(Math.random() * possibleEndings.length)];
                const base = Math.floor(Math.random() * 10); // Adjust range as needed
                return base * 100 + ending;
            };    
            const randomArrayNumber = function (v) {
                sarray = [];
                for(var a=0; a<v; a++){
                    sarray.push(randomScalingFactor());
                }
                return sarray;
            };     
            // const randomScalingFactor2 = Math.round(Math.random() * 100 * (Math.random() > 0.5 ? -1 : 1));
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
            // console.log(randomScalingFactor());
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

        // Start of Daterange Dashboard
            var start = moment().subtract(1, 'days');
            var end = moment();
            $('#dashboard_date').daterangepicker({
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
                set_daterangepicker_dashboard(start, end);
                // checkup_table.ajax.reload();
            });
            $('#dashboard_date').on('apply.daterangepicker', function (ev, picker) {
                // console.log(ev + ', ' + picker);
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                $("#dashboard-notif").html('');
                reload_dashboard();
            });
            function set_daterangepicker_dashboard(start, end) {
                $("#dashboard_date").attr('data-start', start.format('DD-MM-YYYY'));
                $("#dashboard_date").attr('data-end', end.format('DD-MM-YYYY'));
                $('#dashboard_date span').html(start.format('D-MMM-YYYY') + '&nbsp;&nbsp;&nbsp;&nbsp;sd&nbsp;&nbsp;&nbsp;&nbsp;' + end.format('D-MMM-YYYY'));
            }        
            set_daterangepicker_dashboard(start, end);
        // End of Daterange        

        // $("#dashboard_branch").select2();

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
                    name: "Beli",
                    type:'line', 
                    data: [0, 0, 0, 0]
                },                
                {
                    name: "Jual",          
                    type:'column',     
                    data: [0, 0, 0, 0]
                },
                {
                    name: "Biaya",
                    type:'line',                                   
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
            colors:["#db2e59","#0090d9","#f06605","#36a6a3"],      
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
            fill: {
                opacity: [0.5, 0.9, 1, 1],
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

        var apex_1 = new ApexCharts(document.querySelector("#chart-one"), apexOption_1);
        var apex_2 = new ApexCharts(document.querySelector("#chart-two"), apexOption_2);        
        var apex_3 = new ApexCharts(document.querySelector("#chart-three"), apexOption_3); 
        var apex_4 = new ApexCharts(document.querySelector("#chart-four"), apexOption_4);      
        var apex_5 = new ApexCharts(document.querySelector("#chart-five"), apexOption_5);                                

        apex_1.render();
        apex_2.render();        
        apex_3.render();   
        
        apex_4.render();           
        apex_5.render();                      

        function chart_recap_all(){
            var data = {
                action: 'chart-trans-last',
                branch: branchID
            };
            $.ajax({
                url: url_dashboard,
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
                            result_buy.push(parseInt(res[i].chart_buy));
                            result_sell.push(parseInt(res[i].chart_sell));
                            result_income.push(parseInt(res[i].chart_income));
                            result_expense.push(parseInt(res[i].chart_expense));      

                            $('#total-buy-month').text('Rp. ' + addCommas(parseInt(res[i].chart_buy)) + '');
                            $('#total-sell-month').text('Rp. ' + addCommas(parseInt(res[i].chart_sell)) + '');   

                            $('#total-cash-in-month').text('Rp. ' + addCommas(parseInt(res[i].chart_income)) + '');
                            $('#total-cash-out-month').text('Rp. ' + addCommas(parseInt(res[i].chart_expense)) + '');    
                        }

                        /* Chart 1 */
                        // apexOption_1.series[0].data = result_income;
                        // apexOption_1.series[1].data = result_expense;                        
                        // apex_1.update();
                        apex_1.updateOptions({
                            xaxis: {
                              categories: labels
                            }
                        });              
                        apex_1.updateSeries([
                            {
                                data: result_income
                            },
                            {
                                data: result_expense
                            }                            
                        ]);                          

                        /* Chart 2 */
                        // apexOption_2.series[0].data = result_buy;
                        // apexOption_2.series[1].data = result_sell;                    
                        // // apex_2.update();
                        apex_2.updateOptions({
                            xaxis: {
                              categories: labels
                            }
                        });     
                        apex_2.updateSeries([
                            {
                                data: result_buy
                            },
                            {
                                data: result_sell
                            }                            
                        ]);   

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
                            {
                                data: result_buy
                            },
                            {
                                data: result_sell
                            },
                            {
                                data: result_expense
                            },
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
                url: url_dashboard,
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
                url: url_dashboard,
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
        // chart_recap_all();
        // chart_account_expense();
        // chart_account_realtime();
            
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
        function chart_prepare(){
            var datef = $("#dashboard_date").attr('data-start');
            var datee = $("#dashboard_date").attr('data-end');            
            var sbranch = $("#dashboard_branch").find(":selected").val();            
            console.log('chart_prepare => '+datef+', '+datee+', '+sbranch);
            chart_recap_all();
            chart_account_expense();
            chart_account_realtime();            
        }

        $(document).on("change","#dashboard_branch", function(e) {
            e.preventDefault();
            e.stopPropagation();
            branchID = $(this).find(":selected").val();
            chart_prepare();
        });
        
    });
    // End1 of document ready

</script>