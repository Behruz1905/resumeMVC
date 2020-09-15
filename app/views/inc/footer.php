
<?php

   $data['saytParams'];
?>
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="footer-area-in">
                    <div class="zeferanLogo"><img src="<?php echo URLROOT; ?>/img/logo.png"></div>
                    <ul class="list-inline">
                        <li><a href="">Ana səhifə</a></li>
                        <li><a href="">Vakansiyalar</a></li>
                        <li><a href="">Necə müracət etməli?</a></li>
                        <li><a href="">Haqqımızda</a></li>
                        <li><a href="">Əlaqə</a></li>
                    </ul>
                    <address>
                        <strong>Baş ofis: <?=$site_params['main_address']?></strong><br>
                        <abbr title="Phone">Tel: <abbr> <?=$site_params['main_phone']?>,  <a href="mailto:#">E-mail: <?=$site_params['main_email']?></a>
                    </address>
                </div>
            </div>
        </div>
    </div>
</footer>

<footer class="footer-bootom-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="copyright"><p>Copyright ©Zəfəran.az 2018.All right reserved.Created by “Azerimed” MMC</p></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="sosial list-inline text-right">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--end Wrapper Jobs-->

<script>
    $(document).ready(function(){

        var datas = window.localStorage.getItem('errors');

        if(datas){

            setProgressBar(1);
            $("#esas").css({ display: "block" });
            datas = JSON.parse(datas);
            console.log(datas);
            $.each(datas, function(i, obj){
                $('#esas').append($('<li>').text(obj));
            });

            setTimeout(function(){
                $("#esas").hide();
                window.localStorage.removeItem('errors');
            }, 5000);
        }
            var successData = window.localStorage.getItem('successData');
            successData = JSON.parse(successData);
            if(successData){
                var dataSuccess = successData.message;

                if(dataSuccess.trim() !="" ){
                    $(".progress-bar").hide();
                    $("#esas_success").css({ display: "block" });


                    $.each(successData, function(i, obj){
                        $('#esas_success').append($('<h2 class="text-justify">').text(obj));
                    });

                    setTimeout(function(){
                        $("#esas_success").hide();
                        window.localStorage.removeItem('successData');
                    }, 5000);

                }


            }




        var stepkec = true;
        var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
        $( "#1_step" ).click(function() {
            //alert( "Handler for .click() called." );

            current_step = $(this).parent();
            next_step = $(this).parent().next();

            if($('input[name="ad"]').val() == ""){
                $('input[name="ad"]').closest('.parent').children('.invalid-feedback').html('<span style="color:red">Ad bos ola bilmez</span>' );
                $('input[name="ad"]').css("border", "1px solid red");
                stepkec = false;
                next_step.hide();
                current_step.show();
            }else{
                $('input[name="ad"]').closest('.parent').children('.invalid-feedback').html('' );
                $('input[name="ad"]').css("border", "0.5px solid #cccccc");
                stepkec = true;
            }

            if($('input[name="soyad"]').val() == ""){
                $('input[name="soyad"]').closest('.parent').children('.invalid-feedback').html('<span style="color:red">Soyad bos ola bilmez</span>' );
                $('input[name="soyad"]').css("border", "1px solid red");
                stepkec = false;
                next_step.hide();
                current_step.show();
            }else{
                $('input[name="soyad"]').closest('.parent').children('.invalid-feedback').html('' );
                $('input[name="soyad"]').css("border", "0.5px solid #cccccc");
                stepkec = true;
            }

            if(stepkec){
                next_step.show();
                current_step.hide();
                setProgressBar(++current);
            }

        });

        $( "#2_step" ).click(function() {
            //alert( "Handler for .click() called." );

            current_step = $(this).parent();
            next_step = $(this).parent().next();


            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $( "#3_step" ).click(function() {
            //alert( "Handler for .click() called." );

            current_step = $(this).parent();
            next_step = $(this).parent().next();

            if($('input[name="school_name"]').val() == ""){
                $('input[name="school_name"]').closest('.parent').children('.invalid-feedback').html('<span style="color:red">Mekteb secilmedi!</span>' );
                $('input[name="school_name"]').css("border", "1px solid red");
                stepkec = false;
                next_step.hide();
                current_step.show();
            }else{
                $('input[name="school_name"]').closest('.parent').children('.invalid-feedback').html('' );
                $('input[name="school_name"]').css("border", "0.5px solid #cccccc");
                stepkec = true;
            }

            if(stepkec){
                next_step.show();
                current_step.hide();
                setProgressBar(++current);
            }

        });

        //
        $("#4_step").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().next();


            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });

        $("#5_step").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().next();


            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });

        $("#6_step").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().next();


            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });

        $("#7_step").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().next();

            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });






        $(".previous").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width",percent+"%")
                .html(percent+"%");
        }
    });


    $('#cvcreate_form').on('submit',function (e) {

        e.preventDefault();
        var frm = $('#cvcreate_form');
        var formData = new FormData(this);
       // formData.append("data", frm.serialize());

        //var result = confirm("Statusu deyismek istediyinizden eminsiniz?");
        //console.log($('#cvcreate_form').serialize());
            $.ajax({
                url: frm.attr('action'),
                type: "POST",
                data: formData,
                dataType:'json',
                contentType:false,
                cache: false,
                processData: false,
                success: function (msg) {
                    var succ = msg.success;
                    var err = msg.error;
                    var arrE = Object.values(err); //arraya cevirdim
                    var areAllNull  = arrE.every(function(i) { return i === ''; });

                    if(!areAllNull){
                        window.localStorage.setItem('errors', JSON.stringify(err));
                        location.reload();
                    }
                    if(succ){
                        window.localStorage.setItem('successData', JSON.stringify(succ));
                        location.reload();
                    }
                }
            });

    });














