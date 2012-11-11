<?php

abstract class Home {

  static function test() {
    $name = params('name');
    if (empty($name))
      halt(NOT_FOUND, "Undefined name.");
    # you can call an other controller function if you want
    set('name', $name);
    set('page_title', 'Tytulek');
    return html("I hope you are fine, $name.");
  }

  static function add() {
    return html('/home/form.html.php');
  }

  static function process_form() {
    $user = R::dispense('users');
    $user->name = $_POST['user_name'];
    $id = R::store($user);
    redirect_to('/test/show/', $id);
  }

  static function show_user() {
    $user = R::load('users', params('id'));
    echo $user->name;
    return '';
  }

}