<?php

namespace Drupal\custom_form\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomForm extends FormBase{
  
    public function getFormId() {
        return 'custom_form_form';
      }

    public function buildForm(array $form , FormStateInterface $form_state) {
        $form['name'] = [
          '#type' => 'textfield',
          '#title' => $this->t('name'),
        ];
            
        $form['lastname'] = [
          '#type' => 'textfield',
          '#title' => $this->t('lastname'),
        ];

        $form['sumbit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Send'),
          ];
    
        return $form;
      }

    public function submitForm(array &$form, FormStateInterface $form_state) {



        $field=$form_state->getValues();

  
        $name=$field['name'];
        $lastname=$field['lastname'];

        $field  = array(
      
          'name'   => $name,
          'lastname'   => $lastname,
          
        );


        $query = \Drupal::database();
        $query ->insert('customform')
            ->fields($field)
            ->execute();






        $this->messenger()->addStatus($this->t('Bienvenidos @fullname', ['@fullname' =>'se registro con exito']));
        
    }








   
    
}




