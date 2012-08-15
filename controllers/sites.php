<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class CommandControllerSites extends JControllerAdmin {

    public function create() {
        $this->setRedirect('index.php?option=com_command&view=site');
        return true;
    }

    public function getModel($name = 'Site', $prefix = 'CommandModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

}
