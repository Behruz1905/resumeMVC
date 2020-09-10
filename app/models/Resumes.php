<?php


class Resumes
{
    public function __construct()
    {
        $this->db = new Database;
    }


    public function createResume($data)
    {
        $val = '';
        $this->db->query('INSERT INTO cvs (cvName,cvPhoto,gender,bday,bplace,partiya,military,nationality,phone) 
                                VALUES(:name,:cvPhoto,:gender,:bday,:bplace,:partiya,:military,:nationality,:tel_mob)');
        //Bind values
        $this->db->bind(':name', $data['ad']." ".$data['soyad']." ".$data['ata_adi']);
        $this->db->bind(':cvPhoto', $data['photo_cv']);
        $this->db->bind(':gender', $data['cins']);
        $this->db->bind(':bday', $data['bday']);
        $this->db->bind(':bplace', $data['bplace']);
        $this->db->bind(':partiya', $data['partiya']);
        $this->db->bind(':military', $data['military']);
        $this->db->bind(':nationality', $data['nationality']);
        $this->db->bind(':tel_mob', $data['tel_mob']);

        $this->db->conn()->beginTransaction();

        /* Change the database schema and data */

        /* Recognize mistake and roll back changes */



        //Execute
        if($this->db->execute()){

            $lastCvId = $this->db->conn()->lastInsertId();

            $this->db->query('INSERT INTO cv_experience (cvId,is_yeri,is_muddet,position,salary,reason_quit) 
                                VALUES(:cvId, :is_yeri, :is_muddet,:position,:salary,:reason_quit)');
            $say = count($data['tecrube']['muessise']);

            for($i=0;$i < $say; $i++){
                $this->db->bind(':cvId', $lastCvId);
                $this->db->bind(':is_yeri', $data['tecrube']['muessise'][$i]);
                $this->db->bind(':is_muddet',$data['tecrube']['muddet'][$i]);
                $this->db->bind(':position', $data['tecrube']['vezife'][$i]);
                $this->db->bind(':salary', $data['tecrube']['maas'][$i]);
                $this->db->bind(':reason_quit', $data['tecrube']['sebeb'][$i]);
                if($this->db->execute()){
                    $val = true;
                }else{
                    $val = false;
                }
            }

            $this->db->query('INSERT INTO cv_education (cvId,school_name,start_school,end_school,uni_name,uni_faculty,speciality,uni_start,uni_end,az_oxumaq,az_yazmaq,az_danismaq,ru_oxumaq,ru_yazmaq,ru_danismaq,en_oxumaq,en_yazmaq,en_danismaq,proqram1,proqram1_level,proqram2,proqram2_level) 
                                VALUES(:cvId, :school_name,:start_school,:end_school,:uni_name,:uni_faculty,:speciality,:uni_start,:uni_end,:az_oxumaq,:az_yazmaq,:az_danismaq,:ru_oxumaq,:ru_yazmaq,:ru_danismaq,:en_oxumaq,:en_yazmaq,:en_danismaq,:proqram1,:proqram1_level,:proqram2,:proqram2_level)');

            $this->db->bind(':cvId', $lastCvId);
            $this->db->bind(':school_name', $data['school_name']);
            $this->db->bind(':start_school', $data['start_school']);
            $this->db->bind(':end_school', $data['end_school']);
            $this->db->bind(':uni_name', $data['uni_name']);
            $this->db->bind(':uni_faculty', $data['uni_faculty']);
            $this->db->bind(':speciality', $data['profession_name']);
            $this->db->bind(':uni_start', $data['uni_start']);
            $this->db->bind(':uni_end', $data['uni_end']);
            $this->db->bind(':az_oxumaq', $data['az_dili_oxu']);
            $this->db->bind(':az_yazmaq', $data['az_dili_yaz']);
            $this->db->bind(':az_danismaq', $data['az_dili_danis']);
            $this->db->bind(':ru_oxumaq', $data['rus_dili_oxu']);
            $this->db->bind(':ru_yazmaq', $data['rus_dili_yaz']);
            $this->db->bind(':ru_danismaq', $data['rus_dili_danis']);
            $this->db->bind(':en_oxumaq', $data['ing_dili_oxu']);
            $this->db->bind(':en_yazmaq', $data['ing_dili_yaz']);
            $this->db->bind(':en_danismaq', $data['ing_dili_danis']);
            $this->db->bind(':proqram1', $data['proqram_adi']);
            $this->db->bind(':proqram1_level', $data['proqram1_level']);
            $this->db->bind(':proqram2', $data['proqram2_adi']);
            $this->db->bind(':proqram2_level', $data['proqram2_level']);


            if($this->db->execute()){
                $val = true;
                $this->db->conn()->commit();
            }else{
                $val = false;
            }


        }else{
            $val = false;
        }


        if(!$val){
            $this->db->conn()->rollBack();
            return false;
        }




        return true;


    }




}