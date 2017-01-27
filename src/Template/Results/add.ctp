<?php
    $loguser = $this->request->session()->read('Auth.User');
?>

<?= $this->element('results/modal')?>

<section class="content-header hidden-xs" >
    <h1>
        <?= $title ?>
        <small><?= $small ?></small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div id="exercises">


                        <?php
                        echo $this->Form->input(null,[
                           'class' => 'search',
                            'placeholder' => 'Search'
                        ]);
                        ?>

                        <ul class="products-list product-list-in-box list">
                            <?php foreach ($exercises as $exercise): ?>
                                <li class="item">
                                    <div class="product-img">
                                        <?php
                                        if ($exercise->photo){
                                            echo $this->Html->link(
                                                $this->Html->image('/files/exercises/photo/' . $exercise->get('photo_dir') . '/portrait_' . $exercise->get('photo')),
                                                '/files/exercises/photo/' . $exercise->get('photo_dir') . '/better_' . $exercise->get('photo'),
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
                                        <span class="product-title text-primary name">
                                            <?= $this->Html->link(
                                                $exercise->name,
                                                'javascript:void(0);',
                                                [
                                                    'data-toggle'=> 'modal',
                                                    'data-target' => '#Modal',
                                                    'data-field' => 'add',
                                                    'data-value' => $exercise->id
                                                ]);
                                            ?>
                                            <span class="label pull-right">
                                                <?php

                                                echo $this->Form->button(
                                                    '<i class="glyphicon glyphicon-plus"></i>',
                                                    [
                                                        'id' => 'btn_add',
                                                        'class' => 'btn btn-success btn-sm',
                                                        'data-toggle'=> 'modal',
                                                        'data-target' => '#Modal',
                                                        'data-field' => 'add',
                                                        'data-value' => $exercise->id
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
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
</section>