$('#button').click(function(){
	var name = $('#username').val();
	//alert(name);
	$.ajax({
		url:'getName-Service.php',
		type:'POST',
		data:'username='+name,
		success:function(data){
			$('#content').html(data);
			var array = JSON.parse(data);
			
		}

	});
});