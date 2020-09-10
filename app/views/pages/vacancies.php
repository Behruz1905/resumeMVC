<?php require APPROOT . '/views/inc/header.php';    ?>

    <section class="jobs-banner">
        <div class="jobs-banner-transparent"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="jobs-page-title">
                        <h1>Açıq vakansiyalar üzrə axtarış</h1>
                    </div>
                </div>
            </div>
        </div><!--End container-->
    </section><!--Jobs Banner-->


<?php if(!empty($data['vacancy'])):
    $vacancy = $data['vacancy'];
    $monS = $vacancy->start_date_month;
    $monE = $vacancy->end_date_month;



    ?>



    <!--Jobs Form-->
    <section class="jobs-form">
        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="details-wrapper">
                            <div class="body-details-wrapper">
                                <div class="details-wrapper-info">
                                    <h3><?=$vacancy->vacationTitle;?></h3>
                                    <p><?=$vacancy->department; ?></p>
                                    <a href="#" class="details-text">
                                        <i class="fa fa-map-marker"></i>
                                        <?=$vacancy->city?>
                                    </a>
                                    <a href="#" class="details-text">
                                        <i class="fa fa fa-calendar"></i>
                                        <?= $month_array[$monS]. " ".$vacancy->start_date. " - ".$month_array[$monE]. " ".$vacancy->end_date; ?>
                                    </a>
                                    <span class="details-price"><?=$vacancy->salary; ?> AZN</span>
                                    <ul>
                                        <li class="dfull-btn"><a href="#" class="btn btn-danger"><?= $vacancy->working_time?></a></li>
                                        <li class="dcv-btn"><a  onclick="show_vacation(4);" href="javascript:void" class="btn btn-info">iş üçün müraciət edin</a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!--end body-details-wrapper-->
                        </div><!--end details-wrapper-->

                        <div class="details-wrapper">
                            <div class="body-details-wrapper">
                                <div class="details-wrapper-jobs">
                                    <h4>İşin təsviri</h4>
                                </div>
                                <div class="details-wrapper-jobs">
                                    <ul class="details-list">
                                        <li>İşəgötürən: Azerimed MMC</li>
                                        <li>Kateqoriya <?=$vacancy->department?> » <?=$vacancy->vacationTitle?></li>
                                        <li>Şəhər <?=$vacancy->city?></li>
                                        <li>Yaş <?=$vacancy->min_age?> - <?=$vacancy->max_age?></li>
                                        <li>Təhsil <?=$vacancy->tehsil?></li>
                                        <li>İş təcrübəsi <?=$vacancy->experience?></li>
                                        <li>Əlaqədar şəxs <?=$vacancy->related_person?></li>
                                    </ul>
                                </div>
                            </div><!--end body-details-wrapper-->
                        </div><!--end details-wrapper-->

                        <div class="details-wrapper">
                            <div class="body-details-wrapper">
                                <div class="details-wrapper-jobs">
                                    <h4>İş barədə məlumat</h4>
                                </div>
                                <div class="details-wrapper-jobs">
                                    <ul class="details-list">
                                        <?=stripslashes($vacancy->vacationDesc)?>
                                    </ul>
                                </div>
                            </div><!--end body-details-wrapper-->
                        </div><!--end details-wrapper-->

                        <div class="details-wrapper">
                            <div class="body-details-wrapper">
                                <div class="details-wrapper-jobs">
                                    <h4>Namizədə tələblər</h4>
                                </div>
                                <div class="details-wrapper-jobs">
                                    <ul class="details-list">

                                        <?=stripslashes($vacancy->requirements)?>
                                    </ul>
                                </div>
                            </div><!--end body-details-wrapper-->
                        </div><!--end details-wrapper-->

                    </div><!--end main-->

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="company-details">
                            <header class="cd-title">
                                <h4>Companiya Haqqinda</h4>
                            </header>
                            <ul class="company-list">
                                <li><b>Ad:</b> Azerimed MMC</li>
                                <li><b>Email:</b> info@zeferan.az</li>
                                <li><b>Tel:</b> (+994 12) 566-70-70</li>
                                <li><b>Website:</b> <a href="#">zeferan.az</a></li>
                                <li><b>Address:	</b> Baş ofis: Bakı, Nərimanov rayonu, Asif Məmmədov küçəsi, 30 AZ1033</li>
                            </ul>
                        </div><!--end company-details-->
                        <div class="featuredJob-details clearfix">
                            <h2>Seçilmiş işlər</h2>
                            <div class="sidebar">
                                <div class="box">
                                    <div class="thumb">
                                        <a href="#"><img src="img/featuredJob.png" alt="Seçilmiş işlər"></a>
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
                        </div><!--end featuredJob-details-->
                        <div class="bannerDermanTap">
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
                        </div><!--end bannerDermanTap-details-->

                    </div><!--end right blok-->
                </div>
            </div>
        </div>
    </section><!--end section-->



