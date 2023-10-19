var ttl;


// products
function doSearchJadwal(){
	$('#dgJadwal').datagrid('load',{
		search_jadwal: $('#searchJadwal').val()
	});
}

function newJadwal() {
	$('#dlgJadwal').dialog('open').dialog('setTitle','Add Jadwal');
    $('#tt').tabs({
        selected:0
    })
	$('#fmJadwal').form('clear');
	url = 'Jadwal/saveJadwal';
	ttl = "new";
}

function editJadwal() {
	var row = $('#dgJadwal').datagrid('getSelected');
	if (row){
		$('#dlgJadwal').dialog('open').dialog('setTitle','Edit');
		$('#fmJadwal').form('load',row);
		url = 'Jadwal/updateJadwal/'+ row.JAD_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveJadwal() {
	$('#fmJadwal').form('submit',{
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
                $('#dlgJadwal').dialog('close');		// close the dialog
				$('#dgJadwal').datagrid('reload');	// reload the user data
                $('#fmJadwal').form('clear');
                var opts = $('#dgJadwal').datagrid('getColumnFields', true);
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

function destroyJadwal() {
	var row = $('#dgJadwal').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Jadwal..? All data under this Jadwal will be disappear',function(r){
			if (r){
                // alert(row.JAD_ID)
				$.post('Jadwal/destroyJadwal',{JAD_ID:row.JAD_ID},function(result){
                    console.log(result)
					if (result.success){
						$('#dgJadwal').datagrid('reload');	// reload the Vendor data
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

