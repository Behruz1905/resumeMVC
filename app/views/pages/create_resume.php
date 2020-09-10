
<?php require APPROOT . '/views/inc/header.php';    ?>






<section class="jobs-banner">
    <div class="jobs-banner-transparent"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <div class="jobs-page-title">
                    <h1>CV YERLƏŞDİR</h1>
                </div>
            </div>
        </div>
    </div><!--End container-->
</section><!--Jobs Banner-->




<!--Jobs Banner-->

<section class="jobs-form">
    <div class="container" >

        <div id="esas" class="alert alert-danger" style="display: none"  role="alert">

        </div>
        <div id="esas_success"  class="alert alert-success" style="display: none"  role="alert">

        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <form id="cvcreate_form" action="/resume2/resume/createresume" method="post" enctype="multipart/form-data">

            <fieldset>
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="content-row">
                                <div class="img-preview">
                                    <i class="glyphicon glyphicon-picture"></i>
                                    <input type="file" id="file" name="imgFile">
                                    <div class="invalid-feedback">
                                        <span style="color: red"><?= $data['error']['imgFile'];?></span>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-md-3-->

                        <div class="col-md-9">
                            <div class="headline">
                                <h3>Şəxsi məlumatlar</h3>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="parent col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Ad <span>*</span></label><br>
                                        <input type="text" class="def-input" name="ad">
                                        <div class="invalid-feedback">
                                            <span style="color: red"><?= $data['error']['ad'];?></span>
                                        </div>
                                    </div>
                                    <div class="parent col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Soyad <span>*</span></label><br>
                                        <input type="text" class="def-input" name="soyad">
                                        <div class="invalid-feedback">
                                            <span style="color: red"><?= $data['error']['soyad'];?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Ata adı <span>*</span></label><br>
                                        <input type="text" class="def-input" name="ata_adi">
                                        <div class="invalid-feedback">
                                            <span style="color: red"><?= $data['error']['ata_adi'];?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Cinsi <span>*</span></label><br>
                                        <select class="def-input" name="cins" >
                                            <option  value="M" selected="">Kisi</option>
                                            <option  value="F">Qadin</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Təvəllüdü <span>*</span></label><br>
                                        <input type="date" class="def-input" name="bday">
                                        <div class="invalid-feedback">
                                            <span style="color: red"><?= $data['error']['bday'];?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Doğum yeri <span>*</span></label><br>
                                        <input type="text" class="def-input" name="bplace">
                                        <div class="invalid-feedback">
                                            <span style="color: red"><?= $data['error']['bplace'];?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Milliyəti <span>*</span></label><br>
                                        <input type="text" class="def-input" name="nationality">
                                        <div class="invalid-feedback">
                                            <span style="color: red"><?= $data['error']['nationality'];?></span>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Partiyalığı <span>*</span></label><br>
                                        <input type="text" class="def-input" name="partiya">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Hərbi xidmətdə olmusunuzmu <span>*</span></label><br>
                                        <select class="def-input" name="military" >
                                            <option  value="" selected="">Secin</option>
                                            <option  value="yes" >Beli</option>
                                            <option  value="no">Xeyr</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Ailə vəziyyəti <span>*</span></label><br>
                                        <select class="def-input" name="martial_status" >
                                            <option  value="" selected="">Secin</option>
                                            <option  value="aileli">Aileli</option>
                                            <option  value="subay">Subay</option>
                                            <option  value="bosanmis" selected="">Bosanmis</option>
                                            <option value="dul">Dul</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Əlaqə tel. ev<span>*</span></label><br>
                                        <input type="tel" class="def-input" name="tel_home">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Əlaqə tel. mobil<span>*</span></label><br>
                                        <input type="tel" class="def-input" name="tel_mob">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Ailə üzvlərinin əlaqə nömrələri</label><br>
                                        <input type="tel" class="def-input" name="phone_family">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>E-poct<span>*</span></label><br>
                                        <input type="email" class="def-input" name="email">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Yaşadığı ünvan <span>*</span></label><br>
                                        <input type="text" class="def-input" name="living_adress">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Qeydiyyatda olduğunuz ünvan <span>*</span></label><br>
                                        <input type="text" class="def-input" name="qeydiyyat_adress">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Beynəlxalq xarici pasportunuz varmı?</label><br>
                                        <select class="def-input" name="foreign_passport" >
                                            <option  value="beli" selected="">Beli</option>
                                            <option  value="xeyr">Xeyr</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Ezamiyyətə getmək imkanınız varmı?</label><br>
                                        <select class="def-input" name="ezamiyyet" >
                                            <option  value="beli" selected="">Beli</option>
                                            <option  value="xeyr">Xeyr</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Sürücülük vəsiqəsinin dərəcəsi:</label><br>
                                        <select class="def-input" name="driving license" >
                                            <option  value="Yoxdur" selected="">Yoxdur</option>
                                            <option  value="A1">A1</option>
                                            <option  value="A">A</option>
                                            <option  value="B">B</option>
                                            <option  value="BC">BC</option>
                                            <option  value="C">C</option>
                                            <option  value="D">D</option>
                                            <option  value="BE">BE</option>
                                            <option  value="CE">CE</option>
                                            <option  value="DE">DE</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Məsuliyyətə cəlb olunmusunuzmu?</label><br>
                                        <select class="def-input" name="cinayet" >
                                            <option  value="beli" selected="">Beli</option>
                                            <option  value="xeyr">Xeyr</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Nəzərdə tutduğunuz əmək haqqı AZN: <span>*</span></label><br>
                                        <input type="text" class="def-input" name="emmek_haqqi">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Hal hazırda işləyirsinizmi?:</label><br>
                                        <select class="def-input" name="current_work" >
                                            <option  value="beli" selected="">Beli</option>
                                            <option  value="xeyr">Xeyr</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Hazırki iş yerinizi və vəzifənizi yazın:</label><br>
                                        <input type="text" class="def-input" name="current_job">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <label>Hansı səbəbə görə işdən ayrılırsınız?:</label><br>
                                        <input type="text" class="def-input" name="reason_quit">
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-md-9-->
                    </div>
                </div><!--end card-body-->

            </div><!--end card-->
                <input type="button"  id = "1_step" name="password" class="next btn btn-info" value="Next" />
            </fieldset>

            <fieldset>
            <div class="card">
                <div class="card-body" id="dynamic_field" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="headline">
                                <h3>İş təcrübəsi</h3>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                                <label>Müəssisənin adı </label><br>
                                <input type="text" id="muessise_adi" class="def-input" class="job" name="muessise_adi[]">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>İşlədiyiniz müddət </label><br>
                                <input type="date" id="work_time" class="def-input" class="job" name="work_time[]">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>Vəzifə </label><br>
                                <input type="text" id="muessise_vezife" class="def-input" class="job" name="muessise_vezife[]">
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-12 col-xs-12">
                                <label>Əmək haqqı</label><br>
                                <input type="text" id="muessise_emekh" class="def-input" class="job" name="muessise_emekh[]">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label>İşdən çıxma səbəbi</label><br>
                                <input type="text" id="muessise_reason_quit" class="def-input" class="job" name="muessise_reason_quit[]">
                            </div>



                        </div>
                    </div>







                </div>

                <button type="button" class="btn btn-success" id="dinamic_field_add" >Elave et</button>
            </div>
                <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                <input type="button"  id= "2_step" name="next" class="next btn btn-info" value="Next" />
            </fieldset>

            <fieldset>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="headline">
                                <h3>Məzun olduğu orta məktəb</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div  class="parent col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Müəssisənin adı </label><br>
                                <input type="text" class="def-input" class="job" name="school_name">
                                <div class="invalid-feedback">
                                    <span style="color: red"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Daxilolma tarixi </label><br>
                                <input type="date" class="def-input" class="job" name="school_start">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Bitirdiyi/çıxdığı tarix </label><br>
                                <input type="date" class="def-input" class="job" name="school_end">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                <input type="button" id="3_step" name="next" class="next btn btn-info" value="Next" />
            </fieldset>

            <fieldset>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="headline">
                                <h3>Məzun olduğu ali təhsil müəssisəsi</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label>Müəssisənin adı </label><br>
                                <input type="text" class="def-input" class="job" name="uni_name">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label>Fakültə <span>*</span></label><br>
                                <input type="text" class="def-input" class="job" name="faculty_name">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>İxtisas</label><br>
                                <input type="text" class="def-input" class="job" name="profession_name">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>Daxilolma tarixi </label><br>
                                <input type="date" class="def-input" class="job" name="uni_start_date">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>Bitirdiyi tarix </label><br>
                                <input type="date" class="def-input" class="job" name="uni_end_date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                <input type="button" id="4_step" name="next" class="next btn btn-info" value="Next" />
            </fieldset>

            <fieldset>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="headline">
                                <h3>Dil bilikləri</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Azərbaycan dili (oxumaq) </label><br>
                                <select class="def-input" name="az_dili_oxu" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Azərbaycan dili (yazmaq): <span>*</span></label><br>
                                <select class="def-input" name="az_dili_yaz" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Azərbaycan dili (danışmaq):</label><br>
                                <select class="def-input" name="az_dili_danis" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Rus dili (oxumaq) </label><br>
                                <select class="def-input" name="rus_dili_oxu" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Rus dili (yazmaq): <span>*</span></label><br>
                                <select class="def-input" name="rus_dili_yaz" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Rus dili (danışmaq):</label><br>
                                <select class="def-input" name="rus_dili_danis" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Ingilis dili (oxumaq) </label><br>
                                <select class="def-input" name="ing_dili_oxu" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Ingilis dili (yazmaq): <span>*</span></label><br>
                                <select class="def-input" name="ing_dili_yaz" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label>Ingilis dili (danışmaq):</label><br>
                                <select class="def-input" name="ing_dili_danis" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                <input type="button" id="5_step" name="next" class="next btn btn-info" value="Next" />
            </fieldset>

            <fieldset>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="headline">
                                <h3>Komputer bilikləri</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Proqramın adı</label><br>
                                <input type="text" class="def-input" class="job" name="proqram_adi">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Proqramı bildiyiniz səviyyə:</label><br>
                                <select class="def-input" name="proqram1_level" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Proqramın adı</label><br>
                                <input type="text" class="def-input" class="job" name="proqram2_adi">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Proqramı bildiyiniz səviyyə:</label><br>
                                <select class="def-input" name="proqram2_level" >
                                    <option  value="ela" selected="">Əla</option>
                                    <option  value="yaxsi">Yaxşi</option>
                                    <option  value="zeif">Zəif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                <input type="button" id="6_step" name="next" class="next btn btn-info" value="Next" />
            </fieldset>

            <fieldset>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="headline">
                                <h3>Ailə üzvləri (adı, soyadı, iş yeri, yaşadığı ünvan)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Atam <span>*</span></label><br>
                                <input type="text" class="def-input" class="ata" name="father">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Anam <span>*</span></label><br>
                                <input type="text" class="def-input" class="ana" name="mother">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Qardaşım<span>*</span></label><br>
                                <input type="text" class="def-input" class="job" name="brother">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Bacim<span>*</span></label><br>
                                <input type="text" class="def-input" class="job" name="sister">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Həyat yoldaşım<span>*</span></label><br>
                                <input type="text" class="def-input" class="job" name="partner">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Uşaqarın sayı, cinsi, təvəllüdü<span>*</span></label><br>
                                <input type="text" class="def-input" class="job" name="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                <input type="button" id="7_step" name="next" class="next btn btn-info" value="Next" />
            </fieldset>

            <fieldset>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="headline">
                                <h3>Əlavə məlumatlar</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Ətraflı cavablandırmağınızı xahiş edirik.</label><br>
                                <textarea rows="10" cols="10" class="def-textarea" name="person_info">

                                        </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label style="float:left;margin-right:10px;margin-top:2px;">Qeyd etdiyim məlumatların dəqiq və düzgün olmasına şəxsən məsuliyyət daşıyıram və bunu öz imzamla təsdiq edirəm </label>
                                <input type="checkbox" id="accept" name="accept_all">
                                <div class="invalid-feedback">
                                    <span style="color: red"><?= $data['error']['accept_all'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <input type="button" name="previous" class="previous btn btn-default" value="Previous" />
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="formGonder" type="submit"  name="gonder" class="btn btn-primary btn-lg btn-block">CV YARAT</button>
                </div>
            </fieldset>



        </form>
    </div><!--end container-->
</section><!--end section-->


<?php require APPROOT . '/views/inc/footer.php';    ?>
