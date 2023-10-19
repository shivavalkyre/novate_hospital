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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_user.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgUsers" toolbar="#toolbarUser" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('User/getUsers') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="id" width="80">ID</th>
                    <th field="username" width="100">Username</th>
                    <th field="password" width="100">Password</th>
                    <th field="level" width="100">Level</th>
                    <th align="center" data-options="field:'openfile',formatter:openfile">Action</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarUser">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newUser()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editUser()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyUser()">Destroy</a>
            <input  id="searchUser" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchUser,
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

    <div id="dlgUser" class="easyui-dialog" style="width: 380px; height: auto; padding: 10px;" modal="true" closed="true" buttons="#dlgUserBtn">
        <form id="fmUser" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="username" labelPosition="top" style="width:100%" data-options="label:'Username:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="password" labelPosition="top" style="width:100%" data-options="label:'Password:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="level" labelPosition="top" style="width:100%" data-options="label:'Level:',required:true">
            </div>
            </div>
        </form>
    </div>
    <div id="dlgUserBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUser').dialog('close'); $('#fmUser').form(clear)
        " style="width:90px">Cancel</a>
    </div>

    <div id="dlgUserPassword" class="easyui-dialog" style="width: 380px; height: auto; padding: 10px;" modal="true" closed="true" buttons="#dlgUserPasswordBtn">
        <form id="fmUserPassword" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div style="margin-bottom:10px">
                <input id="change_password" class="easyui-textbox"  labelPosition="top" style="width:100%" data-options="label:'Password:',required:true">
            </div>
            </div>
        </form>
    </div>
    <div id="dlgUserPasswordBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="updatePassword()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUserPassword').dialog('close');
        " style="width:90px">Cancel</a>
    </div>
</div>

</body>
</html>
