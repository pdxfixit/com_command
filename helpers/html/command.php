<?php

defined('_JEXEC') or die;

class JHtmlCommand {

    public static function statelist() {
        $options = array();
        $options[] = JHtml::_('select.option', '1', JText::sprintf('COM_COMMAND_ITEM_X_ONLY', JText::_('JPUBLISHED')));
        $options[] = JHtml::_('select.option', '0', JText::sprintf('COM_COMMAND_ITEM_X_ONLY', JText::_('JUNPUBLISHED')));

        return $options;
    }

}
