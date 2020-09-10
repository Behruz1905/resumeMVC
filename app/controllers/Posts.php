<?php

class Posts extends Controller{
    public function __construct() {
       if(!isLoggedIn()){
           redirect('users/login');
       }

       $this->postModel = $this->model('Post');
       $this->userModel = $this->model('User');

    }

    public function index() 
    {
        //GEt posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index',$data);
    }


    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',

            ];

            //Validate title
            if(empty($data['title'])){
                $data['title_err'] = 'Zehmet olmasa basligi girin';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Zehmet olmasa metni girin';
            }

            //Error olmadigindan emin olun
            if(empty($data['title_err']) && empty($data['body_err'])){
                //Validated
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post ugurla elave edildi');

                    redirect('posts');
                } else {
                    die('Something went wrong');
                }

            }else{
                //LOad view with error
                $this->view('posts/add', $data);

            }

        }else $data = [
                'title' => '',
                'body' => ''
            ];{

           
            $this->view('posts/add',$data);
        }

      

    }



    public function edit($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'id'  => $id,
                'title_err' => '',
                'body_err' => '',

            ];

            //Validate title
            if(empty($data['title'])){
                $data['title_err'] = 'Zehmet olmasa basligi girin';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Zehmet olmasa metni girin';
            }

            //Error olmadigindan emin olun
            if(empty($data['title_err']) && empty($data['body_err'])){
                //Validated
                if($this->postModel->updatePost($data)){
                    flash('post_message', 'Post ugurla redakte edildi');

                    redirect('posts');
                } else {
                    die('Something went wrong');
                }

            }else{
                //LOad view with error
                $this->view('posts/edit', $data);

            }

        }else {
             //Modelden movcud postu aliriq.
                $post = $this->postModel->getPostById($id);
                //Check for owner
                if($post->user_id != $_SESSION['user_id']) {
                    redirect('posts');
                }
        
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                 ];

           
            $this->view('posts/edit',$data);
        }

      

    }


    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];
        $this->view('posts/show', $data);
    }

    public function delete($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

             //Modelden movcud postu aliriq.
             $post = $this->postModel->getPostById($id);
             //Check for owner
             if($post->user_id != $_SESSION['user_id']) {
                 redirect('posts');
             }
            if($this->postModel->deletePost($id)){
                flash('post_message', 'Post ugurla silindi');
                redirect('posts');
            }else {
                die('SOMETHING WENT WRONG');
            }

        }else{
            redirect('posts');
        }
    }

}







?>