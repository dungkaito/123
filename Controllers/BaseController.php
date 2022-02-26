<?php

class BaseController
{
    /**
     * load view function
     * param: frontend.user.index
     */
    protected function view($viewPath, array $data = [])
    {
        var_dump($data);

        $viewPath = 'Views/' . str_replace('.', '/', $viewPath) . '.php';
        // echo $viewPath; exit();
        require_once $viewPath;
    }

    /**
     * 
     */
    protected function loadModel($modelName)
    {
        require_once 'Models/' . $modelName . '.php';
    }
}