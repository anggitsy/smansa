<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-6 col-sm-6">
                                <h2>Kelola Pengembalian</h2>
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <a href="#modalCreate" type="button" class="pull-right btn btn-3d btn-primary" data-toggle='modal'><i class="material-icons">add</i> Tambah Pengembalian</a>
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
                                        <th>Nama Barang</th>
                                        <th>Kondisi Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($pengembalian==NULL): ?>
                                    <tr>
                                        <td colspan="6">Belum ada siswa terdaftar.</td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $no=1; ?>
                                    <?php foreach ($pengembalian as $p):?>
                                    <tr>
                                        <td><?=$no; ?></td>
                                        <td><?=$p->nama_prasarana; ?></td>
                                        <td><?=$p->status; ?></td>
                                        <td><img src="<?= base_url('/assets/'.$p->foto);?>" alt="foto"></td>
                                        <td><?=$p->jenis_sarana; ?></td>
                                        <td><?=$p->stok; ?></td>
                                        <td>
                                            <a href='#myModal' type="button" class="btn btn-3d btn-primary" data-toggle='modal' data-id="<?= $p->id_prasarana; ?>">
                                                <i class="material-icons">edit</i> Edit</a>
                                            <a href='#modalDelete' type="button" class="btn btn-3d btn-danger" data-toggle='modal' data-id="<?= $p->id_prasarana; ?>">
                                                <i class="material-icons">delete</i> Delete</a>
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
        <script type="text/javascript">
            console.log("test");
        </script>
        <!-- MODAL -->
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tambah Pengembalian</h4>
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
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detail Pengembalian</h4>
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
        <div class="modal fade" id="modalDelete" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Hapus Data Pengembalian</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Apakah anda yakin ingin menghapus data Pengembalian?</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url('/c_pengelola/hapus_prasarana');?>">
                            <input type="hidden" name="id_peminjaman">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <button class="btn btn-default" data-dismiss="modal">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END MODAL -->
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
            url     :  base_url+'/smansa/c_pengelola/modal_detail_prasarana',
            data    : 'rowid='+rowid,

            success : function(data){
                $('.fetched-data').html(data);
            }
        });
    });
    $('#modalCreate').on('show.bs.modal', function (e) {
        var base_url = window.location.origin;

        $.ajax({
            type    : 'post',
            url     :  base_url+'/smansa/c_pengelola/modal_add_pengembalian',
            success : function(data){
                console.log(data);
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