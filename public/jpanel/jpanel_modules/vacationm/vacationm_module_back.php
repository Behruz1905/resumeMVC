<?php 
	if ($ckey != "MODULE_INCLUDE") exit("<center>Error module loading</center>");
	$cvid = intval($_GET['cv']);
	$cv_obj = getCv($cvid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Müraciət</title>
<link rel="stylesheet" href="jpanel/jpanel_modules/vacationm/style/vacationm_module_style.css"  />
</head>

<body leftmargin="0" topmargin="0">
<div id="body_cont">
<div id="main_cont">
<p> <strong> </strong> <strong>“AZERİMED” MMC</strong> </p>
<center><strong><font size="+1">A N K E T</font></strong></center>
<hr width="100%" align="center" color="#990033" size="3">
</p>
<form action="?" method="post" enctype="multipart/form-data">
<p> <span class="label_span">Şəkil:</span> &nbsp;&nbsp;
  <img src="<?php echo $cv_obj['cvPhoto']; ?>" width="150"  />
</p>
<p> <strong> 1.</strong><span class="label_span"> Adı:</span> 
  <?php echo getCvValue($cvid,"name"); ?>
</p>
<p> <strong>2.</strong><span class="label_span">Soyadı:</span> 
 <?php echo getCvValue($cvid,"surname"); ?>
</p>
<p> <strong> 3.</strong><span class="label_span">Atasının adı: </span> 
  <?php echo getCvValue($cvid,"middle_name"); ?>
</p>
<p> <strong> 4.</strong><span class="label_span">Cinsi &nbsp;&nbsp;: </span> 
  <?php if(getCvValue($cvid,"man") == "on") { print "Kişi";} ?>
 
<?php if(getCvValue($cvid,"woman") == "on") { print "Qadin";} ?>
</p>
<p> <strong> 5.</strong><span class="label_span"> Təvəllüdü: </span> 
  <?php echo getCvValue($cvid,"birthday"); ?>
</p>
<p> <strong> 6.</strong><span class="label_span"> Doğulduğu yer: </span> 
  <?php echo getCvValue($cvid,"birth_place"); ?>
</p>
<p> <strong> 7.</strong><span class="label_span"> Milliyəti:</span> 
  <?php echo getCvValue($cvid,"nationality"); ?>
</p>
<p> <strong> 8.</strong><span class="label_span"> Hərbi mükəlləfiyyəti (Qulluq etdiyi hərbi hissə, rütbə və müddət): </span> 
  <?php echo getCvValue($cvid,"army"); ?>
</p>
<p> <strong> 9.</strong><span class="label_span"> Qeydiyyatda olduğu ünvan: </span> 
  <?php echo getCvValue($cvid,"reg_address"); ?>
</p>
<p><strong>10.</strong><span class="label_span">Yaşadığı  ünvan:</span> 
 <?php echo getCvValue($cvid,"live_address"); ?>
</p>
<p> <strong>11.</strong><span class="label_span">Əlaqə telefonu ev: </span> 
  <?php echo getCvValue($cvid,"house_phone"); ?>
&nbsp;&nbsp;&nbsp;<strong>mob.</strong> 
<?php echo getCvValue($cvid,"mobile_phone"); ?>
</p>
<p> <strong>12</strong><span class="label_span"> Aile üzvlərinin əlaqə nomrələri: </span> 
  <?php echo getCvValue($cvid,"family_phone"); ?>
</p>
<p> <strong>13.</strong><span class="label_span">Partiyalılığı: </span> 
  <?php echo getCvValue($cvid,"party"); ?>
</p>
<p> <strong>14.</strong><span class="label_span">Sürücülük vəsiqəsi : Kateqoriya </span> 
  <?php echo getCvValue($cvid,"driver_cat"); ?>
Sürücülük təcrübəsi  
<?php echo getCvValue($cvid,"driver_exp"); ?>
</p>
<p> <strong>15.</strong> <span class="label_span">Təhsil aldığı orta məktəb </span> </p>
<table border="1" cellspacing="0" cellpadding="0" >
  <tbody>
    <tr>
      <td width="30%" valign="top"><p align="center"> <strong>Adı</strong> </p></td>
      <td width="30%" valign="top"><p align="center"> <strong>Daxilolma tarix </strong></p></td>
      <td width="30%" valign="top"><p align="center"> <strong>Bitirdiyi/çıxdığı tarix</strong> </p></td>
    </tr>
    <tr>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_name"); ?></td>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_date_start"); ?></td>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_date_end"); ?></td>
    </tr>
    <tr>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_name2"); ?></td>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_date_start2"); ?></td>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_date_end2"); ?></td>
    </tr>
    <tr>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_name3"); ?></td>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_date_start3"); ?></td>
      <td  valign="top" align="center"><?php echo getCvValue($cvid,"school_date_end3"); ?></td>
    </tr>
    <tr>
      <td valign="top"></td>
      <td valign="top"></td>
      <td valign="top"></td>
    </tr>
  </tbody>
