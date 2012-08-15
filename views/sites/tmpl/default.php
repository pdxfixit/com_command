<?php
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>
<script type="text/javascript">
    Joomla.submitbutton = function(pressbutton) {
        if (pressbutton == 'sites.delete') {
            if (confirm("<?php echo JText::_('COM_COMMAND_SITES_CONFIRM_DELETE_PROMPT'); ?>")) {
                Joomla.submitform(pressbutton);
            } else {
                return false;
            }
        }

        Joomla.submitform(pressbutton);
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_command&view=sites'); ?>" method="post" name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_search"><?php echo JText::sprintf('COM_COMMAND_SEARCH_LABEL', JText::_('COM_COMMAND_SITES_ITEMS')); ?></label>
            <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_COMMAND_FILTER_SEARCH_DESCRIPTION'); ?>" />
            <button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
            <button type="button" onclick="document.id('filter_search').value=''; this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>
        <div class="filter-select fltrt">
            <select name="filter_state" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('COM_COMMAND_FILTER_BY_STATE'); ?></option>
                <?php echo JHtml::_('select.options', JHtml::_('command.statelist'), 'value', 'text', $this->state->get('filter.state')); ?>
            </select>
        </div>
    </fieldset>
    <div class="clr"> </div>

    <table class="adminlist" style="clear: both;">
        <thead>
            <tr>
                <th width="1%">
                    <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
                </th>
                <th>
                    <?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'title', $listDirn, $listOrder); ?>
                </th>
                <th width="5%">
                    <?php echo JHtml::_('grid.sort', 'COM_COMMAND_ENABLED', 'published', $listDirn, $listOrder); ?>
                </th>
                <th>
                    <?php echo JHtml::_('grid.sort', 'COM_COMMAND_SITES_HEADING_LINK_URL', 'url', $listDirn, $listOrder); ?>
                </th>
                <th width="10%">
                    <?php echo JHtml::_('grid.sort', 'COM_COMMAND_SITES_HEADING_LAST_UPDATE', 'lastupdated', $listDirn, $listOrder); ?>
                </th>
                <th width="5%">
                    <?php echo JHtml::_('grid.sort', 'COM_COMMAND_SITES_HEADING_ID', 'id', $listDirn, $listOrder); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($this->items) == 0): ?>
                <tr class="row0">
                    <td align="center" colspan="7">
                        <?php echo JText::_('COM_COMMAND_SITES_NO_SITES'); ?>
                    </td>
                </tr>
            <?php endif; ?>

            <?php $canChange = JFactory::getUser()->authorise('core.manage', 'com_command'); ?>
            <?php foreach ($this->items as $i => $item): ?>

                <tr class="row<?php echo $i % 2; ?>">
                    <td class="center">
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                    </td>
                    <td>
                        <?php if ($canChange) { ?>
                            <a href="<?php echo JRoute::_('index.php?option=com_command&task=site.edit&id=' . (int) $item->id); ?>">
                                <?php echo $this->escape($item->title); ?>
                            </a>
                        <?php
                        } else {
                            echo $this->escape($item->title);
                        }
                        ?>
                    </td>
                    <td class="center nowrap">
                        <?php echo JHtml::_('jgrid.published', $item->published, $i, 'sites.', $canChange, 'cb'); ?>
                    </td>
                    <td class="center nowrap">
                        <?php
                        if (strlen($item->url) > 80) {
                            echo substr($item->url, 0, 70) . '...';
                        } else {
                            echo '<a href="' . $item->url . '" target="_blank" title="' . $this->title . '">' . $item->url . '</a>';
                        }
                        ?>
                    </td>
                    <td class="center nowrap">
    <?php echo JHtml::_('date', $item->lastupdated, JText::_('DATE_FORMAT_LC4')); ?>
                    </td>
                    <td class="center nowrap">
                        <?php echo $item->id; ?>
                    </td>
                </tr>

<?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="nowrap">
<?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
    </table>

    <input type="hidden" name="task" value="display" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
<?php echo JHtml::_('form.token'); ?>
</form>
