
<div>
  <?php if (! count($pages)): ?>
  There are no definied pages.
  <?php endif ?>

 <?php foreach ($pages as $p): ?>
    <p>
      <a href="<?php echo url_for('/page/' . $p->slug); ?>"><?php echo $p->title ?></a> |  
      <a href="<?php echo url_for('/page/edit/' . $p->slug); ?>">edit</a> | 
       <a href="<?php echo url_for('/page/' . $p->slug);?>" onclick="if (confirm('Are you sure?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_method'); m.setAttribute('value', 'DELETE'); f.appendChild(m); f.submit(); };return false;">delete</a>
    </p>
    <?php endforeach ?>
 
</div>
<a class="button" href="<?php echo url_for('/page/new'); ?>"><span>Add new page</span></a>