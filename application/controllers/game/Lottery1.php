<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lottery1 extends WebLoginBase_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
	{
		$this->loadLotteryTemplate("game1");
	}
}