</table>
<p> <strong>16.</strong> <span class="label_span">Məzun olduğu  təhsil müəssisəsi </span> </p>
<table border="1" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="185" valign="top"><p align="center"> <strong>Adı</strong> </p></td>
      <td width="146" valign="top"><p align="center"> <strong>Fakültə</strong> </p></td>
      <td width="132" valign="top"><p align="center"> <strong>İxtisas</strong> </p></td>
      <td width="104" valign="top"><p align="center"> <strong>Daxilolma tarix</strong> </p></td>
      <td width="104" valign="top"><p align="center"> <strong>Bitirdiyi tarix</strong> </p></td>
    </tr>
    <tr>
      <td width="185" valign="top" align="center"><?php echo getCvValue($cvid,"univer_name"); ?></td>
      <td width="146" valign="top" align="center"><?php echo getCvValue($cvid,"univer_fak"); ?></td>
      <td width="132" valign="top" align="center"><?php echo getCvValue($cvid,"univer_spec"); ?></td>
      <td width="104" valign="top" align="center"><?php echo getCvValue($cvid,"univer_start_date"); ?></td>
      <td width="104" valign="top" align="center"><?php echo getCvValue($cvid,"univer_end_date"); ?></td>
    </tr>
    <tr>
      <td width="185" valign="top" align="center"><?php echo getCvValue($cvid,"univer_name2"); ?></td>
      <td width="146" valign="top" align="center"><?php echo getCvValue($cvid,"univer_fak2"); ?></td>
      <td width="132" valign="top" align="center"><?php echo getCvValue($cvid,"univer_spec2"); ?></td>
      <td width="104" valign="top" align="center"><?php echo getCvValue($cvid,"univer_start_date2"); ?></td>
      <td width="104" valign="top" align="center"><?php echo getCvValue($cvid,"univer_end_date2"); ?></td>
    </tr>
     <tr>
      <td width="185" valign="top" align="center"><?php echo getCvValue($cvid,"univer_name3"); ?></td>
      <td width="146" valign="top" align="center"><?php echo getCvValue($cvid,"univer_fak3"); ?></td>
      <td width="132" valign="top" align="center"><?php echo getCvValue($cvid,"univer_spec3"); ?></td>
      <td width="104" valign="top" align="center"><?php echo getCvValue($cvid,"univer_start_date3"); ?></td>
      <td width="104" valign="top" align="center"><?php echo getCvValue($cvid,"univer_end_date3"); ?></td>
    </tr>
    <tr>
      <td width="185" valign="top"></td>
      <td width="146" valign="top"></td>
      <td width="132" valign="top"></td>
      <td width="104" valign="top"></td>
      <td width="104" valign="top"></td>
    </tr>
    <tr>
      <td width="185" valign="top"></td>
      <td width="146" valign="top"></td>
      <td width="132" valign="top"></td>
      <td width="104" valign="top"></td>
      <td width="104" valign="top"></td>
    </tr>
  </tbody>
</table>
<p> <strong> 17.</strong> <span class="label_span">Əlavə biliklər (kurslar, treninqlər, seminarlar və s.):</span>  </p>
<p>
  <?php echo getCvValue($cvid,"add_education"); ?>