//
   var month_obj = {
       Jan: "Yanvar",
       Feb: "Fevral",
       Mar: "Mart",
       Apr: "Aprel",
       May: "May",
       Jun: "İyun",
       Jul: "İyul",
       Aug: "Avqust",
       Sep: "Sentyabr",
       Oct: "Oktyabr",
       Nov: "Noyabr",
       Dec: "Dekabr"
   }




                        $('#searchvacancy').keyup(function(e) {

                            console.log( $('#searchvacancy').val());
                            clearTimeout($.data(this, 'timer'));
                            if (e.keyCode == 13)
                                search(true);
                            else
                                $(this).data('timer', setTimeout(search, 500));
                        });


                       var url = '/resume2/vacancies/search';
                       var url2 = '/resume2/vacancies/searchByParams';

                        function search(force) {
                            var existingString = $("#searchvacancy").val();
                            if (!force && existingString.length < 3) return; //wasn't enter, not > 2 char
                            $.post( url, { name: existingString} )
                                .done(function( data ) {

                                    data =JSON.parse(data);

                                     console.log(data);
                                    $( "#myJoblist" ).empty();

                                     if(data.length == 0) {
                                         $('#myJoblist').append('<div>').text("Axtarışa uyğun vakansiya tapılmadı").addClass( "text-center");
                                     }else{


                                         var monS;
                                         var monE;
                                         $.each(data, function(i, obj){

                                             monS = obj.start_date_month;
                                             monE = obj.end_date_month;
                                             console.log(typeof monS);
                                             //$('#myJoblist').append($('<li>').append($('<div>').append($('<div>').append($('<a>').append('<img>')))));

                                             $('#myJoblist').append(' <li>\n' +
                                                 '                                        <div class="box">\n' +
                                                 '                                            <div class="thumb"><a href=""><img src="img/logoJob.png" alt=""></a></div>\n' +
                                                 '                                            <div class="jobs_text">\n' +
                                                 '                                                <h4><a href="#">'+ obj.vacationTitle + '</a></h4>\n' +
                                                 '                                                <p>'+ obj.department +'</p>\n' +
                                                 '                                                <a href="#" class="job_into_text"><i class="fa fa-map-marker"></i>'+ obj.city +'</a>\n' +
                                                 '                                                <a href="#" class="job_into_text"><i class="fa fa-calendar"></i>'+ month_obj[monS] + ' '+ obj.start_date + ' - ' + month_obj[monE] + ' ' + obj.end_date + '</a>\n' +
                                                 '                                            </div>\n' +
                                                 '                                            <strong class="job_price">'+ obj.salary +' Azn</strong>\n' +
                                                 '                                            <a href="<?= URLROOT; ?>/vacancies/?vacnum='+(obj.vacationId *12345678) +'&vactitle='+ encodeURIComponent(obj.vacationTitle)+'" class="btnPart red"> '+ obj.working_time + '</a>\n' +
                                                 '                                        </div>\n' +
                                                 '                                    </li>'

                                             )
                                         });



                                     }

                        }, "json").fail(console.log("Xeta bas verdi!"));;

                        }



                        function filterDataByDerscription() {

                                var dates= [];
                                var descs =[];

                                var city = $('#cities').val();
                                //console.log(city);

                                $('#searchbydate').find('input[type=checkbox]:checked').each(function(i){
                                    dates[i] = $(this).val();
                                });

                                $('#searchbydesc').find('input[type=checkbox]:checked').each(function(i){
                                    descs[i] = $(this).val();
                                });

                               // console.log(dates);
                               // console.log(descs);
                               // console.log(city);
                                $.post( url2, { dates: dates, descs: descs, city: city} )
                                    .done(function( data ) {
                                        //console.log(data);
                                       data = JSON.parse(data);

                                        console.log(data);

                                        $( "#myJoblist" ).empty();

                                        if(data.length == 0) {
                                            $('#myJoblist').append('<div>').text("Axtarışa uyğun vakansiya tapılmadı").addClass( "text-center");
                                        }else{
                                            var monS;
                                            var monE;
                                            $.each(data, function(i, obj){

                                                monS = obj.start_date_month;
                                                monE = obj.end_date_month;
                                                // console.log(typeof monS);
                                                //$('#myJoblist').append($('<li>').append($('<div>').append($('<div>').append($('<a>').append('<img>')))));

                                                $('#myJoblist').append(' <li>\n' +
                                                    '                                        <div class="box">\n' +
                                                    '                                            <div class="thumb"><a href=""><img src="img/logoJob.png" alt=""></a></div>\n' +
                                                    '                                            <div class="jobs_text">\n' +
                                                    '                                                <h4><a href="#">'+ obj.vacationTitle + '</a></h4>\n' +
                                                    '                                                <p>'+ obj.department +'</p>\n' +
                                                    '                                                <a href="#" class="job_into_text"><i class="fa fa-map-marker"></i>'+ obj.city +'</a>\n' +
                                                    '                                                <a href="#" class="job_into_text"><i class="fa fa-calendar"></i>'+ month_obj[monS] + ' '+ obj.start_date + ' - ' + month_obj[monE] + ' ' + obj.end_date + '</a>\n' +
                                                    '                                            </div>\n' +
                                                    '                                            <strong class="job_price">'+ obj.salary +' Azn</strong>\n' +
                                                    '                                            <a href="<?= URLROOT; ?>/vacancies/?vacnum='+(obj.vacationId*12345678)+'&vactitle='+ encodeURIComponent(obj.vacationTitle)+'" class="btnPart red"> '+ obj.working_time + '</a>\n' +
                                                    '                                        </div>\n' +
                                                    '                                    </li>'

                                                )
                                            });



                                        }







                                    }, "json").fail(console.log("ayyyyyyyyyy"));

                            };








