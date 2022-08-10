<?php

namespace Drupal\mydato\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\mydato\mydatorepose;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Drupal\mydato\mydatoRepository;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Database\Database;
use Drupal\Core\Ajax\InvokeCommand;
//use Laminas\Diactoros\Response\RedirectResponse;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class Mydato.
 *
 * @package Drupal\mydata\Form
 */
class mydatoForm extends FormBase {

  protected $repository;

  /**
   * Construct the new form object.
   *
   * @param mydatoRepository $repository
   */
  public function __construct(mydatoRepository $repository) {
    $this->repository = $repository;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $form = new static(
      $container->get('mydato.mydato_Repository')
    );
    $form->setMessenger($container->get('messenger'));
    return $form;
  }

  /**
   * {@inheritdoc}
   */
 public function getFormId(){
      return 'mydato_form';
  }

 /**
   * {@inheritdoc}
   */
 public function buildForm(array $form, FormStateInterface $form_state)
  {
    $conn = Database::getConnection();
      $record =array();
      if (isset($_GET['num'])) {
        $query = $conn->select('mydato', 'm')
        ->condition('id', $_GET['num'])->fields('m');
        $record = $query->execute()->fetchAssoc();
      }

      $form['id'] = [
        '#type' => 'number',
        '#size' => 60,
        '#maxlength' => 30,
        '#title' => t('Numero de identificacion:'),
        '#attributes' => [
          'class' => ['custom--input'],
          'placeholder' => "Identificacion",
          'autocomplete' => "off",
          '#data-qadp' => 'form_id',
          '#ajax'=> [
            'callback' => [$this, 'validateid'],
            'wrapper' => 'field-id',
            'event' => 'change',
            //'disable-refocus' => true,
          ],
                    
        ],
        
        '#default_value' => (isset($record['id']) && $_GET['num']) ? $record['id']:'',
        
        
      ];

      $form['primer_nombre'] = [ 
        '#type' => 'textfield',
        '#title' => t('Primer Nombre:'),
        '#required' => TRUE,
        '#default_value' => (isset($record['name1']) && $_GET['num']) ? $record['name1']:'',
      ];
     

      $form['segundo_nombre'] = [ 
        '#type' => 'textfield',
        '#title' => t('segundo Nombre:'),
        //'#required' => TRUE,
        '#default_value' => (isset($record['name2']) && $_GET['num']) ? $record['name2']:'',
      ];

        $form['primer_apellido'] = [ 
            '#type' => 'textfield',
            '#title' => t('Primer Apellido:'),
            '#required' => TRUE,             
            '#default_value' => (isset($record['apel1']) && $_GET['num']) ? $record['apel1']:'',
          ];

        $form['segundo_apellido'] = [ 
            '#type' => 'textfield',
            '#title' => t('segundo Apellido:'),
            '#required' => TRUE,
            '#default_value' => (isset($record['apel2']) && $_GET['num']) ? $record['apel2']:'',
          ];
  
      $form['telefono'] = [ 
        '#type' => 'textfield',
        '#title' => t('Telefono:'),
        '#required' => TRUE,
        '#attributes' => [
          'class' => ['custom--input'],
          'placeholder' => "TELÉFONO",
          'autocomplete' => "on",
          'data-qadp' => 'form_phone',
        ],
        '#ajax' => [
          'callback' => 'validatetelefono',
          'event' => 'change',
          'wrapper' => 'field-relefono',
        ],
        '#default_value' => (isset($record['telefono']) && $_GET['num']) ? $record['telefono']:'',
      ];
  
      $form['email'] = [ 
        '#type' => 'email',
        '#title' => t('Email:'),
        '#required' => TRUE,
        '#attributes' => [
          'class' => ['custom--input'],
          'placeholder' => "CORREO",
          'autocomplete' => "on",
          'data-qadp' => 'form_email',
        ],
        '#ajax' => [
          'callback' => 'validateEmail',
          'event' => 'change',
          'wrapper' => 'field-email',
        ],
        '#suffix' => "<div id='email-valid-message'></div>",
        '#default_value' => (isset($record['email']) && $_GET['num']) ? $record['email']:'',
      ];
  
     $form['fecha_nacimiento'] = [
        '#type' => 'date',
        '#title' => t('Fecha de Nacimiento'),
        '#required' => TRUE,
        '#default_value' => (isset($record['fecha_nacimiento']) && $_GET['num']) ? $record['fecha_nacimiento']:'',
      ];
  
     /* $form['sexo'] = array (
        '#type' => 'select',
        '#title' => ('Sexo'),
        '#options' => array(
          'Female' => t('Femenino'),
          'male' => t('Masculino'),
          '#default_value' => (isset($record['sexo']) && $_GET['num']) ? $record['sexo']:'',
          ),
        );*/
        $form['sexo'] = [
          '#type' => 'select',
          '#required' => TRUE,
          '#empty_option' => t('GÉNERO'),
          '#options' => [
              'Male' => t('Hombre'),
              'Female' => t('Mujer'),
              'Other' => t('Prefiero no decir'),
            ],
          '#attributes' => [
            'class' => ['custom--input__select','secondary'],
          ],
        ];

        $form['termino'] = [ 
          '#type' => 'checkbox',
        //'#title' => t('Email:'),
        '#description' => t(' He leído, entendido y aceptado los <a href="#" target="_blank">Términos y Condiciones</a> y la  <a href="#" target="_blank">política de protección de datos personales</a>, en particular el procesamiento de mi información personal por parte de Bavaria &amp; Cía S.C.A. con las finalidades y usos requeridos por ésta descritos en la mencionada política.'),
        '#required_error' => t('Debe aceptar términos y condiciones y políticas de protección de datos personales.'),  
        '#required' => TRUE,
        '#default_value' => (isset($record['termino']) && $_GET['num']) ? $record['termino']:'',
           
      ];
    
  
    $form['#attached']['library'][] = 'mydato/global-styling';
          
      $form['submit'] = [
          '#type' => 'submit',
          '#value' => 'Guardar',
          //'#value' => t('Submit'),
          '#class' =>'btn btn-success',
      ];
  
      return $form;
  }