</p>
<p> <strong>18.</strong><span class="label_span"> Dillər ( zəif / orta / əla):</span>  </p>
<table border="1" cellspacing="0" cellpadding="0" id="radio_table">
  <tbody>
    <tr>
      <td width="133" valign="top"></td>
      <td width="160" valign="top"><p align="center"> Oxuma </p></td>
      <td width="160" valign="top"><p align="center"> Yazı </p></td>
      <td width="219" valign="top"><p align="center"> Danışıq </p></td>
    </tr>
    <tr>
      <td width="133" valign="top"><p align="center"> Azərbaycan </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"az_read") == "on") { print "+";}  ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"az_write") == "on") { print "+";}  ?></td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"az_speak") == "on") { print "+";} ?></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p align="center"> Rus </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"ru_read") == "on") { print "+";}  ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"ru_write") == "on") { print "+";}  ?></td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"ru_speak") == "on") { print "+";}  ?></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p align="center"> İngilis </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"en_read") == "on") { print "+";}  ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"en_write") == "on") { print "+";}  ?></td>
      <td width="219" valign="top"><?php if(getCvValue($cvid,"en_speak") == "on") { print "+";}  ?></td>
    </tr>
    <tr>
      <td width="133" valign="top"></td>
      <td width="160" valign="top"></td>
      <td width="160" valign="top"></td>
      <td width="219" valign="top"></td>
    </tr>
  </tbody>
</table>
<p> <strong>19.</strong> <span class="label_span">Kompyuter bilikləri </span> </p>
<table border="1" cellspacing="0" cellpadding="0" id="radio_table">
  <tbody>
    <tr>
      <td width="133" valign="middle"><p align="center"> Proqramlar </p></td>
      <td width="160" valign="middle"><p align="center"> Zəif </p></td>
      <td width="160" valign="middle"><p align="center"> Orta </p></td>
      <td width="219" valign="middle"><p align="center"> Əla </p></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p> MS Word </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"word") == "word_1") { print "+"; } ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"word") == "word_2") { print "+"; } ?></td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"word") == "word_3") { print "+"; } ?></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p> MS Excel </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"excel") == "excel_1") { print "+"; } ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"excel") == "excel_2") { print "+"; } ?></td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"excel") == "excel_3") { print "+"; } ?></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p> MS Power Point </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"pp") == "pp_1") { print "+"; } ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"pp") == "pp_2") { print "+"; } ?> </td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"pp") == "pp_3") { print "+"; } ?></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p> Photoshop </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"ph") == "ph_1") { print "+"; } ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"ph") == "ph_2") { print "+"; } ?> </td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"ph") == "ph_3") { print "+"; } ?></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p> Corel Draw </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"corel") == "corel_1") { print "+"; } ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"corel") == "corel_2") { print "+"; } ?></td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"corel") == "corel_3") { print "+"; } ?></td>
    </tr>
    <tr>
      <td width="133" valign="middle"><p> 1C </p></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"1c") == "1cl_1") { print "+"; } ?></td>
      <td width="160" valign="middle"><?php if(getCvValue($cvid,"1c") == "1c_2") { print "+"; } ?></td>
      <td width="219" valign="middle"><?php if(getCvValue($cvid,"1c") == "1c_3") { print "+"; } ?></td>
    </tr>
    <tr>
      <td width="133" valign="top"></td>
      <td width="160" valign="top"></td>
      <td width="160" valign="top"></td>
      <td width="219" valign="top"></td>
    </tr>
  </tbody>
