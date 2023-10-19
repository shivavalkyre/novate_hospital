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
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_jadwal.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgJadwal" toolbar="#toolbarJadwal" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Jadwal/getjadwal') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="JAD_ID" width="120">JAD ID</th>
                    <th field="FAS_ID" width="120">FAS ID</th>
                    <th field="FAS_NAMA" width="100">FAS NAMA</th>
                    <th field="FAS_LOKASI" width="100">FAS_LOKASI</th>
                    <th field="JAD_FAS_NAMA" width="100">JAD_FAS_NAMA</th>
                    <th field="JDT_NAMA" width="100">JDT NAMA</th>
                    <th field="PAM_ID" width="120">PAM ID</th>
                    <th field="PAM_NAMA" width="100">PAM NAMA</th>
                    <th field="PAM_KATEGORI" width="100">PAM_KATEGORI</th>
                    <th field="JAD_JAM_MULAI" width="100">MULAI</th>
                    <th field="JAD_JAM_SELESAI" width="100">SELESAI</th>
                </tr>
            </thead>
        </table>

        <div id="toolbarJadwal">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newJadwal()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editJadwal()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyJadwal()">Destroy</a>
            <input  id="searchJadwal" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchJadwal,
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

    <div id="dlgJadwal" class="easyui-dialog" style="width: 380px; height: 450px; padding: 10px;" modal="true" closed="true" buttons="#dlgJadwalBtn">
        <form id="fmJadwal" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div id="tt" class="easyui-tabs" style="width:100%;height:345px;">
                <div title="Jadwal" style="padding:10px">
                        <div style="margin-bottom:5px">
                            <select class="easyui-combogrid" name="FAS_ID" style="width:100%" data-options="
                                    panelWidth: 500,
                                    idField: 'FAS_ID',
                                    textField: 'FAS_NAMA',
                                    url: 'Fasilitas/getFasilitasAll',
                                    method: 'get',
                                    columns: [[
                                        {field:'FAS_ID',title:'FAS_ID',width:80},
                                        {field:'FAS_NAMA',title:'FAS_NAMA',width:120},
                                        {field:'FAS_LOKASI',title:'FAS_LOKASI',width:80,align:'right'},
                                    ]],
                                    fitColumns: true,
                                    label: 'FAS ID:',
                                    required:true,
                                    labelPosition: 'top'
                                ">
                            </select>
                        </div>
                        <div style="margin-bottom:5px">
                            <input class="easyui-textbox" label="JAD FAS NAMA:" name="JAD_FAS_NAMA" labelPosition="top" data-options="required:true" style="width:100%;">
                        </div>
                        <div style="margin-bottom:5px">
                        <input id="dt1" class="easyui-datetimebox" name="JAD_JAM_MULAI" labelPosition="top" style="width:100%" data-options="label:'Mulai Tugas:',required:true,formatter:mydtformatter,parser:mydtparser,
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
                        <div>
                        <input id="dt2" class="easyui-datetimebox" name="JAD_JAM_SELESAI" labelPosition="top" style="width:100%" data-options="label:'Mulai Tugas:',required:true,formatter:mydtformatter,parser:mydtparser,
                                onSelect: function(value)
                                            {
                                                var c = $('#dt2').datetimebox('calendar');
                                                var t = $('#dt2').datetimebox('spinner');

                                                var day = c.calendar('options').current;

                                                var time = t.timespinner('getValue');
                                                var y = day.getFullYear();
                                                var m = day.getMonth()+1;
                                                var d = day.getDate();
                                                var myday = String(y)+'-'+String(m<10?('0'+m):m)+'-'+String(d<10?('0'+d):d);
                                            
                                                var mydate = strip( myday + ' ' + time + ':00' );

                                                $('#dt2').datetimebox('setValue', mydate);
                                                $('#dt2').datetimebox('hidePanel');
                                                }
                                ">
                        </div>

                        <div>
                             
                        </div>
                        
                </div>
                <div title="Jadwal Detail" style="padding:10px">
                        <div style="margin-bottom:5px">
                            <select class="easyui-combogrid" name="PAM_ID" style="width:100%" data-options="
                                    panelWidth: 500,
                                    idField: 'PAM_ID',
                                    textField: 'PAM_NAMA',
                                    url: 'Paramedis/getParamedisAll',
                                    method: 'get',
                                    columns: [[
                                        {field:'PAM_ID',title:'PAM_ID',width:80},
                                        {field:'PAM_NAMA',title:'PAM_NAMA',width:120},
                                        {field:'PAM_KATEGORI',title:'PAM_KATEGORI',width:80,align:'right'},
                                    ]],
                                    fitColumns: true,
                                    label: 'PAM ID:',
                                    required:true,
                                    labelPosition: 'top'
                                ">
                            </select>
                        </div>  
                        <div style="margin-bottom:5px">
                            <input class="easyui-textbox" label="JDT NAMA:" name="JDT_NAMA" labelPosition="top" data-options="required:true" style="width:100%;">
                        </div>  
                        <div style="margin-bottom:5px">
                            <input class="easyui-textbox" label="JDT STATUS:" name="JDT_STATUS" labelPosition="top" data-options="required:true" style="width:100%;">
                        </div>           
                </div>
            </div>
            
            </div>
        </form>
    </div>
    <div id="dlgJadwalBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveJadwal()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgJadwal').dialog('close'); $('#fmJadwal').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/script_jadwal_bottom.js') ?>"></script>

</body>
</html>
