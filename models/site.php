<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class CommandModelSite extends JModelAdmin {

    protected $text_prefix = 'COM_COMMAND';

    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm('com_command.site', 'site', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
            return false;
        return $form;
    }

    public function getTable($type = 'Site', $prefix = 'CommandTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_command.edit.site.data', array());

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    protected function prepareTable(&$table) {
        $table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);

        if (empty($table->id)) {
            // Set the values
            // Set ordering to the last item if not set
            if (empty($table->ordering)) {
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $query->select('MAX(' . $db->nq('ordering') . ')')->from($db->nq('#__weblinks'));
                $db->setQuery();
                $max = $db->loadResult();

                $table->ordering = $max + 1;
            }
        } else {
            // Set the values
        }
    }
    
    private function _connectSite() {
        
    }

    public function updateSite($id) {
        // get the record
        $item = $this->getItem($id);
        
        // poll the site
        $payload = file_get_contents($item->url);
        
        die(var_export($payload,1));
        
        // if successful, update the timestamp in the database, and return true
    }

}
