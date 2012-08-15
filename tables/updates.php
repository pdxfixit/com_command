<?php

defined('_JEXEC') or die;

class TableUpdates extends JTable {

	public $user_id = null;
	public $updated = null;
	public $stuff = '0';
	
	public function __construct(&$db) {
		parent::__construct('#__command_updates', 'id', $db);
	}
  
}
