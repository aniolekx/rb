<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Page extends RedBean_MyCustomModel {

  function __construct() {
    $this->tableName('page');
}

  public function update() {
    parent::update();

    $this->isEmptyTitle();
    $this->isUniqueTitle();
    if ($this->countErrors() < 1) {
      $this->slug = $this->slug();
    }
  }

  public function open() {
    if (empty($this->slug)) {
      $this->slug = $this->slug();
      if (empty($this->slug))
        $this->slug = $this->id;
      R::begin();
      R::store($this);
      R::commit();
    }
    
  }

}