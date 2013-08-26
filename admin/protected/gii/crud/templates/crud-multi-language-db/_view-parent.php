<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 * @package Multi Language DB crud
 */
?>
<h2>Soruce - <?php echo '<?php echo $model->languageName; ?>'; ?></h2>

<?php echo "<?php\n"; ?>
$attributes = array(
        <?php
            foreach($this->tableSchema->columns as $column){
                if(in_array($column->name, array('deleted')))
                    continue;
                echo "\t\t'".$column->name."',\n";
            }
        ?>
);
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>$attributes,
));
?>