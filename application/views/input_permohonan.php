    <style type="text/css">
        /* Hide HTML5 Up and Down arrows. */
        input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                INPUT PERMOHONAN PEMINJAMAN SARANA
                            </h2>
                        </div>
                        <div class="body">
                            <?php echo form_open('C_siswa/insert_rental', 'class="form-horizontal"'); ?>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Nama Sarana</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <select class="form-control show-tick" name="id_prasarana" id="id_prasarana">
                                            <option value="">-- Pilih Sarana --</option>
                                            <?php foreach ($prasarana as $p) :?>
                                                <option value="<?= $p->id; ?>"><?= $p->nama; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="jumlah">Jumlah</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group spinner" data-trigger="spinner">
                                            <div class="form-line">
                                                <input type="number" name="jumlah" class="form-control text-center" min="1" data-rule="quantity" focus="false" autocomplete="off">
                                            </div>
                                            <span class="input-group-addon">
                                                <a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                                <a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="tanggal">Tanggal Pinjam</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="min-date" type="text" class="datetimepicker form-control" placeholder="Pilih tanggal pinjam" name="tanggal">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="jam">Jam Pinjam</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="min-time" type="text" class="timepicker form-control" placeholder="Antara 07:00 - 21:00" name="jam">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="tanggal">Keterangan Pinjam</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Masukan keterangan pinjam" name="alasan_pinjam">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"></div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button class="btn btn-block bg-pink waves-effect" type="submit">SUBMIT DATA</button>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?=base_url(); ?>plugins/jquery/jquery.min.js"></script>
    
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

        $('#id_prasarana').change(function(){
            var id_prasarana = $(this).val();
            console.log(id_prasarana);
            $.ajax({
                url: "<?php echo base_url('c_siswa/get_stok_prasarana'); ?>",
                data: { 'id_prasarana' : id_prasarana },
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                }
            });
        });
    </script>

</body>

</html>