</table>
<p> <strong> 20.</strong><span class="label_span"> İş təcrübəsi </span> </p>
<table border="1" cellspacing="0" cellpadding="0" width="671">
  <tbody>
    <tr>
      <td width="28" valign="middle"></td>
      <td width="95" valign="middle"><p align="center"> İşlədiyi müddət </p></td>
      <td width="170" valign="middle"><p align="center"> İşlədiyi yer </p></td>
      <td width="113" valign="middle"><p align="center"> Vəzifə </p></td>
      <td width="95" valign="middle"><p align="center"> Əmək haqqı </p></td>
      <td width="170" valign="middle"><p align="center"> İşdən çıxma səbəbi </p></td>
    </tr>
    <tr>
      <td width="28" valign="middle"><p align="center"> 1 </p></td>
      <td width="95" valign="middle" align="center" ><?php echo getCvValue($cvid,"work_date1"); ?></td>
      <td width="170" valign="middle" align="center"><?php echo getCvValue($cvid,"work_place1"); ?></td>
      <td width="113" valign="middle" align="center"><?php echo getCvValue($cvid,"work_post1"); ?></td>
      <td width="95" valign="middle" align="center"><?php echo getCvValue($cvid,"work_earn1"); ?></td>
      <td width="170" valign="middle" align="center"><?php echo getCvValue($cvid,"work_leave1"); ?></td>
    </tr>
    <tr>
      <td width="28" valign="middle"><p align="center"> 2 </p></td>
      <td width="95" valign="middle" align="center"><?php echo getCvValue($cvid,"work_date2"); ?></td>
      <td width="170" valign="middle" align="center"><?php echo getCvValue($cvid,"work_place2"); ?></td>
      <td width="113" valign="middle" align="center"><?php echo getCvValue($cvid,"work_post2"); ?></td>
      <td width="95" valign="middle" align="center"><?php echo getCvValue($cvid,"work_earn2"); ?></td>
      <td width="170" valign="middle" align="center"><?php echo getCvValue($cvid,"work_leave2"); ?></td>
    </tr>
    <tr>
      <td width="28" valign="middle"><p align="center"> 3 </p></td>
      <td width="95" valign="middle" align="center"><?php echo getCvValue($cvid,"work_date3"); ?></td>
      <td width="170" valign="middle" align="center"><?php echo getCvValue($cvid,"work_place3"); ?></td>
      <td width="113" valign="middle" align="center"><?php echo getCvValue($cvid,"work_post3"); ?></td>
      <td width="95" valign="middle" align="center"><?php echo getCvValue($cvid,"work_earn3"); ?></td>
      <td width="170" valign="middle" align="center"><?php echo getCvValue($cvid,"work_leave3"); ?></td>
    </tr>
    <tr>
      <td width="28" valign="top" align="center"><p align="center"> 4 </p></td>
      <td width="95" valign="top" align="center"><?php echo getCvValue($cvid,"work_date4"); ?></td>
      <td width="170" valign="top" align="center"><?php echo getCvValue($cvid,"work_place4"); ?></td>
      <td width="113" valign="top" align="center"><?php echo getCvValue($cvid,"work_post4"); ?></td>
      <td width="95" valign="top" align="center"><?php echo getCvValue($cvid,"work_earn4"); ?></td>
      <td width="170" valign="top" align="center"><?php echo getCvValue($cvid,"work_leave4"); ?></td>
    </tr>
  </tbody>
</table>
<p> <strong>Sonuncu iş yerinin əlaqə nömrəsi </strong>
  <?php echo getCvValue($cvid,"last_work_phone"); ?>
</p>
<p> <strong> </strong> <span class="label_span">Əlaqədar şəxsin adı</span> <strong> 
  <?php echo getCvValue($cvid,"last_work_name"); ?>
