var ttl;


// products
function doSearchPelayanan(){
	$('#dgPelayanan').datagrid('load',{
		search_pelayanan: $('#searchpelayanan').val()
	});
}

function doSearchKeluhan(){
	$('#dgKeluhan').datagrid('load',{
		search_keluhan: $('#searchkeluhan').val()
	});
}

function doSearchDiagnosis(){
	$('#dgDiagnosis').datagrid('load',{
		search_diagnosis: $('#search_diagnosis').val()
	});
}

function doSearchTindakan(){
	$('#dgTindakan').datagrid('load',{
		search_tindakan: $('#search_tindakan').val()
	});
}

function doSearchResep(){
	$('#dgResep').datagrid('load',{
		search_resep: $('#search_resep').val()
	});
}

function newPelayanan() {
	$('#dlgPelayanan').dialog('open').dialog('setTitle','Add Pelayanan');
    $('#tt').tabs({
        selected:0
    })
	$('#fmPelayanan').form('clear');
	url = 'Pelayanan/savePelayanan';
	ttl = "new";
}

function editPelayanan() {
	var row = $('#dgPelayanan').datagrid('getSelected');
	if (row){
		$('#dlgPelayanan').dialog('open').dialog('setTitle','Edit');
		$('#fmPelayanan').form('load',row);
		url = 'Pelayanan/updatePelayanan/'+row.LYN_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function savePelayanan() {
	$('#fmPelayanan').form('submit',{
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
                $('#dlgPelayanan').dialog('close');		// close the dialog
				$('#dgPelayanan').datagrid('reload');	// reload the user data
                $('#fmPelayanan').form('clear');
                var opts = $('#dgPelayanan').datagrid('getColumnFields', true);
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

function destroyPelayanan() {
	var row = $('#dgPelayanan').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Pelayanan..? All data under this Pelayanan will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Pelayanan/destroyPelayanan',{LYN_ID:row.LYN_ID},function(result){
                    console.log(result)
					if (result.success){
						$('#dgPelayanan').datagrid('reload');	// reload the Vendor data
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

function newKeluhan() {
	$('#dlgKeluhan').dialog('open').dialog('setTitle','Add Keluhan');
	$('#fmKeluhan').form('clear');
	var row = $('#dgPelayanan').datagrid('getSelected')
	var user_id = $('#IDX').text()
	// console.log(user_id)
	$('#LYN_ID').textbox('setValue',row.LYN_ID)
	$('#USER_ID').textbox('setValue',user_id)
	$('#NAMA_USER').textbox('setValue',user_id)
	url = 'Keluhan/saveKeluhan';
	ttl = "new";
}

function editKeluhan() {
	var row = $('#dgKeluhan').datagrid('getSelected');
	if (row){
		$('#dlgKeluhan').dialog('open').dialog('setTitle','Edit');
		$('#fmKeluhan').form('load',row);
		url = 'Keluhan/updateKeluhan/'+row.KEL_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveKeluhan() {
	$('#fmKeluhan').form('submit',{
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
                $('#dlgKeluhan').dialog('close');		// close the dialog
				$('#dgKeluhan').datagrid('reload');	// reload the user data
                $('#fmKeluhan').form('clear');
                var opts = $('#dgPelayanan').datagrid('getColumnFields', true);
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

function destroyKeluhan() {
	var row = $('#dgKeluhan').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Keluhan..? All data under this Keluhan will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Keluhan/destroyKeluhan',{KEL_ID:row.KEL_ID},function(result){
                    console.log(result)
					if (result.success){
						$('#dgKeluhan').datagrid('reload');	// reload the Vendor data
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

function newDiagnosis() {
	$('#dlgDiagnosis').dialog('open').dialog('setTitle','Add Diagnosis');
	$('#fmDiagnosis').form('clear');
	var row = $('#dgPelayanan').datagrid('getSelected')
	var user_id = $('#IDX').text()
	console.log(user_id)
	$('#DIA_LYN_ID').textbox('setValue',row.LYN_ID)
	$('#DIA_USER_ID').textbox('setValue',user_id)
	$('#DIA_NAMA_USER').textbox('setValue',user_id)
	url = 'Diagnosis/saveDiagnosis';
	ttl = "new";
}

function editDiagnosis() {
	var row = $('#dgDiagnosis').datagrid('getSelected');
	if (row){
		$('#dlgDiagnosis').dialog('open').dialog('setTitle','Edit');
		$('#fmDiagnosis').form('load',row);
		url = 'Diagnosis/updateDiagnosis/'+row.DIA_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveDiagnosis() {
	$('#fmDiagnosis').form('submit',{
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
                $('#dlgDiagnosis').dialog('close');		// close the dialog
				$('#dgDiagnosis').datagrid('reload');	// reload the user data
                $('#fmDiagnosis').form('clear');
                var opts = $('#dgDiagnosis').datagrid('getColumnFields', true);
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

function destroyDiagnosis() {
	var row = $('#dgDiagnosis').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Diagnosis..? All data under this Diagnosis will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Diagnosis/destroyDiagnosis',{DIA_ID:row.DIA_ID},function(result){
                    console.log(result)
					if (result.success){
						$('#dgDiagnosis').datagrid('reload');	// reload the Vendor data
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


function newTindakan() {
	$('#dlgTindakan').dialog('open').dialog('setTitle','Add Tindakan');
	$('#fmTindakan').form('clear');
	var row = $('#dgPelayanan').datagrid('getSelected')
	var user_id = $('#IDX').text()
	console.log(user_id)
	$('#TIN_LYN_ID').textbox('setValue',row.LYN_ID)
	$('#TIN_USER_ID').textbox('setValue',user_id)
	$('#TIN_NAMA_USER').textbox('setValue',user_id)
	url = 'Tindakan/saveTindakan';
	ttl = "new";
}

function editTindakan() {
	var row = $('#dgTindakan').datagrid('getSelected');
	if (row){
		$('#dlgTindakan').dialog('open').dialog('setTitle','Edit');
		$('#fmTindakan').form('load',row);
		url = 'Tindakan/updateTindakan/'+row.TIN_ID;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveTindakan() {
	$('#fmTindakan').form('submit',{
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
                $('#dlgTindakan').dialog('close');		// close the dialog
				$('#dgTindakan').datagrid('reload');	// reload the user data
                $('#fmTindakan').form('clear');
                var opts = $('#dgTindakan').datagrid('getColumnFields', true);
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

function destroyTindakan() {
	var row = $('#dgTindakan').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Tindakan..? All data under this Tindakan will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Tindakan/destroyTindakan',{TIN_ID:row.TIN_ID},function(result){
                    console.log(result)
					if (result.success){
						$('#dgTindakan').datagrid('reload');	// reload the Vendor data
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




function newResep() {
	$('#dlgResep').dialog('open').dialog('setTitle','Add Resep');
	$('#fmResep').form('clear');
	var row = $('#dgPelayanan').datagrid('getSelected')
	var user_id = $('#IDX').text()
	console.log(user_id)
	$('#RES_LYN_ID').textbox('setValue',row.LYN_ID)
	url = 'Resep/saveResep';
	ttl = "new";
}

function editResep() {
	var row = $('#dgResep').datagrid('getSelected');
	if (row){
		$('#dlgResep').dialog('open').dialog('setTitle','Edit');
		$('#fmResep').form('load',row);
		url = 'Resep/updateResep/'+row.RES_NO;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveResep() {
	$('#fmResep').form('submit',{
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
                $('#dlgResep').dialog('close');		// close the dialog
				$('#dgResep').datagrid('reload');	// reload the user data
                $('#fmResep').form('clear');
                var opts = $('#dgResep').datagrid('getColumnFields', true);
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

function destroyResep() {
	var row = $('#dgResep').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Resep..? All data under this Resep will be disappear',function(r){
			if (r){
                // alert(row.PAS_NO_REG)
				$.post('Resep/destroyResep',{RES_NO:row.RES_NO},function(result){
                    console.log(result)
					if (result.success){
						$('#dgResep').datagrid('reload');	// reload the Vendor data
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