<?php

    class Pages extends Controller {


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

            $data['searchparam'] ='';

            if(isset($_GET['form_submitted'])){

                if(!empty($_GET['is_yeri']) || !empty($_GET['vezife'])  || !empty($_GET['region'])) {
                    $is_yeri = $_GET['is_yeri'];
                    $is_yeri = preg_replace("#[^0-9a-zA-Z]#i","",$is_yeri);

                    $vezife = $_GET['vezife'];
                    $vezife = preg_replace("#[^0-9a-zA-Z]#i","",$vezife);

                    $region = $_GET['region'];
                    $region = preg_replace("#[^0-9a-zA-Z]#i","",$region);

                    $data['searchparam'] = $this->model('Page')->getSearchValueByParams($is_yeri, $vezife, $region );

                }



            }




            $data['menu'] = $this->menus;
            $data['saytParams'] = $this->saytParams;
            $data['lastVacancies'] = $this->model('Vacancy')->getLastVacancies();

            $this->view('pages/index',$data);
        }


        public function vacancies()
        {
            $data['menu'] = $this->menus;
            $this->view('pages/vacancies', $data);
        }

        public function errorPage()
        {
            $this->view('pages/404');
        }
  
    }





?>