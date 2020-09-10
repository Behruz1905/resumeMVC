// JavaScript Document
$(document).ready(function(e) {
    $('#middle_cont').jqxSplitter({ width: "100%", height: "100%",theme:'arctic', panels: [{ size: 240 }] });
	$("#left_menu_bar").jqxNavigationBar({ width: 228, expandMode: 'multiple',theme:'arctic' });        
	
	$("#head_menu").jqxMenu({ width: 'auto', height: '30px', autoOpen: false, autoCloseOnMouseLeave: false, showTopLevelArrows: true,theme:'energyblue',rtl: true});
    $("#head_menu").css('visibility', 'visible');
	
	//$("body").css("visibility","visible");
	//$("body").animate({opacity: 1,visibility: "visible"}, 200); 
	$(window).load(function(e) {
		$("#main_loading").hide();
        $("body").css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
    });
	
	$("#messageNotification").jqxNotification({
		width: 300, position: "bottom-right", opacity: 0.9,
		autoOpen: false, animationOpenDelay: 800, autoClose: true, autoCloseDelay: 18000, template: "info"
	 });
	 
	 /*
	 setInterval(function(){ 
		$.ajax({
		   type: "POST",
		   url: "admin_backend.php?module=orderm",
		   data: "action=has_new_orders",
		   success: function(msg){
			 console.log(msg);
			 if(msg == "1") { $("#messageNotification").jqxNotification("open"); } else {}
		   },
		   error: function(msg){
			alert('Error sehifeni yenileyin');
		   }
		 });
		
	}, 10000);
	*/
});

function number_valid(input) { 
	var value = input.value; 
	var rep = /[-\,\|;":'a-zA-Zа-яА-Я ? u g o s c ?  - _ + = ]/ ; 
	if (rep.test(value)) { 
		value = value.replace(rep, ''); 
		input.value = value; 
	} 
}