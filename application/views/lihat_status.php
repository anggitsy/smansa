    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                STATUS PEMIMJAMAN SARANA DAN PRASARANA
                            </h2>
                        </div>
                        <div class="body">
                       <?php echo $this->session->flashdata('info'); ?>  
                        <div class="table-responsive">
                            <table id="#datatables-example" class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                                                <i class="material-icons">visibility</i> Lihat Detail</a>
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
            <!-- MODAL END -->
        </div>
    </section>
    <!-- Jquery Spinner Plugin Js -->
    <script src="<?=base_url(); ?>plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="<?=base_url(); ?>plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="<?=base_url(); ?>plugins/autosize/autosize.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?=base_url(); ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url(); ?>js/admin.js"></script>
    <script src="<?=base_url(); ?>js/pages/forms/advanced-form-elements.js"></script>
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

    <!-- Autosize Plugin Js -->
    <script src="<?=base_url(); ?>plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="<?=base_url(); ?>plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?=base_url(); ?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url(); ?>js/admin.js"></script>
    <script src="<?=base_url(); ?>js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="<?=base_url(); ?>js/demo.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="<?=base_url(); ?>plugins/jquery-spinner/js/jquery.spinner.js"></script>
    <script type="text/javascript">
        $('#min-date').bootstrapMaterialDatePicker({ 
            format : 'YYYY-MM-DD', 
            minDate : new Date(),
            time : false
        });

        $('#min-time').bootstrapMaterialDatePicker({ 
            format : 'HH:mm', 
            date: false
        });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#datatables-example').DataTable();
      });

      $('#myModal').on('show.bs.modal', function (e) {
          var rowid = $(e.relatedTarget).data('id');
          var base_url = window.location.origin;


          $.ajax({
              type    : 'post',
              url     :  base_url+'/smansa/c_siswa/modal_detail',
              data    : 'rowid='+rowid,

              success : function(data){
                $('.fetched-data').html(data);
              }
          });
       });
    </script>

</body>
</html>
