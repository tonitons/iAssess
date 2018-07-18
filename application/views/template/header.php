<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $title ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
    
  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">
  
  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">
  
  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link href="<?php echo base_url('upload/'.$detail->logo)?>" rel="shortcut icon">
  
  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">  -->
  
  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  
  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url('assets/lib/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/lib/animate-css/animate.min.css') ?>" rel="stylesheet">
  
  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
  <!-- <link href="http://localhost/iassess/assets/css/styles.css" rel="stylesheet"> -->
  <link href="<?php echo base_url('assets/css/Pretty-footer.css') ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/print.css') ?>" media="print">
  <?php foreach ($css as $key => $file): ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/'.$file.'.css') ?>">
  <?php endforeach; ?>
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.min.js') ?>"></script>
</head>

<body>
  <div id="preloader"></div>
