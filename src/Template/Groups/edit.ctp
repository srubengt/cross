<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        <?= $title ?>
        <small><?= $small ?></small>
    </h1>

    <?php
        $this->Html->addCrumb('Exercises', ['controller' => 'groups']);
        $this->Html->addCrumb('Edit');
        echo $this->Html->getCrumbList([
            'firstClass' => false,
            'lastClass' => 'active',
            'class' => 'breadcrumb'
        ],
            'Home');
    ?>
</section>

<section class="content">
    <div class="row">
        <?= $this->Form->create($group,['type'=>'file', 'novalidate']) ?>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= __('Edit Exercise')?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <?php
                    if ($group->photo){
                        echo '<p style="text-align: center;">';
                        echo $this->Html->image('/files/groups/photo/' . $group->get('photo_dir') . '/portrait_' . $group->get('photo'));
                        echo '</p>';
                    }else{
                        echo '<p style="text-align: center;">';
                        echo $this->Html->image('/img/no-image-available.jpg');
                        echo '</p>';
                    }

                    echo $this->Form->input('name',[
                        "label" => "Name"
                    ]);

                    echo $this->Form->input('description',[
                        "label" => "Description"
                    ]);

                    echo $this->Form->input('photo',[
                        "label" => "Photo",
                        "type" => 'file'
                    ]);
                    ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <?= $this->Html->link(
                        '<i class="fa fa-arrow-left"></i> ' . __('Back'),
                        ['action' => 'index'],
                        ['escape' => false, 'class' => 'btn btn-default']
                    ) ?>

                    <?= $this->Form->button(__('Guardar')) ?>

                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
</section>