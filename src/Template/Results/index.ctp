
<section class="content-header">
    <h1>
        <?= __('Results')?>
    </h1>
</section>

<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="#exercise" data-toggle="tab" aria-expanded="false">Exercises</a></li>
                <li class="active"><a href="#results" data-toggle="tab" aria-expanded="true"><?= __('Results')?></a></li>
                <li class="pull-right">
                    <?php
                    echo $this->Html->Link(
                        '<i class="fa fa-plus"></i>',
                        [
                            'controller' => 'results',
                            'action' => 'add'
                        ],
                        [
                            'escape' => false,
                            'class' => 'text-muted'
                        ]
                    );
                    ?>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="exercise">
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
                                            'action' => 'add',
                                            $exercise->id
                                        ],
                                        [
                                            'escape' => false,
                                            'class' => 'product-title'
                                        ]
                                    );
                                    ?>
                                    <span class="product-description">
                                            <?= __('Group') . ': ' . $exercise->group->name ?>
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        <?php endforeach;?>
                    </ul>
                </div>
                <!-- /.tab-pane -->

                <!-- RESULTS -->
                <div class="tab-pane active" id="results">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <?php foreach ($results as $result): ?>
                                    <!-- timeline time label -->
                                    <li class="time-label">
                                        <span class="bg-red">
                                        <?= ucwords($result->date->i18nFormat('dd MMM yyyy')); ?>
                                        </span>
                                    </li>
                                    <!-- /.timeline-label -->

                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?= $result->created->i18nFormat('HH:ss'); ?></span>

                                            <h3 class="timeline-header"><?= $result->exercise->name ?></h3>

                                            <div class="timeline-body">
                                                Mostramos los set
                                            </div>
                                            <div class="timeline-footer">
                                                <?php
                                                echo $this->Html->link(
                                                    __('Edit'),
                                                    ['action' => 'edit', $result->id],
                                                    [
                                                        'escape' => false,
                                                        'class' => 'btn btn-primary btn-xs'

                                                    ]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                    __('Delete'),
                                                    ['action' => 'delete', $result->id],
                                                    [
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'confirm' => __('¿Elimnar resultado?')
                                                    ]
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->

                                <?php endforeach;?>

                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col -->
                    </div>

                </div>
                <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->

</div>
<!-- /.row -->
</section>
