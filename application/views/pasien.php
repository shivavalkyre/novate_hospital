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
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_pasien.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgPasien" toolbar="#toolbarPasien" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Pasien/getpasien') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="PAS_NO_REG" width="80">PAS NO REG</th>
                    <th field="PAS_NAMA_AWAL" width="80">NAMA AWAL</th>
                    <th field="PAS_NAMA_AKHIR" width="100">NAMA AKHIR</th>
                    <th field="PAS_ALAMAT1" width="100">ALAMAT1</th>
                    <th field="PAS_ALAMAT2" width="100">ALAMAT2</th>
                    <th field="PAS_KOTA" width="100">PAS KOTA</th>
                    <th field="PAS_PROVINSI" width="100">PAS PROVINSI</th>
                    <th field="PAS_NEGARA" width="100">PAS NEGARA</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarPasien">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newPasien()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editPasien()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyPasien()">Destroy</a>
            <input  id="searchPasien" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchPasien,
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

    <div id="dlgPasien" class="easyui-dialog" style="width: 380px; height: 500px; padding: 10px;" modal="true" closed="true" buttons="#dlgPasienBtn">
        <form id="fmPasien" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="PAS_NAMA_AWAL" labelPosition="top" style="width:100%" data-options="label:'Nama Awal:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="PAS_NAMA_AKHIR" labelPosition="top" style="width:100%" data-options="label:'Nama Akhir:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="PAS_ALAMAT1" labelPosition="top" style="width:100%" data-options="label:'Alamat1:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="PAS_ALAMAT2" labelPosition="top" style="width:100%" data-options="label:'Alamat2:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="PAS_KOTA" labelPosition="top" style="width:100%" data-options="label:'Kota:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="PAS_PROVINSI" labelPosition="top" style="width:100%" data-options="label:'Provinsi:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="PAS_NEGARA" labelPosition="top" style="width:100%" data-options="label:'Negara:',required:true">
            </div>
            </div>
        </form>
    </div>
    <div id="dlgPasienBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="savePasien()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgPasien').dialog('close'); $('#fmProduct').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

</body>
</html>
