<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bets_model extends CRM_Model
{
	protected $table_name = "ssc_bets";
    public function __construct()
    {
        parent::__construct($this->table_name);
    }

}
?>