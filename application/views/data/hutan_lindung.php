<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hutan Lindung</h1>
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
                                <th>Tahun</th>
                                <th>Jumlah Luas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Tahun</th>
                                <th>Jumlah Luas</th>
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
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
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
                            <label for="tahun">Tahun :</label>
                            <input type="text" class="form-control" id="tahun" placeholder="Input Tahun">
                        </div>
                        <div class="form-group">
                            <label for="tahun">Jumlah Luas :</label>
                            <input type="text" class="form-control" id="tahun" placeholder="Input Tahun">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" onclick="javascript:tambah();" id="btn-save">Simpan</button>
                    <button type="submit" class="btn btn-warning" onclick="javascript:edit();" id="btn-edit">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>