<?php
//Example Script, saves Hello World to the database.
//First, we need to include redbean

require_once('rb.php');

class RedBean_MyCustomModel extends RedBean_SimpleModel {

  private static $errors = array();

  public function error($type, $field, $text) {

    self::$errors[$type] = array($field => $text);
  }

  public function getErrors() {

    return self::$errors;
  }

  public function update() {

    //$this->errors = array(); // reset the errors array
  }

  public function after_update() {

    if (count(self::$errors) > 0) {

      //throw new Exception('Validation failed');
    }
  }

}

class Model_Category extends RedBean_MyCustomModel {

  private $t = 'category';

  public function update() {

    parent::update();

    if (empty($this->name))
      $this->error($this->t, 'name', 'field is empty');
  }

}

class Model_Page extends RedBean_MyCustomModel {

  private $t = 'page';

  public function update() {

    parent::update();

    if (empty($this->name))
      $this->error($this->t, 'name', 'field is empty');
  }

}

class Model_Image extends RedBean_MyCustomModel {

  private $t = 'image';

  public function update() {

    parent::update();

    if (empty($this->name))
      $this->error($this->t, 'name', 'field is empty');
  }

}

R::setup('sqlite:/test.db');
R::debug(false);
//R::setup('database.txt'); -- for other systems



$all = R::findAll('page');

$all = R::$f->begin()->select('*')
      ->from('page')
      ->left_join('category')
      ->on('page.id = category.page_id')
      ->left_join('image')
      ->on('image.category_id = category.id');

// $test = R::exportAll($all);


 
 echo '<pre>';
 print_r($all->get());
 //ReflectionObject::export($all);
 echo '</pre>';
 
 
 die();
foreach ($all->get() as $one) {
  echo $one->name . '<br>';
  foreach ($one->ownCategory as $o)
    echo $o->name . '<br>';
}







if (count($_POST)) {



  $test = R::graph($_POST);

  $err = array();



  $page = $test['page'];

  $category = $test['category'];

  $image = $test['image'];

  $category->ownImage[] = $image;

  $page->ownCategory[] = $category;





  R::begin();

  

    foreach ($test as $t) {



    $id = R::store($t);

    if (count($t->getErrors()) > 0)

    $err[$t->getMeta('type')] = $t->getErrors();

    }

  

   

  $id = R::store($page);

  if (count($page->getErrors()) > 0)
    $err[$page->getMeta('type')] = $page->getErrors();



  if (count($err) > 0)
    R::rollback();

  else
    R::commit();
}

?>

<form method=post action="">

  <input type='hidden'name="page[type]" value="page"/>

  <input type='hidden'name="category[type]" value="category"/>

  <input type='hidden'name="image[type]" value="image"/>

  <input type='text'name="page[name]" value=""/>

  <input type='text'name="category[name]" value=""/>

  <input type='text'name="image[name]" value=""/>

  <br>

  <input type="submit"/></form>

<?php
IF (count($_POST)) {

  echo '<pre>';

  print_r($err);

  echo '</pre>';
}

/*

class Model_Todo extends RedBean_MyCustomModel {
	public function getList() {
		return R::findAndExport("todo");
	}
}
$beancan = new RedBean_BeanCan;
if (isset($_POST["json"])) die($beancan->handleJSONRequest( $_POST["json"] ));
?>
<html>
	<head><title>DEMO BEANCAN</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	</head>
	<body>
		
		<h1>My Todo List</h1>
		<ul class="list">
			<?php foreach(R::find("todo") as $todo): ?>
			<li><button todo="<?php echo $todo->id; ?>">DONE</button><?php echo $todo->description; ?></li>
			<?php endforeach; ?>
		</ul>
		<fieldset>
			<label>Todo:<label>
			<input type="text" id="dscr" />
			<button>add to list</button>
		</fieldset>
		
		<script>
			
			
			$("document").ready(function(){
				//Delete an Item
				var requestDelete = '{"jsonrpc":"2.0","id":"delete","method":"todo:trash","params":[@]}';
				var clickHandler = function(){
					var $btn = $(this);
					$.post("?",{"json":requestDelete.replace("@",$btn.attr("todo"))},function(d){
						eval("data="+d);
						if (data.id=="delete") $btn.parent().remove();
					});
				}
				//Attach Click Handlers
				$("li button").click(clickHandler);
				//Add an Item
				$("fieldset button").click(function(){
					var requestAdd = '{"jsonrpc":"2.0","id":"add_todo","method":"todo:store","params":[{"description":"@"}]}';
					$.post("?",{"json":requestAdd.replace("@",$("#dscr").val())},function(d){
						data = JSON.parse(d);
						if (data.id=="add_todo") {
							$(".list").append("<li><button todo='"+data.result+"'>DONE</button>"+$("#dscr").val()+"</li>");
							//Restore Click Handlers
							$("li button").unbind().click(clickHandler);
						}
					});		
				});
			});
			
		</script>
		
	</body>
</html>
 * *?
 */