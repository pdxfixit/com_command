<?php

defined('_JEXEC') or die;

class CommandTableSite extends JTable {

    public $id = null;
    public $title = null;
    public $url = null;
    public $published = null;
    public $lastUpdated = null;

    public function __construct(&$db) {
        parent::__construct('#__command_sites', 'id', $db);
    }

    public function check() {
        // check for valid name
        if (trim($this->title) == '') {
            $this->setError(JText::_('COM_COMMAND_ERR_TABLES_TITLE'));
            return false;
        }

        // check for valid URL
        if (JFilterInput::checkAttribute(array('href', $this->url))) {
            $this->setError(JText::_('COM_COMMAND_ERR_TABLES_PROVIDE_URL'));
            return false;
        }

        // verify URL
        if (!$this->verifySite($this->url)) {
            $this->setError(JText::_('COM_COMMAND_ERR_TABLES_VERIFY_URL'));
            return false;
        }

        return true;
    }

    public function store($updateNulls = false) {
        if (isset($this->ordering)) {
            unset($this->ordering);
        }
        return parent::store($updateNulls);
    }

    protected function verifySite($url) {
        return true;
    }

}