$(document).ready(function() {
    var i = 1;
    $('#dinamic_field_add').click(function () {
        i++;
        $('#dynamic_field').append('<div id="row'+i+'" class="form-group">\n' +
            '                        <div class="row">\n' +
            '                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">\n' +
            '                                <label>Müəssisənin adı </label><br>\n' +
            '                                <input type="text" id="muessise_adi'+i+'" class="def-input" class="job" name="muessise_adi[]">\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">\n' +
            '                                <label>İşlədiyiniz müddət </label><br>\n' +
            '                                <input type="date" id="work_time'+i+'" class="def-input" class="job" name="work_time[]">\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">\n' +
            '                                <label>Vəzifə </label><br>\n' +
            '                                <input type="text" id="muessise_vezife'+i+'" class="def-input" class="job" name="muessise_vezife[]">\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">\n' +
            '                                <label>Əmək haqqı</label><br>\n' +
            '                                <input type="text" id="muessise_emekh'+i+'" class="def-input" class="job" name="muessise_emekh[]">\n' +
            '                            </div>\n' +
            '                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">\n' +
            '                                <label>İşdən çıxma səbəbi</label><br>\n' +
            '                                <input type="text" id="muessise_reason_quit'+i+'" class="def-input" class="job" name="muessise_reason_quit[]">\n' +
            '                            </div>\n' +

            '                           <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">\n' +
             '                          <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" style="margin-top: 25px;">x</button>\n' +
              '                          </div>\n'+
            '                        </div>\n' +
            '                    </div>\n');
    });


    //elementi silmek ucun
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });




});



function show_vacation(id){
    var url = "/resume2/vacancies/sendVacation/?vacation="+id;
    var params = "resizable=yes,scrollbars=yes,status=yes,width=990"
    window.open(url, "Vakansiya", params)

}





</script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
-->
</body>
</html>