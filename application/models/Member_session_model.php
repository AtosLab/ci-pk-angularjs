<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Member_session_model extends CRM_Model
{
	protected $table_name = "ssc_member_session";
    public function __construct()
    {
        parent::__construct($this->table_name);
    }
}
?>