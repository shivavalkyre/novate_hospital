var ttl;


// products
function doSearchRekam(){
	$('#dgRekam').datagrid('load',{
		search_rekam: $('#searchrekam').val()
	});
}

function newRekam() {
	$('#dlgRekam').dialog('open').dialog('setTitle','Add Rekam');
    $('#tt').tabs({
        selected:0
    })
	$('#fmRekam').form('clear');
	url = 'Rekam/saveRekam';
	ttl = "new";
}

function editRekam() {
	var row = $('#dgRekam').datagrid('getSelected');
	if (row){
		$('#dlgRekam').dialog('open').dialog('setTitle','Edit');
		$('#fmRekam').form('load',row);
		url = 'Rekam/updateRekam/'+row.RMD_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveRekam() {
	$('#fmRekam').form('submit',{
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
                $('#dlgRekam').dialog('close');		// close the dialog
				$('#dgRekam').datagrid('reload');	// reload the user data
                $('#fmRekam').form('clear');
                var opts = $('#dgRekam').datagrid('getColumnFields', true);
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

function destroyRekam() {
	var row = $('#dgRekam').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Rekam..? All data under this Rekam will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Rekam/destroyRekam',{RMD_ID:row.RMD_ID},function(result){
                    console.log(result)
					if (result.success){
						$('#dgRekam').datagrid('reload');	// reload the Vendor data
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

