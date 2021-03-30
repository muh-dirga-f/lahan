<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perikanan</h1>
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
                                <th>Kecamatan</th>
                                <th>Komoditi</th>
                                <th>Target Produksi (Ton)</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list_perikanan as $key => $value) {
                                echo '
                                    <tr>
                                        <td>' . $no++ . '</td>
                                        <td>' . $value['nama_kec'] . '</td>
                                        <td>' . $value['komoditi'] . '</td>
                                        <td>' . $value['target_produksi'] . '</td>
                                        <td>' . $value['tahun'] . '</td>
                                        <td>
                                            <a href="' . base_url('data/perikanan_view?id=' . $value['id_perikanan']) . '" class="btn btn-info view" role="button"><i class="fas fa-eye fa-sm"></i></a>
                                            <a data-id="' . $value['id_perikanan'] . '" href="#" class="btn btn-warning edit" role="button" data-toggle="modal" data-target="#exampleModalScrollable"><i class="fas fa-edit fa-sm"></i></a>
                                            <a data-id="' . $value['id_perikanan'] . '" class="btn btn-danger hapus" href="#" role="button"><i class="fas fa-trash fa-sm fa-fw"></i></a>
                                        </td>
                                    </tr>
                                ';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Kecamatan</th>
                                <th>Komoditi</th>
                                <th>Target Produksi</th>
                                <th>Tahun</th>
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
        <div class="modal-dialog //modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
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
                            <label for="id_kecamatan">Kecamatan :</label>
                            <select name="id_kecamatan" class="form-control" id="id_kecamatan">
                                <?php
                                $opt = $this->db->get('kecamatan')->result_array();
                                foreach ($opt as $key => $value) {
                                    echo '<option value="' . $value['id_kec'] . '">' . $value['nama_kec'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="komoditi">Komoditi :</label>
                            <input name="komoditi" type="text" class="form-control" id="komoditi" placeholder="Input Komoditi">
                        </div>
                        <div class="form-group">
                            <label for="target_produksi">Target Produksi :</label>
                            <div class="input-group">
                                <input name="target_produksi" type="text" class="form-control" id="target_produksi" placeholder="Input Target Produksi">
                                <div class="input-group-append">
                                    <span class="input-group-text">Ton</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun :</label>
                            <input name="tahun" type="text" class="form-control" id="tahun" placeholder="Input Tahun">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" onclick="javascript:tambah();" id="btn-save">Simpan</button>
                    <button type="submit" class="btn btn-warning" onclick="javascript:ubah();" id="btn-edit">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var url = "<?php echo base_url(); ?>";
        var nama_table = "perikanan";
        var id_table = "id_perikanan";

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

        function ubah() {
            let data = $('#btn-edit').data();
            var form = $("form")[0];
            var formData = new FormData(form);
            formData.append('table', nama_table);
            formData.append('id_table', id_table);
            formData.append('id', data.id);
            $.ajax({
                url: url + '/api/edit', //link json
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

        $('#btn-tambah').on('click', function() {
            $('#komoditi').val('');
            $('#target_produksi').val('');
            $('#tahun').val('');
            $('#btn-save').show();
            $('#btn-edit').hide();
        })

        $('.edit').on('click', function() {
            $('#btn-save').hide();
            $('#btn-edit').show();
            let data = $(this).data();
            $.ajax({
                url: url + '/api/get_where?table=' + nama_table + '&id=' + data.id + '&id_table=' + id_table, //link json
                type: 'GET',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(result) {
                    $('#komoditi').val(result.data[0].komoditi);
                    $('#target_produksi').val(result.data[0].target_produksi);
                    $('#tahun').val(result.data[0].tahun);
                    $('#id_kecamatan').children('option[value="' + result.data[0].id_kecamatan + '"]').attr('selected', 'selected');
                    $('#btn-edit').attr('data-id',data.id);
                }
            })
        })

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
    </script>