<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PT. Kumara Wardhana</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/metro-blue/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/easyui/themes/icon.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/general.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/user.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.mobile.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_pelayanan.js') ?>"></script>
</head>
<body>
<div id="IDX" hidden><?php echo $this->session->userdata("nama"); ?></div>
<div class="easyui-navpanel" style="background-color:white;">
        <div id="container" class="easyui-layout" fit="true" style="background:transparent;">
            <div region="center" style="background:transparent">
                <table id="dgPelayanan" toolbar="#toolbarPelayanan" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Pelayanan/getPelayanan') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
                    <thead>
                        <tr>
                            <th field="LYN_ID" width="80">LYN ID</th>
                            <th field="LYN_TANGGAL" width="80">LYN TANGGAL</th>
                            <th field="KUN_NO_ANTRI" width="100">KUN NO ANTRI</th>
                            <th field="RMD_ID" width="100">RMD ID</th>
                            <th field="KUN_TGL" width="100">KUN TGL</th>
                            <th field="RMD_PAS_NAMA" width="100">RMD PAS NAMA</th>
                            <th field="RMD_GOL_DARAH" width="100">RMD GOL DARAH</th>
                            <th align="center" width="40" data-options="field:'openfile',formatter:openfile">Action</th>
                        </tr>
                    </thead>
                </table>
                <div id="toolbarPelayanan">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newPelayanan()">New</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editPelayanan()">Edit</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyPelayanan()">Destroy</a>
                    <input  id="searchPelayanan" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchPelayanan,
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

            <div id="dlgPelayanan" class="easyui-dialog" style="width: 380px; height: 500px; padding: 10px;" modal="true" closed="true" buttons="#dlgPelayananBtn">
                <form id="fmPelayanan" method="post">
                    <div class="col-sm-12 justify-content-sm-center">
                                <div style="margin-bottom:5px">
                                    <input id="dt1" class="easyui-datetimebox" name="LYN_TANGGAL" labelPosition="top" style="width:100%" data-options="label:'KUN TGL:',required:true,formatter:mydtformatter,parser:mydtparser,
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
                                    <select id="KUN_NO_ANTRI" class="easyui-combogrid" name="KUN_NO_ANTRI" style="width:100%" data-options="
                                                        panelWidth: 500,
                                                        idField: 'KUN_NO_ANTRI',
                                                        textField: 'KUN_NO_ANTRI',
                                                        url: 'Kunjungan/getKunjunganAll',
                                                        method: 'get',
                                                        columns: [[
                                                            {field:'KUN_NO_ANTRI',title:'KUN_NO_ANTRI',width:100},
                                                        ]],
                                                        fitColumns: true,
                                                        label: 'PAS NO REG:',
                                                        labelPosition: 'top',
                                                        required:true,
                                                    
                                                    ">
                                    </select>
                                </div> 
                                
                                <div style="margin-bottom:5px">
                                    <select id="RMD_ID" class="easyui-combogrid" name="RMD_ID" style="width:100%" data-options="
                                                        panelWidth: 500,
                                                        idField: 'RMD_ID',
                                                        textField: 'RMD_ID',
                                                        url: 'Rekam/getRekamAll',
                                                        method: 'get',
                                                        columns: [[
                                                            {field:'RMD_ID',title:'RMD_ID',width:100},
                                                            {field:'RMD_PAS_NAMA',title:'RMD_PAS_NAMA',width:100},
                                                            {field:'RMD_GOL_DARAH',title:'RMD_GOL_DARAH',width:100},
                                                        ]],
                                                        fitColumns: true,
                                                        label: 'RMD ID:',
                                                        labelPosition: 'top',
                                                        required:true,
                                                    
                                                    ">
                                    </select>
                                </div>        
                    </div>

                </form>
            </div>
            <div id="dlgPelayananBtn">
                <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="savePelayanan()" style="width:90px">Save</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgPelayanan').dialog('close'); $('#fmProduct').form(clear)
                " style="width:90px">Cancel</a>
            </div>
        </div>
</div>

