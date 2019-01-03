<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login | SMANSA 1 Baleendah</title>
    
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url(); ?>images/fav.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url(); ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url(); ?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url(); ?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url(); ?>css/style.css?<?=time(); ?>" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">SMAN 1 Baleendah <b class="col-pink">Logistik</b></a>
            <small>Peminjaman Sarana dan Prasarana</small>
        </div>
        <div class="card">
            <div class="body">
                <?php echo form_open('c_pengelola/buat_akun', 'id="sign_up"'); ?>
                    <div class="msg">Daftar Akun Baru</div>
                    <?php echo $this->session->flashdata('registrasi'); ?>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">fingerprint</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="nis" placeholder="Nomor Induk Siswa (NIS)" required autofocus>
                        </div>
                        <div class="col-red text-error"><?php echo form_error('nis'); ?></div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama" placeholder="Name Lengkap" required autofocus>
                        </div>
                        <div class="col-red text-error"><?php echo form_error('nama'); ?></div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Alamat Email" required>
                        </div>
                        <div class="col-red text-error"><?php echo form_error('email'); ?></div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                        <div class="col-red text-error"><?php echo form_error('password'); ?></div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="col-red text-error"><?php echo form_error('confirm'); ?></div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink" required>
                        <label for="terms">Saya setuju data di atas adalah benar</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?=base_url(); ?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url(); ?>plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url(); ?>plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?=base_url(); ?>plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url(); ?>js/admin.js"></script>
    <script src="<?=base_url(); ?>js/pages/examples/sign-up.js"></script>
</body>

</html>