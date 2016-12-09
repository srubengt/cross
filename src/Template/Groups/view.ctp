<?php
$loguser = $this->request->session()->read('Auth.User');
?>

<div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-green-gradient">
        <div class="widget-user-image ">
            <?php
            if ($group->photo){
                echo $this->Html->image(
                    '/files/Groups/photo/' . $group->photo_dir . '/portrait_' . $group->photo,
                    [
                        'class' => 'img-circle img-lg'
                    ]
                );
            }else{
                echo $this->Html->image(
                    '/img/no-image-available.jpg',
                    [
                        'class' => 'img-circle'
                    ]
                );
            }
            ?>
        </div>

        <!-- /.widget-user-image -->
        <h3 class="widget-user-username "><?= h($group->name) ?></h3>
        <h5 class="widget-user-desc"><?= h($group->description) ?></h5>

        <div class="input-group input-group-sm">
            <?php
            if (in_array($loguser['role_id'], [1,2], true)) {
                echo $this->Html->link(
                    '<i class="fa fa-plus"></i> ' . __('New Exercise'),
                    ['controller' => 'exercises', 'action' => 'add', $group->id],
                    ['escape' => false, 'class' => 'btn btn-default btn-xs']
                );
            }
            ?>
        </div>
    </div>
    <div class="box-footer">
        <ul class="products-list product-list-in-box">
            <?php foreach ($group->exercises as $exercise): ?>
                <li class="item">
                    <div class="product-img">
                        <?php
                        if ($exercise->photo){
                            echo $this->Html->link(
                                $this->Html->image('/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo')),
                                '/files/exercises/photo/' . $exercise->get('photo_dir') . '/' . $exercise->get('photo'),
                                [
                                    'escape' => false,
                                    'data-gallery' =>''
                                ]);
                        }else{
                            echo $this->Html->image('/img/no-image-available.jpg');
                        }
                        ?>
                    </div>
                    <div class="product-info">
                        <?php
                        echo $this->Html->Link(
                            h($exercise->name),
                            [
                                'controller' => 'exercises',
                                'action' => 'view',
                                $exercise->id
                            ],
                            [
                                'escape' => false,
                                'class' => 'product-title'
                            ]
                        );
                        ?>

                        <?php
                        if (in_array($loguser['role_id'], [1,2], true)) {

                            echo $this->Form->postLink(
                                '<i class="glyphicon glyphicon-remove-circle"></i> ' . __('Del'),
                                ['controller' => 'exercises', 'action' => 'delete', $exercise->id],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-danger btn-xs pull-right',
                                    'confirm' => __('¿Remove variant # {0}?', $exercise->name)
                                ]
                            );

                            echo $this->Html->link(
                                '<i class="fa fa-pencil"></i> ' . __('Edit'),
                                ['controller' => 'exercises', 'action' => 'edit', $exercise->id],
                                [
                                    'escape' => false,
                                    'style' => 'margin:0 5px;',
                                    'class' => 'btn btn-info btn-xs pull-right'
                                ]
                            );
                        }
                        ?>
                        <span class="product-description">
                            <?= $exercise->description ?>
                        </span>
                    </div>
                </li>
                <!-- /.item -->
            <?php endforeach;?>
        </ul>
    </div>
</div>

