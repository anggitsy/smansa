<section class="content">
    <div class="container-fluid">
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>Kelola Prasarana dan Sarana</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <?php echo $this->session->flashdata('info'); ?>  
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Prasarana</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status Pinjam</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($peminjaman==NULL): ?>
                                    <tr>
                                        <td colspan="6">Belum ada siswa terdaftar.</td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $no=1; ?>
                                    <?php foreach ($peminjaman as $p):?>
                                    <tr>
                                        <td><?=$no; ?></td>
                                        <td><?=$p->nama_prasarana; ?></td>
                                        <td><?=$p->nama; ?></td>
                                        <td><?=$p->tanggal; ?></td>
                                        <td><?=$p->tanggal; ?></td>
                                        <td><?=$p->status_peminjaman; ?></td>
                                        <td><?=$p->jumlah; ?></td>
                                        <td>
                                            <a href='#myModal' type="button" class=" btn btn-3d btn-primary" data-toggle='modal' data-id="<?= $p->id_peminjaman; ?>">
                                                <i class="material-icons">edit</i> Edit</a>
                                            </td>
                                        </tr>
                                    <?php $no++; ?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Detail Penjual -->
        
        <!-- MODAL -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detail Peminjaman</h4>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Jquery Core Js -->
<script src="<?=base_url(); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="<?=base_url(); ?>plugins/bootstrap/js/bootstrap.js"></script>
<!-- Select Plugin Js -->
<script src="<?=base_url(); ?>plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Slimscroll Plugin Js -->
<script src="<?=base_url(); ?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="<?=base_url(); ?>plugins/node-waves/waves.js"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="<?=base_url(); ?>plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Morris Plugin Js -->
<script src="<?=base_url(); ?>plugins/raphael/raphael.min.js"></script>
<script src="<?=base_url(); ?>plugins/morrisjs/morris.js"></script>
<!-- ChartJs -->
<script src="<?=base_url(); ?>plugins/chartjs/Chart.bundle.js"></script>
<!-- Flot Charts Plugin Js -->
<script src="<?=base_url(); ?>plugins/flot-charts/jquery.flot.js"></script>
<script src="<?=base_url(); ?>plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="<?=base_url(); ?>plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="<?=base_url(); ?>plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="<?=base_url(); ?>plugins/flot-charts/jquery.flot.time.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="<?=base_url(); ?>plugins/jquery-sparkline/jquery.sparkline.js"></script>
<!-- Custom Js -->
<script src="<?=base_url(); ?>js/admin.js"></script>
<script src="<?=base_url(); ?>js/pages/index.js"></script>
<!-- Demo Js -->
<script src="<?=base_url(); ?>js/demo.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });

  $('#myModal').on('show.bs.modal', function (e) {
      var rowid = $(e.relatedTarget).data('id');
      var base_url = window.location.origin;


      $.ajax({
          type    : 'post',
          url     :  base_url+'/smansa/c_pengelola/modal_detail',
          data    : 'rowid='+rowid,

          success : function(data){
            $('.fetched-data').html(data);
          }
      });
   });
</script>
</body>
</html>ss