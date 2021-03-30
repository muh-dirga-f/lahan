<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Industri</h1>
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
                        <div class="" style="height:400px">
                            <div id="map" style="margin-top:0px !important;height:100%;width:100%"></div>
                        </div>
                        <?php foreach ($list_industri as $key => $value) {
                            echo '
                                <div class="form-group" id="input-id">
                                    <label for="id" class="col-form-label bmd-label-static">ID</label>
                                    <input id="id" type="text" class="form-control" readonly="" value="' . $value['id_industri'] . '">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label bmd-label-static">Nama Kecamatan</label>
                                    <input type="text" class="form-control" readonly="" value="' . $value['nama_kec'] . '">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label bmd-label-static">Komoditi</label>
                                    <input type="text" class="form-control" readonly="" value="' . $value['komoditi'] . '">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label bmd-label-static">Target Produksi (Ton)</label>
                                    <input type="text" class="form-control" readonly="" value="' . $value['target_produksi'] . '">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label bmd-label-static">Tahun</label>
                                    <input type="text" class="form-control" readonly="" value="' . $value['tahun'] . '">
                                </div>
                            ';
                        }
                        ?>
                        <table id="example" class="display table table-stipped table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="50px">No.</th>
                                    <th width="200px">Nama Pemilik Lahan</th>
                                    <th>Luas Area (m<sup>2</sup>)</th>
                                    <th>Produksi (Ton)</th>
                                    <th width="115px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($list_industri_data as $key => $value) {
                                    echo '
                                    <tr>
                                        <td>' . $no++ . '</td>
                                        <td>' . $value['nama'] . '</td>
                                        <td>' . $value['luas_area'] . '</td>
                                        <td>' . $value['produksi'] . '</td>
                                        <td><a name="delete" data-id="' . $value['id_industri_data'] . '" class="btn btn-danger hapus" href="#" role="button"><i class="fas fa-trash fa-sm fa-fw"></i> Hapus</a></td>
                                    </tr>
                                ';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pemilik Lahan</th>
                                    <th>Luas Area (m<sup>2</sup>)</th>
                                    <th>Produksi (Ton)</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= $url_back ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="<?= base_url('data/industri_add?id=' . $id) ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
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
        var nama_table = "industri_data";
        var id_table = "id_industri_data";

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

            const array_kecamatan = <?= json_encode($kecamatan) ?>;
            array_kecamatan.filter((x) => {
                console.log(x)
                poin = x.poligon_kec.replace(/&quot;/g, '"');
                let coords = JSON.parse(poin);
                let polygon = new google.maps.Polygon({
                    paths: coords,
                    strokeColor: "white",
                    strokeOpacity: 0.8,
                    strokeWeight: 0.5,
                    fillColor: "white",
                    fillOpacity: 0.5,
                });
                polygon.setMap(map);
            })

            const array_points = <?= json_encode($list_industri_data) ?>;
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
                        "Luas Area : " + x.luas_area + " m<sup>2</sup><br>" +
                        "Produksi : " + x.produksi + " Ton<br>";
                    infoWindow.setContent(contentString);
                    infoWindow.setPosition(event.latLng);
                    infoWindow.open(map);
                }
            })
        }
    </script>