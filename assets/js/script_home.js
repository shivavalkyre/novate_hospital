var index = 0;

function logoff(){
	var winVisible = 0;
	var win
	

		
winVisible = 1;
 win = $.messager.confirm('Logout Confirm', 'Do you want to Logout?', function(r){

	if (r){
		// window.location='./control/Logout.php';
		window.location.href = "Home/logout";
		
	}else{
		winVisible = 0;
	}
});

}

function menuSelection(title){
	// alert (title);

	if(title=='Pasien'){
		var url = 'pasien'
	}else if(title == 'Fasilitas'){
		var url = 'fasilitas'
	}else if(title == 'Paramedis'){
		var url = 'paramedis'
	}else if (title == 'Users'){
		var url = 'user'
	}else if(title =='Jadwal'){
		var url = 'jadwal'
	}else if(title =='Invoice'){
		var url = 'invoice'
	}else if(title =='Kunjungan'){
		var url = 'kunjungan'
	}else if(title =='Rekam Medik'){
		var url = 'rekam'
	}else if(title =='Pelayanan'){
		var url = 'pelayanan'
	}
	// var url= "./view/"+title+".php";
	// alert (url);
	addTab (title,url);
}

function addTab(title,url){
		if ($('#ttab').tabs('exists', title)){
				$('#ttab').tabs('select', title);
			} else {
			index++;
			// alert (url);
			var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'"  allowtransparency="true" style="width:100%;height:99%;background-color : transparent;"></iframe>';
			$('#ttab').tabs('add',{
				title: title,
				content: content,
				closable: true,
				fit: true
			});
			
			}
			//$('#cc').layout('collapse','west');
			$('#ttab').tabs('close', 'Welcome');
			$('#ttab').css("opacity",1)
			
}