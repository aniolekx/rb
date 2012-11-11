<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Page {

  static function show_pages() {
    $pages = R::findAll('page');
    set('heading', 'Pages');
    set('pages', $pages);
    return html('/page/pages.html.php');
  }

  static function new_page_process() {
    $p = R::graph($_POST);
    R::begin();
    $id = R::store($p['page']);
    
    if ($p['page']->countErrors() < 1) {
      R::commit();
      flash('msg', 'Success, all changes has been saved');
      redirect('/pages');
    } else {
      R::rollback();
      flash('error_msg', $p['page']->getErrors());
      $page = $_POST['page'];
      flash('page_title', $page['title']);
      flash('page_body', $page['body']);
    }
    redirect('/page/new/' . $p['page']->slug);
    
   
    return html('/page/page_new.html.php');
  }

  static function new_page() {
    set('heading', 'New Page');
    set('title', 'New Page');
    return html('/page/page_new.html.php');
  }

  static function show_page() {
    $page = R::dispense('page')->getBySlug(params('page_slug'));
    set('heading', $page->title);
    set('page', $page);
    return html('/page/page.html.php');
  }

  static function edit_page() {
    $page = R::dispense('page')->getBySlug(params('page_slug'));
    set('heading', $page->page_title);
    set('page', $page);
    return html('/page/page_edit.html.php');
  }

  static function edit_page_process() {
    $p = R::graph($_POST);
    R::begin();
    $id = R::store($p['page']);
    
    if (!$p['page']->countErrors()) {
      R::commit();
      flash('msg', 'Success, all changes has been saved');
      redirect('/pages');
    } else {
      R::rollback();
      flash('error_msg', $p['page']->getErrors());
      $page = $_POST['page'];
      flash('page_title', $page['title']);
      flash('page_body', $page['body']);
    }
    redirect('/page/edit/' . $p['page']->slug);

  }

    static function delete_page() {
    $page = R::dispense('page')->getBySlug(params('page_slug'));
    R::trash($page);
    flash('msg', 'Success, page has been deleted');
    redirect('/pages');
    }

}