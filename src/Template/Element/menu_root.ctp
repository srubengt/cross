<?php
$controller = $this->request->param('controller');
$action = $this->request->param('action');

?>
<li <?= ($controller == 'Roles') ? 'class="active"' : ''; ?> > <?= $this->Html->link(
        '<i class="fa fa-users"></i> <span>' . __('Roles') .'</span>',
        ['controller' =>'roles', 'action' => 'index'],
        ['escape' => false]
    );
    ?>
</li>