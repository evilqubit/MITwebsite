<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Create',
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
);
?>

<h1>Create <?php echo $this->modelClass; ?>  - <?php echo '<?php echo $language ?>'; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>

<br />

<?php echo "<?php if(\$model->parentId): ?>\n"; ?>
    <?php echo '<?php
        echo $this->renderPartial(\'_view-parent\', array(\'model\'=>$model->parent));
    ?>'; ?>
<?php echo "\n<?php endif; ?>\n"; ?>
