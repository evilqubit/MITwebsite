<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
);
foreach($model->remainingLanguages() as $key=>$value){
    $this->menu[] = array('label'=>"Add Translation: $value", 
        'url'=>array('create', 'parentId'=>$model->id, 'lang'=>$key));
}
$childAttributes = array(
        <?php
        foreach($this->tableSchema->columns as $column){
            if(in_array($column->name, array('deleted')))
                continue;
            echo "\t\t'".$column->name."',\n";
        }
        ?>
);
?>

<h1>View <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo '<?php echo $model->buttons(); ?>'; ?>

<?php echo '<?php echo $this->renderPartial(\'_view-parent\', array(\'model\'=>$model)); ?>'; ?>

<?php echo '<?php foreach($model->children as $child): ?>'; ?>
<br /><br />
<?php echo '<?php echo $child->buttons(); ?>'; ?>
<h2>Translation - <?php echo '<?php echo $child->languageName; ?>'; ?></h2>
    <?php echo '<?php'; ?>
    $this->widget('zii.widgets.CDetailView', array(
        'data'=>$child,
        'attributes'=>$childAttributes,
    ));
    <?php echo '?>';?>
<?php echo "\n<?php endforeach; ?>\n";?>
