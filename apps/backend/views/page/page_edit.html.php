<div>
  <p>last modified on: <?php echo $page->last_modified ?>, created on: <?php echo $page->created ?></p>
  <form method="post" action="<?php echo url_for('/page/edit/' . $page->slug) ?>">
    <label laber_for="page_title">Page title:</label>
    <br /> 
    <input value='<?php echo ($title = flash_now('page_title'))? $title : $page->title; ?>' maxlength="128" size="84" type="text" name="page[title]" /><br />
    <label label_for="page[body]"> Page description: </label>
    <br />
    <input type="hidden" name="page[type]" value="page" />
    <input type="hidden" name="page[id]" value="<?php echo $page->id ?>" />
    <textarea cols="64" rows="6" type="text" name="page[body]"><?php echo ($body = flash_now('page_body'))? $body : $page->body; ?></textarea><br />
    <input type="submit" value="Save page" /><a style="float: right" class="button" href="javascript: history.go(-1)" alt="return to last page"><span>Return</span></a>
  </form>
</div>