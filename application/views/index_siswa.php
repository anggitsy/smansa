    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD SISWA</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
