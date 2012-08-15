<?php

defined('_JEXEC') or die;

class CommandHelper {

    public function addSubmenu($currentViewName) {
        if (strtolower($currentViewName) == "site")
            return;
        JSubMenuHelper::addEntry(
                JText::_('COM_COMMAND_SUBMENU_COMMAND'), 'index.php?option=com_command&view=command', $currentViewName == 'command'
        );
        JSubMenuHelper::addEntry(
                JText::_('COM_COMMAND_SUBMENU_SITES'), 'index.php?option=com_command&view=sites', $currentViewName == 'sites'
        );
        JSubMenuHelper::addEntry(
                JText::_('COM_COMMAND_SUBMENU_UPDATES'), 'index.php?option=com_command&view=updates', $currentViewName == 'updates'
        );
    }

    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;
        $assetName = 'com_command';

        $actions = JAccess::getActions($assetName, 'component');

        foreach ($actions as $action) {
            $result->set($action->name, $user->authorise($action->name, $assetName));
        }

        return $result;
    }

}
