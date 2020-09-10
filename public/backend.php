<?php


$data = array();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $forma = false;
    $adErr =$soyadErr= $papnameErr= $tevelludErr = $captchaErr = "";
    $name = $email = $subject = $message =  "";
    $val = true;

    $error = [
        'imgFile' => '',
        'ad' => '',
        'soyad' => '',
        'ata_adi' => '',
        'bday' => '',
        'bplace' => '',
        'partiya' => '',
        'military' => '',
        'nationality' => '',
        'tel_mob' => '',
        'phone_family' => '',
        'living_adress' => '',
        'qeydiyyat_adress' => '',
        'school_name' => '',
        'school_start' => '',
        'school_end' => '',
        'prqram_adi' => '',
        'person_info' => '',
        'accept_all' => '',
    ];
    //Sanitize post data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



    if($_FILES["imgFile"]["name"] == '') {
        $error['imgFile'] = "CV üçün şəkil seçilmədi!";
    }else {
        $fload = $_FILES["imgFile"]["name"];
        $file_loc = $_FILES['imgFile']['tmp_name'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/resume2/public/img/cvs/";
        $target_file = $target_dir . basename($_FILES["imgFile"]["name"]);

        if(file_exists($target_file)){

            $fload = rand(10,10000). "_".$_FILES["imgFile"]["name"];

            $target_file = $target_dir . basename($fload);
        }

        if ($_FILES['imgFile']['size'] > 1000000) {
            $error['imgFile'] = "Faylın ölçüsü böyükdür";
            $uploadOk = false;
            $val = false;
        } else {

            $allowed = array('jpg', 'png','JPG','PNG','JPEG','jpeg');
            $ext = pathinfo($fload, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $error['imgFile'] = "Bu fayl tipi uyğun deyil,zəhmət olmazsa Şəkil formatı seçin";
                $uploadOk = false;
                $val = false;
            } else {

                if (move_uploaded_file($file_loc, $target_file)) {
                    $data['photo_cv'] = basename($fload);
                }
            }
        }
    }


    if (empty($_POST["ad"])) {
        $error['ad'] = "Ad qeyd olunmayıb";
        $val = false;
    } else {
        $data['ad'] = SqlInjectFilter($_POST["ad"]);
    }

    if (empty($_POST["soyad"])) {
        $error['soyad'] = "Soyad qeyd olunmayıb";
        $val = false;
    } else {
        $data['soyad'] = SqlInjectFilter($_POST["soyad"]);
    }

    if (empty($_POST["ata_adi"])) {
        $error['ata_adi'] = "Ata adi qeyd olunmayıb";
        $val = false;
    } else {
        $data['ata_adi'] = SqlInjectFilter($_POST["ata_adi"]);
    }

    if (empty($_POST["bday"])) {
        $error['bday'] = "Dogum gunu qeyd olunmayıb";
        $val = false;
    } else {
        $data['bday'] = SqlInjectFilter($_POST["bday"]);
    }

    if (empty($_POST["bplace"])) {
        $error['bplace'] = "Dogum gunu unvani qeyd olunmayıb";
        $val = false;
    } else {
        $data['bplace'] = SqlInjectFilter($_POST["bplace"]);
    }

    if (empty($_POST["partiya"])) {
        $error['partiya'] = "Partiya qeyd olunmayıb";
        $val = false;
    } else {
        $data['partiya'] = SqlInjectFilter($_POST["partiya"]);
    }

    if (empty($_POST["military"])) {
        $error['military'] = "Secim etmediniz";
        $val = false;
    } else {
        $data['military'] = SqlInjectFilter($_POST["military"]);
    }



    if (empty($_POST["tel_mob"])) {
        $error['tel_mob'] = "Telefon qeyd olunmayıb";
        $val = false;
    } else {

        $regex =  "/^[\d\s]+$/";

        if(!preg_match($regex,$_POST['tel_mob'])){
            $error['tel_mob'] = "Yalnış telefon formatı!";
            $val = false;
        }else{
            $data['tel_mob'] = SqlInjectFilter($_POST["tel_mob"]);
        }

    }

    $tecrube = array();
    $number = count($_POST["muessise_adi"]);

    //  if($number > 1) {
    for($i=0; $i < $number; $i++){
        if(trim($_POST['muessise_adi'][$i] !='') || trim($_POST['work_time'][$i] !='') || trim($_POST['muessise_vezife'][$i] !='' )
            || trim($_POST['muessise_emekh'][$i] !='') || trim($_POST['muessise_reason_quit'][$i] !='')
        ){
            $tecrube['muessise'][$i] = $_POST['muessise_adi'][$i];
            $tecrube['muddet'][$i] = $_POST['work_time'][$i];
            $tecrube['vezife'][$i] = $_POST['muessise_vezife'][$i];
            $tecrube['maas'][$i] = $_POST['muessise_emekh'][$i];
            $tecrube['sebeb'][$i] = $_POST['muessise_reason_quit'][$i];

        }
    }
    // }

    $data['tecrube'] = $tecrube;


    if (empty($_POST["school_name"])) {
        $error['school_name'] = "Xana bos ola bilmez";
        $val = false;
    } else {
        $data['school_name'] = SqlInjectFilter($_POST["school_name"]);
    }


    if (empty($_POST["school_start"])) {
        $error['school_start'] = "Xana bos ola bilmez";
        $val = false;
    } else {
        $data['school_start'] = SqlInjectFilter($_POST["school_name"]);
    }


    if (empty($_POST["school_end"])) {
        $error['school_end'] = "Xana bos ola bilmez";
        $val = false;
    } else {
        $data['school_end'] = SqlInjectFilter($_POST["school_end"]);
    }



    if (! empty($_POST["uni_name"])) {
        $data['uni_name'] = SqlInjectFilter($_POST["uni_name"]);
    }


    if (! empty($_POST["profession_name"])) {
        $data['profession_name'] = SqlInjectFilter($_POST["profession_name"]);
    }



    if (! empty($_POST["uni_start_date"])) {
        $data['uni_start_date'] = SqlInjectFilter($_POST["uni_start_date"]);
    }

    if (! empty($_POST["uni_start_date"])) {
        $data['uni_start_date'] = SqlInjectFilter($_POST["uni_start_date"]);
    }


    $data['az_dili_oxu'] = SqlInjectFilter($_POST["az_dili_oxu"]);
    $data['az_dili_yaz'] = SqlInjectFilter($_POST["az_dili_yaz"]);
    $data['az_dili_danis'] = SqlInjectFilter($_POST["az_dili_danis"]);
    $data['rus_dili_oxu'] = SqlInjectFilter($_POST["rus_dili_oxu"]);
    $data['rus_dili_yaz'] = SqlInjectFilter($_POST["rus_dili_yaz"]);
    $data['rus_dili_danis'] = SqlInjectFilter($_POST["rus_dili_danis"]);
    $data['ing_dili_oxu'] = SqlInjectFilter($_POST["ing_dili_oxu"]);
    $data['ing_dili_yaz'] = SqlInjectFilter($_POST["ing_dili_yaz"]);
    $data['ing_dili_danis'] = SqlInjectFilter($_POST["ing_dili_danis"]);

    $data['proqram_adi'] = SqlInjectFilter($_POST["proqram_adi"]);
    $data['proqram1_level'] = SqlInjectFilter($_POST["proqram1_level"]);

    $data['proqram2_adi'] = SqlInjectFilter($_POST["proqram2_adi"]);
    $data['proqram2_level'] = SqlInjectFilter($_POST["proqram2_level"]);




    $data['father'] = SqlInjectFilter($_POST["father"]);
    $data['mother'] = SqlInjectFilter($_POST["mother"]);
    $data['brother'] = SqlInjectFilter($_POST["brother"]);
    $data['sister'] = SqlInjectFilter($_POST["sister"]);
    $data['partner'] = SqlInjectFilter($_POST["partner"]);
    $data['person_info'] = SqlInjectFilter($_POST["person_info"]);

    if (empty($_POST["accept_all"])) {
        $error['accept_all'] = "Sertleri qebul etdiyinizi tesdiqleyin";
        $val = false;
    }




    $data['cins'] = $_POST['cins'];



    if($val){
        //sleep(4);
        if($this->model('Resumes')->createResume($data)){
            //flash('register_success', 'Siz ugurla qeydiyyatdan kecdiniz Giris ede bilersiniz');
            //redirect
            // redirect('/');
            echo "databaseye yazildi";
        }else {
            die('Something went wrong');
        }
    }


}


$data['menu'] = $this->menus;
$data['saytParams'] = $this->saytParams;
$data['error']=  $error;
echo $data;
