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
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_Rekam.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgRekam" toolbar="#toolbarRekam" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Rekam/getRekam') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="RMD_ID" width="80">RMD ID</th>
                    <th field="PAS_NO_REG" width="80">PAS NO REG</th>
                    <th field="RMD_PAS_NAMA" width="80">NAMA AWAL</th>
                    <th field="RMD_GOL_DARAH" width="100">GOL DARAH</th>
                    
                </tr>
            </thead>
        </table>
        <div id="toolbarRekam">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newRekam()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editRekam()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyRekam()">Destroy</a>
            <input  id="searchrekam" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchRekam,
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

    <div id="dlgRekam" class="easyui-dialog" style="width: 380px; height: 500px; padding: 10px;" modal="true" closed="true" buttons="#dlgRekamBtn">
        <form id="fmRekam" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div style="margin-bottom:5px">
                    <select id="PAS_NO_REG" class="easyui-combogrid" name="PAS_NO_REG" style="width:100%" data-options="
                                        panelWidth: 500,
                                        idField: 'PAS_NO_REG',
                                        textField: 'PAS_NO_REG',
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
                                        onSelect:function(){
                                            var g = $('#PAS_NO_REG').combogrid('grid');	// get datagrid object
                                            var r = g.datagrid('getSelected');	// get the selected row
                                            $('#RMD_PAS_NAMA').textbox('setValue',r.PAS_NAMA_AWAL)
                                        }
                                    ">
                    </select>
            </div>
            <div style="margin-bottom:5px">
                <input id="RMD_PAS_NAMA" class="easyui-textbox" name="RMD_PAS_NAMA"  label="PAS NAMA:" required labelPosition="top" style="width:100%;">     
            </div>
            <div style="margin-bottom:5px">
                <input id="RMD_GOL_DARAH" class="easyui-textbox" name="RMD_GOL_DARAH"  label="GOL DARAH:" required labelPosition="top" style="width:100%;">     
            </div>
            </div>
        </form>
    </div>
    <div id="dlgRekamBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveRekam()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRekam').dialog('close'); $('#fmProduct').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

</body>
</html>
