<?php

namespace Drupal\mydato\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\mydato\Controller
 */


 class mydatoTableController extends ControllerBase {

    public function getContent() {
    // First we'll tell the user what's going on. This content can be found
    // in the twig template file: templates/description.html.twig.
    // @todo: Set up links to create nodes and point to devel module.
    $build =[
            'description' =>[
                '#theme' => 'mydato_description',
                '#description' => 'foo',
                '#attributes'  => [],
            ],
        ];
        return $build;
    }

     /**
   * mydatover.
   *
   * @return string
   *   Return Hello string.
   */
  public function mydatover() {
    //create table header
    $header_table = array(
        'id'=> t('Numero de Identificacion'),
         'name1' => t('Primer Nombre'),
         'name2' => t('Segundo Nombre'),
         'apel1' => t('Primer Apellido'),
         'apel2' => t('Segundo Apellido'),
           'telefono' => t('Telefono'),
           'email'=>t('Email'),
           'fecha_nacimiento'=>t('Fecha de Nacimiento'),
           'sexo' => t('Sexo'),
           'termino' => t('Termino'),
           //'website' => t('Web site'),
           'opt' => t('opcion 1'),
           'opt1' => t('opcion 2'),
       );

       $query = \Drupal::database()->select('mydato', 'm');
        $query->fields('m', ['id','name1','name2','apel1','apel2','telefono','email','fecha_nacimiento','sexo','termino']);
         $result = $query->execute()->fetchAll();
            $rows=array();
       foreach($result as $data){
           $delete = Url::fromUserInput('/mydato/form/delete/'.$data->id);
           $edit = Url::fromUserInput('/mydato/form/?num='.$data->id);


           $rows[] = array(
               'id'=> $data->id,
                    'name1'=> $data->name1,
                    'name2'=> $data->name2,
                    'apel1'=> $data->apel1,
                    'apel2'=> $data->apel2,
                    'telefono'=> $data->telefono,
                    'email'=> $data->email,
                    'fecha_nacimiento'=>$data->fecha_nacimiento,
                    'sexo' => $data->sexo,
                    'termino' => $data->termino,

                    \Drupal::l('Delete', $delete),
                    \Drupal::l('Edit', $edit),

           );

       }
       $form['table'] = [
           '#type' => 'table',
           '#header' => $header_table,
           '#rows' => $rows,
           'class' => ['table-hover' ],
           '#empty' => t('No se encontraron usuarios'),
       ];

       return $form;
  }



 }