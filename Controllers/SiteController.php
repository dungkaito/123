<?php

class SiteController extends BaseController
{
    public function index()
    {
        return $this->loadView('layout.header')
             . $this->loadView('frontend.index')
             . $this->loadView('layout.footer');
    }
}