  public function validateid(array &$form, FormStateInterface $form_state) {

    $response = new AjaxResponse();
    $id = $form_state->getValue('id');
    $count = $this->repository->formDataExists('id', $id, NULL);

    if($count > 0 ) {
      $response->addCommand(new InvokeCommand('#edit-id', 'addClass' , ['id-exists']));
    }
    else {
      $response->addCommand(new InvokeCommand('#edit-id', 'removeClass' , ['id-exists']));
    }
    return $response;
    
  }

  
  public function validatemail(array &$form, FormStateInterface $form_state) {

    $response = new AjaxResponse();
    $email = $form_state->getValue('email');
    $count = $this->repository->formDataExists('email', $email, NULL);

    if($count > 0 ) {
      $response->addCommand(new InvokeCommand('#edit-email', 'addClass' , ['email-exists']));
    }
    else {
      $response->addCommand(new InvokeCommand('#edit-email', 'removeClass' , ['email-exists']));
    }
    return $response;

  }

  /**
    * {@inheritdoc}
    */
public function validateForm(array &$form, FormStateInterface $form_state) {

  $id =$form_state->getValue('id');
  if(!preg_match('/[0-9]{7,15}/', $id)) {
  $form_state->setErrorByName('id', $this->t('su identificacion, debe tener 7 números como minimo'));
  }

    $name1 = $form_state->getValue('Primer_nombre');
     if(preg_match('/[^A-Za-z]/', $name1)) {
        $form_state->setErrorByName('Primer_nombre', $this->t('tu primer nombre debe estar en caracteres sin espacio'));
     }

     $name2 = $form_state->getValue('Segundo_nombre');
     if(preg_match('/[^A-Za-z]/', $name2)) {
        $form_state->setErrorByName('Segundo_nombre', $this->t('tu nombre debe estar en caracteres sin espacio'));
     }
     if (strpos($form_state->getValue('email'), '+') == true) {
      $form_state->setErrorByName('email', $this->t('<p id="errorMailValido">Este correo electrónico no es valido</p>'));
  }
    /*$admin_user_ids = \Drupal::entityQuery('mydato')
            ->condition($id, $form_state->getValue('id'), '=')
            ->execute();
        if (count($admin_user_ids) > 0) {
            $form_state->setErrorByName('id', $this->t('<p id="errorCedula">Este número de identificación ya fue registrado</p>'));
        }*/
   
        
     
   /*if (!intval($form_state->getValue('Fecha_Nacimiento'))) {
        $form_state->setErrorByName('Fecha_Nacimiento', $this->t('Debe seleccionar su edad.'));
       }*/

       $telefono = $form_state->getValue('telefono');
       if(!preg_match('/[^A-Za-z]{7,15}/', $telefono)) {
          $form_state->setErrorByName('telefono', $this->t('tu telefono, debe estar en números'));
       }

     if (strlen($form_state->getValue('telefono')) < 10 ) {
       $form_state->setErrorByName('telefono', $this->t('su número de móvil debe ser de 10 dígitos'));
      }

      $validateid = \Drupal::database()->select('mydato','u')->condition('id',$id)->fields('u',['id'])->execute()->fetchField();

      if($validateid){
        $menssage = $this->t('<span class="error-message">El número de Identificacion ya existe.</span>');
        $form_state->setErrorByName('id', $menssage);
        $form_state->setRebuild();

      }
      $email = $form_state->getValue('email');
      $validateemail = \Drupal::database()->select('mydato','u')->condition('email',$email)->fields('u',['id'])->execute()->fetchField();

      if($validateemail){
        $menssage = $this->t('<span class="error-message">el Correo ya existe.</span>');
        $form_state->setErrorByName('email', $menssage);
        $form_state->setRebuild();

      }

      $validatetelefono = \Drupal::database()->select('mydato','u')->condition('telefono',$telefono)->fields('u',['id'])->execute()->fetchField();

      if($validatetelefono){
        $menssage = $this->t('<span class="error-message">el numero te telefono ya existe en nuestra Base de Datos.</span>');
        $form_state->setErrorByName('telefono', $menssage);
        $form_state->setRebuild();

      }


parent::validateForm($form, $form_state);
}

