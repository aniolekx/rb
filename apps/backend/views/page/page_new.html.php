<div>
  <form action="<?php echo url_for('/page/new'); ?>" method="post">
    <label laber_for="page_title">Page title:</label>
    <br /> 
    <input value='<?php echo flash_now('page_title')?>' maxlength="128" size="84" type="text" name="page[title]" /><br />
    <label label_for="page_body"> Page description: </label>
    <br />
    <textarea cols="64" rows="6" type="text" name="page[body]"><?php echo flash_now('page_body')?></textarea><br />
    <input type="hidden" name="page[type]" value="page" />
    <input type="submit" value="Save page" /><a style="float: right" class="button" href="javascript: history.go(-1)" alt="return to last page"><span>Return</span></a>
  </form>
</div>