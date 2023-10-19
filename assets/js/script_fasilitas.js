var ttl;

// products
function doSearchFasilitas(){
	$('#dgFasilitas').datagrid('load',{
		search_fasilitas: $('#searchFasilitas').val()
	});
}

function newFasilitas() {
	$('#dlgFasilitas').dialog('open').dialog('setTitle','Add Fasilitas');
	$('#fmFasilitas').form('clear');
	url = 'Fasilitas/saveFasilitas';
	ttl = "new";
}

function editFasilitas() {
	var row = $('#dgFasilitas').datagrid('getSelected');
	if (row){
		$('#dlgFasilitas').dialog('open').dialog('setTitle','Edit');
		$('#fmFasilitas').form('load',row);
		url = 'Fasilitas/updateFasilitas/'+row.FAS_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveFasilitas() {
	$('#fmFasilitas').form('submit',{
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
                $('#dlgFasilitas').dialog('close');		// close the dialog
				$('#dgFasilitas').datagrid('reload');	// reload the user data
                $('#fmFasilitas').form('clear');
                var opts = $('#dgFasilitas').datagrid('getColumnFields', true);
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

function destroyFasilitas() {
	var row = $('#dgFasilitas').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Fasilitas..? All data under this Fasilitas will be disappear',function(r){
			if (r){
				$.post('Fasilitas/destroyFasilitas',{FAS_ID:row.FAS_ID},function(result){
					if (result.success){
						$('#dgFasilitas').datagrid('reload');	// reload the Vendor data
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