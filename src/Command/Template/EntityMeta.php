<?php
/*
  Copyright 2013, amkt922 <amkt922@gmail.com>

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */
?>
<?php
echo "<?php\n";
?>
/**
 * EntityMeta class for table <?php echo $tableName ?>
 *
 * This file was generated at by ssql-gen.
 */
class <?php echo $className ?>Meta {
    /**
     * table name
     */
    const TABLE_NAME = <?php echo $tableName ?>;

<?php foreach ($columns as $column): ?>
    /**
     * column <?php echo $column['name'] ?> name
     */
	const <?php echo $column['constName'] ?> = "<?php echo $column['name'] ?>";
    <?php echo "\n" ?>
<?php endforeach; ?>

}

