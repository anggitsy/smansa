<section class="content">
    <div class="container-fluid">
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>Kelola User Siswa</h2>
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
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($siswa==NULL): ?>
                                    <tr>
                                        <td colspan="6">Belum ada siswa terdaftar.</td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $no=1; ?>
                                    <?php foreach ($siswa as $s):?>
                                    <tr>
                                        <td><?=$no; ?></td>
                                        <td><?=$s->nis; ?></td>
                                        <td><?=$s->nama; ?></td>
                                        <td><?=$s->email; ?></td>
                                        <td><?=$s->status; ?></td>
                                        <td><?php //$s->status; ?></td>
                                        <td>
                                            <a href='#myModal' type="button" class=" btn btn-3d btn-primary" data-toggle='modal' data-id="<?= $s->id_peminjam; ?>">
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
                        <h4 class="modal-title">Detail User Siswa</h4>
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
<!-- Jquery DataTable Plugin Js -->
<script src="<?=base_url(); ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?=base_url(); ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- Custom Js -->
<script src="<?=base_url(); ?>js/admin.js"></script>
<script src="<?=base_url(); ?>js/pages/index.js"></script>
<!-- Demo Js -->
<script src="<?=base_url(); ?>js/demo.js"></script>
<script type="text/javascript">

    $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        var base_url = window.location.origin;

        $.ajax({
            type    : 'post',
            url     :  base_url+'/smansa/c_pengelola/modal_siswa',
            data    : 'rowid='+rowid,

            success : function(data){
                $('.fetched-data').html(data);
            }
        });
    });
    $('.js-basic-example').DataTable({
        responsive: true
    });
</script>
</body>
</html>