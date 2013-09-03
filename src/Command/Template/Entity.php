<?php 
echo "<?php\n";
?>
/**
 * Entity
 */
class <?php echo $className ?> {

    const NAME = <?php echo $tableName ?>;

<?php foreach ($columns as $column): ?>
	public $<?php echo $column['name'] ?>;
<?php endforeach; ?>

}

