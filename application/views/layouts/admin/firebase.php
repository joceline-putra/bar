<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kitchen</title>
    <link href="<?php echo base_url();?>assets/core/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
</head>
<body style="background-color:#eaeaea;">
        <div class="container" style="background-color:white;margin-top:20px;padding-bottom:15px;">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top:15px;padding-bottom:15px;padding-left:0px;padding-right:0px;">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="padding-left:0px;padding-right:0px;">
                        <div class="col-lg-3 col-md-3 col-xs-12 col-sm-5 form-group">
                            <label class="form-label">Type</label>
                            <select id="filter_type" name="filter_type" class="form-control">
                                <option value="kitchen">Food / Beverages</option>
                                <option value="table">Meja</option>  
                                <option value="type">Delivery / Dine In / Take Away</option>                                                                                
                            </select>
                        </div>   
                        <div class="col-lg-7 col-md-7 col-xs-12 col-sm-12 form-group">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Cari</label>
                                <input id="filter_search" name="filter_search" type="text" value="" class="form-control" placeholder="Pencarian" />
                            </div>
                        </div>         
                        <div class="col-md-2 col-xs-12 col-sm-12">
                            <div class="pull-right">             
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <label class="form-label">Action</label><br>            
                                    <button id="btn_new" class="btn btn-primary btn-small" type="button" style="display: inline;" data-toggle="modal" data-target="#modal_form">
                                        <i class="fas fa-plus"></i>
                                        Buat Baru
                                    </button>
                                </div>   
                            </div>
                        </div>
                    </div>                                  
                    <div class="hide col-md-12 col-xs-12 col-sm-12" style="padding-left: 0;">
                        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-5 form-group">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Kitchen Side</label>
                                <select id="filter_kitchen" name="filter_kitchen" class="form-control">
                                    <option value="ALL">All</option>
                                    <option value="Food" selected>Food</option>
                                    <option value="Beverages">Beverages</option>                                        
                                </select>
                            </div>
                        </div>   
                        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-5 form-group">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Table</label>
                                <select id="filter_table" name="filter_table" class="form-control">
                                    <option value="ALL">All</option>
                                    <option value="Meja 001">Meja 001</option>
                                    <option value="Meja 002">Meja 002</option>                                        
                                </select>
                            </div>
                        </div>                                                          
                        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-5 form-group">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Status</label>
                                <select id="filter_status" name="filter_status" class="form-control">
                                    <option value="ALL">All</option>
                                    <option value="Order">Order</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Cancel">Cancel</option>                                        
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-5 form-group">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Limit</label>
                                <select id="filter_length" name="filter_length" class="form-control">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>                                        
                                </select>
                            </div>
                        </div>                                                     
                    </div>
                </div>           
                <div id="div_firebase" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Tambah Data</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <!-- hidden input -->
                            <input name="key" id="key" type="hidden" readonly>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Kitchen Side</label>
                                <select id="kitchen" name="kitchen" class="form-control">
                                    <option value="Food">Food</option>
                                    <option value="Beverages">Beverages</option>                                        
                                </select>
                            </div> 
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Order Type</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="ALL">All</option>
                                    <option value="Dine-In">Dine-In</option>
                                    <option value="Take Away">Take Away</option>  
                                    <option value="Delivery">Delivery</option>                                                                                
                                </select>
                            </div>  
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <label class="form-label">Table</label>
                                <select id="table" name="table" class="form-control">
                                    <option value="ALL">All</option>
                                    <option value="Meja 001">Meja 001</option>
                                    <option value="Meja 002">Meja 002</option> 
                                    <option value="Meja 003">Meja 003</option>
                                    <option value="Meja 004">Meja 004</option>                                                                                
                                </select>
                            </div>                                                                                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnTutup" type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Tutup</button>
                        <button id="btn_save" type="button" class="btn btn-primary"><i class="fas fa-disk"></i>Simpan</button>
                        <button id="btn_update" type="button" class="btn btn-warning d-none"><i class="fas fa-disk"></i>Update</button>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url();?>assets/core/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- yg ini wajib firebase-app dan firebase-database -->
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-messaging.js"></script>

    <script>
        $(function () {
            // loadData();
        })

        //Firebase Config
        var table = "jrn_table";
        var config = {
            apiKey: "<?php echo $firebase['apiKey']; ?>",
            serverKey: "<?php echo $firebase['serverKey']; ?>",            
            authDomain: "<?php echo $firebase['authDomain']; ?>",
            databaseURL: "<?php echo $firebase['databaseURL']; ?>",
            projectId: "<?php echo $firebase['projectId']; ?>",
            storageBucket: "<?php echo $firebase['storageBucket']; ?>",
            messagingSenderId: "<?php echo $firebase['messagingSenderId']; ?>",
            appId: "<?php echo $firebase['appId']; ?>"
        };
        firebase.initializeApp(config);
        
        const firebaseDatabase = firebase.database();
        const firebaseMessaging = firebase.messaging();

        //Variable
        let fcmToken = '';
        let datas = [];
        let counter = 0;

        var intervalId = setInterval(function() {
            // Increment counter
            counter++;
            
            // Print counter value to console
            console.log("Counter:", counter);
            
            // Check if it's been 10 seconds
            if (counter >= 5) {
                // Clear the interval after 10 seconds
                clearInterval(intervalId);
                
                // Print last position to console
                console.log("Last position:", counter);
            }
        }, 1000); // Interval setiap detik (1000 milidetik)    

        // Minta izin kepada pengguna untuk menampilkan notifikasi
        /*
            if ("Notification" in window) {
                Notification.requestPermission().then(function(permission) {
                    if (permission === "granted") {
                        // Buat dan tampilkan notifikasi
                        // var notification = new Notification("Judul Notifikasi", {
                        //     body: "Isi notifikasi disini",
                        //     icon: "icon.png"
                        // });

                        // Ubah properti 'body' notifikasi setelah 3 detik
                        setTimeout(function() {
                            // notification.body = "Isi notifikasi telah diubah";
                        }, 3000);

                        // Memanggil properti 'body' notifikasi setelah 5 detik
                        setTimeout(function() {
                            // console.log("Isi notifikasi saat ini:", notification.body);
                        }, 5000);
                    }
                });
            } else {
                console.log("Browser tidak mendukung API Notifikasi");
            }   
        */ 
        
        /*
            $(document).on("keyup","#filter_search",function(e) {
                e.preventDefault();
                e.stopPropagation();
                var filter_type = $("#filter_type").find(":selected").val();
                var filter_length = parseInt($("#filter_length").find(":selected").val());
                            
                var terms = this.value;
                if(terms.length > 2){
                    $("#div_firebase").empty();


                    // firebaseDatabase.ref(table).orderByChild(tipe_search).startAt(terms).endAt(terms + "\uf8ff").on('child_added', function (data) {
                        // console.log("prosess : added " + terms);
                        // dataTableCreate(data.val().nama, data.val().alamat, data.val().perusahaan, data.val().telp, data.key);
                        // loadData();
                    // });                    

                    firebaseDatabase.ref(table).orderByChild(filter_type).startAt(terms).endAt(terms + "\uf8ff").limitToFirst(10).once('value')
                        .then((snapshot) => {
                            datas = [];
                            console.log(snapshot);
                            // Ambil data dari snapshot
                            snapshot.forEach((childSnapshot) => {
                                // Ambil nilai dari childSnapshot (value)
                                let value = childSnapshot.val();
                                datas.push(value);
                            });
                            console.log(datas);
                            loadDataFilter(datas);
                        })
                        .catch((error) => {
                            console.error("Error getting data:", error);
                    });                   
                }
            });
            $(document).on("change","#filter_type",function(e) {
                var filter_type = $("#filter_type").find(":selected").val();
                var filter_length = $("#filter_length").find(":selected").val();            
                firebaseDatabase.ref(table).orderByChild(filter_type).limitToFirst(filter_length).once('value')
                    .then((datas) => {
                        // Ambil data dari snapshot
                        let dd = snapshot.val();
                        snapshot.forEach((childSnapshot) => {
                            // Ambil nilai dari childSnapshot (value)
                            let value = childSnapshot.val();
                            datas.push(value);
                        });
                        console.log(datas);
                        loadData(datas);
                    })
                    .catch((error) => {
                        console.error("Error getting data:", error);
                });
            });
        */

        firebaseMessaging.requestPermission()
            .then(() => {
                console.log('Firebase FCM: Permission granted');
                // Mendapatkan token perangkat
                return firebaseMessaging.getToken();
            })
            .then((token) => {
                console.log('Firebase FCM: Token =>', token);
                fcmToken = token;
                // Kirim token ke server Anda untuk disimpan dan digunakan untuk mengirim notifikasi
            })
            .catch((error) => {
                console.log('Firebase FCM: Permission denied => ', error);
        });

        // Menangani pesan masuk saat aplikasi berjalan di foreground
        firebaseMessaging.onMessage((payload) => {
            // console.log('Firebase FCM: Message received => ', payload);
            console.log('Firebase FCM: Message received');            
            fcmShowNotification(payload);
        });

        $(document).on("click","#btn_new",function(e) {
            formEmpty();
        });
        $(document).on("click","#btn_save",function(e) { //Works
            // format keyUnique => 1618891006051-2021320-105646
            var date = new Date();
            var keyUnique = date.getTime() + "-"
                    + date.getFullYear() + date.getMonth() + date.getDate() + "-"
                    + date.getHours() + date.getMinutes() + date.getSeconds();
            var params = {
                type: $("#type").val(),
                kitchen: $("#kitchen").val(),
                table: $("#table").val(),                    
                id: keyUnique
            };

            firebaseDatabase.ref(table + '/' + keyUnique).set(params);    
            $('#modal_form').modal('hide');
        });
        $(document).on("click","#btn_update",function(e) { //Works
            var key = $(this).attr('data-id');
            var params = {
                type: $("#type").val(),
                kitchen: $("#kitchen").val(),
                table: $("#table").val(),                    
                id: key
            };            
            firebaseDatabase.ref(table + '/' + key).update(params);                
            // update_data($("#txtnama").val(), $("#txtalamat").val(), $("#txtperusahaan").val(), $("#numtelp").val(), $("#key").val());
            $('#modal_form').modal('hide');
            // loadData();
        });
        $(document).on("click",".btn_edit",function(e) { //Works
            $('#modal_form').modal('show');
            $("#btn_update").removeClass("d-none");
            $("#btn_save").addClass("d-none");
            var key = $(this).attr('data-id');
            // firebaseDatabase.ref(table + '/' + key).once("value").then(function (snapshot) {
            firebaseDatabase.ref(table + '/' + key).on("value", function(snapshot) {
                // console.log(snapshot.val());
                $("#kitchen").val(snapshot.val().kitchen);
                $("#type").val(snapshot.val().type);
                $("#table").val(snapshot.val().table);                    
                $("#key").val(key);                    
            }, function (error) {
                console.log("Error: " + error.code);
            });                      
            // }); 
            $("#btn_update").attr('data-id',key);
        });
        $(document).on("click",".btn_delete",function(e) { //Works
            var key = $(this).attr('data-id');
            if (confirm("Yakin ingin menghapus data ini?")) {
                // delete_data(key);
                firebaseDatabase.ref(table + '/' + key).remove();
                $("#div_firebase tr[id='" + key + "']").remove();
            }
        });           
        function loadData(){ //Works
            // return;
            console.log('loadData()');
            $("#div_firebase").html('');
            $("#div_firebase").empty();
            
            var dsp = '';
            // .orderByChild('age')
            // .startAt(18)
            // .endAt(30)
            // firebaseDatabase.ref(table).orderByChild("id").limitToFirst(10).once('value')
            firebaseDatabase.ref(table)
            .orderByChild("id")
            .limitToFirst(10)
            .once('value')
                .then((snapshot) => {

                    // Ambil data dari snapshot
                    let dd = snapshot.val();
                    datas = [];
                    snapshot.forEach((childSnapshot) => {
                        // Ambil nilai dari childSnapshot (value)
                        let value = childSnapshot.val();
                        datas.push(value);
                    });

                    // Tampilkan data di halaman HTML menggunakan jQuery
                    datas.forEach((v, k) => {                    
                        // dsp += '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 div_table" data-id="'+v['id']+'">';    
                        //     dsp += '    <div class="col-md-12 col-sm-12" style="padding:12px 0px;cursor:pointer;border:1px solid white;background-color: #b7e7a1;">';    
                        //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                        //     dsp += '            <span class="order-ref">';    
                        //     dsp += '                <b style="font-size:16px;">'+ v['table'] +'</b>';    
                        //     dsp += '            </span><br>';    
                        //     dsp += '            <span class="order-ref">';    
                        //     dsp += '                <b style="font-size:12px;">'+ v['type'] +'</b>';    
                        //     dsp += '            </span><br>';                                       
                        //     dsp += '        </div>';    
                        //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:left;padding-top:10px;padding-bottom:10px;background-color:#eaeaea;border:1px solid #b7e7a1;">';    
                        //     dsp += '            <p>1 x Es Teh Manis</p>';    
                        //     dsp += '            <p>1 x Jus Mangga';    
                        //     dsp += '                <br><i>esnya sedikit aja</i>';    
                        //     dsp += '            </p>';    
                        //     dsp += '            <p style="text-decoration:line-through;">2 x Sop Buah</p>';    
                        //     dsp += '        </div>';    
                        //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                        //     dsp += '            <span class="order-ref">';    
                        //     dsp += '                <b style="font-size:12px;">02:00 Menit</b><br>';  
                        //     dsp += '                '+ v['kitchen'] +'';  
                        //     dsp += '            </span><br>';                                        
                        //     dsp += '        </div>'; 
                        //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                        //     dsp += '            <span class="btn_edit" data-id="'+v['id']+'">Edit</span>';    
                        //     dsp += '            <span class="btn_delete" data-id="'+v['id']+'">Hapus</span>';    
                        //     dsp += '        </div>';                                                                
                        //     dsp += '    </div>';    
                        // dsp += '</div>';     
                        appendDataHTML(datas);
                    });
                    // $("#div_firebase").append(dsp);                       
                })
                .catch((error) => {
                    console.error("Error getting data:", error);
            });            
        }
        function loadDataFilter(set_data){ //Works
            $("#div_firebase").html('');
            $("#div_firebase").empty();
            var dsp = '';
            set_data.forEach((v, k) => {
                // dsp += '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 div_table" data-id="'+v['id']+'">';    
                //     dsp += '    <div class="col-md-12 col-sm-12" style="padding:12px 0px;cursor:pointer;border:1px solid white;background-color: #b7e7a1;">';    
                //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                //     dsp += '            <span class="order-ref">';    
                //     dsp += '                <b style="font-size:16px;">'+ v['table'] +'</b>';    
                //     dsp += '            </span><br>';    
                //     dsp += '            <span class="order-ref">';    
                //     dsp += '                <b style="font-size:12px;">'+ v['type'] +'</b>';    
                //     dsp += '            </span><br>';                                       
                //     dsp += '        </div>';    
                //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:left;padding-top:10px;padding-bottom:10px;background-color:#eaeaea;border:1px solid #b7e7a1;">';    
                //     dsp += '            <p>1 x Es Teh Manis</p>';    
                //     dsp += '            <p>1 x Jus Mangga';    
                //     dsp += '                <br><i>esnya sedikit aja</i>';    
                //     dsp += '            </p>';    
                //     dsp += '            <p style="text-decoration:line-through;">2 x Sop Buah</p>';    
                //     dsp += '        </div>';    
                //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                //     dsp += '            <span class="order-ref">';    
                //     dsp += '                <b style="font-size:12px;">02:00 Menit</b><br>';  
                //     dsp += '                '+ v['kitchen'] +'';  
                //     dsp += '            </span><br>';                                        
                //     dsp += '        </div>'; 
                //     dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                //     dsp += '            <span class="btn_edit" data-id="'+v['id']+'">Edit</span>';    
                //     dsp += '            <span class="btn_delete" data-id="'+v['id']+'">Hapus</span>';    
                //     dsp += '        </div>';                                                                
                //     dsp += '    </div>';    
                // dsp += '</div>';     
                appendDataHTML(set_data);
            });
            // $("#div_firebase").append(dsp);
        }        
        function formEmpty(){
            $("#nama").val("");
            $("#qty").val("");
            $("#key").val("");

            $("#btn_update").addClass("d-none");
            $("#btn_save").removeClass("d-none");
        }    
        function appendDataHTML(params){
            var dsp = '';
            dsp += '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 div_table" data-id="'+params.id+'">';    
                dsp += '    <div class="col-md-12 col-sm-12" style="padding:12px 0px;cursor:pointer;border:1px solid white;background-color: #b7e7a1;">';    
                dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                dsp += '            <span class="order-ref">';    
                dsp += '                <b style="font-size:16px;">'+ params.table +'</b>';    
                dsp += '            </span><br>';    
                dsp += '            <span class="order-ref">';    
                dsp += '                <b style="font-size:12px;">'+ params.type +'</b>';    
                dsp += '            </span><br>';                                       
                dsp += '        </div>';    
                dsp += '        <div class="col-md-12 col-sm-12" style="text-align:left;padding-top:10px;padding-bottom:10px;background-color:#eaeaea;border:1px solid #b7e7a1;">';    
                dsp += '            <p>1 x Es Teh Manis</p>';    
                dsp += '            <p>1 x Jus Mangga';    
                dsp += '                <br><i>esnya sedikit aja</i>';    
                dsp += '            </p>';    
                dsp += '            <p style="text-decoration:line-through;">2 x Sop Buah</p>';    
                dsp += '        </div>';    
                dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                dsp += '            <span class="order-ref">';    
                dsp += '                <b style="font-size:12px;">02:00 Menit</b><br>';  
                dsp += '                '+ params.kitchen +'';  
                dsp += '            </span><br>';                                        
                dsp += '        </div>'; 
                dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
                dsp += '            <span class="btn_edit" data-id="'+params.id+'">Edit</span>';    
                dsp += '            <span class="btn_delete" data-id="'+params.id+'">Hapus</span>';    
                dsp += '        </div>';                                                                
                dsp += '    </div>';    
            dsp += '</div>';   
            $("#div_firebase").append(dsp);  
        }
        function updateDataHTML(params){
            // console.log(params.id);
            var dsp = '';
            dsp += '    <div class="col-md-12 col-sm-12" style="padding:12px 0px;cursor:pointer;border:1px solid white;background-color: #b7e7a1;">';    
            dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
            dsp += '            <span class="order-ref">';    
            dsp += '                <b style="font-size:16px;">'+ params.table +'</b>';    
            dsp += '            </span><br>';    
            dsp += '            <span class="order-ref">';    
            dsp += '                <b style="font-size:12px;">'+ params.type +'</b>';    
            dsp += '            </span><br>';                                       
            dsp += '        </div>';    
            dsp += '        <div class="col-md-12 col-sm-12" style="text-align:left;padding-top:10px;padding-bottom:10px;background-color:#eaeaea;border:1px solid #b7e7a1;">';    
            dsp += '            <p>1 x Es Teh Manis</p>';    
            dsp += '            <p>1 x Jus Mangga';    
            dsp += '                <br><i>esnya sedikit aja</i>';    
            dsp += '            </p>';    
            dsp += '            <p style="text-decoration:line-through;">2 x Sop Buah</p>';    
            dsp += '        </div>';    
            dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
            dsp += '            <span class="order-ref">';    
            dsp += '                <b style="font-size:12px;">02:00 Menit</b><br>';  
            dsp += '                '+ params.kitchen +'';  
            dsp += '            </span><br>';                                        
            dsp += '        </div>'; 
            dsp += '        <div class="col-md-12 col-sm-12" style="text-align:center;">';    
            dsp += '            <span class="btn_edit" data-id="'+params.id+'">Edit</span>';    
            dsp += '            <span class="btn_delete" data-id="'+params.id+'">Hapus</span>';    
            dsp += '        </div>';                                                                
            dsp += '    </div>';    
            $(".div_table[data-id='"+params.id+"']").html(dsp);
        }
        function removeDataHTML(id){
            $(".div_table[data-id='"+id+"']").remove();            
        }

        // Trigger From Firebase
        firebaseDatabase.ref(table).orderByChild("id").on('child_added', function(snapshot) {
            // Mendapatkan data baru yang ditambahkan
            var newData = snapshot.val();
            // Melakukan pengecekan jika ada "id" baru yang ditambahkan
            if (newData.id) {
                // Lakukan tindakan yang diperlukan, misalnya, tampilkan notifikasi
                console.log('New data added with ID:', newData.id);
                // Tampilkan notifikasi menggunakan jQuery atau cara lain yang sesuai
                // Misalnya, Anda dapat menggunakan metode UI untuk menampilkan notifikasi di halaman web Anda
                $('#notification').text('New data added with ID: ' + newData.id).show();
                appendDataHTML(newData);

                if(counter > 0){
                    // console.log("Data baru yg di ambil dari background");
                    // notification.onclick = function() {
                    //     console.log("Ada data baru "+newData.table);
                    //     // Tambahkan tindakan yang sesuai saat notifikasi diklik
                    // };
                    var payload = {
                        data:{
                            title:"1 Data Baru",
                            body:'Di Meja '+newData.table,
                            icon:'https://cdns.klimg.com/bola.net/library/i/v2/apple-touch-icon.png',
                            clickAction:''
                        }
                    }
                    fcmShowNotification(payload);
                }
            }               
        });        
        firebaseDatabase.ref(table).orderByChild("id").on('child_changed', function (data) { //Works
            console.log(table+' => Data Has Update');                
            updateDataHTML(data.val());
        });
        firebaseDatabase.ref(table).orderByChild("id").on('child_removed', function (data) { //Works
            console.log(table+' => Data Has Removed');         
            // loadData();
            var vv = data.val();
            removeDataHTML(data.key);
        });         
        
        /*
            var params = {
                'token':'cXVp6IzCmW7ezSsaLtCaCe:APA91bGgdIiFC8gSA5pW6H05dfFLYeKjN9l9hoff0ArMGhSo5sAYx3v8GRT3TEThGqI5iG943DppgvyTmCmuMx5_S81-AHAPD5_94bR8fK-D6k6XvsqXfy0gs35B5_tOuyLfguayJwmE',
                'title':'Titlenya Disini',
                'body':'Halo ini body',
                'url':'https://bola.net',
            };
            fcmSendNotification(params);
        */

        // FCM / Firebase Cloud Messaging
        function fcmSendNotification(params){

            // Header untuk kirim pesan
            const headers = new Headers();
            headers.append('Content-Type', 'application/json');
            headers.append('Authorization', 'key=' + config['serverKey']);

            const message = {
            to: params.token,
            data: {
                title: params.title,
                body: params.body,
                icon:params.icon,
                click_action: params.url
            }
            };

            // Konfigurasi untuk kirim pesan
            const requestOptions = {
                method: 'POST',
                headers: headers,
                body: JSON.stringify(message)
            };

            fetch('https://fcm.googleapis.com/fcm/send', requestOptions)
            .then(response => {
                if (!response.ok) {
                throw new Error('Firebase FCM: Error => ', response.status);
                }
                console.log('Firebase FCM: Message sent');
            })
            .catch(error => {
                console.error('Firebase FCM: Error => ', error);
            });
        }
        function fcmShowNotification(payload){
            let notification = new Notification(payload.data.title,{
                body: payload.data.body,
                icon: payload.data.icon,
                clickAction: payload.data.click_action
            });

            notification.onclick = function(event) {
                event.preventDefault(); // Mencegah default action
                window.open(payload.data.click_action, '_blank'); // Buka tautan yang ditentukan saat notifikasi diklik
            };
        }
        // loadData();
    </script>
</body>
</html>