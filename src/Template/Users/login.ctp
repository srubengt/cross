<!-- File: src/Template/Users/login.ctp -->
<p class="login-box-msg">Sign in to start your sesion</p>

<?= $this->Form->create() ?>
<?= $this->Form->input('login') ?>
<?= $this->Form->input('password', ['type' => 'password']) ?>
<?= $this->Form->submit(__('Login')); ?>
<?= $this->Form->end() ?>

<?php
echo $this->Html->link(
    'Drop-in',
    [
        'controller' => 'Users',
        'action' => 'dropin'
    ]
)
?>
