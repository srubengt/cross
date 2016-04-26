<!-- File: src/Template/Users/login.ctp -->

<?= $this->Form->create() ?>
<?= $this->Form->input('login') ?>
<?= $this->Form->input('password', ['type' => 'password']) ?>
<?= $this->Form->submit(__('Login')); ?>
<?= $this->Form->end() ?>
