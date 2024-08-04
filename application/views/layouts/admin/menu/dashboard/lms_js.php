<input class="hidden" id="iduser" name="iduser" value="<?php echo $session['user_data']['user_id']; ?>">
<script>
    // Start document ready
    $(document).ready(function () {
        var url_approval = "<?= base_url('approval'); ?>";
        var url_dashboard = "<?= base_url('dashboard'); ?>";
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
            const randomDistrictName = function () {
                const names = ["MIJEN",
                "GUNUNG PATI",
                "BANYUMANIK",
                "GAJAH MUNGKUR",
                "SEMARANG SELATAN",
                "CANDISARI",
                "TEMBALANG",
                "PEDURUNGAN",
                "GENUK",
                "GAYAMSARI",
                "SEMARANG TIMUR",
                "SEMARANG UTARA",
                "SEMARANG TENGAH",
                "SEMARANG BARAT",
                "TUGU",
                "NGALIYAN"];
                const randomIndex = Math.floor(Math.random() * names.length);
                return names[randomIndex];
            };  
            const randomHumanName = function () {
                const names = ["John", "Alice", "Robert", "Maria", "Michael", "Emma", "David", "Olivia", "James", "Sophia"];
                const randomIndex = Math.floor(Math.random() * names.length);
                return names[randomIndex];
            };                        
            const randomScalingFactor = function () {
                const possibleEndings = [0, 25, 50];
                const ending = possibleEndings[Math.floor(Math.random() * possibleEndings.length)];
                const base = Math.floor(Math.random() * 10); // Adjust range as needed
                return base * 100 + ending;
            };
            const randomScalingFactor2 = function () {
                const possibleEndings = [0, 25, 50];
                const ending = possibleEndings[Math.floor(Math.random() * possibleEndings.length)];
                return Math.floor(Math.random() * 10) + ending; // Adjust range as needed
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
                text: 'Jenis Kelamin Siswa',
                align: 'center',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },
            series: [2000,1300],
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
            labels:['Laki-laki','Perempuan'],
            colors:["#db2e59", "#f06605"],     
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

        let label5 = [
            "Bhs Indonesia","Bhs Inggris","Matematika","Fisika","Kimia","Biologi","Olahraga","Komputer"
        ]; 
        let data5 = [];
        for(var a5=0; a5 < label5.length; a5++){
            data5.push(randomScalingFactor2());
            //     label6.push(randomHumanName());
        }        
        var apexOption_5 = {
            title: { 
                text: 'Jumlah Guru Mata Pelajaran',
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
                data: data5             
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
                categories: label5               
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

        let label6 = [
            "SMA SA 1","SMA SA 2","SMA SA 3","SMP SA 1","SD SA 1","TK SA 1"
        ]; 
        let data6 = [];
        for(var a6=0; a6 < 6; a6++){
            data6.push(randomScalingFactor());
            // label6.push(randomHumanName());
        }
        var apexOption_6 = {
            title: { 
                text: 'Jumlah Siswa',
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
                data: data6             
            }],
            chart: {
                type: 'bar',
                height: 250,
                width: "100%",
                // zoom: {
                //     enabled: false
                // },
                // toolbar: {
                //     show: true
                // },
                // animations: {
                //     enabled: true,
                //     easing: 'easeinout',
                //     speed: 900,
                //     animateGradually: {
                //         enabled: true,
                //         delay: 150
                //     },
                //     dynamicAnimation: {
                //         enabled: true,
                //         speed: 350
                //     }
                // }    
            },
            // colors:['#db2e59', '#f06605', '#0090d9', '#36a6a3', '#36a6a3'],          
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function (val, opt) {
                    return numberToLabel(val);
                    // return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
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
                        show: false
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
                    barHeight: '80%',
                    distributed: true,
                    dataLabels: {
                        position: 'bottom'
                    },                    
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
                categories: label6               
            },
            yaxis: {
                labels: {
                    show: false,
                    formatter: function (value) {
                        return numberToLabel(value);
                    }
                },                
                title: { 
                    text: ''
                },/* min: 5, max: 40*/
            }          
        };  
        
        let label7 = []; let data7 = [];
        for(var a7=0; a7 < 6; a7++){
            ss = {
                x:randomDistrictName(),
                y:randomScalingFactor()
            }
            data7.push(ss);
            // data7.push(randomScalingFactor());
            // label7.push(randomHumanName());

        }
        var apexOption_7 = {
            title: { 
                text: 'Siswa Berdasarkan Kecamatan',
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
                data: data7             
            }],
            chart: {
                type: 'treemap',
                height: 250,
                width: "100%",
                // zoom: {
                //     enabled: false
                // },
                // toolbar: {
                //     show: true
                // },
                // animations: {
                //     enabled: true,
                //     easing: 'easeinout',
                //     speed: 900,
                //     animateGradually: {
                //         enabled: true,
                //         delay: 150
                //     },
                //     dynamicAnimation: {
                //         enabled: true,
                //         speed: 350
                //     }
                // }    
            },
            // colors:['#db2e59', '#f06605', '#0090d9', '#36a6a3', '#36a6a3'],          
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function (val, opt) {
                    return [val, numberToLabel(opt.value)];
                    // return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
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
                        show: false
                    }
                },   
                yaxis: {
                    lines: {
                        show: false
                    }
                },                  
            },
            plotOptions: {
                treemap: {
                    distributed: true,
                    enableShades: false
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
                // categories: label7              
            },
            yaxis: {
                labels: {
                    show: false,
                    formatter: function (value) {
                        return numberToLabel(value);
                    }
                },                
                title: { 
                    text: ''
                },/* min: 5, max: 40*/
            }          
        };  
        
        let data8 = [
            {
                name: 'Fasilitas',
                type:'column',
                data: [200,150,300]
            },
            {
                name: 'Biaya',
                type:'column',
                data: [300,200,100]
            },                 
            {
                name: 'Perkembangan Siswa',
                type:'line',
                data: [200,300,400]
            },                                   
        ];         

        var apexOption_8 = {
            title: { 
                text: 'Survey Kepuasan Wali Siswa',
                align: 'left',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },        
            series: data8,
            chart: {
                type: 'line',
                height: 250,
                width: "100%",
                stacked:false  
            },
            colors:['#0090d9', '#f06605', '#36a6a3'],       
            dataLabels: {
                enabled: false,
            },        
            legend: {
                horizontalAlign: 'left',
                offsetX: 40
            },            
            // stroke: {
            //     width: [1, 1, 4]
            // },   
            // markers: {
            //     size: 0,
            // },     
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
            xaxis: {
                categories: [2022, 2023, 2024],
            }       ,
            yaxis: [
                {
                    seriesName: 'Revenue',
                    opposite: true,
                    axisTicks: {
                        show: true,
                    },
                    axisBorder: {
                        show: true,
                        color: '#FEB019'
                    },
                    labels: {
                        style: {
                            colors: '#FEB019',
                        },
                    },
                    title: {
                        // text: "Revenue (thousand crores)",
                        style: {
                            color: '#FEB019',
                        }
                    }
                }
            ], 
        };          

        let label9 = [
            "PNS","Polri","TNI","Wiraswasta","Karyawan Swasta"
        ]; 
        let data9 = [];
        for(var a9=0; a9 < label9.length; a9++){
            data9.push(randomScalingFactor());
        //     label6.push(randomHumanName());
        }
        var apexOption_9 = {
            title: { 
                text: 'Profesi Orang Tua Siswa',
                align: 'center',
                style: {
                    fontSize:  '12px',
                    fontWeight:  'bold',
                    fontFamily:  undefined,
                    color:  '#263238'
                },
            },
            series: data9,
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
            labels:label9,
            // colors:["#db2e59", "#f06605"],     
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

        var apex_1 = new ApexCharts(document.querySelector("#chart-one"), apexOption_1);
        var apex_2 = new ApexCharts(document.querySelector("#chart-two"), apexOption_2);        
        var apex_3 = new ApexCharts(document.querySelector("#chart-three"), apexOption_3); 
        var apex_4 = new ApexCharts(document.querySelector("#chart_4"), apexOption_4);      
        var apex_5 = new ApexCharts(document.querySelector("#chart_5"), apexOption_5);                 
        var apex_6 = new ApexCharts(document.querySelector("#chart_6"), apexOption_6); 
        var apex_7 = new ApexCharts(document.querySelector("#chart_7"), apexOption_7);   
        var apex_8 = new ApexCharts(document.querySelector("#chart_8"), apexOption_8);     
        var apex_9 = new ApexCharts(document.querySelector("#chart_9"), apexOption_9);                                         

        apex_1.render();
        apex_2.render();        
        apex_3.render();   
        
        apex_4.render();           
        apex_5.render();
        apex_6.render();
        apex_7.render();
        apex_8.render(); 
        apex_9.render();                                

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
        function reload_dashboard(){
            var datef = $("#dashboard_date").attr('data-start');
            var datee = $("#dashboard_date").attr('data-end');            
            var sbranch = $("#dashboard_branch").find(":selected").val();            
            console.log('reload_dashboard '+datef+', '+datee+', '+sbranch);
            chart_recap_all();
        }

        $(document).on("change","#dashboard_branch", function(e) {
            e.preventDefault();
            e.stopPropagation();
            branchID = $(this).find(":selected").val();
            reload_dashboard();
        });
        
    });
    // End1 of document ready

</script>