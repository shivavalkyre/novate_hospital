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
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_product.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true" style="background:transparent;">
    <div region="center" style="background:transparent">
        <table id="dgProducts" toolbar="#toolbarProduct" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Product/getproducts') ?>" pageSize="10" pageList="[10,25,50,75,100,125,150,200]" nowrap="false" style="background:transparent;">
            <thead>
                <tr>
                    <th field="product_number" width="80">Product Number</th>
                    <th field="product_name" width="100">Product Name</th>
                    <th field="product_description" width="100">Description</th>
                    <th field="product_unit" width="100">Unit</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarProduct">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newProduct()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editProduct()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyProduct()">Destroy</a>
            <input  id="searchProduct" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchProduct,
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

    <div id="dlgProduct" class="easyui-dialog" style="width: 380px; height: auto; padding: 10px;" modal="true" closed="true" buttons="#dlgProductBtn">
        <form id="fmProduct" method="post">
            <div class="col-sm-12 justify-content-sm-center">
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="product_name" labelPosition="top" style="width:100%" data-options="label:'Product Name:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="product_description" labelPosition="top" style="width:100%" data-options="label:'Description:',required:true">
            </div>
            <div style="margin-bottom:10px">
                <input class="easyui-textbox" name="product_unit" labelPosition="top" style="width:100%" data-options="label:'Unit:',required:true">
            </div>
            </div>
        </form>
    </div>
    <div id="dlgProductBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-save" onclick="saveProduct()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgProduct').dialog('close'); $('#fmProduct').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

</body>
</html>
