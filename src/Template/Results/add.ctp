<?php
$loguser = $this->request->session()->read('Auth.User');
?>
<section class="content-header">
    <h1>
        <?= __('Add Exercise')?>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <form action="<?php echo $this->Url->build(['action' => 'search']); ?>" method="post">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" value="<?=$search?>" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                                <span class="input-group-btn">
                                    <?php
                                    if ($search) {
                                        echo $this->Html->link(
                                            '<i class="fa fa-close"></i>',
                                            ['action' => 'add'],
                                            [
                                                'escape' => false,
                                                'class' => 'btn btn-default'

                                            ]);
                                    }
                                    ?>
                                    <button class="btn btn-info btn-flat" type="submit"><?= __('Filter') ?></button>
                                </span>
                        </div>
                    </form>
                    <ul class="products-list product-list-in-box">
                        <?php foreach ($exercises as $exercise): ?>
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
                                    <span class="product-title text-primary">
                                        <?= $exercise->name; ?>
                                        <span class="label pull-right">
                                            <?php

                                            echo $this->Form->postLink(
                                                '<i class="glyphicon glyphicon-plus"></i>',
                                                ['action' => 'add', $exercise->id],
                                                [
                                                    'escape' => false,
                                                    'class' => 'btn btn-success btn-sm',
                                                    'confirm' => __('¿Add Exercise # {0}?', $exercise->name)
                                                ]
                                            );
                                            ?>
                                        </span>
                                    </span>
                                    <span class="product-description">
                                            <?= __('Group') . ': ' . $exercise->group->name ?>
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
</section>