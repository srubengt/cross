<!-- File: src/Template/Users/login.ctp -->

<p class="login-box-msg">Type your name to start your sesion</p>

<?= $this->Form->create($dropin) ?>
<?= $this->Form->input('name') ?>
<div class="g-recaptcha" data-sitekey="6Le83w8UAAAAAAJ-FRAHI_M6jSERNcLecSuYMf6h"></div>
<?= $this->Form->submit(__('Drop-in')); ?>
<?= $this->Form->end() ?>

