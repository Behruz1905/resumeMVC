    <?php require APPROOT . '/views/inc/header.php';    ?>


    <section class="mainBanner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-wrapper">
                        <form action="/resume2">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-jobs-build">
                                        <input name ="is_yeri" type="text" placeholder="Is Yeri">
                                        <i class="fa fa-building build-icon"></i>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-jobs-work">
                                        <input name="vezife" type="text" placeholder="Vezife">
                                        <i class="fa fa-briefcase work-icon"></i>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-jobs-location">
                                        <input name="region" type="text" placeholder="Region">
                                        <i class="fa fa-map-marker location-icon"></i>
                                    </div>
                                </div>
                                 <input type="hidden" name="form_submitted" value="1">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-btn-wrapper">
                                        <ul>
                                            <li>
                                                <input type="submit" value ="Axtar" >
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                        </form>

                    </div><!--End form-wrapper-->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-filter">
                        <ul>
                            <li><i class="fa fa-check-circle"></i><a href="">16 Jobs</a></li>
                            <li><i class="fa fa-check-circle"></i><a href="">200 Resume</a></li>
                        </ul>
                    </div><!--End banner filter-->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="banner-line">
                        <p class="lineB"><span>Biz sizi axtarırıq</span></p>
                    </div>
                </div><!--End banner-line-->
            </div><!--End row-->
        </div><!--End container-->
    </section><!--End Banner-->

    <?php   if(!empty($data['searchparam'])) : ?>

        <!--Wrapper Jobs-->
        <section class="content_listing">
            <div class="container">
                <div class="row">
                    <!--Recent Hot Jobs-->
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="content_list_area">
                            <h2>Axtaris neticeleri</h2>
                            <ul class="my_job_list">

                                <?php  foreach ($data['searchparam'] as $searchparam) :


                                    $monS = $searchparam->start_date_month;
                                    $monE = $searchparam->end_date_month;

                                    ?>
                                        <li>
                                            <div class="box">
                                                <div class="thumb"><a href=""><img src="img/logoJob.png" alt=""></a></div>
                                                <div class="jobs_text">
                                                    <h4><a href="#"><?= $searchparam->vacationTitle?></a></h4>
                                                    <p><?=$searchparam->department; ?></p>
                                                    <a href="#" class="job_into_text"><i class="fa fa-map-marker"></i><?= $searchparam->city?></a>
                                                    <a href="#" class="job_into_text"><i class="fa fa-calendar"></i><?= $month_array[$monS]. " ".$searchparam->start_date. " - ".$month_array[$monE]. " ".$searchparam->end_date; ?></a>
                                                </div>
                                                <strong class="job_price"><?=$searchparam->salary; ?> AZN</strong>
                                                <a href="<?= URLROOT; ?>/vacancies/?vacnum=<?=($searchparam->vacationId*12345678)?>&vactitle=<?=urlencode(strtolower($searchparam->vacationTitle))?>" class="btnPart<?= ($searchparam->working_time == "Full Time") ? " blue" : " red"?>"><?=$searchparam->working_time; ?></a>
                                            </div>
                                        </li>

                                 <?php endforeach;     ?>
                            </ul>

                        </div><!--end content_list_area-->
                    </div><!--end Recent Hot Jobs-->
                    <!--Featured Jobs-->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <h2 class="featuredtitle">Seçilmiş işlər</h2>
                        <aside>
                            <div class="sidebar">
                                <div class="box">
                                    <div class="thumb"> <a href="#"><img src="img/featuredJob.png" alt="Seçilmiş işlər"></a>
                                        <div class="caption"><img src="img/logo.png" alt="envato"></div>
                                    </div>
                                    <div class="jobs_text">
                                        <a href="#" class="btnRed">Part Time</a>
                                        <h4><a href="">Tibbi Nümayəndə</a></h4>
                                        <a href="#" class="job_into_text"><i class="fa fa-map-marker"></i>Bakı,Nərimanov</a>
                                        <a href="#" class="job_into_text"><i class="fa fa-calendar"></i>İyun 27, 2018 - İyul 27, 2018</a>
                                        <strong class="job_price">300 - 600 AZN</strong>
                                        <a href="#" class="btn-apply">iş üçün müraciət edin</a>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <!--end Featured Jobs-->
                </div><!--end row-->
            </div><!--container-->
        </section><!--content_listing-->


     <?php else:  ?>
        <!-- First sidebar and main wrapper -->
        <section class="first_sidebar_main_wrapper">
            <div class="container">
                <div class="row">

                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="register_section_main_wrapper">
                                    <div class="register_left_side_box_wrapper">
                                        <div class="register_left_img_overlay"></div>
                                        <div class="register_left_side_box">
                                            <img src="img/regis_icon2.png" alt="">
                                            <h4>iş axtaranlar</h4>
                                            <p>Formu dolduraraq özünüz haqda <br> məlumat yerləşdirə bilərsiz.</p>
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-plus-circle"></i> &nbsp; CV YERLƏŞDİR
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!--end register_left_side_box-->

                                        <div class="regis_center_tag_wrapper">
                                            <p>və</p>
                                        </div>

                                    </div><!--end register_left_side_box_wrapper-->
                                    <div class="register_right_side_box_wrapper">
                                        <div class="register_right_side_box">
                                            <img src="img/regis_icon.png" alt="icon" />
                                            <h4>iş elanları</h4>
                                            <p>Azerimed şirkətlər qrupunda açıq <br> vakansiyalar.</p>

                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-plus-circle"></i> &nbsp;Vakansiya axtar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!--register_right_side_box-->
                                    </div><!--register_right_side_box_wrapper-->
                                </div><!--register_section_main_wrapper-->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="dermanTapBan">
                                    <div class="dermanTap_img_overlay"></div>
                                    <div class="dermanTap_cont">
                                        <img src="img/dermantapLogo.png" alt="">
                                        <h4>*7700 Təcili dərman çatdırılması xidməti və Məlumat Mərkəzi</h4>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-search"></i>&nbsp; Axtar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--End row-->
            </div><!--End Container-->
        </section><!--End First sidebar and main wrapper-->



    <?php  endif; ?>








    <!--Wrapper Jobs-->
    <section class="content_listing">
        <div class="container">
            <div class="row">
                <!--Recent Hot Jobs-->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="content_list_area">
                        <h2>Ən son əlavə olunanlar</h2>
                        <ul class="my_job_list">

                            <?php foreach ($data['lastVacancies'] as $vacancy):

                                $monS = $vacancy->start_date_month;
                                $monE = $vacancy->end_date_month;

                                ?>

                                <li>
                                    <div class="box">
                                        <div class="thumb"><a href=""><img src="img/logoJob.png" alt=""></a></div>
                                        <div class="jobs_text">
                                            <h4><a href="#"><?=$vacancy->vacationTitle; ?></a></h4>
                                            <p><?=$vacancy->department; ?></p>
                                            <a href="#" class="job_into_text"><i class="fa fa-map-marker"></i><?=$vacancy->city?></a>
                                            <a href="#" class="job_into_text"><i class="fa fa-calendar"></i><?= $month_array[$monS]. " ".$vacancy->start_date. " - ".$month_array[$monE]. " ".$vacancy->end_date; ?></a>
                                        </div>
                                        <strong class="job_price"><?=$vacancy->salary; ?>   Azn</strong>
                                        <a href="<?= URLROOT; ?>/vacancies/?vacnum=<?=($vacancy->vacationId*12345678)?>&vactitle=<?=urlencode(strtolower($vacancy->vacationTitle))?>" class="btnPart<?= ($vacancy->working_time == "Full Time") ? " blue" : " red"?>"><?=$vacancy->working_time; ?></a>
                                    </div>
                                </li>

                            <?php  endforeach; ?>


                        </ul>
                        <div class="loadMore"><a href="#">Hamısına bax</a></div>
                    </div><!--end content_list_area-->
                </div><!--end Recent Hot Jobs-->
                <!--Featured Jobs-->
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <h2 class="featuredtitle">Seçilmiş işlər</h2>
                    <aside>
                        <div class="sidebar">
                            <div class="box">
                                <div class="thumb"> <a href="#"><img src="img/featuredJob.png" alt="Seçilmiş işlər"></a>
                                    <div class="caption"><img src="img/logo.png" alt="envato"></div>
                                </div>
                                <div class="jobs_text">
                                    <a href="#" class="btnRed">Part Time</a>
                                    <h4><a href="">Tibbi Nümayəndə</a></h4>
                                    <a href="#" class="job_into_text"><i class="fa fa-map-marker"></i>Bakı,Nərimanov</a>
                                    <a href="#" class="job_into_text"><i class="fa fa-calendar"></i>İyun 27, 2018 - İyul 27, 2018</a>
                                    <strong class="job_price">300 - 600 AZN</strong>
                                    <a href="#" class="btn-apply">iş üçün müraciət edin</a>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <!--end Featured Jobs-->
            </div><!--end row-->
        </div><!--container-->
    </section><!--content_listing-->

    <section class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                    <h2 class="newslettertitle">Son Iş Elanlarından xəbərdar ol!</h2>
                    <div class="newsletter-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Öz Email Addressivi yaz">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--end newsletter-->
   
  
    <?php require APPROOT . '/views/inc/footer.php';    ?>
 
