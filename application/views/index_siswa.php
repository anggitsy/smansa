    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD SISWA</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW TASKS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW TICKETS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW COMMENTS</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW VISITORS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Selamat Datang, <b><?php echo $this->session->userdata('logged_in')['nama']; ?></b> !
                            </h2>
                        </div>
                        <div class="body">
                            Selamat datang di aplikasi peminjaman sarana dan pra sarana olahraga SMAN 1 Baleendah. <br>
                            Disini kamu dapat meminjam semua sarana dan prasarana dengan akses lebih mudah. <br>
                            Kamu dapat mengakses website ini 24x7 jam. Kamu bisa mengakses fungsionalitas pada panel sebelah kiri.
                            <br> Enjoy! :)
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
</body>

</html>
