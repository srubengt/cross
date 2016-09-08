<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Exercises')?>
        <small><?= __('List of exercises')?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="<?php echo $this->Url->build(); ?>" method="POST">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" value="<?=$search?>" class="form-control" placeholder="<?= __('Fill in to start search') ?>">
                            <span class="input-group-btn">
                                <?php
                                if ($search) {
                                    echo $this->Html->link(
                                        '<i class="fa fa-close"></i>',
                                        ['action' => 'listar'],
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

                </div>
                <!-- /.box-header -->
                <div class="box-body">
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




                                <a href="javascript:void(0)" class="product-title"><?= h($exercise->name) ?>
                                    <span class="label <?= $exercise->type == 0 ? 'label-warning' : 'label-success'?> pull-right">
                                        <?= $exercise->type == 0 ? 'Gymnastic' : 'Strenght'?>
                                    </span>
                                </a>
                                <span class="product-description">
                                  Description
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <?php endforeach;?>
                    </ul>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                        </ul>
                        <p><?= $this->Paginator->counter() ?></p>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->