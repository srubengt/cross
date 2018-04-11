<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('activities')
            ->addColumn('name', 'string', [
                'comment' => 'Nombre de la actividad',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('bootstrap_class', 'string', [
                'comment' => 'Clase bootstrap para el icono de la actividad',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('bg_color', 'string', [
                'comment' => 'Color de fondo para la actividad',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('details')
            ->addColumn('label', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('type', 'integer', [
                'comment' => '0-txt, 1-int, 2-array',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('unit_id', 'integer', [
                'comment' => 'tabla Units',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('txtarray', 'string', [
                'comment' => 'Opciones para cuando los valores es tipo 2-array ',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('dropins')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('exercises')
            ->addColumn('group_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('video', 'string', [
                'comment' => 'URL Video',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('photo', 'string', [
                'comment' => 'Imagen del Exercise',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('photo_dir', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('for_time', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('for_reps', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('for_weight', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('for_distance', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('for_calories', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('detail_id', 'integer', [
                'comment' => 'Detalle a especificar del ejercicio',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('modified', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->create();

        $this->table('groups')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('photo', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('photo_dir', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('partners')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('rate', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('price', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('date_start', 'date', [
                'comment' => 'Fecha alta socio',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('active', 'boolean', [
                'comment' => 'True=Tarifa de socio activa, false=> tarifa de socio no activa',
                'default' => true,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('payments')
            ->addColumn('user_id', 'integer', [
                'comment' => 'Id Usuario',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('rate_id', 'integer', [
                'comment' => 'Id tarifa',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('month_payment', 'integer', [
                'comment' => 'Mes del pago',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('year_payment', 'integer', [
                'comment' => 'Año del pago',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('type', 'integer', [
                'comment' => 'Tipo de Pago [Efectivo, Tarjeta]',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('amount', 'decimal', [
                'comment' => 'Importe',
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('discount', 'decimal', [
                'comment' => 'Descuento aplicado',
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('igic', 'integer', [
                'comment' => 'Impuesto aplicado',
                'default' => '7',
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('total_igic', 'decimal', [
                'comment' => 'Total IGIC Aplicado',
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('total', 'decimal', [
                'comment' => 'Total a pagar',
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('description', 'text', [
                'comment' => 'Observaciones sobre el pago',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('rates')
            ->addColumn('name', 'string', [
                'comment' => 'Nombre Tarifa',
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('price', 'decimal', [
                'comment' => 'Precio de la tarifa',
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 2,
            ])
            ->addColumn('created', 'datetime', [
                'comment' => 'fecha creación',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'comment' => 'fecha modificación',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('reservations')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('dropin_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('results')
            ->addColumn('exercise_id', 'integer', [
                'comment' => 'Ejercicio sobre el que guardamos resultado',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('score', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('timeset', 'time', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('restset', 'time', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('roles')
            ->addColumn('name', 'string', [
                'comment' => 'nombre rol: Administrador, user, etc…
',
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('orden', 'integer', [
                'comment' => 'Orden de prioridad',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('scores')
            ->addColumn('name', 'string', [
                'comment' => 'For Rounds / Reps, For Time, For Weight',
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('sessions')
            ->addColumn('activity_id', 'integer', [
                'comment' => 'Id de la actividad a la que pertenece la session',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('start', 'time', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end', 'time', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('max_users', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('workout_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('sets')
            ->addColumn('result_id', 'integer', [
                'comment' => 'Resultado -> Set',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('reps', 'integer', [
                'comment' => 'Repeticiones del ejercicio',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('time', 'time', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('weight', 'integer', [
                'comment' => 'Peso utilizado',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('distance', 'integer', [
                'comment' => 'Distancia recorrida',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('calories', 'integer', [
                'comment' => 'Resistencia del ejercicio',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('detail_id', 'integer', [
                'comment' => 'Id del Detalle para obtener los datos',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('value_detail', 'string', [
                'comment' => 'Valor del detalle. En formato texto pero que habrá que eval()',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('units')
            ->addColumn('name', 'string', [
                'comment' => 'mt, cm, kg',
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->create();

        $this->table('users')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('idcard_type', 'integer', [
                'comment' => 'Tipo de Documento',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('idcard', 'string', [
                'comment' => 'Documento del usuario',
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('gender', 'integer', [
                'comment' => 'Genero Usuario',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('photo', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('photo_dir', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('login', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('role_id', 'integer', [
                'comment' => 'tipo de usuario, administrador, super-usuario, usuario standar
 ',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('nivel', 'integer', [
                'comment' => 'Nivel del usuario, define los pesos y variante que debe hacer en los ejercicios.
',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('is_dropin', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'email',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'login',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('wods')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('type', 'integer', [
                'comment' => '0 - Strenght/Gymnastic - 1 - Strenght',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('photo', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('photo_dir', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('locked', 'boolean', [
                'comment' => 'Wod bloqueado porque se ha creado desde un workout',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('wods_workouts')
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('wod_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('workout_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('workouts')
            ->addColumn('date', 'date', [
                'comment' => 'Fecha cuando se realiza el workout',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('warmup', 'text', [
                'comment' => 'Calentamiento del entreno',
                'default' => null,
                'limit' => 4294967295,
                'null' => true,
            ])
            ->addColumn('photo', 'string', [
                'comment' => 'nombre de la imagen del workout',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('photo_dir', 'string', [
                'comment' => 'Ruta ubicación de la imagen',
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('info_results', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('info_competitor', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('competitor', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('activities');
        $this->dropTable('details');
        $this->dropTable('dropins');
        $this->dropTable('exercises');
        $this->dropTable('groups');
        $this->dropTable('partners');
        $this->dropTable('payments');
        $this->dropTable('rates');
        $this->dropTable('reservations');
        $this->dropTable('results');
        $this->dropTable('roles');
        $this->dropTable('scores');
        $this->dropTable('sessions');
        $this->dropTable('sets');
        $this->dropTable('units');
        $this->dropTable('users');
        $this->dropTable('wods');
        $this->dropTable('wods_workouts');
        $this->dropTable('workouts');
    }
}
