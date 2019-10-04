<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $title_page; ?> &mdash; Aplikasi Survei Harga</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/css/components.css">
  <style type="text/css">
    @media only screen and (max-width:1200px)
    {
        .tombolfull{width:100%; margin-top:5px;}
    }
  </style>
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA -->

<!-- General JS Scripts -->
<script src="<?php echo base_url('dist/')?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/popper.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url('dist/')?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?php echo base_url('dist/')?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url('dist/')?>assets/modules/jquery-ui/jquery-ui.min.js"></script>



</head>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <!-- Navbar & Sidebar-->
      <?php 
      include('navbar_admin.php');
      if($this->session->userdata('role') == "admin"){
          include('sidebar_admin.php');
      }else if($this->session->userdata('role') == "surveyor"){
          include('sidebar_surveyor.php');
      }else if($this->session->userdata('role') == "pengunjung"){
          include('sidebar_pengunjung.php');
      }?>