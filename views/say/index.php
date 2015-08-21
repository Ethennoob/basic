hello index
<?php echo $this->render('about',array('v_hello_str'=>'hello world')); ?>
<?php $this->beginBlock('block1');?>
<h1>index</h1>
<?php $this->endBlock();?>