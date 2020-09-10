<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");  ?>
<style>
	<?php print  "#".$item."_menu { background-color:#DDE4EE; } ";?>
</style>
<script>
	$(window).load(function(e) {
        if($("<?php print  "#".$item."_menu";?>").length>0){
			 $('#left_menu_bar').jqxNavigationBar('expandAt', $("<?php print  "#".$item."_menu";?>").parent().attr("index"));
		} else {
			$('#left_menu_bar').jqxNavigationBar('expandAt',0);
		}
    });
</script>
<div id="left_menu_bar">
    <div>
        <div style='margin-top: 2px;'>
            <div style='float: left;'><img alt='Mail' src='jpanel/jpanel_img/journal.png' /></div>
            <div style='margin-left: 4px; float: left;'>Kontent</div>
        </div>
    </div>
    <div>
        <ul class="left_menu_ul" index='0'>
            <li id="cats_menu" ><a href='?smode=page&item=cats' >Kontentin kateqoriyaları</a></li>
            <li id="material_menu"><a href='?smode=page&item=material&action=articles' >Materiallar</a></li>
            <li id="menu_menu"><a href='?smode=page&item=menu&action=menu_types' >Menyular</a></li>
            
            <!--<li id="tags_menu"><a href='?smode=page&item=tags&action=show' >Teqlər</a></li>-->
        </ul>
    </div>
    
    <!--<div>
        <div style='margin-top: 2px;'>
            <div style='float: left;'><img alt='Mail' src='jpanel/jpanel_img/product.png' /></div>
            <div style='margin-left: 4px; float: left;'>Mallar</div>
        </div>
    </div>-->
    <!--<div>
        <ul class="left_menu_ul" index='1'>
            <li id="prodpropertycat_menu"><a href='?smode=page&item=prodpropertycat&action=show' >Xüsusiyyətlərin kat-sı</a></li>
            <li id="prodcat_menu"><a href='?smode=page&item=prodcat&action=show_category' >Malların kateqoriyaları</a></li>
            <li id="brandm_menu"><a href='?smode=page&item=brandm&action=show' >Brendlər</a></li>
        </ul>
    </div>-->
    
    <!--<div>
        <div style='margin-top: 2px;'>
            <div style='float: left;'><img alt='Mail' src='jpanel/jpanel_img/shop_cart.png' /></div>
            <div style='margin-left: 4px; float: left;'>Shop</div>
        </div>
    </div>
    <div>
        <ul class="left_menu_ul" index='2'>
            <li id="shopm_menu"><a href='?smode=page&item=shopm&action=show' >Kataloq</a></li>
            <li id="prod_questionm_menu"><a href='?smode=page&item=prod_questionm&action=show' >Sual cavab</a></li>
            <li id="orderm_menu"><a href='?smode=page&item=orderm&action=show' >Sifarişlər</a></li>
            <li id="pharmacy_face_menu"><a href='?smode=page&item=pharmacy_face&action=show' >Aptek sifarişləri</a></li>
        </ul>
    </div>-->
    
    
    <div>
        <div style='margin-top: 2px;'>
            <div style='float: left;'><img alt='Mail' src='jpanel/jpanel_img/setting_tools.png' /></div>
            <div style='margin-left: 4px; float: left;'>Sazlamalar</div>
        </div>
    </div>
    <div>
        <ul class="left_menu_ul" index='1' >
        	<li id="siteparam"><a href='?smode=page&item=vacationm&action=show_vacations' >Vakansiyalar</a></li>
            <li id="derman_menu"><a href='?smode=page&item=qebul&action=show' >Qəbula yazıl</a></li>
            <!--<li id="regionm_menu"><a href='?smode=page&item=regionm&action=show' >Regionlar</a></li>
            <li id="derman_menu"><a href='?smode=page&item=derman&action=show' >Dermanlar</a></li>
            <li id="pharmacym_menu"><a href='?smode=page&item=pharmacym&action=show' >Apteklər</a></li>-->
            <li id="cpuserm_menu"><a href='?smode=page&item=cpuserm&action=show' >Cpanel istifadəçiləri</a></li>
            <li id="cpuserm_menun"><a href='?smode=page&item=cpuserm&action=show_types' >İstifadəçi tipləri</a></li>
            <li id="access_menu"><a href='?smode=page&item=access&action=show_access' >Moderator hüquqları</a></li>
            <li id="siteparamn"><a href='?smode=page&item=siteparam&action=show' >Saytın parametrləri</a></li>
            
           <!-- <li id="siteparam"><a href='?smode=page&item=subscribem&action=show' >Istifadəçilərə mesajlar</a></li>-->
        </ul>
    </div>
   
</div>