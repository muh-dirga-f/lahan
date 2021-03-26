  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>


<!-- REQUIRED SCRIPTS -->
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<!-- <script src="<?php echo base_url('assets/'); ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script> -->
<!-- <script src="<?php echo base_url('assets/'); ?>plugins/raphael/raphael.min.js"></script> -->
<!-- <script src="<?php echo base_url('assets/'); ?>plugins/jquery-mapael/jquery.mapael.min.js"></script> -->
<!-- <script src="<?php echo base_url('assets/'); ?>plugins/jquery-mapael/maps/usa_states.min.js"></script> -->
<!-- ChartJS -->
<!-- <script src="<?php echo base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script> -->

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url('assets/'); ?>dist/js/pages/dashboard2.js"></script> -->

<script type="text/javascript">
  var windowURL = window.location.href;
  // pageURL = windowURL.substring(windowURL.lastIndexOf('/')+1,windowURL.length);
  // console.log(windowURL)
  // var x = $('a[href="' + pageURL + '"]');
  // x.addClass('active');
  // x.parent().addClass('active');
  var y = $('a[href="' + windowURL + '"]');
  y.addClass('active');
  y.parent().parent().parent().addClass('menu-open');
</script>
</body>

</html>