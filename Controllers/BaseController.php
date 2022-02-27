<?php

class BaseController
{
    /**
     * load view function
     * @param string $viewPath      view file path, format example: frontend.user.index
     * @param array  $data          data to render view (option)
     */
    protected function loadView($viewPath, array $data = [])
    {
        // var_dump($data);

        $viewPath = 'Views/' . str_replace('.', '/', $viewPath) . '.php';
        // echo $viewPath; exit();
        return require_once $viewPath;
    }

    /**
     * 
     */
    protected function loadModel($modelName)
    {
        return require_once 'Models/' . $modelName . '.php';
    }
}
