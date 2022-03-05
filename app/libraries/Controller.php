<?php
/*
*Base controller
*Loads the model and view
*/

class Controller
{
    //Load model
    public function model($model)
    {
        //Require model file
        require_once '../app/models/' . $model . '.php';

        //Intatiate model
        return new $model();
    }

    //Loads view
    public function view($view, $data = [])
    {
        //Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            //View is not exist
            die('View does not exist');
        }
    }
}
