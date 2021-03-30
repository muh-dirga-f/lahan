<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
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
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tree"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Perkebunan</span>
                            <span class="info-box-number"><?= count($this->db->get('perkebunan')->result_array()); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-seedling"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pertanian</span>
                            <span class="info-box-number"><?= count($this->db->get('pertanian')->result_array()); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-fish"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Perikanan</span>
                            <span class="info-box-number"><?= count($this->db->get('perikanan')->result_array()); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fas fa-industry"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Industri</span>
                            <span class="info-box-number"><?= count($this->db->get('industri')->result_array()); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text text-center pt-5 pb-5">Selamat Datang</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->