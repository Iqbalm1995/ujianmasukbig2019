
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Survei Harga</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <h4>Aplikasi Web Survey Harga</h4>
            </div>
            <!-- validasi -->
            <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
            <?php if($this->session->flashdata('pesan1')) {?>
                <div class="alert alert-warning" role="alert">
                    <h4>Peringatan!</h4>
                    <?php echo $this->session->flashdata('pesan1'); ?>
                </div>
            <?php }elseif($this->session->flashdata('pesan2')) {?>
                <div class="alert alert-warning" role="alert">
                    <h4>Ada Kesalahan!</h4>
                    <?php echo $this->session->flashdata('pesan2'); ?>
                </div>
            <?php }; ?>
            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url('daftar/proses_daftar'); ?>">

                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" class="form-control" name="nama" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" class="form-control" required></textarea>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Daftar
                    </button>
                    <br>
                    <span>Sudah mempunyai Akun ? <a href="<?php echo base_url('login'); ?>"><strong>Login</strong></span></a>
                  </div>

                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy;
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo base_url('dist/')?>assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/popper.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="<?php echo base_url('dist/')?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?php echo base_url('dist/')?>assets/js/page/auth-register.js"></script>
  
  <!-- Template JS File -->
  <script src="<?php echo base_url('dist/')?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/js/custom.js"></script>
</body>
</html>