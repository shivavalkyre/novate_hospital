var ttl;

// Users
function doSearchUser(){
	$('#dgUsers').datagrid('load',{
		search_user: $('#searchUser').val()
	});
}

function newUser() {
	$('#dlgUser').dialog('open').dialog('setTitle','Add Users');
	$('#fmUser').form('clear');
	url = 'User/saveUser';
	ttl = "new";
}

function editUser() {
	var row = $('#dgUsers').datagrid('getSelected');
	if (row){
		$('#dlgUser').dialog('open').dialog('setTitle','Edit');
		$('#fmUser').form('load',row);
		url = 'User/updateUser/'+row.id;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','User not selected!');
	}
}

function saveUser() {
	$('#fmUser').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			var result = eval('(' + result + ')');
			if (result.errorMsg){
				$.messager.show({
					title: 'Error',
					msg: result.errorMsg
				});
			}else if (result.success){
                $('#dlgUser').dialog('close');		// close the dialog
				$('#dgUsers').datagrid('reload');	// reload the user data
                $('#fmUser').form('clear');
                var opts = $('#dgUsers').datagrid('getColumnFields', true);
                var msg = ttl == "updt" ? "Update data success" : "New data added successfully";
                var title = ttl == "updt" ? "Data Update" : "New data";
                $.messager.alert({
                    title: title,
                    msg: msg,
                    fadeOut: 'slow',
                    showType:'fade',
                });
            }else {
				 $.messager.alert({
                        title: 'Error',
                        msg: "Encourage Error!"
                    });
			}
		}
	});
}

function destroyUser() {
	var row = $('#dgUsers').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this User..? All data under this User will be disappear',function(r){
			if (r){
				$.post('User/destroyUser',{id:row.id},function(result){
					if (result.success){
						$('#dgUsers').datagrid('reload');	// reload the Vendor data
					} else {
						$.messager.show({	// show error message
							title: 'Error',
							msg: result.errorMsg
						});
					}
				},'json');
			}
		});
	}
}

function openfile(val,row){
    //alert(row.id_access_card);
    return '<button class="btn" onClick="changePassword()"><div title="Change Password." class="easyui-tooltip" style="margin-top:-3px;"><img src="assets/images/key_password.png" width="20"  height="20" /></div></button>';
}

function changePassword(){
	$('#dlgUserPassword').dialog('open').dialog('setTitle','Change Password');
}

function updatePassword(){
	// alert('Update Password')
	var row = $('#dgUsers').datagrid('getSelected');
	var id = row.id;
	var password  = $('#change_password').val();
	var url =  'User/updatePassword';
	var string = "id="+ id +"&password="+password;
	$.ajax({
		url:url,
		method:'post',
        cache:false,
        data:string,
        success: function(data)
            {
                // alert(data);
				$('#dgUsers').datagrid('reload');
				$('#fmUserPassword').form('clear');
				$('#dlgUserPassword').dialog('close')
               
            },
        error: function(error)
            {
                alert(error);
            }
	})
}