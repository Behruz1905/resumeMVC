<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Kontrol panel</title>

<link rel="stylesheet" href="admincontrol/jpanel_style/admin_style.css" type="text/css" >
<link rel="stylesheet" href="admincontrol/jpanel_style/portlet_style.css" type="text/css" >
<script src="resources/script/jquery-1.10.2.min.js" type="text/javascript"></script>



<link rel="stylesheet" href="resources/lib/jqwidgets/styles/jqx.base.css"  />
<link rel="stylesheet" href="resources/lib/jqwidgets/styles/jqx.arctic.css"  />
<script src="admincontrol/jpanel_lib/jqwidgets/jqxcore.js" language="javascript" ></script>
<script src="admincontrol/jpanel_lib/jqwidgets/jqxdata.js" language="javascript" ></script>
<script src="admincontrol/jpanel_lib/jqxbuttons.js" language="javascript" ></script>
<script src="admincontrol/jpanel_lib/jqxscrollbar.js" language="javascript" ></script>
<script src="admincontrol/jpanel_lib/jqxlistbox.js" language="javascript" ></script>
<script src="admincontrol/jpanel_lib/jqxdropdownlist.js" language="javascript" ></script>
<script src="admincontrol/jpanel_lib/jqxcheckbox.js" language="javascript" ></script>
<script src="admincontrol/jpanel_lib/jqxmenu.js" language="javascript" ></script>



<script>

	$(document).ready(function(){

		$("#edit_sel").change(function(){
			if($(this).val() == "link") {
				$("#edit_material").show();
			} else {
				$("#edit_material").attr("selectedIndex","0");
				$("#edit_material").hide();
			}
		});		

	});

	function proverka(input) { 
		var value = input.value; 
		var rep = /[-\,\|;":'a-zA-Zа-яА-Я ? u g o s c ?  - _ + = ]/ ; 
		if (rep.test(value)) { 
			value = value.replace(rep, ''); 
			input.value = value; 
		} 
	}
</script>



 <?php 
	if(empty($smode) == false) {
			if($smode == "page") {
				if($_REQUEST['mode'] == "front") {
					if(!empty($item)){
						if(file_exists("modules/".$item."/".$item."_module_header.php")) {	
							include("modules/".$item."/".$item."_module_header.php");
						}
					}
				} else {
					if(!empty($item)){
						if(file_exists("admincontrol/jpanel_modules/".$item."/".$item."_module_header.php")) {	
							include("admincontrol/jpanel_modules/".$item."/".$item."_module_header.php");
						}
					}
				}

			}
	} else { 
		//include("pages/main_page_module.php");
	}

 ?>