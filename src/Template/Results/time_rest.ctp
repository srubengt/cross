<?php
echo $this->Form->create($result,[
    'url' => [
        'action' => 'edit',
        $result->id
    ]
]);

switch ($field){
    case 'time':
        echo $this->Form->input(
            'timeset',
            [
                'type' => 'text',
                'label' => 'Rest Set',
                'value' => $result->timeset?$result->timeset->i18nFormat('mm:ss'):'00:00'
            ]
        );
        break;
    case 'rest':
        echo $this->Form->input(
            'restset',
            [
                'type' => 'text',
                'label' => 'Rest Set',
                'value' => $result->restset?$result->restset->i18nFormat('mm:ss'):'00:00'
            ]
        );
        break;
}

echo $this->Form->button('Save');

echo $this->Form->end();
?>