</strong></p>
<p> <strong>21.</strong> <span class="label_span">Səfərdə olduğu xarici ölkələr</span>  </p>
<table border="1" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <td width="170" valign="top"><p align="center"> Ölkə </p></td>
      <td width="132" valign="top"><p align="center"> Getdiyi tarix </p></td>
      <td width="142" valign="top"><p align="center"> Qayıtdığı tarix </p></td>
      <td width="227" valign="top"><p align="center"> Getməkdə məqsəd </p></td>
    </tr>
    <tr>
      <td width="170" valign="top" align="center"><?php echo getCvValue($cvid,"country_name1"); ?></td>
      <td width="132" valign="top" align="center"><?php echo getCvValue($cvid,"country_go1"); ?></td>
      <td width="142" valign="top" align="center"><?php echo getCvValue($cvid,"country_return1"); ?></td>
      <td width="227" valign="top" align="center"><?php echo getCvValue($cvid,"country_aim1"); ?></td>
    </tr>
    <tr>
      <td width="170" valign="top" align="center"><?php echo getCvValue($cvid,"country_name2"); ?></td>
      <td width="132" valign="top" align="center"><?php echo getCvValue($cvid,"country_go2"); ?></td>
      <td width="142" valign="top" align="center"><?php echo getCvValue($cvid,"country_return2"); ?></td>
      <td width="227" valign="top" align="center"><?php echo getCvValue($cvid,"country_aim2"); ?></td>
    </tr>
    <tr>
      <td width="170" valign="top" align="center"><?php echo getCvValue($cvid,"country_name3"); ?></td>
      <td width="132" valign="top" align="center"><?php echo getCvValue($cvid,"country_go3"); ?></td>
      <td width="142" valign="top" align="center"><?php echo getCvValue($cvid,"country_return3"); ?></td>
      <td width="227" valign="top" align="center"><?php echo getCvValue($cvid,"country_aim3"); ?></td>
    </tr>
  </tbody>
</table>
<p> <strong>22.</strong> <span class="label_span_long"><strong>Şirkət tərəfindən göndəriləcək ezamiyyətlərə gedə bilərsinizmi?</strong> </span> 
  <?php if(getCvValue($cvid,"can_trip") == "Y") { print "Bəli"; } else { print "Xeyr";} ?>

</p>
<p> <strong>23.</strong> <span class="label_span_long"><strong>Bazar günləri iş günü elan olunmasına münasibətiniz: </strong></span> 
 <?php echo getCvValue($cvid,"weekend_work"); ?>
</p>
<p> <strong>24.</strong><span class="label_span"> Hobbiniz (Maraqlarınız): </span> 
 <?php echo getCvValue($cvid,"hobby"); ?>
</p>
<p> <strong>25. </strong><span class="label_span"> Ailə vəziyyəti: </span> 
<?php echo getCvValue($cvid,"family_status"); ?>
</p>
<p> <strong>26.</strong> Ailə üzvləri (Adı, soyadı, atasının adı, təvəllüdü,doğulduğu yer, qeydiyyatda olduğu yer və işlədiyi yer göstərilməklə): </p>
<p> Ata<br/> 
  <?php echo getCvValue($cvid,"father_info"); ?>
</p>
<p> Ana <br/> 
  <?php echo getCvValue($cvid,"mother_info"); ?>
</p>
<p> Qardaş <br/> 
  <?php echo getCvValue($cvid,"brother_info"); ?>
</p>
<p> Bacı <br/> 
  <?php echo getCvValue($cvid,"sister_info"); ?>
</p>
<p>Həyat
  yoldaşı <br/> 
  <?php echo getCvValue($cvid,"sattelite"); ?>
</p>
<p> <strong>27.</strong><span class="label_span"> Özünüzü hansı işdə görürsünüz? </span> 
  <?php echo getCvValue($cvid,"your_work"); ?>
</p>
<p> <strong>28.</strong><span class="label_span"> Sizi işə nə bağlaya bilər? </span> 
  <?php echo getCvValue($cvid,"work_close"); ?>
</p>
<p> <strong>29.</strong><span class="label_span"> Sizi qane edəcək əmək haqqı:  </span> 
  <?php echo getCvValue($cvid,"want_earn"); ?>
</p>
<p> <strong>30.</strong> <span class="label_span_long">“AzeriMed”şirkətinə necə və kimin vasitəsilə müraciət etmisiniz? </span> 
  <?php echo getCvValue($cvid,"contacter"); ?>
</p>
<p> Əlavə məlumatlar<br/>
  <?php echo getCvValue($cvid,"add_info"); ?>
</p>
<p><strong><em><u>Ətraflı cavablandırmagınızı xahiş edirik.</u></em></strong> </p>
<input type="hidden" name="module"  value="vacation" />
<input type="hidden" name="vacationId" value="<?php echo intval($_GET['vacation']); ?>" />
<input type="hidden" name="action"   value="do_send_vacation"/>
</form>
</div>
</div>
</body>
</html>