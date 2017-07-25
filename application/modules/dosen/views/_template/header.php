<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?> | Sistem Informasi Akademik</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet/less" type="text/css" href="<?php echo base_url("assets/build/siakad.less"); ?>" media="screen, projection"/>
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/bootstrap.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/ionicons/css/ionicons.min.css"); ?>">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow|Lato|Raleway|Droid+Sans" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url("assets/dist/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/skins/skin-pertiba.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/animate.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/picdate/themes/default.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/picdate/themes/default.date.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/picdate/themes/default.time.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/validation/css/formValidation.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/select2/select2.min.css"); ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url("assets/img/logo.png"); ?>"/>
  <style>
    * { font-family: 'Droid Sans', sans-serif; font-size: 13px; }
    li > a > i.ion { font-size: 18px; }
    a.link { color:blue; }
    a.link:hover { color:#00C0EF; }
    .mini-font { font-size:0.9em; }
    a.active { font-weight: bold; }
    a { cursor: pointer; }
    div.checkbox, label.checkbox { padding-top:0px; padding-bottom: 0px; }
    .bg-silver { background:rgb(249,250,252); }
    .icon-button { font-size: 1.1em; margin: 5px 10px 0px 0px; }
    .icon-button:hover { font-size: 1.2em;}
    .text-line { text-decoration: line-through; color: rgb(173,0,0); }
    dt { text-align: left; }
    .table-black{border:0.5px solid #cdcdcd}.table-bordered-black > thead > tr > th,.table-bordered-black > tbody > tr > th,.table-bordered-black > tfoot > tr > th,.table-bordered-black > thead > tr > td,.table-bordered-black > tbody > tr > td,.table-bordered-black > tfoot > tr > td{border:.5px solid #cdcdcd}
    .input-nilai { outline: none; border: transparent; width: 100%; padding: 8px; text-align: center;  }
    .input-nilai:focus { background-color: #FFF9D3; font-size: 17px; padding: 6px; }
    .table-nilai-input{border:.5px solid #cdcdcd}.table-nilai-input > thead > tr > th,.table-nilai-input> tbody > tr > th,.table-nilai-input > tfoot > tr > th,.table-nilai-input > thead > tr > td,.table-nilai-input > tbody > tr > td,.table-nilai-input > tfoot > tr > td{border:0.5px solid #cdcdcd; padding: 5px; padding: 6px; }
    td.td-padding {  }
    td.td-nilai { border:0.5px solid #cdcdcd; white-space: nowrap; padding: 0px; }
    .table-nilai-input > tbody > tr > td.td-nilai { padding: 0px; font-family: 'Droid Sans', sans-serif; }
    .table-nilai-input > tbody > tr > td {  font-family: 'Droid Sans', sans-serif; font-size: 14px;  }
    .top { margin-top: 20px; }
    div.kisaran > .ticks_labels { padding: 10px;  }
    .bigger-font { font-size: 15px; }
  </style>
</head>
<?php  
/* End of file header.php */
/* Location: ./application/modules/Akademik/views/_template/header.php */
?>