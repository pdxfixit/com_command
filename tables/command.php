<?php

defined('_JEXEC') or die('Access Restricted');

class TableCommand extends JTable {

	public $user_id = null;
	public $updated = null;
	public $stuff = '0';
	
	public function __construct(&$db) {
		parent::__construct('#__command', 'id', $db);
	}
  
}
