<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

class CommandModelSite extends JModelAdmin {

    protected $text_prefix = 'COM_COMMAND';

    public function conformUrl($url) {
        $parsed = parse_url($url);
        
        $path = trim($parsed['path'], 'index.php'); 
        
        return $url;
    }
    
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

    public function refreshSite($id) {
        // get the record
        $item = $this->getItem((int) $id);

        // prepare a token
        require JPATH_COMPONENT . '/helpers/command.php';
        $token = CommandHelper::generateToken();

        // poll the site
        $url = parse_url($item->url);
        $payload = file_get_contents($url['scheme'] . '://' . $url['host'] . $url['path']
                . '/index.php?option=com_control&task=update.check&format=raw&token=' . $token);
        $json = json_decode($payload);

        // if successful, update the timestamp in the database, and return true
        if (is_object($json)) {
            $this->_updateSiteCache($id, $payload);
        } elseif (is_array($json)) {
            foreach ($json as $item) {
                $this->_updateSiteCache($id, $payload);
            }
            return true;
        } else {
            return false;
        }
    }

    public function updateSite($id) {
        // get the record
        $item = $this->getItem((int) $id);

        // prepare a token
        require JPATH_COMPONENT . '/helpers/command.php';
        $token = CommandHelper::generateToken();

        // poll the site
        $json = json_decode($item->updates);
        $url = parse_url($item->url);
        set_time_limit(60);
        foreach ($json as $update) {
            $response = file_get_contents($url['scheme'] . '://' . $url['host'] . $url['path']
                    . '/index.php?option=com_control&task=update.update&id=' . (int) $update->update_id . '&format=raw&token=' . $token);
            if ($response === '1') {
                continue;
            } else { die('n'.$update->update_id. ' '.var_export($response,1));
                return false;
            }
        }

        // if successful, update the timestamp in the database, and return true
        $this->_purgeSiteCache($id);
        return true;
    }

    protected function verifySite($url) {
        //sanitize the url
        $urlExplosion = parse_url($url);
        //check for index.php
        //check for administrator
        //verify the site, and download the update data
        return true;
    }
    
    private function _purgeSiteCache($id) {
        $query = $this->_db->getQuery(true);
        $query->update($this->_db->nq('#__command_sites'))
                ->set($this->_db->nq('updates') . ' = ' . $this->_db->q(''))
                ->set($this->_db->nq('lastupdated') . ' = NOW()')
                ->where($this->_db->nq('id') . ' = ' . $this->_db->q($id));
        $this->_db->setQuery($query);
        $this->_db->query();
    }

    private function _updateSiteCache($id, $payload) {
        $query = $this->_db->getQuery(true);
        $query->update($this->_db->nq('#__command_sites'))
                ->set($this->_db->nq('updates') . ' = ' . $this->_db->q((string) $payload))
                ->set($this->_db->nq('lastupdated') . ' = NOW()')
                ->where($this->_db->nq('id') . ' = ' . $this->_db->q($id));
        $this->_db->setQuery($query);
        $this->_db->query();
    }

}
