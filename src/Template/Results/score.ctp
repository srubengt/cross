<?php
$loguser = $this->request->session()->read('Auth.User');

echo $this->Form->create('add',
    [
        'url' => [
            'controller' => 'results',
            'action' => 'add'
        ]
    ]
);
    echo $this->Form->hidden('exercise_id', [
       'value' => $exercise->id
    ]);

    echo $this->Form->input('score',[
        'options' => $scores,
        'label' => 'Score Type:'
    ]);
    echo $this->Form->button(
        __('Next') . ' <i class="fa fa-arrow-right"></i>',
        [
            'type' => 'submit',
            'escape' => false,
            'class' => 'btn btn-primary'
        ]
        );
$this->Form->end;
?>
