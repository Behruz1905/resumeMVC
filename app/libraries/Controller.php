<?php
/*
*
*Base Controller
*Models ve Viewlari yuleyirik
*/
class Controller {
    //Load Model
    public function model($model) 
    {
        //Reqwuire model file
        require_once '../app/models/' . $model.  '.php';

        //Instantiate model
        return new $model();
    }

    // load view
    public function view($view, $data = [])
    {
        //Check view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        }else{
            //view movcud deyil
            die('View movcud deyil');
        }
    }


}




?>