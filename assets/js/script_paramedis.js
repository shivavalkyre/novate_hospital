var ttl;


// products
function doSearchParamedis(){
	$('#dgParamedis').datagrid('load',{
		search_paramedis: $('#searchParamedis').val()
	});
}

function newParamedis() {
	$('#dlgParamedis').dialog('open').dialog('setTitle','Add Paramedis');
	$('#fmParamedis').form('clear');
	url = 'Paramedis/saveParamedis';
	ttl = "new";
}

function editParamedis() {
	var row = $('#dgParamedis').datagrid('getSelected');
	if (row){
		$('#dlgParamedis').dialog('open').dialog('setTitle','Edit');
		$('#fmParamedis').form('load',row);
		url = 'Paramedis/updateParamedis/'+row.PAM_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveParamedis() {
	$('#fmParamedis').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
            console.log(result)
			var result = eval('(' + result + ')');
			if (result.errorMsg){
				$.messager.show({
					title: 'Error',
					msg: result.errorMsg
				});
			}else if (result.success){
                $('#dlgParamedis').dialog('close');		// close the dialog
				$('#dgParamedis').datagrid('reload');	// reload the user data
                $('#fmParamedis').form('clear');
                var opts = $('#dgParamedis').datagrid('getColumnFields', true);
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

function destroyParamedis() {
	var row = $('#dgParamedis').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Paramedis..? All data under this Paramedis will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Paramedis/destroyParamedis',{PAM_ID:row.PAM_ID},function(result){
                    console.log(result)
					if (result.success){
						$('#dgParamedis').datagrid('reload');	// reload the Vendor data
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

