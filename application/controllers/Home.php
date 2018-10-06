<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends WebLoginBase_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
		$this->loadHomeTemplate('home', true);
	}
}