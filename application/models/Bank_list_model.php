<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bank_list_model extends CRM_Model
{
	protected $table_name = "ssc_bank_list";
    public function __construct()
    {
        parent::__construct($this->table_name);
    }

}
?>