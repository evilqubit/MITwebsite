<?php
$this->breadcrumbs = array(
    'Newsletter'=>array('admin/index'),
    'Groups'=>array('index'),
    $model->name=>array('view', 'id'=>$model->id),
    'Add Multiple Subscribers',
);

$this->menu = array(
    array('label'=>'List Newsletter Groups', 'url'=>array('index')),
    array('label'=>'Create Newsletter Group', 'url'=>array('create')),
    array('label'=>'View Newsletter Group', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Add Multiple Subscribers for Group <?php echo $model->id; ?></h1>

<form method="POST">
    <div><?php echo CHtml::ListBox('subscribers', '', $subscribersArray, array('multiple'=>'multiple')); ?></div>
    <br />
    <div><input type="submit" value="Save" /></div>
</form>