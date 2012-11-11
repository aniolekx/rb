<?php
require_once dirname(dirname(__FILE__)).'/lib/limonade.php';

function configure()
{
  option('env', ENV_DEVELOPMENT);
}

function before($route)
{
  layout('layout.html.php');
}

dispatch('/', 'home');
  function home()
  {
    echo option('base_uri');
    return "";
  }


  

    
dispatch('/test/:name', 'how_are_you');
  function how_are_you()
  {
    $name = params('name');
    if(empty($name)) halt(NOT_FOUND, "Undefined name.");
    # you can call an other controller function if you want
    set('name', $name);
    return html("I hope you are fine, $name.");
  }
  

   

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
