var ttl;

// products
function doSearchPasien(){
	$('#dgPasien').datagrid('load',{
		search_pasien: $('#searchPasien').val()
	});
}

function newPasien() {
	$('#dlgPasien').dialog('open').dialog('setTitle','Add Pasiens');
	$('#fmPasien').form('clear');
	url = 'Pasien/savePasien';
	ttl = "new";
}

function editPasien() {
	var row = $('#dgPasien').datagrid('getSelected');
	if (row){
		$('#dlgPasien').dialog('open').dialog('setTitle','Edit');
		$('#fmPasien').form('load',row);
		url = 'Pasien/updatePasien/'+row.PAS_NO_REG;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function savePasien() {
	$('#fmPasien').form('submit',{
		url: url,
		onSubmit: function(){
			return $(this).form('validate');
		},
		success: function(result){
			console.log('result',result)
			var result = eval('(' + result + ')');
			
			if (result.errorMsg){
				$.messager.show({
					title: 'Error',
					msg: result.errorMsg
				});
			}else if (result.success){
                $('#dlgPasien').dialog('close');		// close the dialog
				$('#dgPasien').datagrid('reload');	// reload the user data
                $('#fmPasien').form('clear');
                var opts = $('#dgPasien').datagrid('getColumnFields', true);
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

function destroyPasien() {
	var row = $('#dgPasien').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Pasien..? All data under this Pasien will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Pasien/destroyPasien',{PAS_NO_REG:row.PAS_NO_REG},function(result){
                    console.log(result)
					if (result.success){
						$('#dgPasien').datagrid('reload');	// reload the Vendor data
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