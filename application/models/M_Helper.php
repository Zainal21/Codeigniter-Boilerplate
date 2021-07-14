<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Helper extends CI_Model {
  /**
   *   use for retrieve all data from database
   *  @param table_name, data
   *  @return array
   */
  public function FetchAllData($table)
  {
    return $this->db->get($table)->result_array();
  }
  /**
   *   use for  retreive selected data from filter passing with parameter
   *  @param table, filter
   *  @return array
   */
  public function FetchSelectedData($table, $filter)
  {
    return $this->db->get_where($table, $filter);
  }
  /**
   *   use for action input data into database
   *  @param table, data
   *  @return int
   */
  public function HandleInsert($table, $data)
  {
    $this->db->insert($table, $data);
    return $this->db->affected_rows();
  }
  /**
   *   use for action insert batch data into database
   *  @param table, data
   *  @return int
   */
  public function HandleInsertBatch($table, $data)
  {
    $this->db->insert_batch($table, $data);
    return $this->db->affected_rows();
  }
  /**
   *   use for deleted item or data from database
   *  @param table_name&data
   *  @return int
   */
  public function HandleDelete($table, $filter)
  {
    $this->db->delete($table,$filter);
    return $this->db->affected_rows();
  }
  /**
   *   use for deleted item where not in spesific datable
   *  @param table_name&data
   *  @return int
   */
  public function DeleteWhereNotIn($table, $filter, $in = false, $field = false)
  {
      $this->db->where($filter);
      $this->db->where_not_in($field, $in);
      $this->db->delete($table);
      return $this->db->affected_rows();
  }
  /**
   *   use for updated item or data from database
   *  @param table, data, id filter
   *  @return int
   */
  public function HandleUpdate($table, $data, $filter)
  {
      $this->db->update($table, $data,$filter);
      return $this->db->affected_rows();
  }
  /**
   *   use for count all row from table parama
   *  @param table_name
   *  @return int
   */
  public function CountDataInRow($table, $filter = false)
  {
    if($filter)
    {
        $this->db->where($filter);
    }
    return $this->db->count_all_results($table);
  }
  /**
   *   use for sum row selected or spesific data
   *  @param table_name
   *  @return int
   */
  public function SumDataRow($field, $table, $filter)
  {
      $this->db->select_sum($field);
      return $this->db->get_where($table,$filter)->row();
  }
  /**
   *   use for sum row selected or spesific data
   *  @param table_name
   *  @return int
   */
  public function handlePrintLog($table = 'activity',$data)
  {
      $this->db->insert($table,$data);
      return $this->db->affected_rows();
  }
  /**
   *   use check data is contraint or not
   *  @param table_name
   *  @return boolean
   */
  public function CheckIsConstraint($table_one, $table_sec, $on=[], $filter)
  {
      $this->db->join($table_sec.' T2', $on, 'INNER');
      $result = $this->db->get_where($table_one.' T1', $filter)->num_rows();
      if($result > 0)
      {
          return false;
      }
      else
      {
          return true;
      }
  }
  /**
   *   use check data is exist or spesific table
   *  @param table_name
   *  @return boolean
   */
  public function CheckExist($table, $filter)
  {
      $result = $this->db->get_where($table, $filter)->num_rows();
      if($result > 0)
      {
          return false;
      }
      else
      {
          return true;
      }
  }
}
