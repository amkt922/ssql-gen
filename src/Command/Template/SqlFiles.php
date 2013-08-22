<?php 
echo "<?php\n";
?>
/**
 * SqlFiles
 */
class SqlFiles {

<?php foreach ($sqlList as $key => $value): ?>
	const <?php echo $key ?> = '<?php echo $value ?>';
<?php endforeach; ?>

}

