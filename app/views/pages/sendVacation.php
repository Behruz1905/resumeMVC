
<?php require APPROOT . '/views/inc/header.php';    ?>




<form action="?module=vacation" method="post" enctype="multipart/form-data">
    <div id="particles-js">
        <div class="full-width">
            <div class="container">
                <header> <a href="#"><img src="vacancies/images/main_logo.png"></a></header>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 ">
                        <div class="box full ">
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Ad</label>
                                    <input type="text" value="" placeholder="Ad" class="form-control" autocapitalize="words" autofocus  name="name" id="name" required="" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Soyadı</label>
                                    <input type="text" value="" placeholder="Soyadı" class="form-control" autocapitalize="words" autofocus name="surname" id="surname" required="" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Atasının adı</label>
                                    <input type="text" value="" placeholder="Atasının adı" class="form-control" autocapitalize="words" autofocus name="middle_name" id="middle_name"  required="" >
                                </div>
                            </div>
                            <div class="col-sm-1 col-xs-12 gender">
                                <div class="form-group">
                                    <label>Cinsi:</label>
                                    <select class="form-control cins" >
                                        <option class="sechim" name="man" id="man">kişi</option>
                                        <option class="sechim" name="woman" id="woman">qadın</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--col-sm-10-->
                    </div>
                    <!--box-->

                    <div class="col-sm-2 col-xs-12 camera">
                        <div class="choose_file">
                            <label><i class="fa fa-camera fa-3x"></i>
                                <input type="file" placeholder='Şəkil Yüklə' name="pic" id="pic"/>
                            </label>
                        </div>
                    </div>
                </div>
                <!--col-sm-12-->
            </div>

            <!---line 2--->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <div class="col-sm-2 ">
                                <div class="form-group">
                                    <label>Təvəllüdü</label>
                                    <input type="text" value="" placeholder="gün/ay/il" class="form-control" autocapitalize="words" autofocus name="birthday" id="birthday"  required="" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Doğulduğu yer</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="birth_place" id="birth_place" required="" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Hərbi mükəlləfiyyəti</label>
                                    <input type="text" value="" placeholder="Qulluq etdiyi hh, rütbə və müddət" class="form-control" autocapitalize="words" autofocus name="army" id="army"  >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Yaşadığı ünvan</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="live_address" id="live_address" required="" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Qeydiyyatda olduğu ünvan</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="reg_address" id="reg_address" required="" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Əlaqə nömrəsi</label>
                                    <input type="text" value="" placeholder="012 1234567, 012 1235647" class="form-control" autocapitalize="words" autofocus name="house_phone" id="house_phone" required="" >
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Ailə üzvlərinin əlaqə nömrələri</label>
                                    <input type="text" value="" placeholder="012 1234567, 012 1235647" class="form-control" autocapitalize="words" autofocus name="family_phone" id="family_phone"  >
                                </div>
                            </div>
                            <div class="col-sm-2 ">
                                <div class="form-group">
                                    <label>Partiyalığı</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus  name="party" id="party"  >
                                </div>
                            </div>
                            <div class="col-sm-2 ">
                                <div class="form-group">
                                    <label>Milliyəti</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="nationality" id="nationality" required="" >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Sürücülük vəsiqəsi:</label>
                                    <select class="form-control cins" name="driver_cat" id="driver_cat" >
                                        <option class="sechim" value="A">A</option>
                                        <option class="sechim" value="B">B</option>
                                        <option class="sechim" value="C">C</option>
                                        <option class="sechim" value="D">D</option>
                                        <option class="sechim" value="BE">BE</option>
                                        <option class="sechim" value="CE">CE</option>
                                        <option class="sechim" value="DE">DE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Sürücülük təcrübəsi</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="driver_exp" id="driver_exp" >
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <p class="input-bashliq">Təhsil aldığı orta məktəb</p>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Adı</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_name" id="school_name"  required="" >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_name2" id="school_name"  required="" >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_name3" id="school_name"  required="" >
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <div class="form-group">
                                    <label>Daxilolma tarixi</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_date_start" id="school_date_start"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_date_start2" id="school_date_start"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_date_start3" id="school_date_start"  >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Bitirdiyi/çıxdığı tarix</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_date_end" id="school_date_end"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_date_end2" id="school_date_end"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="school_date_end3" id="school_date_end"  >
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <!---Mezun oldugu ali tehsil muessesi--->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <p class="input-bashliq">Məzun olduğu  təhsil müəssisəsi</p>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Adı</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_name" id="univer_name"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_name2" id="univer_name"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_name3" id="univer_name"  >
                                </div>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Fakültə</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_fak" id="univer_fak"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_fak2" id="univer_fak"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_fak3" id="univer_fak"  >
                                </div>
                            </div>
                            <div class="col-sm-2 ">
                                <div class="form-group">
                                    <label>İxtisas</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_spec" id="univer_spec"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_spec2" id="univer_spec"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_spec3" id="univer_spec"  >
                                </div>
                            </div>
                            <div class="col-sm-2 ">
                                <div class="form-group">
                                    <label>Daxilolma tarixi</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_start_date" id="univer_start_date"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_start_date2" id="univer_start_date"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_start_date3" id="univer_start_date"  >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Bitirdiyi/çıxdığı tarix</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_end_date" id="univer_end_date"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_end_date2" id="univer_end_date"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="univer_end_date3" id="univer_end_date"  >
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <p class="input-bashliq">Əlavə biliklər (kurslar, treninqlər, seminarlar və s.)</p>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="add_education" id="add_education"  >
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="add_education_second" id="add_education_second"  >
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <p class="input-bashliq">Dil bilikləri</p>
                            <div class="col-sm-3 lang col-xs-6">
                                <div class="form-group">
                                    <label>Azərbaycan</label>
                                    <ul >
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio" name="az_1" id="az_1" style="position: absolute;top: 32px;left: 102px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="az_2" id="az_2" style="position: absolute;top: 64px;left: 102px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio"  name="az_3" id="az_3" style="position: absolute;top: 92px;left: 102px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3 lang  col-xs-6">
                                <div class="form-group">
                                    <label>Rus dili</label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio"  name="ru_1" id="ru_1" style="position: absolute;top: 32px;left: 102px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="ru_2" id="ru_2" style="position: absolute;top: 64px;left: 102px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio" ame="ru_3" id="ru_3" style="position: absolute;top: 92px;left: 102px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3 lang  col-xs-6">
                                <div class="form-group">
                                    <label>Ingilis dili</label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio"  name="en_1" id="en_1" style="position: absolute;top: 32px;left: 102px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="en_2" id="en_2"  style="position: absolute;top: 64px;left: 102px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio" name="en_3" id="en_3"  style="position: absolute;top: 92px;left: 102px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-3 lang  col-xs-6">
                                <div class="form-group">
                                    <label>
                                        <input type="text"  name="ohtl "style="height: 22px;border-radius: 5px;border: 1px solid #ccc;font-size: 12px;font-family: arial; font-weight: normal;padding: 0px 5px;" placeholder="Digər dil">
                                    </label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla
                                                <input type="radio" name="ohtl_1" id="ohtl_1"  style="position: absolute;top: 32px;left: 102px;">
                                            </label>
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="ohtl_2" id="ohtl_2" style="position: absolute;top: 64px;left: 102px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio" name="ohtl_3" id="ohtl_3" style="position: absolute;top: 92px;left: 102px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <p class="input-bashliq">Kompyuter bilikləri</p>
                            <div class="col-sm-2 lang col-xs-6">
                                <div class="form-group" id="radio_table">
                                    <label>MS Word</label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio" name="word" id="word_1" value="word_1" style="position: absolute;top: 32px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="word" id="word_2" value="word_2"  style="position: absolute;top: 64px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio" name="word" id="word_3" value="word_3" style="position: absolute;top: 92px;left: 59px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 lang  col-xs-6">
                                <div class="form-group">
                                    <label>MS Excell</label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio" name="excel" id="excel_1" value="excel_1"  style="position: absolute;top: 32px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="excel" id="excel_2" value="excel_2" style="position: absolute;top: 64px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio"  name="excel" id="excel_3" value="excel_3" style="position: absolute;top: 92px;left: 59px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 lang  col-xs-6">
                                <div class="form-group">
                                    <label>MS Power Point</label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio" name="pp" id="pp_1" value="pp_1" style="position: absolute;top: 32px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio"  name="pp" id="pp_2" value="pp_2" style="position: absolute;top: 64px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio" name="pp" id="pp_3" value="pp_3" style="position: absolute;top: 92px;left: 59px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 lang  col-xs-6">
                                <div class="form-group">
                                    <label>Photoshop</label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio" name="ph" id="ph_1" value="ph_1" style="position: absolute;top: 32px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="ph" id="ph_2" value="ph_2" style="position: absolute;top: 64px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio" name="ph" id="ph_3" value="ph_3" style="position: absolute;top: 92px;left: 59px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 lang  col-xs-6">
                                <div class="form-group">
                                    <label>1C </label>
                                    <ul>
                                        <li>
                                            <label class="level">Əla</label>
                                            <input type="radio" name="1c" id="1c_1" value="1cl_1" style="position: absolute;top: 32px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Yaxşı</label>
                                            <input type="radio" name="1c" id="1c_2" value="1cl_2" style="position: absolute;top: 64px;left: 59px;">
                                        </li>
                                        <li>
                                            <label class="level">Zəif</label>
                                            <input type="radio" name="1c" id="1c_3" value="1cl_3" style="position: absolute;top: 92px;left: 59px;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 lang  col-xs-6">
                                <div class="form-group">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle all-soft-head" type="button" id="all-softs" data-toggle="dropdown">
                                            <label>Digər Proqramlar</label>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="all-softs">
                                            <li role="presentation" class="all-soft">
                                                <label>
                                                    <input type="checkbox">
                                                    Corel Draw</label>
                                            </li>
                                            <li role="presentation" class="all-soft">
                                                <label>
                                                    <input type="checkbox" name="delphi">
                                                    Delphi </label>

                                            </li>
                                            <li role="presentation" class="all-soft">
                                                <label>
                                                    <input type="checkbox" name="clang">
                                                    C </label>
                                            </li>
                                            <li role="presentation" class="all-soft">
                                                <label>
                                                    <input type="checkbox" name="csharp">
                                                    C# </label>
                                            </li>
                                            <li role="presentation" class="all-soft">
                                                <label>
                                                    <input type="checkbox" name="cpp">
                                                    C+ </label>
                                            </li>
                                            <li role="presentation" class="all-soft">
                                                <label>
                                                    <input type="checkbox" name="sql">
                                                    SQL </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <!---------------------------------------------------
        -------------------------------------------------------
        ---------------------------------------------------->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full ">
                            <p class="input-bashliq">İş təcrübəsi</p>
                            <div class="col-sm-3 work lang col-xs-6">
                                <div class="form-group">
                                    <label>İşlədiyi müddət</label>
                                    <ul>
                                        <li>
                                            <label class="level">1</label>
                                            <input type="text" style="position: absolute;top: 32px;left: 37px;" name="work_date1" id="work_date1">
                                        </li>
                                        <li>
                                            <label class="level">2</label>
                                            <input type="text" style="position: absolute;top: 62px;" name="work_date2" id="work_date2">
                                        </li>
                                        <li>
                                            <label class="level">3</label>
                                            <input type="text" style="position: absolute;top: 92px;" name="work_date3" id="work_date3">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 work lang  col-xs-6">
                                <div class="form-group">
                                    <label>İşlədiyi yer</label>
                                    <ul>
                                        <li>
                                            <label class="level">1</label>
                                            <input type="text" style="position: absolute;top: 32px;left: 37px;" name="work_place1" id="work_place1">
                                        </li>
                                        <li>
                                            <label class="level">2</label>
                                            <input type="text" style="position: absolute;top: 62px;" name="work_place2" id="work_place2">
                                        </li>
                                        <li>
                                            <label class="level">3</label>
                                            <input type="text" style="position: absolute;top: 92px;" name="work_place3" id="work_place3">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 work  lang  col-xs-6">
                                <div class="form-group">
                                    <label>Vəzifə</label>
                                    <ul>
                                        <li>
                                            <label class="level">1</label>
                                            <input type="text" style="position: absolute;top: 32px;left: 37px;" name="work_post1" id="work_post1">
                                        </li>
                                        <li>
                                            <label class="level">2</label>
                                            <input type="text" style="position: absolute;top: 62px;" name="work_post2" id="work_post2">
                                        </li>
                                        <li>
                                            <label class="level">3</label>
                                            <input type="text" style="position: absolute;top: 92px;" name="work_post3" id="work_post3">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 work  lang  col-xs-6">
                                <div class="form-group">
                                    <label>Əmək Haqqı</label>
                                    <ul>
                                        <li>
                                            <label class="level">1</label>
                                            <input type="text" style="position: absolute;top: 32px;left: 37px;" name="work_earn1" id="work_earn1">
                                        </li>
                                        <li>
                                            <label class="level">2</label>
                                            <input type="text" style="position: absolute;top: 62px;" name="work_earn2" id="work_earn2">
                                        </li>
                                        <li>
                                            <label class="level">3</label>
                                            <input type="text" style="position: absolute;top: 92px;" name="work_earn3" id="work_earn3">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 work  lang  col-xs-6">
                                <div class="form-group">
                                    <label>İşdən çıxma səbəbi</label>
                                    <ul>
                                        <li>
                                            <label class="level">1</label>
                                            <input type="text" style="position: absolute;top: 32px;left: 37px;" name="work_leave1" id="work_leave1">
                                        </li>
                                        <li>
                                            <label class="level">2</label>
                                            <input type="text" style="position: absolute;top: 62px;" name="work_leave2" id="work_leave2">
                                        </li>
                                        <li>
                                            <label class="level">3</label>
                                            <input type="text" style="position: absolute;top: 92px;" name="work_leave3" id="work_leave3">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="container">
                                <div class="col-sm-6">
                                    <label>Sonuncu iş yerinin əlaqə nömrəsi:
                                        <input type="text" style="height: 25px;" name="last_work_phone" id="last_work_phone">
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <label>Əlaqədar şəxsin adı:
                                        <input type="text" style="height: 25px;" name="last_work_name" id="last_work_name">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <!---Mezun oldugu ali tehsil muessesi--->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full travel">
                            <p class="input-bashliq">Səfərdə olduğu xarici ölkələr</p>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Ölkə</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_name1" id="country_name1"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_name2" id="country_name2"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_name3" id="country_name3"  >
                                </div>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Getdiyi tarix</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_go1" id="country_go1"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_go2" id="country_go2"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_go3" id="country_go3"  >
                                </div>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Qayıtdıxı tarix</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_return1" id="country_return1"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_return2" id="country_return2"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_return3" id="country_return3"  >
                                </div>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Getməkdə məqsəd</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_aim1" id="country_aim1"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_aim2" id="country_aim2"  >
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="country_aim3" id="country_aim3"  >
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full travel">
                            <p class="input-bashliq"></p>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Şirkət tərəfindən göndəriləcək ezamiyyətlərə edə bilərsinizmi?</label>
                                    <select name="can_trip" id="can_trip">
                                        <option value="Y">Bəli</option>
                                        <option value="N">Xeyr</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Bazar günləri iş günü elan olunmasına münasibətiniz</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="weekend_work" id="weekend_work"  >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Hobbiniz (Maraqlarınız)<br>
                                        <br>
                                    </label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="hobby" id="hobby"  >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Ailə vəziyyəti<br>
                                        <br>
                                    </label>
                                    <select class="form-control cins" name="family_status" id="family_status" >
                                        <option class="sechim" value="married">Evli</option>
                                        <option class="sechim" value="single">Subay</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full travel">
                            <p class="input-bashliq">Ailə üzvləri <i>(Adı, soyadı, atasının adı, təvəllüdü, doğulduğu yer, qeydiyyatda olduğu yer və işlədiyi yer göstərilməklə)</i></p>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Ata</label>
                                    <input type="text" value="" placeholder="SAA" class="form-control" autocapitalize="words" autofocus name="father_name" required="" >
                                    <input type="text" value="" placeholder="təvəllüdü" class="form-control" autocapitalize="words" autofocus name="father_birthdate"  >
                                    <input type="text" value="" placeholder="doğulduğu yer" class="form-control" autocapitalize="words" autofocus name="father_birthplace"  >
                                    <input type="text" value="" placeholder="qeydiyyatda olduğu yer" class="form-control" autocapitalize="words" autofocus name="father_register"  >
                                    <input type="text" value="" placeholder="işlədiyi yer " class="form-control" autocapitalize="words" autofocus name="father_work"  >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Ana</label>
                                    <input type="text" value="" placeholder="SAA" class="form-control" autocapitalize="words" autofocus name="mother_name" required="" >
                                    <input type="text" value="" placeholder="təvəllüdü" class="form-control" autocapitalize="words" autofocus name="mother_birthdate"  >
                                    <input type="text" value="" placeholder="doğulduğu yer" class="form-control" autocapitalize="words" autofocus name="mother_birthplace"  >
                                    <input type="text" value="" placeholder="qeydiyyatda olduğu yer" class="form-control" autocapitalize="words" autofocus name="mother_register"  >
                                    <input type="text" value="" placeholder="işlədiyi yer " class="form-control" autocapitalize="words" autofocus name="mother_work"  >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Qardaş</label>
                                    <input type="text" value="" placeholder="SAA" class="form-control" autocapitalize="words" autofocus name="br1_name"  >
                                    <input type="text" value="" placeholder="təvəllüdü" class="form-control" autocapitalize="words" autofocus name="br1_birthdate"  >
                                    <input type="text" value="" placeholder="doğulduğu yer" class="form-control" autocapitalize="words" autofocus name="br1_birthplace"  >
                                    <input type="text" value="" placeholder="qeydiyyatda olduğu yer" class="form-control" autocapitalize="words" autofocus name="br1_register"  >
                                    <input type="text" value="" placeholder="işlədiyi yer " class="form-control" autocapitalize="words" autofocus name="br1_work"  >
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Qardaş 2</label>
                                    <input type="text" value="" placeholder="SAA" class="form-control" autocapitalize="words" autofocus name="br2_name"  >
                                    <input type="text" value="" placeholder="təvəllüdü" class="form-control" autocapitalize="words" autofocus name="br2_birthdate"  >
                                    <input type="text" value="" placeholder="doğulduğu yer" class="form-control" autocapitalize="words" autofocus name="br2_birthplace"  >
                                    <input type="text" value="" placeholder="qeydiyyatda olduğu yer" class="form-control" autocapitalize="words" autofocus name="br2_register"  >
                                    <input type="text" value="" placeholder="işlədiyi yer " class="form-control" autocapitalize="words" autofocus name="br2_work"  >
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Bacı</label>
                                    <input type="text" value="" placeholder="SAA" class="form-control" autocapitalize="words" autofocus name="sis1_name" >
                                    <input type="text" value="" placeholder="təvəllüdü" class="form-control" autocapitalize="words" autofocus name="sis1_birthdate"  >
                                    <input type="text" value="" placeholder="doğulduğu yer" class="form-control" autocapitalize="words" autofocus name="sis1_birthplace"  >
                                    <input type="text" value="" placeholder="qeydiyyatda olduğu yer" class="form-control" autocapitalize="words" autofocus name="sis1_register"  >
                                    <input type="text" value="" placeholder="işlədiyi yer " class="form-control" autocapitalize="words" autofocus name="sis1_work"  >
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Bacı 2</label>
                                    <input type="text" value="" placeholder="SAA" class="form-control" autocapitalize="words" autofocus name="sis2_name"  >
                                    <input type="text" value="" placeholder="təvəllüdü" class="form-control" autocapitalize="words" autofocus name="sis2_birthdate"  >
                                    <input type="text" value="" placeholder="doğulduğu yer" class="form-control" autocapitalize="words" autofocus name="sis2_birthplace"  >
                                    <input type="text" value="" placeholder="qeydiyyatda olduğu yer" class="form-control" autocapitalize="words" autofocus name="sis2_register"  >
                                    <input type="text" value="" placeholder="işlədiyi yer " class="form-control" autocapitalize="words" autofocus name="sis2_work"  >
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Həyat yoldaşı</label>
                                    <input type="text" value="" placeholder="SAA" class="form-control" autocapitalize="words" autofocus name="hey_name"  >
                                    <input type="text" value="" placeholder="təvəllüdü" class="form-control" autocapitalize="words" autofocus name="hey_birthdate"  >
                                    <input type="text" value="" placeholder="doğulduğu yer" class="form-control" autocapitalize="words" autofocus name="hey_birthplace"  >
                                    <input type="text" value="" placeholder="qeydiyyatda olduğu yer" class="form-control" autocapitalize="words" autofocus name="hey_register"  >
                                    <input type="text" value="" placeholder="işlədiyi yer yer " class="form-control" autocapitalize="words" autofocus name="hey_work"  >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---Mezun oldugu ali tehsil muessesi--->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full travel">
                            <p class="input-bashliq"></p>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Özünüzü hansı işdə görürsünüz?</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="your_work" id="your_work"  style="margin-top: 30px;
