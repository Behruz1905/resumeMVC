<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");    ?>
<meta charset="utf-8">
<title>Jpanel</title>
<link rel="stylesheet" href="jpanel/jpanel_style/admin_style_new.css" />


<script src="jpanel/jpanel_script/jquery-1.11.3.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="jpanel/jpanel_lib/jquery_ui/jquery-ui.css" />
<script src="jpanel/jpanel_lib/jquery_ui/jquery-ui.min.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jquery_ui/jquery-ui-timepicker-addon.js" language="javascript" ></script>




<!--<link href='http://fonts.googleapis.com/css?family=Roboto:500,400italic,300italic,400' rel='stylesheet' type='text/css'>-->


<link rel="stylesheet" href="jpanel/jpanel_lib/jqwidgets/styles/jqx.base.css"  />
<link rel="stylesheet" href="jpanel/jpanel_lib/jqwidgets/styles/jqx.arctic.css"  />
<link rel="stylesheet" href="jpanel/jpanel_lib/jqwidgets/styles/jqx.energyblue.css" type="text/css" />
<script src="jpanel/jpanel_lib/jqwidgets/jqxcore.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxsplitter.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxdata.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxbuttons.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxscrollbar.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxlistbox.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxdropdownlist.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxcheckbox.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxmenu.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxnavigationbar.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxgrid.js" language="javascript" ></script>

<script src="jpanel/jpanel_lib/jqwidgets/jqxtabs.js" language="javascript" ></script>

<script src="jpanel/jpanel_lib/jqwidgets/jqxgrid.columnsresize.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxgrid.sort.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxgrid.selection.js" language="javascript" ></script>
<script src="jpanel/jpanel_lib/jqwidgets/jqxnotification.js" language="javascript" ></script>


<script src="jpanel/jpanel_script/main_script_new.js" language="javascript" ></script>





<link rel="stylesheet" href="jpanel/jpanel_style/new_portlet_style.css" />
<?php 
	if(empty($smode) == false) {
			if($smode == "page") {
				
					if(!empty($item)){
						if(file_exists("jpanel/jpanel_modules/".$item."/".$item."_module_header.php")) {	
							include("jpanel/jpanel_modules/".$item."/".$item."_module_header.php");
						}
					}

			}
	} 
 ?>