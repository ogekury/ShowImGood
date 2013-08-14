$(function() {
		basics.init();
		table.init();
		var checkform = $('#id_id');
		if(checkform.attr('id')){
			editor.init();
		}
}); 


var basics ={
		init: function(){
//			$(".tablesorter").tablesorter();
//			//When page loads...
//			$(".tab_content").hide(); //Hide all content
//			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
//			$(".tab_content:first").show(); //Show first tab content
		
			//On Click Event
			$("ul.tabs li").click(function() {
		
				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content
		
				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});

			$('.column').equalHeight();
		}
}

var table ={
		status : false,
		init: function(){
			$("#checkbox_head").click(function(){
				table.status = $(this).is(":checked");
				table.check_tbl();
			});
			$(".delete_btn").click(function(){
				return table.msg_handler("confirm",'Are you sure you want to delete this record?');
			});
		},
		check_tbl:function(){
			$(".check_box_tbl").each(function(index){
				$(this).prop("checked",table.status);
			});
			
		},
		msg_handler:function(type,msg){
			switch(type){
				case 'confirm':
					var conf =window.confirm(msg);
					if(conf == true){
						return true;
					}
					return false;
				break;	
			}
		}
}

var editor = {
	init: function (){
		$(".txt_area").cleditor();
	}
}
