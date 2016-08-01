<?php
// in src/Form/ContactForm.php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\I18n\Time;

class RelatedForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {

        return $schema
            ->addField('workout_id', 'int')
            ;
    }

    protected function _buildValidator(Validator $validator)
    {
        return $validator;
    }

    protected function _execute(array $data)
    {
        //Array que guarda
        $data2 = [];
        foreach (array_keys($data) as $key) {
            if ($key != 'workout_id'){
                $aux = [
                    'id' => $data[$key],
                    'workout_id' => $data['workout_id']
                ];

                array_push($data2, $aux);
            }
        }
        return $data2;
    }


    public function setErrors($errors)
    {
        $this->_errors = $errors;
    }

}