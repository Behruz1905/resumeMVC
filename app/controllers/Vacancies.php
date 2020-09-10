<?php


class Vacancies extends Controller
{

    private $menus;

    private $saytParams;

    public function __construct()
    {
        $this->menus = $this->model('Post')->getMenus();
        $this->saytParams = $this->model('Post')->getSaytParams();
    }

    public function index()
    {
        $data = array();
        $data['vacancy']= '';

        $data['menu'] = $this->menus;
        $data['saytParams'] = $this->saytParams;

        if(isset($_GET)){
            print_r($_GET);
            if(!empty($_GET['vacnum'])){
                $vacId = intval($_GET['vacnum']);
                $vacId = ($vacId/12345678);


                $data['vacancy'] = $this->model('Vacancy')->getVacancy($vacId);

                if(!$data['vacancy']){
                    header('Location: /resume2/vacancies/item-not-found');
                }

            }
        }


        $data['vacancies'] = $this->model('Vacancy')->getVacancies();



        $this->view('pages/vacancies',$data);
    }


    public function search()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $search_data = [];

            foreach($_POST as  $question) {
                $search_data[] = "'%".trim($question)."%'";
            }


            $data = $this->model('Vacancy')->getSearchValue($search_data);

            $data = json_encode($data);

            $data = json_decode($data,TRUE);
            echo json_encode($data);
        }


    }


    public function searchByParams()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $city = trim($_POST['city']);

            $dates =  (isset($_POST['dates'])) ? $_POST['dates'] : "";
            $descs = (isset($_POST['descs'])) ? $_POST['descs'] : "";





            $data = $this->model('Vacancy')->getSearchValueByParams($city,$dates,$descs);

            echo json_encode($data);
            $data = json_encode($data);

            $data = json_decode($data,TRUE);


        }


    }

    public function sendVacation()
    {
        //if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->view('pages/sendVacation');
       // }

    }

    public function errorPage()
    {
        $this->view('pages/404');
    }

}