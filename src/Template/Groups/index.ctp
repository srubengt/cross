<!-- Content Header (Page header) -->
<?php
$loguser = $this->request->session()->read('Auth.User');

?>

<section class="content-header">
    <h1>
        <?= __('Exercises')?>
        <small><?= __('Groups of exercises')?></small>

        <?php
        if (in_array($loguser['role_id'], [1,2], true)) {
            echo $this->Html->link(
                '<i class="fa fa-plus"></i> ' . __('New Group'),
                ['controller' => 'groups', 'action' => 'add'],
                ['escape' => false, 'class' => 'btn btn-success btn-xs pull-right']
            );
        }
        ?>
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
                                        ['action' => 'index'],
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
                        <?php foreach ($groups as $group): ?>
                            <li class="item">
                                <div class="product-img">
                                    <?php
                                    if ($group->photo){
                                        echo $this->Html->link(
                                            $this->Html->image('/files/groups/photo/' . $group->get('photo_dir') . '/portrait_' . $group->get('photo')),
                                            '/files/groups/photo/' . $group->get('photo_dir') . '/' . $group->get('photo'),
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
                                        h($group->name),
                                        [
                                            'controller' => 'groups',
                                            'action' => 'view',
                                            $group->id
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
                                            '<i class="glyphicon glyphicon-remove-circle"></i> ' . __('Remove'),
                                            ['action' => 'delete', $group->id],
                                            [
                                                'escape' => false,
                                                'class' => 'btn btn-danger btn-xs pull-right',
                                                'confirm' => __('¿Remove Exercise # {0}?', $group->name)
                                            ]
                                        );

                                        echo $this->Html->link(
                                            '<i class="fa fa-pencil"></i> ' . __('Edit'),
                                            ['controller' => 'groups', 'action' => 'edit', $group->id],
                                            [
                                                'escape' => false,
                                                'style' => 'margin:0 5px;',
                                                'class' => 'btn btn-info btn-xs pull-right'
                                            ]
                                        );


                                    }
                                    ?>

                                    <span class="product-description">
                                        <?= $group->description ?>
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