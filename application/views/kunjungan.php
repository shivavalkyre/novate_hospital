<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PT. Kumara Wardhana</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/metro-blue/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/icon.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/general.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_kunjungan.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgKunjungan" toolbar="#toolbarKunjungan" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Kunjungan/getKunjungan') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="KUN_NO_ANTRI" width="120">KUN NO ANTRI</th>
                    <th field="KUN_TGL" width="120">KUN TGL</th>
                    <th field="PAS_NO_REG" width="100">PAS NO REG</th>
                    <th field="PAS_NAMA_AWAL" width="100">PAS NAMA</th>
                    <th field="PAS_ALAMAT1" width="100">PAS ALAMAT</th>
                    <th field="FAS_NAMA" width="100">FAS NAMA</th>
                    <th field="PAM_NAMA" width="100">PAM NAMA</th>
                    <th field="PAM_KATEGORI" width="100">PAM_KATEGORI</th>
                    <th field="JAD_JAM_MULAI" width="100">MULAI</th>
                    <th field="JAD_JAM_SELESAI" width="100">SELESAI</th>
                </tr>
            </thead>
        </table>

        <div id="toolbarKunjungan">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newKunjungan()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editKunjungan()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyKunjungan()">Destroy</a>
            <input  id="searchKunjungan" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchKunjungan,
            inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                keyup: function(e){
                    var t = $(e.data.target);
                    var opts = t.searchbox('options');
                    t.searchbox('setValue', $(this).val());
                    opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                }
              })" style="width:50%;"></input>
        </div>
    </div>

    <div id="dlgKunjungan" class="easyui-dialog" style="width: 380px; height: 450px; padding: 10px;" modal="true" closed="true" buttons="#dlgKunjunganBtn">
        <form id="fmKunjungan" method="post">
                        <div style="margin-bottom:5px">
                            <input id="dt1" class="easyui-datetimebox" name="KUN_TGL" labelPosition="top" style="width:100%" data-options="label:'KUN TGL:',required:true,formatter:mydtformatter,parser:mydtparser,
                                    onSelect: function(value)
                                                {
                                                    var c = $('#dt1').datetimebox('calendar');
                                                    var t = $('#dt1').datetimebox('spinner');

                                                    var day = c.calendar('options').current;

                                                    var time = t.timespinner('getValue');
                                                    var y = day.getFullYear();
                                                    var m = day.getMonth()+1;
                                                    var d = day.getDate();
                                                    var myday = String(y)+'-'+String(m<10?('0'+m):m)+'-'+String(d<10?('0'+d):d);
                                                
                                                    var mydate = strip( myday + ' ' + time + ':00' );

                                                    $('#dt1').datetimebox('setValue', mydate);
                                                    $('#dt1').datetimebox('hidePanel');
                                                    }
                                    ">
                        </div>

                        <div style="margin-bottom:5px">
                                <select class="easyui-combogrid" name="PAS_NO_REG" style="width:100%" data-options="
                                        panelWidth: 500,
                                        idField: 'PAS_NO_REG',
                                        textField: 'PAS_NAMA_AWAL',
                                        url: 'Pasien/getPasienAll',
                                        method: 'get',
                                        columns: [[
                                            {field:'PAS_NO_REG',title:'PAS_NO_REG',width:100},
                                            {field:'PAS_NAMA_AWAL',title:'PAS_NAMA_AWAL',width:100},
                                            {field:'PAS_NAMA_AKHIR',title:'PAS_NAMA_AKHIR',width:100},
                                        ]],
                                        fitColumns: true,
                                        label: 'PAS NO REG:',
                                        labelPosition: 'top',
                                        required:true,
                                    ">
                                </select>
                        </div>

                        
                        <div style="margin-bottom:5px">
                                <select class="easyui-combogrid" name="FAS_ID" style="width:100%" data-options="
                                        panelWidth: 500,
                                        idField: 'FAS_ID',
                                        textField: 'FAS_NAMA',
                                        url: 'Fasilitas/getFasilitasAll',
                                        method: 'get',
                                        columns: [[
                                            {field:'FAS_ID',title:'FAS ID',width:100},
                                            {field:'FAS_NAMA',title:'FAS_NAMA',width:100},
                                            {field:'FAS_LOKASI',title:'FAS LOKASI',width:100},
                                        ]],
                                        fitColumns: true,
                                        label: 'FAS ID:',
                                        labelPosition: 'top',
                                        required:true,
                                    ">
                                </select>
                        </div>

                        <div style="margin-bottom:5px">
                                <select class="easyui-combogrid" name="JAD_ID" style="width:100%" data-options="
                                        panelWidth: 500,
                                        idField: 'JAD_ID',
                                        textField: 'JAD_FAS_NAMA',
                                        url: 'Jadwal/getJadwalAll',
                                        method: 'get',
                                        columns: [[
                                            {field:'JAD_ID',title:'JAD ID',width:100},
                                            {field:'JAD_FAS_NAMA',title:'JAD FAS_NAMA',width:100},
                    
                                        ]],
                                        fitColumns: true,
                                        label: 'JAD ID:',
                                        labelPosition: 'top',
                                        required:true,
                                    ">
                                </select>
                        </div>
        </form>
    </div>
    <div id="dlgKunjunganBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveKunjungan()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgKunjungan').dialog('close'); $('#fmJadwal').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/script_kunjungan_bottom.js') ?>"></script>

</body>
</html>
