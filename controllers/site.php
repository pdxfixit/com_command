<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class CommandControllerSite extends JControllerForm {

    public function batch($model = null) {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Set the model
        $model = $this->getModel('Site', '', array());

        // Preset the redirect
        $this->setRedirect(JRoute::_('index.php?option=com_command&view=sites' . $this->getRedirectToListAppend(), false));

        return parent::batch($model);
    }

}
