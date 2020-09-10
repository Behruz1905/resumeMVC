<?php

class Users  extends Controller {

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form
           
            //Sanitize post data 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_pass_err' => ''

            ];

            // Validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Email daxil edilmədi!';
            }else {
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email artiq movcuddur!';
                }
            }

            //valdiate name
            if(empty($data['name'])){
                $data['name_err'] = 'Ad daxil edilmədi!';
            }

             //valdiate password
             if(empty($data['password'])){
                $data['password_err'] = 'Shifre daxil edilmədi!';
            }elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Shifre en az 6 simvol olmalidi';
            }

             //valdiate password
             if(empty($data['confirm_password'])){
                $data['confirm_pass_err'] = 'Shifre tesdiqlenme daxil edilmədi!';
            }else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_pass_err'] = 'Shifreler eynilesmedi';
                }
            }


            // Errorlarin olmadigindan emin ol
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_pass_err'])){
                //validated
                
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user
                if($this->userModel->register($data)){
                    flash('register_success', 'Siz ugurla qeydiyyatdan kecdiniz Giris ede bilersiniz');
                    //redirect
                    redirect('users/login');


                }else {
                    die('Something went wrong');
                }
            } else{
                //Load view
                $this->view('users/register', $data);
            }


        }else{
            //Load form 
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_pass_err' => ''

            ];
            
            //load view
            $this->view('users/register', $data);
        }
    }


    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

              //Sanitize post data 
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                
                  'email' => trim($_POST['email']),
                  'password' => trim($_POST['password']),
                  'email_err' => '',
                  'password_err' => '',
              ];

                 // Validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Email daxil edilmədi!';
            }

               //valdiate password
            if(empty($data['password'])){
                $data['password_err'] = 'Shifre daxil edilmədi!';
            }

            //Ceck user email
            if($this->userModel->findUserByEmail($data['email'])){
                //user found


            }else{
                $data['email_err'] = 'Bele istifadeci tapilamdi';
            }

            // Emin olduqdan sonraki butun xanalar daxil edildi..
            if(empty($data['email_err']) && empty($data['password_err'])) {
                //validated
                // check user logged in
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    //Create session
                   $this->createUserSession($loggedInUser);

                }else {
                    $data['password_err'] = 'Şifrə düzgün deyil';
                    $this->view('users/login', $data);
                }
            } else{
                //Load view
                $this->view('users/login', $data);
            }

            
            // process form
        }else{
            //Load form 
            $data = [
               
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            
            //load view
            $this->view('users/login', $data);
        }
    }



    public function createUserSession($user) 
    {   
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        redirect('posts');
    }


    public function logout() 
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }




}