<div id="p2" class="easyui-navpanel" style="background-color:white;">
        <header>
            <div class="m-toolbar">
                <!-- <div class="m-title">Panel2</div> -->
                <div class="m-left">
                    <a href="#" class="easyui-linkbutton m-back" data-options="plain:true,outline:true,back:true">Back</a>
                </div>
            </div>
        </header>
        <div class="easyui-tabs" data-options="narrow:true" style="width:100%;height:500px">
            <div title="Keluhan" style="padding:10px">
                <table id="dgKeluhan" toolbar="#toolbarKeluhan" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true"  pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
                        <thead>
                            <tr>
                                <th field="KEL_ID" width="80">KEL ID</th>
                                <th field="KEL_TYPE" width="80">KEL TYPE</th>
                                <th field="KEL_KETERANGAN" width="100" hidden>KEL KETERANGAN</th>
                                <th field="LYN_ID" width="100" >LYN ID</th>
                                <th field="USER_ID" width="100" >USER ID</th>
                                <th field="NAMA_USER" width="100">NAMA USER</th>
                                <th field="PAM_ID" width="100">PAM_ID</th>
                                <th field="PAM_NAMA" width="100">PAM_NAMA</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="toolbarKeluhan">
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newKeluhan()">New</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editKeluhan()">Edit</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyKeluhan()">Destroy</a>
                        <input  id="searchkeluhan" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchKeluhan,
                        inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                            keyup: function(e){
                                var t = $(e.data.target);
                                var opts = t.searchbox('options');
                                t.searchbox('setValue', $(this).val());
                                opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                            }
                        })" style="width:50%;"></input>
                    </div>
                    <div id="dlgKeluhan" class="easyui-dialog" style="width: 380px; height: 500px; padding: 10px;" modal="true" closed="true" buttons="#dlgKeluhanBtn">
                        <form id="fmKeluhan" method="post">
                            <div class="col-sm-12 justify-content-sm-center">
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="KEL_TYPE" label="KEL TYPE:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="KEL_KETERANGAN" label="KEL KETERANGAN:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input id="LYN_ID" class="easyui-textbox" name="LYN_ID" label="LYN ID:" labelPosition="top"  data-options="editable:false" style="width:100%;">
                            </div>   
                            <div style="margin-bottom:5px">
                                <input id="USER_ID" class="easyui-textbox" name="USER_ID" label="USER ID:" labelPosition="top" value="<?php echo $this->session->userdata("nama"); ?>" data-options="editable:false" style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input id="NAMA_USER" class="easyui-textbox" name="NAMA_USER" label="NAMA USER:" labelPosition="top" value="<?php echo $this->session->userdata("nama"); ?>" data-options="editable:false" style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <select id="PAM_ID" class="easyui-combogrid" name="PAM_ID" style="width:100%" data-options="
                                            panelWidth: 500,
                                            idField: 'PAM_ID',
                                            textField: 'PAM_NAMA',
                                            url: 'Paramedis/getParamedisAll',
                                            method: 'get',
                                            columns: [[
                                                {field:'PAM_ID',title:'PAM_ID',width:100},
                                                {field:'PAM_NAMA',title:'PAS_NAMA',width:100},
                                                {field:'PAM_KATEGORI',title:'PAM KATEGORI',width:100},
                                            ]],
                                            fitColumns: true,
                                            label: 'PAM ID:',
                                            labelPosition: 'top',
                                            required:true,
                     
                                        ">
                                    </select>
                            </div>
                            </div>

                        </form>
                    </div>
                    <div id="dlgKeluhanBtn">
                        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveKeluhan()" style="width:90px">Save</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgKeluhan').dialog('close'); $('#fmProduct').form(clear)
                        " style="width:90px">Cancel</a>
                    </div>
            </div>
            <div title="Diagnosis" style="padding:10px">
            <table id="dgDiagnosis" toolbar="#toolbarDiagnosis" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true"  pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
                                <thead>
                                    <tr>
                                        <th field="DIA_ID" width="80">DIA ID</th>
                                        <th field="DIA_TYPE" width="80">DIA TYPE</th>
                                        <th field="DIA_KETERANGAN" width="100">DIA KETERANGAN</th>
                                        <th field="LYN_ID" width="100" >LYN ID</th>
                                        <th field="USER_ID" width="100" >USER ID</th>
                                        <th field="NAMA_USER" width="100">NAMA USER</th>
                                        <th field="PAM_ID" width="100">PAM_ID</th>
                                        <th field="PAM_NAMA" width="100">PAM_NAMA</th>
                                    </tr>
                                </thead>
                    </table>
                    <div id="toolbarDiagnosis">
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newDiagnosis()">New</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editDiagnosis()">Edit</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyDiagnosis()">Destroy</a>
                        <input  id="search_diagnosis" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchDiagnosis,
                        inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                            keyup: function(e){
                                var t = $(e.data.target);
                                var opts = t.searchbox('options');
                                t.searchbox('setValue', $(this).val());
                                opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                            }
                        })" style="width:50%;"></input>
                    </div>
                    <div id="dlgDiagnosis" class="easyui-dialog" style="width: 380px; height: 500px; padding: 10px;" modal="true" closed="true" buttons="#dlgDiagnosisBtn">
                        <form id="fmDiagnosis" method="post">
                            <div class="col-sm-12 justify-content-sm-center">
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="DIA_TYPE" label="DIA TYPE:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="DIA_KETERANGAN" label="DIA KETERANGAN:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input id="DIA_LYN_ID" class="easyui-textbox" name="LYN_ID" label="LYN ID:" labelPosition="top"  data-options="editable:false" style="width:100%;">
                            </div>   
                            <div style="margin-bottom:5px">
                                <input id="DIA_USER_ID" class="easyui-textbox" name="USER_ID" label="USER ID:" labelPosition="top" value="<?php echo $this->session->userdata("nama"); ?>" data-options="editable:false" style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input id="DIA_NAMA_USER" class="easyui-textbox" name="NAMA_USER" label="NAMA USER:" labelPosition="top" value="<?php echo $this->session->userdata("nama"); ?>" data-options="editable:false" style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <select id="DIA_PAM_ID" class="easyui-combogrid" name="PAM_ID" style="width:100%" data-options="
                                            panelWidth: 500,
                                            idField: 'PAM_ID',
                                            textField: 'PAM_NAMA',
                                            url: 'Paramedis/getParamedisAll',
                                            method: 'get',
                                            columns: [[
                                                {field:'PAM_ID',title:'PAM_ID',width:100},
                                                {field:'PAM_NAMA',title:'PAS_NAMA',width:100},
                                                {field:'PAM_KATEGORI',title:'PAM KATEGORI',width:100},
                                            ]],
                                            fitColumns: true,
                                            label: 'PAM ID:',
                                            labelPosition: 'top',
                                            required:true,
                     
                                        ">
                                    </select>
                            </div>
                            </div>

                        </form>
                    </div>
                    <div id="dlgDiagnosisBtn">
                        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveDiagnosis()" style="width:90px">Save</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDiagnosis').dialog('close'); $('#fmProduct').form(clear)
                        " style="width:90px">Cancel</a>
                    </div>
            </div>
            <div title="Tindakan" style="padding:10px">

            <table id="dgTindakan" toolbar="#toolbarTindakan" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true"  pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
                                <thead>
                                    <tr>
                                        <th field="TIN_ID" width="80">TIN ID</th>
                                        <th field="TIN_TYPE" width="80">TIN TYPE</th>
                                        <th field="TIN_KETERANGAN" width="100" >TIN KETERANGAN</th>
                                        <th field="LYN_ID" width="100" >LYN ID</th>
                                        <th field="PAM_ID" width="100">PAM_ID</th>
                                        <th field="PAM_NAMA" width="100">PAM_NAMA</th>
                                    </tr>
                                </thead>
                    </table>
                    <div id="toolbarTindakan">
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newTindakan()">New</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editTindakan()">Edit</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyTindakan()">Destroy</a>
                        <input  id="search_tindakan" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchTindakan,
                        inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                            keyup: function(e){
                                var t = $(e.data.target);
                                var opts = t.searchbox('options');
                                t.searchbox('setValue', $(this).val());
                                opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                            }
                        })" style="width:50%;"></input>
                    </div>
                    <div id="dlgTindakan" class="easyui-dialog" style="width: 380px; height: 500px; padding: 10px;" modal="true" closed="true" buttons="#dlgTindakanBtn">
                        <form id="fmTindakan" method="post">
                            <div class="col-sm-12 justify-content-sm-center">
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="TIN_TYPE" label="TIN TYPE:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="TIN_KETERANGAN" label="TIN KETERANGAN:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input id="TIN_LYN_ID" class="easyui-textbox" name="LYN_ID" label="LYN ID:" labelPosition="top"  data-options="editable:false" style="width:100%;">
                            </div>   
                            
                            <div style="margin-bottom:5px">
                                <select id="TIN_PAM_ID" class="easyui-combogrid" name="PAM_ID" style="width:100%" data-options="
                                            panelWidth: 500,
                                            idField: 'PAM_ID',
                                            textField: 'PAM_NAMA',
                                            url: 'Paramedis/getParamedisAll',
                                            method: 'get',
                                            columns: [[
                                                {field:'PAM_ID',title:'PAM_ID',width:100},
                                                {field:'PAM_NAMA',title:'PAS_NAMA',width:100},
                                                {field:'PAM_KATEGORI',title:'PAM KATEGORI',width:100},
                                            ]],
                                            fitColumns: true,
                                            label: 'PAM ID:',
                                            labelPosition: 'top',
                                            required:true,
                     
                                        ">
                                    </select>
                            </div>
                            </div>

                        </form>
                    </div>
                    <div id="dlgTindakanBtn">
                        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveTindakan()" style="width:90px">Save</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgTindakan').dialog('close'); $('#fmProduct').form(clear)
                        " style="width:90px">Cancel</a>
                    </div>

            </div>
            <div title="Resep" style="padding:10px">
            <table id="dgResep" toolbar="#toolbarResep" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true"  pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
                                <thead>
                                    <tr>
                                        <th field="RES_NO" width="80">RES_NO</th>
                                        <th field="RES_OBAT" width="80">RES OBAT</th>
                                        <th field="RES_ATURAN_PAKAI" width="100" >ATURAN PAKAI</th>
                                        <th field="RES_DOSIS" width="100" >DOSIS</th>
                                        <th field="RES_SATUAN" width="100" >SATUAN</th>
                                        <th field="LYN_ID" width="100" >LYN ID</th>
                                        <th field="PAM_ID" width="100">PAM_ID</th>
                                        <th field="PAM_NAMA" width="100">PAM_NAMA</th>
                                    </tr>
                                </thead>
                    </table>
                    <div id="toolbarResep">
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newResep()">New</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editResep()">Edit</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyResep()">Destroy</a>
                        <input  id="search_resep" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchResep,
                        inputEvents: $.extend({}, $.fn.searchbox.defaults.inputEvents, {
                            keyup: function(e){
                                var t = $(e.data.target);
                                var opts = t.searchbox('options');
                                t.searchbox('setValue', $(this).val());
                                opts.searcher.call(t[0],t.searchbox('getValue'),t.searchbox('getName'));
                            }
                        })" style="width:50%;"></input>
                    </div>
                    <div id="dlgResep" class="easyui-dialog" style="width: 380px; height: 500px; padding: 10px;" modal="true" closed="true" buttons="#dlgResepBtn">
                        <form id="fmResep" method="post">
                            <div class="col-sm-12 justify-content-sm-center">
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="RES_OBAT" label="RES OBAT:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="RES_ATURAN_PAKAI" label="ATURAN PAKAI:" labelPosition="top" required style="width:100%;">
                            </div>  
							<div style="margin-bottom:5px">
                                <input class="easyui-textbox" name="RES_DOSIS" label="DOSIS:" labelPosition="top"  required style="width:100%;">
                            </div>  
							<div style="margin-bottom:5px">
                                <input  class="easyui-textbox" name="RES_SATUAN" label="SATUAN:" labelPosition="top" required style="width:100%;">
                            </div>  
                            <div style="margin-bottom:5px">
                                <input id="RES_LYN_ID" class="easyui-textbox" name="LYN_ID" label="LYN ID:" labelPosition="top"  data-options="editable:false" style="width:100%;">
                            </div>   
      
                            <div style="margin-bottom:5px">
                                <select id="RES_PAM_ID" class="easyui-combogrid" name="PAM_ID" style="width:100%" data-options="
                                            panelWidth: 500,
                                            idField: 'PAM_ID',
                                            textField: 'PAM_NAMA',
                                            url: 'Paramedis/getParamedisAll',
                                            method: 'get',
                                            columns: [[
                                                {field:'PAM_ID',title:'PAM_ID',width:100},
                                                {field:'PAM_NAMA',title:'PAS_NAMA',width:100},
                                                {field:'PAM_KATEGORI',title:'PAM KATEGORI',width:100},
                                            ]],
                                            fitColumns: true,
                                            label: 'PAM ID:',
                                            labelPosition: 'top',
                                            required:true,
                     
                                        ">
                                    </select>
                            </div>
                            </div>

                        </form>
                    </div>
                    <div id="dlgResepBtn">
                        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveResep()" style="width:90px">Save</a>
                        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgResep').dialog('close'); $('#fmProduct').form(clear)
                        " style="width:90px">Cancel</a>
                    </div>


            </div>
        </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/script_pelayanan_bottom.js') ?>"></script>

</body>
</html>
