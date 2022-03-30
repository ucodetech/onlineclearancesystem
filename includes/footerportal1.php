  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     Online Clearance System
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020-2021 <a href="https://adminlte.io">Fed Poly Idah</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=URLROOT?>assests/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="<?=URLROOT?>assests/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?=URLROOT?>assests/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=URLROOT?>assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=URLROOT?>assests/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=URLROOT?>assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- AdminLTE App -->
<script src="<?=URLROOT?>assests/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
   <script type="text/javascript" src="../assests/TimeCircles.js"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
