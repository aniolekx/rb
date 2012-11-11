<?php


class User {
    public static function is_logged_in() {
        if(isset($_SESSION['logged_in'])){
            return true;
        }
        return false;
    }
}



require_once dirname(dirname(__FILE__)).'/lib/limonade.php';
require_once dirname(dirname(__FILE__)).'/lib/rb.php';



function configure()
{
  $path = dirname(dirname(__FILE__));
  option('env', ENV_DEVELOPMENT);
  option('views_dir', file_path($path . '/apps/backend/views'));
  option('controllers_dir', file_path($path . '/apps/backend/controllers'));
  option('model_dir', file_path($path . '/model'));
  set('title', 'Defaultek');
  require_once_dir(option('model_dir'));
  
 //$dsn = 'sqlite3:/'.file_path($path,'lib/rb.db');
  R::setup('sqlite:/rb.db');
}





function before($route)
{
  layout('layout.html.php');
}

dispatch('/', 'home');
  function home()
  {
  echo sys_get_temp_dir() . '<br>';
  //option('root_dir',           $root_dir);
  echo option('root_dir') . '<br>';
  //option('limonade_dir',       file_path($lim_dir));
  echo option('limonade_dir') . '<br>';
  //option('limonade_views_dir', file_path($lim_dir, 'limonade', 'views'));
  echo option('limonade_views_dir') . '<br>';
  //option('limonade_public_dir',file_path($lim_dir, 'limonade', 'public'));
  echo option('limonade_public_dir') . '<br>';
  //option('public_dir',         file_path($root_dir, 'public'));
  echo option('public_dir') . '<br>';
  //option('views_dir',          file_path($root_dir, 'views'));
  echo option('views_dir') . '<br>';
  //option('controllers_dir',    file_path($root_dir, 'controllers'));
  echo option('controllers_dir') . '<br>';
  //option('lib_dir',            file_path($root_dir, 'lib'));
  echo option('lib_dir') . '<br>';
  //option('error_views_dir',    option('limonade_views_dir'));
  echo option('error_views_dir') . '<br>';
  //$base_uri  = file_path($base_path, (($base_file == 'index.php') ? '?' : $base_file.'?'));
    echo option('base_uri');
    set('name', 'Krzysztof');
    return html('/home/index.html.php');
  }


  

    

dispatch('/test/add', 'Home::add');
dispatch_post('/test/add', 'Home::process_form');
dispatch('/test/show/:id', 'Home::show_user');
dispatch('/test/:name', 'Home::test');

dispatch('/pages', 'Page::show_pages');
dispatch_post('/page/new','Page::new_page_process');
dispatch('/page/new','Page::new_page');
dispatch('/page/:page_slug', 'Page::show_page');
dispatch('/page/edit/:page_slug','Page::edit_page');
dispatch_post('/page/edit/:page_slug','Page::edit_page_process');
dispatch_delete('/page/:page_slug','Page::delete_page');
   

function after($output, $route)
{
  $time = number_format( (float)substr(microtime(), 0, 10) - LIM_START_MICROTIME, 6);
  $output .= "\n<!-- page rendered in $time sec., on ".date(DATE_RFC822)." -->\n";
  $output .= "<!-- for route\n";
  $output .= print_r($route, true);
  $output .= "-->";
  return $output;
}


run();
