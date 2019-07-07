<section class="content">
    <div class="container-fluid">
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-12">
                                <h2>Kelola Peminjaman Sarana</h2>
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
                        <div class="fetched-data">
                            <form method="post" action="<?php echo base_url('c_pengelola/update_status');?>">
                <input type="hidden" name="id_peminjaman" id="id_peminjaman">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label id="modal">Nama Sarana</label>
                        <input type="text" class="form-control" name="nama_sarana" id="nama_sarana" readonly>
                    </div>
                    <div class="col-md-6">
                        <label id="modal">Nama Peminjam</label>
                        <input type="text" class="form-control" name="nama" id="nama" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Status Peminjaman</label>
                        <select name="status_peminjaman" id="status_peminjaman" class="form-control show-tick">
                            <option value="Menunggu Konfimasi">Menunggu Konfimasi</option>
                            <option value="Sudah Konfirmasi">Sudah Konfirmasi</option>
                            <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                            <option value="Terkonfirmasi">Telah Kembali</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label id="modal">Tanggal Pinjam</label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label id="modal">Jam</label>
                        <input type="text" class="form-control" name="tanggalkembali" id="tanggalkembali" readonly>
                    </div>
                    <div class="col-md-6">
                        <label id="modal">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit"><i class="material-icons">check</i>Update</button>
            </form>
                        </div>
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
            dataType: 'json',
            url     :  base_url+'/smansa/c_pengelola/modal_detail',
            data    : 'rowid='+rowid,

            success : function(response){
                if (response != 'error') {
                    $('#id_peminjaman').val(response.id_peminjaman);
                    $('#nama_sarana').val(response.nama_prasarana);
                    $('#nama').val(response.nama);
                    $('#status_peminjaman').val(response.status_peminjaman);
                    $('#tanggal').val(response.tanggal);
                    $('#tanggalkembali').val(response.jam);
                }
            }
        });
    });
    $('.js-basic-example').DataTable({
        responsive: true
    });
</script>
</body>
</html>