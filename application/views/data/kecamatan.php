<style type="text/css">
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .controls {
        background-color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        height: 29px;
        margin-left: 17px;
        margin-top: 10px;
        outline: none;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
    }

    .controls:focus {
        border-color: #4d90fe;
    }

    .title {
        font-weight: bold;
    }

    .pac-container {
        z-index: 9999999999;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }

    #target {
        width: 345px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kecamatan</h1>
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
            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title">Title</h3> -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" onclick="javascript:btnTambah();" id="btn-tambah"><i class="fa fa-plus"></i> Tambah Data</button>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="display table table-stipped table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th width="50px">No.</th>
                                <th width="200px">Nama Kecamatan</th>
                                <th>Poligon Kecamatan</th>
                                <th width="115px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list_kecamatan as $key => $value) {
                                echo '
                                    <tr>
                                        <td>' . $no++ . '</td>
                                        <td>' . $value['nama_kec'] . '</td>
                                        <td>' . $value['poligon_kec'] . '</td>
                                        <td><a name="delete" data-id="' . $value['id_kec'] . '" class="btn btn-danger hapus" href="#" role="button"><i class="fas fa-trash fa-sm fa-fw"></i>Hapus</a></td>
                                    </tr>
                                ';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Nama Kecamatan</th>
                                <th>Poligon Kecamatan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
                <!-- <div class="card-footer">
                    Footer
                </div> -->
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <!------------------------------ Modal -------------------------------->
    <div class="modal fade" id="exampleModalScrollable" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Data</h5>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-validate" id="submit">
                        <div class="form-group">
                            <label for="nama">Nama Kecamatan :</label>
                            <input name="nama_kec" type="text" class="form-control" id="nama" placeholder="Input Nama Kecamatan">
                        </div>
                        <div class="form-group">
                            <label for="poligon">Poligon Kecamatan :</label>
                            <input name="poligon_kec" type="text" class="form-control" id="points" placeholder="Input Poligon" readonly><br>
                            <input id="pac-input" class="controls" type="text" placeholder="Search Box" />
                            <div class="" style="height:500px">
                                <div id="map" style="margin-top:0px !important;height:100%;width:100%"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" onclick="javascript:tambah();" id="btn-save">Simpan</button>
                    <!-- <button type="submit" class="btn btn-warning" onclick="javascript:edit();" id="btn-edit">Ubah</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.hapus').on('click', function() {
            let data = $(this).data();
            swal({
                title: "Apa anda yakin?",
                text: "data yang terhapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "GET",
                        url: url + "/api/del?table=" + nama_table + "&id_table=" + id_table + "&id=" + data.id,
                        dataType: "JSON",
                        success: function(result) {
                            console.log(result);
                            if (result.status == true) {
                                swal({
                                    title: "Sukses",
                                    text: result.message,
                                    icon: "success"
                                }).then((e) => {
                                    location.reload();
                                });
                            } else {
                                swal("Error!", result.message, "error");
                            }
                        }
                    });
                } else {
                    swal("Aksi dibatalkan!");
                }
            });
        });
        var url = "<?php echo base_url(); ?>";
        var nama_table = "kecamatan";
        var id_table = "id_kec";

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
                            location.reload();
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
            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };
                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
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
                    strokeColor: "white",
                    strokeOpacity: 0.8,
                    strokeWeight: 1,
                    fillColor: "white",
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

            const array_points = <?= json_encode($list_kecamatan) ?>;
            array_points.filter((x) => {
                console.log(x)
                poin = x.poligon_kec.replace(/&quot;/g, '"');
                let coords = JSON.parse(poin);
                let polygon = new google.maps.Polygon({
                    paths: coords,
                    strokeColor: 'black',
                    strokeOpacity: 0.8,
                    strokeWeight: 0.5,
                    fillColor: 'white',
                    fillOpacity: 0.8,
                });
                polygon.setMap(map);
                // polygon.addListener("click", showArrays);
                // infoWindow = new google.maps.InfoWindow();

                // function showArrays(event) {
                //     let polygon = this;
                //     let vertices = polygon.getPath();
                //     let contentString =
                //         "<b>Detail Lahan</b><br>" +
                // "Pemilik : " + x.nama + "<br>" +
                // "NIK : " + x.no_induk + "<br>" +
                // "Jenis Lahan : " + x.nama_jenis_lahan.charAt(0).toUpperCase() + x.nama_jenis_lahan.slice(1) + "<br>" +
                // "Luas Lahan : " + x.luas_lahan + " m<sup>2</sup>";
                //         infoWindow.setContent(contentString);
                //     infoWindow.setPosition(event.latLng);
                //     infoWindow.open(map);
                // }
            })
        }
    </script>