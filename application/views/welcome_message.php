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
    <script type="text/javascript" src="<?php echo base_url('assets/js/script_customer.js') ?>"></script>
</head>
<body>

<div id="container" class="easyui-layout" fit="true">
    <div region="center">
        <table id="dgCustomers" toolbar="#toolbarCustomer" class="easyui-datagrid" fit="true" singleSelect="true" fitColumns="true" rowNumbers="false" pagination="true" url="<?= site_url('Welcome/getcustomers') ?>" pageSize="50" pageList="[25,50,75,100,125,150,200]" nowrap="false">
            <thead>
                <tr>
                    <th field="customerNumber" width="80">Customer Number</th>
                    <th field="customerName" width="100">Name</th>
                    <th field="contactFirstName" width="100">Contact First Name</th>
                    <th field="contactLastName" width="100">Contact Last Name</th>
                    <th field="phone" width="50">Phone</th>
                    <th field="addressLine1" width="100">First Address</th>
                    <th field="addressLine2" width="100">Second Address</th>
                    <th field="city" width="50">City</th>
                    <th field="state" width="50">State</th>
                    <th field="postalCode" width="50">Postal Code</th>
                    <th field="country" width="50">Country</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarCustomer">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newCustomer()">New</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editCustomer()">Edit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="destroyCustomer()">Destroy</a>
            <input  id="searchCustomer" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearchCustomer,
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

    <div id="dlgCustomer" class="easyui-dialog" style="width: 780px; height: auto; padding: 10px;" modal="true" closed="true" buttons="#dlgCustomerBtn">
        <form id="fmCustomer" method="post">
            <div class="col-sm-12 justify-content-sm-center">
                <div class="row" style="width: 100%">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Customer Name</label>
                            <input type="text" name="customerName" class="easyui-textbox" style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Contact First Name</label>
                            <input type="text" name="contactFirstName" class="easyui-textbox" style="width: 100%;"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Contract Last Name</label>
                            <input type="text" name="contactLastName" class="easyui-textbox" style="width: 100%;"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="easyui-textbox" style="width: 100%;"></div>
                    </div>
                </div>
                <div class="row" style="width: 100%">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">First Address Line</label>
                            <input type="text" name="addressLine1" multiline="true" class="easyui-textbox" style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Second Address Line</label>
                            <input type="text" name="addressLine2" multiline="true" class="easyui-textbox" style="width: 100%;"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" name="city" class="easyui-textbox" style="width: 100%;"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">State</label>
                            <input type="text" name="state" class="easyui-textbox" style="width: 100%;"></div>
                    </div>
                </div>
                <div class="row" style="width: 100%">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Postal Code</label>
                            <input type="text" name="postalCode" class="easyui-textbox" style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" name="country" class="easyui-textbox" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="dlgCustomerBtn">
        <a href="javascript:void(0)" id="btn_save" class="easyui-linkbutton" iconCls="icon-ok-a" onclick="saveCustomer()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-del-a" onclick="javascript:$('#dlgCustomer').dialog('close'); $('#fmEmployee').form(clear)
        " style="width:90px">Cancel</a>
    </div>
</div>

</body>
</html>