  /**
   * {@inheritdoc}
   */
public function submitForm(array &$form, FormStateInterface $form_state) {

    $field=$form_state->getValues();
    $fecha = date('d/m/y', strtotime($field['fecha_nacimiento']));
    $id=$field['id'];
    $name1=$field['primer_nombre'];
    $name2=$field['segundo_nombre'];
    $apel1=$field['primer_apellido'];
    $apel2=$field['segundo_apellido'];
    //echo "$name";
    $telefono=$field['telefono'];
    $email=$field['email'];
    $fecha_nacimiento=$fecha;
    $sexo=$field['sexo'];
    $termino=$field['termino'];

    

    

    if (isset($_GET['num'])) {
          $field  = array(
              'id' => $id,
              'name1'   => $name1,
              'name2'   => $name2,
              'apel1'   => $apel1,
              'apel2'   => $apel2,
              'telefono' =>  $telefono,
              'email' =>  $email,
              'sexo' => $sexo,
              'termino' => $termino,
              'fecha_nacimiento' => $fecha_nacimiento,
              //'website' => $website,
          );
          $query = \Drupal::database();
          $query->update('mydato')
              ->fields($field)
              ->condition('id', $_GET['num'])
              ->execute();
              \Drupal::messenger()->addMessage("actualizacion exitosa");
          $form_state->setRedirect('mydato.display_table_controller_mydatover');

      }

       else
       {
           $field  = array(
            'id'   =>  $id,
              'name1'   =>  $name1,
              'name2'   =>  $name2,
              'apel1'   =>  $apel1,
              'apel2'   =>  $apel2,
              'telefono' =>  $telefono,
              'email' =>  $email,
              'sexo' => $sexo,
              'fecha_nacimiento' => $fecha_nacimiento,
              'termino' => $termino,
              //'website' => $website,
          );
           $query = \Drupal::database();
           $query ->insert('mydato')
               ->fields($field)
               ->execute();
               \Drupal::messenger()->addMessage("Se guardo con exito");

           $response = new RedirectResponse("/mydato/table");
           //$response->send();
           return $response;
       }


    }

 }