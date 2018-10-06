<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CRM_Model
{
	protected $table_name = "ssc_order";
    public function __construct()
    {
        parent::__construct($this->table_name);
    }

}
?>