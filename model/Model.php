<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class RedBean_MyCustomModel extends RedBean_SimpleModel {

  private static $errors = array();
  private $t;

  public function error($field, $text, $table = '') {

    self::$errors[$table] = array($field => $text);
  }

  public function getErrors() {

    return self::$errors;
  }

  public function update() {

    //$this->errors = array(); // reset the errors array
  }

  public function after_update() {

    if (count(self::$errors) > 0) {
      if (empty($this->created))
        $this->created = R::isoDateTime();
      $this->last_modified = R::isoDateTime();
      //throw new Exception('Validation failed');
    }
  }

  protected function isEmptyTitle() {
    if (empty($this->title))
      $this->error('title', 'title is empty', $this->t);
  }

  protected function isUniqueTitle() {
    if ($this->countErrors() < 1) {

      $test = R::find('page', ' slug = ? AND id != ?', array($this->slug(), $this->id));

      if (count($test) > 0)
        $this->error('unique_title', 'page with this title already exist', $this->t);
    }
  }

  public function humanize($str) {
    $str = trim(strtolower($str));
    $str = preg_replace('/[^a-z0-9\s+]/', ' ', $str);
    $str = preg_replace('/\s+/', ' ', $str);
    $str = explode(' ', $str);
    return ucfirst(implode(' ', $str));
  }

  public function to_slug($str) {
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    return $clean;
  }

  public function getBySlug($slug) {
    return R::findOne($this->t, ' slug = ? LIMIT 1', array($slug));
  }

  public function countErrors() {
    return count(self::$errors);
  }

  public function slug() {
    return $this->to_slug($this->title);
  }

  protected function tableName($name) {
    $this->t = $name;
  }

}