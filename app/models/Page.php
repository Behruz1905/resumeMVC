<?php


class Page
{





    private $db;

    protected  $sql = "SELECT   vacationId,vacationTitle,vacationDesc,
                                        vacationDate,vacationStatus,vacationType,salary,requirements,
                                     	city,min_age,max_age,tehsil,related_person,phone_person,email_person,
                                     	department, working_time,
                                        experience, DATE_FORMAT(start_date, '%b') as start_date_month,
                                     	DATE_FORMAT(start_date, '%e, %Y' ) as start_date ,DATE_FORMAT(end_date, '%b') as end_date_month,
                                     	DATE_FORMAT(end_date, '%e, %Y' ) as end_date,rate
                                     FROM vacations";



    public function __construct()
    {
        $this->db = new Database;
    }




    public function  getSearchValueByParams($is_yeri, $vezife, $region)
    {

        $this->sql .= " WHERE vacationStatus = 'A'";

        if (!empty($is_yeri)) {
            $this->sql .= " AND city like '%".$is_yeri."%'";
        }

        if(!empty($vezife)) {

            $this->sql .= " AND vacationTitle like '%".$vezife."%'";
        }

        if(!empty($region)) {

            $this->sql .= " AND city like '%".$region."%'";
        }



        $this->db->query($this->sql);
        $results =  $this->db->resultSet();

        return $results;

    }




}