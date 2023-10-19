<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Novate Hospital</title>
    <link rel="icon" href="<?php echo base_url('assets/images/n_logo.png') ?>" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/metro-blue/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/icon.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/general.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_main.js') ?>"></script>
    <style>
        body, html {
  height: 100%;
}

.bg {
  /* The image used */
  background-image: url(<?php echo base_url();?>./assets/images/main00.png);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
    </style>
</head>
<body>
<div class="bg"></div>
    <div id="form_login" class="easyui-panel" title="" style="width:300px;height:210px;padding:10px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);border-radius:5px;background:white;">
        <form id="fmLogin" class="easyui-form" method="post" data-options="novalidate:true">
            <div style="margin-bottom:10px">
                <input id="username" class="easyui-textbox" label="Username:" labelPosition="top" name="username" data-options="tipPosition:'bottom',prompt:'Username',required:true" style="width:100%;">
            </div>
            <div style="margin-bottom:15px">
                <input id="password" class="easyui-passwordbox" label="Password:" labelPosition="top" name="password" prompt="Password" data-options="tipPosition:'bottom',required:true" iconWidth="28" style="width:100%;">
            </div>
            <div>
            <a href="#" class="easyui-linkbutton"  style="width:100%;height:40px;" onclick="loginApp()">Login</a>
            </div>
        </form>
    </div>

</body>
</html>