<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
  <h1>
    <?= __('Usuarios')?>
    <small><?= __('Editar usuario');?></small>
  </h1>
  
    <?php
        $this->Html->addCrumb('Usuarios', ['controller' => 'users']);
        $this->Html->addCrumb('Editar');
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
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($user, ['type'=>'file', 'novalidate']) ?>
                <div class="box-body">
                    <?php
                        echo $this->Form->input('name',[
                            "label" => "Nombre"
                        ]);
                        echo $this->Form->input('last_name',[
                            "label" => "Apellidos"
                        ]);

                        echo $this->Form->input('gender',[
                            "label" => "Genero",
                            "options" => ['Male', 'Female']
                        ]);

                        echo $this->Form->input('login',[
                            "label" => "Nick Login"
                        ]);
                        
                        echo $this->Form->input('password',[
                            "label" => "Password"
                        ]);
                        echo $this->Form->input('email',[
                            "label" => "Email"
                        ]);
                        echo $this->Form->input('role_id', ['options' => $roles]);
                        
                        echo $this->Form->input('nivel',[
                            "label" => "Nivel"
                        ]);

                        echo $this->Form->input('is_dropin',[
                            "label" => "Is Dropin"
                        ]);

                        echo $this->Form->input('photo',[
                            "label" => "Photo",
                            "type" => "file"
                        ]);
                    ?>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div><!-- /.col-md-6 -->
    
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Imagen de Usuario</h3>
            </div>
            <!-- /.box-header -->
                <div class="box-body">
                    <p style="text-align:center;">
                        <?php 
                            if ($user->photo){
                                echo $this->Html->link(
                                    $this->Html->image(
                                        '/files/users/photo/' . $user->get('photo_dir') . '/portrait_' . $user->get('photo'),
                                        [
                                            'class' => 'img-circle'
                                        ]
                                    ),
                                    '/files/users/photo/' . $user->get('photo_dir') . '/better_' . $user->get('photo'),
                                    [
                                        'escape' => false,
                                        'data-gallery' =>''
                                    ]);
                            }else{
                                echo $this->Html->image('no_image.gif', ['alt' => 'Imagen de Perfil', 'class' => 'img-circle', 'style' => 'width: 90px;']); 
                            }
                        ?>
                    </p>
                </div>
                <!-- /.box-body -->

            <!-- /.box-footer -->
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tarifa de Usuario</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                echo $this->Form->create($user,
                    [
                        'role' => 'form',
                    ]
                );

                $indice = count($user->partners);

                echo $this->Form->input('partners.' . $indice . '.rate',[
                    'empty' => 'Select One',
                    'type' => 'select',
                    'label' => 'Tarifa',
                    'options' => $rates
                ]);

                echo $this->Form->input('partners.' . $indice . '.price');

                echo $this->Form->submit();

                echo $this->Form->end();
                ?>

                <table id="table_partners" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created</th>
                        <th scope="col">Modified</th>
                        <th scope="col">Active</th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($user->partners as $partner): ?>
                        <tr>
                            <td><?= $partner->id ?></td>
                            <td><?= $rates[$partner->rate] ?></td>
                            <td><?= $partner->price ?></td>
                            <td><?= $partner->created ?></td>
                            <td><?= $partner->modified ?></td>
                            <td><?= $partner->active ?></td>
                            <td class="actions">
                                &nbsp;
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
        </div>
    </div><!-- /.col-md-6 -->

    </div><!-- /.row -->
</section>