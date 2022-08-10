<?php

namespace Drupal\mydato;

use Drupal;
use Drupal\Core\Database\Connection;
use Exception;
use Drupal\Core\Form\FormStateInterface;

class mydatorepository {
  protected $connection;

  public function __construct() {
    $this->connection = \Drupal::database();
  }



  public function createRegister($entry, $table = NULL) {
    try {

      $entry['updated'] = $entry['created'] = \Drupal::time()->getRequestTime();
    
      if ( is_null($table) ) {
        $table = 'mydato';
      }
      return (int) $this->connection->insert($table)
        ->fields($entry)
        ->execute();
    }
    catch (\Exception $e) {
      Drupal::logger(__FUNCTION__)->error($e->getMessage());
    }
    return NULL;
  }
  public function getConnection() {
    return $this->connection;
  }

  public function formDataExists($column_name, $column_value, $campaign=NULL) {
    $query = $this->connection->select('mydato', 'data')
      ->fields('data')
      ->condition("data.$column_name", $column_value);
    if (!is_null($campaign)) {
      $query->condition('data.campaign', $campaign);
    }
  
    $result = $query->execute();
    $records = $result->fetchAll();
    $num_results = count($records);
    return $num_results;
  }
  
   /**
   * This method validates if a record exist according to the params
   * 
   * @param string $column_name
   * @param string $column_value
   * @param string $campaign
   */
  public function DataExists($column_name, $column_value, $campaign) {
    $query = $this->connection->select('mydato', 'data')
      ->fields('data')
      ->condition("data.$column_name", $column_value);
    if (!is_null($campaign)) {
      $query->condition('data.campaign', $campaign);
    }
  
    $result = $query->execute();
    $records = $result->fetchAll();
    $num_results = count($records);
    return $num_results;
  }

  /**
   * This method returns the number or rows of a query according to the params.
   * 
   * @param string $table
   * @param array $params
   */
  public function getNumRecords($table, $params = NULL) {

    $query = $this->connection->select($table, 'data')
      ->fields('data');
    
    if (!is_null($params)) {
      foreach($params as $key => $value) {
        if ($value == "NULL") {
          $query->condition("data.$key", NULL, 'IS NULL');
        }
        elseif($value == "NOT NULL") {
          $query->condition("data.$key", NULL, 'IS NOT NULL');
        }
        else {
          $query->condition("data.$key",$value);
        }
        
      }
    }

    $result = $query->execute();
    $records = $result->fetchAll();
    return count($records);
  }



    


 }