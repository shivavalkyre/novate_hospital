
function loginApp() {

    var url = 'Main/loginApp';
	var username = $('#username').textbox('getValue')
	var password = $('#password').passwordbox('getValue')
	// $('#fmLogin').form('submit',{
	// 	url: url,
	// 	onSubmit: function(){
	// 		return $(this).form('enableValidation').form('validate');
	// 	},
	// 	success: function(result){
	// 		var result = eval('(' + result + ')')
	// 		console.log('result',result)
    //         console.log('success',result.success)
	// 		console.log('data',result.data)
	// 		var success = result.success
	// 		var data = result.data
	// 		if(success== false){
	// 			$.messager.alert('Sales System',data,'error');
	// 		}else{
	// 			window.location.href = "Main/logged";
	// 			// console.log(result)
	// 			// alert(result)
	// 		}
    //     },
    // })
	$.ajax({
		type: "POST",
		url: url,
		data: {
		  username: username,
		  password: password
		},
		cache: false,
		success: function(datas){
			console.log(datas)
			var success = datas.success

			if(success== false){
				$.messager.alert('Sales System',data,'error');
			}else{
				window.location.href = "Main/logged";
				// console.log(result)
				// alert(result)
			}
			
		},
		error: function(xhr, status, error) {
		console.error(xhr.responseText);
		console.error(status);
		console.error(error);
		}
	});
	// alert('here')
}