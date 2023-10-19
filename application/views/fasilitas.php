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
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_fasilitas.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgFasilitas" toolbar="#toolbarFasilitas" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Fasilitas/getFasilitas') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="FAS_ID" width="80">FAS ID</th>
                    <th field="FAS_NAMA" width="100">FAS NAMA</th>
                    <th field="FAS_LOKASI" width="100">FAS LOKASI</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarFasilitas">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newFasilitas()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editFasilitas()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyFasilitas()">Destroy</a>
            <input  id="searchFasilitas" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchFasilitas,
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

    <div id="dlgFasilitas" class="easyui-dialog" style="width: 380px; height: auto; padding: 10px;" modal="true" closed="true" buttons="#dlgFasilitasBtn">
        <form id="fmFasilitas" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="FAS_NAMA" labelPosition="top" style="width:100%" data-options="label:'FAS NAMA:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="FAS_LOKASI" labelPosition="top" style="width:100%" data-options="label:'FAS LOKASI:',required:true">
            </div>

            </div>
        </form>
    </div>
    <div id="dlgFasilitasBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveFasilitas()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgFasilitas').dialog('close'); $('#fmProduct').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

</body>
</html>
