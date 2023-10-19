var ttl;

// products
function doSearchProduct(){
	$('#dgProducts').datagrid('load',{
		search_product: $('#searchProduct').val()
	});
}

function newProduct() {
	$('#dlgProduct').dialog('open').dialog('setTitle','Add Products');
	$('#fmProduct').form('clear');
	url = 'Product/saveProduct';
	ttl = "new";
}

function editProduct() {
	var row = $('#dgProducts').datagrid('getSelected');
	if (row){
		$('#dlgProduct').dialog('open').dialog('setTitle','Edit');
		$('#fmProduct').form('load',row);
		url = 'Product/updateProduct/'+row.product_number;
		ttl = "updt";
	}else {
		$.messager.alert('Warning','Product not selected!');
	}
}

function saveProduct() {
	$('#fmProduct').form('submit',{
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
                $('#dlgProduct').dialog('close');		// close the dialog
				$('#dgProducts').datagrid('reload');	// reload the user data
                $('#fmProduct').form('clear');
                var opts = $('#dgProducts').datagrid('getColumnFields', true);
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

function destroyProduct() {
	var row = $('#dgProducts').datagrid('getSelected');
    console.log(row)
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to delete this Product..? All data under this Product will be disappear',function(r){
			if (r){
				$.post('Product/destroyProduct',{id:row.product_number},function(result){
					if (result.success){
						$('#dgProducts').datagrid('reload');	// reload the Vendor data
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