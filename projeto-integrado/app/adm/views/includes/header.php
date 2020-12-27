<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>brinsp - Área Administrativa</title>

    <!--ICON-->
    <link rel="icon" href="<?= URL; ?>assets/img/icon/icon.png">

    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

    <!--CUSTOM CSS-->
    <link rel="stylesheet" href="<?= URL ?>assets/css/dashboard.css">

    <!--SWEETALERT-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
      function showtime() {
        setTimeout("showtime();", 1000);
        callerdate.setTime(callerdate.getTime() + 1000);
        var hh = String(callerdate.getHours());
        var mm = String(callerdate.getMinutes());
        var ss = String(callerdate.getSeconds());
        document.getElementById("relogio").innerHTML = ((hh < 10) ? " " : "") + hh + ((mm < 10) ? ":0" : ":") + mm + ((ss < 10) ? ":0" : ":") + ss;
      }
      callerdate = new Date(<?php echo date("Y,m,d,H-3,i,s"); ?>);
    </script>
</head>

<body onLoad="showtime()">

    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow" style="background-color:orange;">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?= URL ?>adm-home/index">
        <i class="fas fa-user-cog"></i>
        <b>BRINSP_</b><em>adm</em>
      </a>
    </nav>

    <div class="container-fluid">
      <div class="row">