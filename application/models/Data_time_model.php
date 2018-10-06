<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_time_model extends CRM_Model
{
	protected $table_name = "ssc_data_time";
    public function __construct()
    {
        parent::__construct($this->table_name);
    }

}
?>