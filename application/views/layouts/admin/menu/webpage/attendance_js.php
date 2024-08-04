<script>
    $(document).ready(function() {   
        let url = "<?= base_url('attendance'); ?>";
        let imageRESULT;
        //Map Config
        let mapLAT      = -6.200000;
        let mapLNG      = 106.816666;
        let mapZOOM     = 20;
        
        let geocoderADDRESS;

        let map; let geocoder;
        let marker; let marker2;
        let circle;
        let additionalCircles = [];
        let additionalMarkers = [];            
        let infowindow;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: mapLAT, lng: mapLNG},
                zoom: mapZOOM,
                mapTypeControl: false, // Menonaktifkan kontrol jenis peta
                fullscreenControl: false, // Menonaktifkan kontrol fullscreen
                streetViewControl: false, // Menonaktifkan kontrol Street View   
                // draggable: true             
            });
            marker = new google.maps.Marker({
                position: {lat: mapLAT, lng: mapLNG},
                map: map,
                // icon: 'upload/map_icon/red.png'
            });
            geocoder = new google.maps.Geocoder();
            // marker.addListener('dragend', function(event) {
            //     const newPosition = {
            //         lat: event.latLng.lat(),
            //         lng: event.latLng.lng()
            //     };
            //     console.log('Marker baru:', newPosition);
            // });
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    console.log('Update Location:'+JSON.stringify(pos));  
                    updateLocation(pos);
                }, function() {
                    console.log('Error: The Geolocation service failed.');                    
                });
            } else {
                // Browser doesn't support Geolocation
                console.log('Error: The Geolocation service failed.');
            }
        }
        function updateLocation(position) {
            // console.log(JSON.stringify(position));
            // fetch('/location', {
                // method: 'POST',
                // headers: {
                    // 'Content-Type': 'application/json'
                // },
                // body: JSON.stringify(position)
            // })
            // .then(response => response.json())
            // .then(data => {   
                const newPos = {
                    lat: position.lat,
                    lng: position.lng
                };                                
                marker.setPosition(newPos);
                map.setCenter(newPos);
                $("#latlng").val(position.lat+', '+position.lng);
                // console.log(newPos);
                updateGeoCoder(newPos);
                // circle.setCenter(newPos);
            // })
            // .catch(error => console.error('Error fetching location:', error));
        }
        function updateGeoCoder(location){
            // const geocoder = new google.maps.Geocoder();
            // const location = { lat: lat, lng: lng }; // Create a location object with lat and lng

            geocoder.geocode({ location: location }, function(results, status) {
                // console.log(results);
            if (status === 'OK') {
                if (results[0]) {
                    abc = results[0]; // Store the result in the variable abc
                    // console.log(abc);  // Log the result to the console
                    geocoderADDRESS = abc['formatted_address'];
                } else {
                    alert('No results found');
                }
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }
            });
            // console.log(geocoderADDRESS);
        }
        function getCircle(){ //Ajax
            let form = new FormData();
            form.append('action', 'get_location');
            $.ajax({
                type: "post",
                url: url,
                data: form, 
                dataType: 'json', cache: 'false', 
                contentType: false, processData: false,
                beforeSend:function(x){
                    // x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                    // x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                },
                success:function(d){
                    let s = d.status;
                    let m = d.message;
                    let r = d.result;
                    if(parseInt(s) == 1){
                        // notif(s,m);
                        updateCircle(r);
                    }else{
                        // notif(s,m);
                    }
                },
                error:function(xhr,status,err){
                    // notif(0,err);
                }
            });
        }
        function updateCircle(positions){
            positions.forEach(v => {
                circle = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    map: map,
                    center: { lat: parseFloat(v['location_lat']), lng: parseFloat(v['location_lng']) },
                    radius: parseInt(v['location_allow_radius'])
                });

                marker2 = new google.maps.Marker({
                    position: { lat: parseFloat(v['location_lat']), lng: parseFloat(v['location_lng']) },
                    map: map,
                    icon: 'upload/map_icon/green.png',
                    // label: v['location_id'],
                    // title: v['location_name'],
                });

                // infowindow = new google.maps.InfoWindow({
                //     content: `<div>${v['location_name']}</div>`
                // });

                circle.label = v['location_id'];
                additionalCircles.push(circle);
                additionalMarkers.push(marker2);
                // circle.setCenter({ lat: parseFloat(v['location_lat']), lng: parseFloat(v['location_lng']) });                    
            
                // marker2.addListener('click', function() {
                //     infowindow.open(map, marker2);
                // });
            });
        }
        function removeCircle() {
            additionalCircles.forEach(circle => {
                circle.setMap(null);
            });
            additionalCircles = [];
        }            
        function removeMarker() {
            additionalMarkers.forEach(marker2 => {
                marker2.setMap(null);
            });
            additionalMarkers = [];
        }            

        function checkIfMarkerInCircles() {
            if (!marker || additionalCircles.length === 0) {
                console.log('Marker or circles not initialized.');
                return;
            }

            const markerPosition = marker.getPosition();
            let isInAnyCircle = false;
            let closestDistance = Infinity;
            let returnDistance = 0;
            let closestLabel = '';

            additionalCircles.forEach(circle => {
                const circleCenter = circle.getCenter();
                const circleRadius = circle.getRadius();

                // Hitung jarak antara marker dan pusat lingkaran
                const distance = google.maps.geometry.spherical.computeDistanceBetween(circleCenter, markerPosition);

                if (distance <= circleRadius) {
                    isInAnyCircle = true;
                    if (distance < closestDistance) {
                        closestDistance = distance;
                        closestLabel = circle.label;
                    }
                }
                returnDistance = distance;
            });

            if (isInAnyCircle) {
                // alert(`Marker is inside at least one circle. Closest distance: ${closestDistance.toFixed(2)} meters.`);
                return {status:1,meter:closestDistance.toFixed(2),label:closestLabel};
            } else {
                alert('Marker is outside all circles.');
                return {status:0,meter:returnDistance.toFixed(2)};
            }
        }        

        function checkDashboardActivity(limit_start) {
            // $.playSound("http://www.noiseaddicts.com/samples_1w72b820/3721.mp3");
            // var awal = $("#filter_date").attr('data-start');
            // var akhir = $("#filter_date").attr('data-end');
            // var user = $("#dashboard_user").val();
            var data = {
                action: 'load_activity',
                // start: awal,
                // end: akhir,
                // user: user,
                limit_start: limit_start,
                limit_end: 5,
            };
            $.ajax({
                type: "post",
                url: url,
                data: data,
                dataType: 'json',
                cache: false,
                beforeSend: function () {
                    $("#activity").append("<div class='loading-pages text-center' style='color: black;padding-top:10px'><i class='fas fa-spinner fa-spin m-2'></i> Sedang Memuat...</div>");
                },
                success: function (d) {
                    if (parseInt(d.total_records) > 0) {
                        $(".loading-pages").hide(200);
                        setTimeout(() => {
                            $(".loading-pages").remove();
                        }, 500);
                        $.each(d.result, function (i, val) {

                            var teks = '';
                            teks += `<div class="col-md-3 col-sm-12 col-xs-12 m-b-10">
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
                                                            <img src="${val['user_image']}" alt="" data-src="#" data-src-retina="#" width="35" height="35"> </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="user-name text-black bold large-text">&nbsp;&nbsp;<span class="semi-bold">${val['user_fullname']}</span> </div>
                                                        <div class="preview-wrapper">&nbsp;&nbsp;${val['location_name']}</div>
                                                    </div>
                                                </div>
                                                <div id="image-demo-carl" class="m-t-15 owl-carousel owl-theme" style="opacity: 1; display: block;">
                                                    <div class="owl-wrapper-outer autoHeight">
                                                        <div class="owl-wrapper" style="left: 0px; display: block;">
                                                            <div class="owl-item">
                                                                <div class="item col-md-12">
                                                                    <img src="${val['att_image']}" alt="" class="img-responsive" style="width:100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <p class="p-b-10 p-l-15 p-r-15">
                                                    <i>${val['att_note']}</i><br>
                                                    <b>${val['att_address']}</b><br>
                                                    <span style="color:#c2bdbd;">${val['time_ago']}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>`;
                            $("#activity").append(teks);
                        });
                        next_ = true;
                    } else {
                        next_ = false;
                        limit_start = 1;
                        $(".loading-pages").remove();
                        $("#activity").append("<div class='loading-pages text-center' style='color: black;padding-top:10px'>Tidak ada aktifitas</div>");
                    }
                },
                error: function (data) {
                    // checkInternet('offline');
                }
            });
            var waktu = setTimeout("checkDashboardActivity()", 6000000);
        }
        window.onload = function() {
            initMap();
            getCircle();
            setInterval(getLocation, 5000); // Polling setiap 10 detik
        };
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

        $(document).on("click","#btn_distance", function(e) {
            e.preventDefault();
            e.stopPropagation();
            checkIfMarkerInCircles();
        });
        $(document).on("click","#btn_move_location", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var latlng = $("#latlng").val();
            var spl = latlng.split(', ');
            updateLocation({lat:parseFloat(spl[0]),lng:parseFloat(spl[1])});              
        });
        
        $(document).on("click","#btn_fetch_location", function(e){
            e.preventDefault();
            e.stopPropagation();
            getLocation();
        });
        $(document).on("click","#btn_fetch_circle", function(e){
            e.preventDefault();
            e.stopPropagation();
            getCircle();
        });            

        $(document).on("click","#btn_remove_circle", function(e){
            e.preventDefault();
            e.stopPropagation();
            removeCircle();
        });   
        $(document).on("click","#btn_remove_marker", function(e){
            e.preventDefault();
            e.stopPropagation();
            removeMarker();
        });                                       
        
        $(document).on("click","#btn_take_selfie, .btn_take_selfie", function(e){
            e.preventDefault();
            e.stopPropagation();
            // alert('btn_take_selfie');
            document.getElementById('camera_input').click();
        });  
        $(document).on("click","#btn_take_posting, .btn_take_posting", function(e){
            e.preventDefault();
            e.stopPropagation();
            document.getElementById('camera_input_posting').click();
        });   
        $(document).on("click","#btn_take_checkout, .btn_take_checkout", function(e){
            e.preventDefault();
            e.stopPropagation();
            document.getElementById('camera_input_checkout').click();
        });                         
        $(document).on("change","#camera_input", function(e){
            e.preventDefault();
            e.stopPropagation();
            const file = event.target.files[0];
            if (file) {
                console.log(file.size / 1024 + ' KB');
                new Compressor(file, {
                    quality: 0.4,
                    success(result) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            // imageRESULT = e.target.result;
                            img.classList.add('img');
                            img.setAttribute('data-image', e.target.result);
                            img.style.maxWidth = '100%';
                            document.body.appendChild(img);
                            $("#files_preview").attr('src',e.target.result);
                        };
                        reader.readAsDataURL(result);
                        // imageRESULT = result;
                        console.log('Compressed file size:', result.size / 1024, ' KB');
                    },
                    error(err) {
                        console.log(err.message);
                    },
                });
                // console.log(imageRESULT);
            }
        });
        $(document).on("change","#camera_input_checkout", function(e){
            e.preventDefault();
            e.stopPropagation();
            const file = event.target.files[0];
            if (file) {
                console.log(file.size / 1024 + ' KB');
                new Compressor(file, {
                    quality: 0.4,
                    success(result) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            // imageRESULT = e.target.result;
                            img.classList.add('img_checkout');
                            img.setAttribute('data-image', e.target.result);
                            img.style.maxWidth = '100%';
                            document.body.appendChild(img);
                            $("#files_preview_checkout").attr('src',e.target.result);
                        };
                        reader.readAsDataURL(result);
                        // imageRESULT = result;
                        console.log('Compressed file size:', result.size / 1024, ' KB');
                    },
                    error(err) {
                        console.log(err.message);
                    },
                });
                // console.log(imageRESULT);
            }
        }); 
        $(document).on("change","#camera_input_posting", function(e){
            e.preventDefault();
            e.stopPropagation();
            const file = event.target.files[0];
            if (file) {
                console.log(file.size / 1024 + ' KB');
                new Compressor(file, {
                    quality: 0.4,
                    success(result) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            // imageRESULT = e.target.result;
                            img.classList.add('img_posting');
                            img.setAttribute('data-image', e.target.result);
                            img.style.maxWidth = '100%';
                            document.body.appendChild(img);
                            $("#files_preview_posting").attr('src',e.target.result);
                        };
                        reader.readAsDataURL(result);
                        // imageRESULT = result;
                        console.log('Compressed file size:', result.size / 1024, ' KB');
                    },
                    error(err) {
                        console.log(err.message);
                    },
                });
                // console.log(imageRESULT);
            }
        });        
                
        $(document).on("click","#btn_checkin_new", function(e){
            e.preventDefault();
            e.stopPropagation();
            $("#modal_checkin").modal('show');
        });
        $(document).on("click","#btn_checkout_new", function(e){
            e.preventDefault();
            e.stopPropagation();
            $("#modal_checkout").modal('show');
        });
        $(document).on("click","#btn_posting_new", function(e){
            e.preventDefault();
            e.stopPropagation();
            $("#modal_posting").modal('show');
        });                
        $(document).on("click","#btn_checkin", function(e){
            e.preventDefault();
            e.stopPropagation();
            let markerPosition = marker.getPosition();
            let mDistance = checkIfMarkerInCircles();
            console.log(mDistance);
            if(mDistance['status'] == 1){
                // console.log(markerPosition.lat());
                // console.log(markerPosition.lng());     
                // let form = new FormData($("#form_checkin")[0]);
                let form = new FormData();                    
                form.append('action', 'checkin');
                form.append('lat', markerPosition.lat());         
                form.append('lng', markerPosition.lng());  
                form.append('location_id', mDistance['label']);       
                // form.append('files',$("#camera_input")[0].files[0]);
                form.append('address',geocoderADDRESS); 
                form.append('file', $(".img").attr('data-image'));  
                // form.append('files',imageRESULT);                                        
                $.ajax({
                    type: "post",
                    url: url,
                    data: form, 
                    // dataType: 'json',
                    // cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(x){
                        // x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                        // x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                    },
                    success:function(d){
                        // let s = d.status;
                        // let m = d.message;
                        // let r = d.result;
                        // if(parseInt(s) == 1){
                        //     // notif(s,m);
                        //     /* hint zz_for or zz_each */
                            
                        // }else{
                        //     // notif(s,m);
                        // }
                        alert('Sukses Checkin');
                    },
                    error:function(xhr,status,err){
                        // notif(0,err);
                    }
                });
            }else{
                alert('Anda berada diluar zona absensi');
            }
        }); 
        $(document).on("click","#btn_checkout", function(e){
            e.preventDefault();
            e.stopPropagation();
            let markerPosition = marker.getPosition();
            let mDistance = checkIfMarkerInCircles();
            console.log(mDistance);
            if(mDistance['status'] == 1){
                // console.log(markerPosition.lat());
                // console.log(markerPosition.lng());     
                let form = new FormData();
                form.append('action', 'checkout');
                form.append('lat', markerPosition.lat());         
                form.append('lng', markerPosition.lng());   
                form.append('location_id', mDistance['label']);
                form.append('keterangan', $("#keterangan").val());  
                form.append('address',geocoderADDRESS); 
                form.append('file', $(".img_checkout").attr('data-image'));                                                                                   
                $.ajax({
                    type: "post",
                    url: url,
                    data: form, 
                    dataType: 'json', cache: 'false', 
                    contentType: false, processData: false,
                    beforeSend:function(x){
                        // x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                        // x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                    },
                    success:function(d){
                        let s = d.status;
                        let m = d.message;
                        let r = d.result;
                        if(parseInt(s) == 1){
                            // notif(s,m);
                            /* hint zz_for or zz_each */
                            
                        }else{
                            // notif(s,m);
                        }
                        alert('Sukses checkout');
                    },
                    error:function(xhr,status,err){
                        // notif(0,err);
                    }
                });       
            }else{
                    alert('Anda berada diluar zona absensi');
                }         
        }); 
        $(document).on("click","#btn_posting", function(e){
            e.preventDefault();
            e.stopPropagation();
            let markerPosition = marker.getPosition();            
            let form = new FormData();
            form.append('action', 'posting');
            form.append('lat', markerPosition.lat());         
            form.append('lng', markerPosition.lng());   
            form.append('keterangan', $("#keterangan_posting").val());     
            form.append('address',geocoderADDRESS); 
            form.append('file', $(".img_posting").attr('data-image'));                                                                           
            $.ajax({
                type: "post",
                url: url,
                data: form, 
                dataType: 'json', cache: 'false', 
                contentType: false, processData: false,
                beforeSend:function(x){
                    // x.setRequestHeader('Authorization',"Bearer " + bearer_token);
                    // x.setRequestHeader('X-CSRF-TOKEN',csrf_token);
                },
                success:function(d){
                    let s = d.status;
                    let m = d.message;
                    let r = d.result;
                    if(parseInt(s) == 1){
                        // notif(s,m);
                        /* hint zz_for or zz_each */
                        
                    }else{
                        // notif(s,m);
                    }
                    alert('Sukses post gambar');
                },
                error:function(xhr,status,err){
                    // notif(0,err);
                }
            });             
        });         
    });        
</script>