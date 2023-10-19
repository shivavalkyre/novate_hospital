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
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_paramedis.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgParamedis" toolbar="#toolbarParamedis" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Paramedis/getparamedis') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="PAM_ID" width="80">PAM ID</th>
                    <th field="PAM_NAMA" width="80">PAM NAMA</th>
                    <th field="PAM_KATEGORI" width="100">PAM KATEGORI</th>
                    <th field="PAM_KUALIFIKASI" width="100">PAM KUALIFIKASI</th>
                    <th field="PAM_MULAI_TUGAS" width="100">PAM MULAI TUGAS</th>
                    <th field="PAM_STATUS" width="100">PAM STATUS</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarParamedis">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newParamedis()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editParamedis()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyParamedis()">Destroy</a>
            <input  id="searchParamedis" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchParamedis,
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

    <div id="dlgParamedis" class="easyui-dialog" style="width: 380px; height: 450px; padding: 10px;" modal="true" closed="true" buttons="#dlgParamedisBtn">
        <form id="fmParamedis" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div style="margin-bottom:5px">
                <input class="easyui-textbox" name="PAM_NAMA" labelPosition="top" style="width:100%" data-options="label:'Nama:',required:true">
            </div>
            <div style="margin-bottom:5px">
                <input class="easyui-textbox" name="PAM_KATEGORI" labelPosition="top" style="width:100%" data-options="label:'Kategori:',required:true">
            </div>
            <div style="margin-bottom:5px">
                <input class="easyui-textbox" name="PAM_KUALIFIKASI" labelPosition="top" style="width:100%" data-options="label:'Kualifikasi:',required:true">
            </div>
            <div style="margin-bottom:5px">
                <input id="dt" class="easyui-datetimebox" name="PAM_MULAI_TUGAS" labelPosition="top" style="width:100%" data-options="label:'Mulai Tugas:',required:true,formatter:mydtformatter,parser:mydtparser,
                onSelect: function(value)
                              {
                                var c = $('#dt').datetimebox('calendar');
                                var t = $('#dt').datetimebox('spinner');

                              	var day = c.calendar('options').current;

                                var time = t.timespinner('getValue');
                                var y = day.getFullYear();
                                var m = day.getMonth()+1;
                                var d = day.getDate();
                                var myday = String(y)+'-'+String(m<10?('0'+m):m)+'-'+String(d<10?('0'+d):d);
                               
                                var mydate = strip( myday + ' ' + time + ':00' );

                                $('#dt').datetimebox('setValue', mydate);
                                $('#dt').datetimebox('hidePanel');
                            	}
                ">
            </div>
            <div style="margin-bottom:5px">
                <input class="easyui-textbox" name="PAM_STATUS" labelPosition="top" style="width:100%" data-options="label:'Status:',required:true">
            </div>
            
            </div>
        </form>
    </div>
    <div id="dlgParamedisBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveParamedis()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgParamedis').dialog('close'); $('#fmProduct').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/script_paramedis_bottom.js') ?>"></script>

</body>
</html>
