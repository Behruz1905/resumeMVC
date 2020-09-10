<?php


class Vacancy
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

    public function getVacancies()
    {
        $this->db->query($this->sql);

        $results = $this->db->resultSet();

        return $results;
    }


    public  function  getVacancy($id)
    {

        $this->sql .= " WHERE vacationId = {$id}";

        $this->db->query($this->sql);

        $result = $this->db->single();

        return $result;

    }


    public function getLastVacancies()
    {
        $this->sql .= " ORDER BY vacationdate DESC LIMIT 3";

        $this->db->query($this->sql);

        $results = $this->db->resultSet();

        return $results;
    }


    public function getSearchValue($search_data)
    {

        if (!empty($search_data)) {
            $this->sql .= " WHERE vacationTitle LIKE "
                .array_shift($search_data) // remove first element from array
                .implode(" OR  LIKE ", $search_data); // implode rests with 'OR'
        }

        $this->db->query($this->sql);
        $results =  $this->db->resultSet();

        return $results;

    }



    public function  getSearchValueByParams($city, $dates = null, $descs = null)
    {

            $this->sql .= " WHERE vacationStatus = 'A'";

            if (!empty($city)) {
               $this->sql .= " AND city ='$city'";
            }

            if(!empty($descs)) {

                $descs =  "'" . implode("','", $descs) . "'";

                $this->sql .= " AND  working_time  IN ($descs)";
            }


            if(! empty($dates)) {

                $this->sql .= ' AND ( ';
                  for($i = 0; $i < count($dates); $i ++){
                      if($dates[$i] == 'today'){
                          if($dates[0] == 'today'){
                              $this->sql .=  ' Date(vacationDate)= CURDATE()';
                          }else{
                              $this->sql .=  ' OR Date(vacationDate)= CURDATE()';
                          }

                      }

                      if($dates[$i] == 'week'){

                          if($dates[0] == 'week'){
                              $this->sql .=  ' YEARWEEK(vacationDate)= YEARWEEK(CURDATE())';
                          }else{
                              $this->sql .=  ' OR YEARWEEK(vacationDate)= YEARWEEK(CURDATE())';
                          }

                      }

                      if($dates[$i] == 'month'){

                          if($dates[0] == 'month'){
                              $this->sql .=  '  (Year(vacationDate)=Year(CURDATE()) AND Month(vacationDate)= Month(CURDATE()))';
                          }else{
                              $this->sql .=  ' OR (Year(vacationDate)=Year(CURDATE()) AND Month(vacationDate)= Month(CURDATE()))';
                          }

                      }
                  }

                $this->sql .= ' ) ';
            }

            $this->db->query($this->sql);
            $results =  $this->db->resultSet();

            return $results;

    }




}