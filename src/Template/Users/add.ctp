<!-- Content Header (Page header) -->
<section class="content-header hidden-xs">
    <h1>
        <?= $title?>
        <small><?= $small;?></small>
    </h1>
    <?php
    $this->Html->addCrumb('Usuarios', ['controller' => 'users']);
    $this->Html->addCrumb('Añadir');
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
              <h3 class="box-title">Añadir Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($user,['novalidate']) ?>
                <div class="box-body">
                    <?php
                        echo $this->Form->input('name',[
                            "label" => "Nombre"
                        ]);
                        echo $this->Form->input('last_name',[
                            "label" => "Apellidos"
                        ]);

                        echo $this->Form->input('idcard_type',[
                            "label" => "Tipo Documento",
                            'options' => $idcards
                        ]);

                        echo $this->Form->input('idcard',[
                            'type' => 'text',
                            "label" => "Número Documento"
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
                    ?>
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                    <?= $this->Form->button(__('Guardar')) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div><!-- /.col-md-6 -->
    
    </div><!-- /.row -->
</section>