<?php else: ?>

    <!--Jobs Form-->
    <section class="jobs-form">
        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="user-filters">

                            <div class="input-search">
                                <div class="search-bar">
                                    <i class="fa fa-search"></i>
                                    <input id="searchvacancy" type="text" name="" placeholder="Axtar" class="form-control">
                                </div>

                                <div class="search-bar">
                                    <i class="fa fa-map-marker"></i>
                                    <select id= "cities" onchange="filterDataByDerscription()"  name="city" class="form-control">
                                        <option value ="">Region</option>
                                        <option value="Baki">Baki</option>
                                        <option value="sumqayit">Sumqayit</option>
                                        <option value="gence">Gence</option>
                                        <option value="lenkeran">Lenkeran</option>
                                        <option value="seki">Seki</option>
                                    </select>
                                </div>
                            </div>

                            <div class="search-filter-wrap">
                                <h2>Tarixə  əsasən</h2>
                                <div id="searchbydate" class="search-checkbox">
                                    <label for="check1" class="checkbox-new">
                                        Bugün
                                        <input type="checkbox" id="check1" value="today" onclick="filterDataByDerscription(this.value);">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label  for="check2" class="checkbox-new">
                                        Bu həftə
                                        <input type="checkbox"  id="check2" value="week" onclick="filterDataByDerscription(this.value);">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox-new">
                                        Bu ay
                                        <input type="checkbox" id="check3" value="month" onclick="filterDataByDerscription(this.value);">
                                        <span class="checkmark"></span>
                                    </label>
                                    <!--                                    <label class="checkbox-new">-->
                                    <!--                                        Hamısı-->
                                    <!--                                        <input type="checkbox" id="check4" value="all" onclick="filterDataByDerscription(this.value);">-->
                                    <!--                                        <span class="checkmark"></span>-->
                                    <!--                                    </label>-->
                                </div>
                            </div>

                            <div class="search-filter-wrap">
                                <h2>Fəaliyyət</h2>
                                <div id="searchbydesc" class="search-checkbox">
                                    <label class="checkbox-new">
                                        Full Time
                                        <input type="checkbox"  value="Full Time" onclick="filterDataByDerscription(this.value)">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox-new">
                                        Part Time
                                        <input type="checkbox"  value="Part Time" onclick="filterDataByDerscription(this.value)">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox-new">
                                        Freelance
                                        <input type="checkbox"  value="Freelance" onclick="filterDataByDerscription(this.value)">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="content_list_area">
                            <ul class="my_job_list" id="myJoblist">

                                <?php   foreach ($data['vacancies'] as $vacancy):

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


                                <!--
                                                            </ul>
                                                        </div>  end content_list_area-->
                                <!--jobs Navigator-->
                                <?php  if(count($data['vacancies'])  > 3 ): ?>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <li>
                                                <a href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li>
                                                <a href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>

                                <?php  endif; ?>
                                <!--End jobs Navigator-->
                        </div>
                    </div>
                </div>
            </div>
    </section><!--end section-->


<?php endif;   ?>










    <?php require APPROOT . '/views/inc/footer.php';    ?>