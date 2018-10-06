<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Links_model extends CRM_Model
{
	protected $table_name = "ssc_links";
    public function __construct()
    {
        parent::__construct($this->table_name);
    }

}
?>