<?php

class SiteController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['id'])) {
            return header('Location: ?controller=user&action=main');
        }
        
        return $this->loadView('layout.header')
             . $this->loadView('frontend.index')
             . $this->loadView('layout.footer');
    }
}