">
                                </div>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Sizi işə nə bağlaya bilər?</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="work_close" id="work_close"  style="margin-top: 30px;
">
                                </div>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>Sizi qane edəcək əmək haqqı</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="want_earn" id="want_earn"  style="margin-top: 30px;
">
                                </div>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="form-group">
                                    <label>"ZeferanHospital" necə və kimin vasitəsilə müraciət etmisiniz?</label>
                                    <input type="text" value="" placeholder="" class="form-control" autocapitalize="words" autofocus name="contacter" id="contacter"   >
                                </div>
                            </div>
                        </div>
                        <!--col-sm-12-->
                    </div>
                    <!--box-->
                </div>
                <!--col-sm-12-->
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="box full additional">
                            <p class="input-bashliq">Əlavə məlumatlar</p>
                            <div class="col-sm-11">
                                <textarea class="form-control" placeholer="" name="add_info" id="add_info"></textarea >
                                <p class="more">Ətraflı cavablandırmağınızı xahiş edirik.</p>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-danger" type="submit" name="do_send">Göndər</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--full üidth-->
    </div>
    <input type="hidden" name="module"  value="vacation" />
    <input type="hidden" name="vacationId" value="<?php echo intval($_GET['vacation']); ?>" />
    <input type="hidden" name="action"   value="do_send_vacation"/>
</form>


</div>

<?php require APPROOT . '/views/inc/footer.php';    ?>
