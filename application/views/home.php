<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Novate Hospital</title>
    <link rel="icon" href="<?php echo base_url('assets/images/n_logo.png') ?>" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/metro-blue/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/icon.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/home.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_home.js') ?>"></script>
    <style>
        body, html {
            height: 100%;
        }

        .bg {
        /* The image used */
        background-image: url(<?php echo base_url();?>./assets/images/main11.png);

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
<div id="form_home" class="easyui-layout" style="width:100%;height:100%;">

        <div data-options="region:'north'" style="height:50px">
                <div style="margin-top:5px;">
                    <img src="<?php echo base_url('assets/images/N_logo.png');  ?>" width="40" height="40" />
                </div>

                <div class="easyui-panel" style="padding:5px;width:400px; margin-left:60px;top:4px;position:absolute;border:none;">
                    <a href="#" class="easyui-menubutton" data-options="menu:'#mm0'">File</a>
                    <a href="#" class="easyui-menubutton" data-options="menu:'#mm1'">Hospital Data</a>
                    <a href="#" class="easyui-menubutton" data-options="menu:'#mm2'">Pasien Data</a>

                        <div id="mm0" style="width:150px;height:36px;" data-options="
				            onClick:function(item){
					            logoff();
				            }
			            ">
                            <div data-options="iconCls:'icon-cancel'" style="min-height:30px;margin-top:0px;"><span style="margin-top:0px;display: block;">Logout</span></div>
                        </div>

                        <div id="mm1" style="width:150px;" data-options="
                            onClick:function(item){
                                menuSelection(item.name);
                            }
                        ">
                            <div name="Users" data-options="iconCls:'icon-user'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Users</span></div>
                            <div class="menu-sep"></div>
                            <div name="Paramedis" data-options="iconCls:'icon-user'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Paramedis</span></div>
                            <div class="menu-sep"></div>
                            <div name="Fasilitas" data-options="iconCls:'icon-product'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Fasilitas</span></div>
                            <div class="menu-sep"></div>
                            <div name="Jadwal" data-options="iconCls:'icon-note'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Jadwal</span></div>
                        </div>

                        <div id="mm2" style="width:150px;" data-options="
                            onClick:function(item){
                                menuSelection(item.name);
                            }
                        ">
                            <div name="Pasien" data-options="iconCls:'icon-user'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Pasien</span></div>
                            <div class="menu-sep"></div>
                            <!-- <div name="Invoice" data-options="iconCls:'icon-customer'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Invoice</span></div> -->
                            <div name="Kunjungan" data-options="iconCls:'icon-user'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Kunjungan</span></div>
                            <div class="menu-sep"></div>
                            <div name="Rekam Medik" data-options="iconCls:'icon-user'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Rekam Medik</span></div>
                            <div class="menu-sep"></div>
                            <div name="Pelayanan" data-options="iconCls:'icon-user'" style="min-height:30px;margin-top:0px;"><span style="margin-top:3px;display: block;">Pelayanan</span></div>
                        </div>
                </div>
                
        </div>

        <div data-options="region:'south'" style="height:25px;">
            <div style="text-align:left;">Novate - Hospital Management
			<span style="float:right;">Welcome, you login as : <?php echo $this->session->userdata("nama"); ?></span> 
			</div>
        </div>
        <div data-options="region:'center'" style="background:transparent;">
            <div class="easyui-tabs" fit="true" border="none" id="ttab" style="width:100%;height:100%;max-width:100%;background:none;opacity:1;">
                        <div title="Welcome" closable="true" style="padding:20px;background:none;"> 
                            <div style="margin-top:20px;">
                                <h3>Selamat datang di Hospital Management</h3>
                                <li>dalam system ini dapat di lakukan entry data .</li> 
                                <li>proses reporting juga dapat dilakukan dalam aplikasi ini.</li> 
                                <li>aplikasi ini masih dalam tahap pengembangan.</li> 											
                            </div>
                        </div>					
            </div>
        </div>
</div>

</body>
</html>