<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Pertanian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card card-body">

                <!-- Content Row -->
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-validate" id="submit">
                            <input name="id_pertanian" type="text" class="d-none" value="<?= $id ?>">
                            <div class="form-group bmd-form-group">
                                <label for="nama" class="col-form-label bmd-label-static">Nama Pemilik</label>
                                <input id="nama" type="text" name="nama" required="" class="form-control">
                            </div>
                            <div class="form-group bmd-form-group">
                                <label for="luas_area" class="col-form-label bmd-label-static">Luas Area</label>
                                <div class="input-group">
                                    <input id="luas_area" type="text" name="luas_area" required="" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">m<sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group bmd-form-group">
                                <label for="produksi" class="col-form-label bmd-label-static">Produksi</label>
                                <div class="input-group">
                                    <input id="produksi" type="text" name="produksi" required="" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Ton</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group bmd-form-group">
                                <label for="points" class="col-form-label bmd-label-static">Poligon Lahan</label>
                                <input id="points" type="text" name="points" required="" class="form-control" readonly>
                            </div>
                        </form>
                        <div class="" style="height:500px">
                            <div id="map" style="margin-top:0px !important;height:100%;width:100%"></div>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-12">
                        <a href="<?= $url_back ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="" class="btn btn-warning"><i class="fas fa-undo"></i> Reset</a>
                        <button type="submit" class="btn btn-success" onclick="javascript:tambah();" id="btn-save"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <script>
        var url = "<?php echo base_url(); ?>";
        var nama_table = "pertanian_data";
        var id_table = "id_pertanian_data";

        function tambah() {
            var form = $("form")[0];
            var formData = new FormData(form);
            formData.append('table', nama_table);
            formData.append('id_table', id_table);
            $.ajax({
                url: url + '/api/add', //link json
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.status == true) {
                        swal({
                            title: "Sukses",
                            text: result.message,
                            icon: "success"
                        }).then((e) => {
                            location.replace('<?= $url_back ?>');
                        });
                    } else {
                        swal("Error!", result.message, "error");
                    }
                }
            });
        }
        const style_map = [{
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "poi",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [{
                    "visibility": "off"
                }]
            },
            {
                "featureType": "transit",
                "stylers": [{
                    "visibility": "off"
                }]
            }
        ]

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -3.6483486,
                    lng: 119.5571677
                },
                zoom: 10,
                styles: style_map,
                mapTypeId: 'satellite'
            });

            const drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                        google.maps.drawing.OverlayType.POLYGON,
                    ],
                },
                polygonOptions: {
                    strokeColor: "black",
                    strokeOpacity: 0.8,
                    strokeWeight: 0.5,
                    fillColor: "black",
                    fillOpacity: 0.35,
                }
            });
            drawingManager.setMap(map);

            google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
                var path = polygon.getPath();
                var luasArea = google.maps.geometry.spherical.computeArea(path);
                // console.log(luasArea.toFixed(2))
                $('#luas_lahan').val(luasArea.toFixed(2));
                var coordinates = [];

                for (var i = 0; i < path.length; i++) {
                    coordinates.push({
                        lat: path.getAt(i).lat(),
                        lng: path.getAt(i).lng()
                    });
                }
                // console.log(coordinates);
                $('#points').val(JSON.stringify(coordinates));

                //sembunyikan drawing button
                drawingManager.setOptions({
                    drawingControl: false
                });

                //non-aktifkan drawing mode
                drawingManager.setDrawingMode(null);
            });


            const array_kecamatan = <?= json_encode($kecamatan) ?>;
            array_kecamatan.filter((x) => {
                console.log(x)
                poin = x.poligon_kec.replace(/&quot;/g, '"');
                let coords = JSON.parse(poin);
                let desaPolygon = new google.maps.Polygon({
                    paths: coords,
                    strokeColor: "black",
                    strokeOpacity: 0.8,
                    strokeWeight: 0.5,
                    fillColor: "white",
                    fillOpacity: 0.35,
                });
                desaPolygon.setMap(map);
            })

            const array_points = <?= json_encode($list_pertanian_data) ?>;
            array_points.filter((x) => {
                console.log(x)
                poin = x.points.replace(/&quot;/g, '"');
                let coords = JSON.parse(poin);
                let polygon = new google.maps.Polygon({
                    paths: coords,
                    strokeColor: 'black',
                    strokeOpacity: 0.8,
                    strokeWeight: 0.5,
                    fillColor: 'green',
                    fillOpacity: 0.8,
                });
                polygon.setMap(map);
                polygon.addListener("click", showArrays);
                infoWindow = new google.maps.InfoWindow();

                function showArrays(event) {
                    let polygon = this;
                    let vertices = polygon.getPath();
                    let contentString =
                        "<b>Detail Lahan</b><br>" +
                        "Pemilik : " + x.nama + "<br>" +
                        "NIK : " + x.no_induk + "<br>" +
                        "Jenis Lahan : " + x.nama_jenis_lahan.charAt(0).toUpperCase() + x.nama_jenis_lahan.slice(1) + "<br>" +
                        "Luas Lahan : " + x.luas_lahan + " m<sup>2</sup>";
                    infoWindow.setContent(contentString);
                    infoWindow.setPosition(event.latLng);
                    infoWindow.open(map);
                }
            })
        }
    </script>