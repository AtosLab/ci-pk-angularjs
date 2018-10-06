<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Member_bank_model extends CRM_Model
{
	protected $table_name = "ssc_member_bank";
    public function __construct()
    {
        parent::__construct($this->table_name);
    }

}
?>