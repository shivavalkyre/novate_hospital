var ttl;


// products
function doSearchKunjungan(){
	$('#dgKunjungan').datagrid('load',{
		search_kunjungan: $('#searchKunjungan').val()
	});
}

function newKunjungan() {
	$('#dlgKunjungan').dialog('open').dialog('setTitle','Add Kunjungan');
    $('#tt').tabs({
        selected:0
    })
	$('#fmKunjungan').form('clear');
	url = 'Kunjungan/saveKunjungan';
	ttl = "new";
}

function editKunjungan() {
	var row = $('#dgKunjungan').datagrid('getSelected');
	if (row){
		$('#dlgKunjungan').dialog('open').dialog('setTitle','Edit');
		$('#fmKunjungan').form('load',row);
		url = 'Kunjungan/updateKunjungan/'+row.KUN_NO_ANTRI;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveKunjungan() {
	$('#fmKunjungan').form('submit',{
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
                $('#dlgKunjungan').dialog('close');		// close the dialog
				$('#dgKunjungan').datagrid('reload');	// reload the user data
                $('#fmKunjungan').form('clear');
                var opts = $('#dgKunjungan').datagrid('getColumnFields', true);
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

function destroyKunjungan() {
	var row = $('#dgKunjungan').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Kunjungan..? All data under this Kunjungan will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Kunjungan/destroyKunjungan',{KUN_NO_ANTRI:row.KUN_NO_ANTRI},function(result){
                    console.log(result)
					if (result.success){
						$('#dgKunjungan').datagrid('reload');	// reload the Vendor data
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

