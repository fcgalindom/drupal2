<?php

namespace Drupal\mydato\Controller;

use Drupal\Core\Controller\ControllerBase;




/**
 * Class mydatoController.
 *
 * @package Drupal\mydato\Controller
 */

 class MydatoController extends ControllerBase {
     
  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */

   public function Mostrar() {
      /*return [
           '#type' => 'markup',
           '#markup' => $this->t('Esto es una prueba de controlador')
       ];*/
       $form = \Drupal::formBuilder()->getForm('\Drupal\mydato\Form\mydatoForm');
     
         return $form;
   }


 }