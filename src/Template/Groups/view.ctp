<?php
$loguser = $this->request->session()->read('Auth.User');
?>

<div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-green-gradient">
        <div class="widget-user-image">
            <?php
            if ($group->photo){
                    echo $this->Html->image(
                        '/files/Groups/photo/' . $group->photo_dir . '/portrait_' . $group->photo,
                        [
                            'class' => 'img-circle'
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
        <h3 class="widget-user-username"><?= h($group->name) ?></h3>
        <h5 class="widget-user-desc"><?= h($group->description) ?></h5>
    </div>
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">

            <?php foreach ($group->exercises as $exercise): ?>
                <li><a href="#"><?= $exercise->name?> <span class="pull-right badge bg-blue">31</span></a></li>
            <?php endforeach; ?>

        </ul>
    </div>
</div>

