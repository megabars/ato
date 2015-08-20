<?php

/**### Timestamp 30/10/14 18:19:03 ###


* Added new table: 'YiiLog'
* Table 'YiiLog' -> New column: 'id' | type: 'int(11) primary KEY AUTO_INCREMENT'
* Table 'YiiLog' -> New column: 'level' | type: 'varchar(128) DEFAULT NULL'
* Table 'YiiLog' -> New column: 'category' | type: 'varchar(128) DEFAULT NULL'
* Table 'YiiLog' -> New column: 'logtime' | type: 'int(11) DEFAULT NULL'
* Table 'YiiLog' -> New column: 'message' | type: 'text DEFAULT NULL'
* Table 'nav_menu' -> New column: 'alias' | type: 'varchar(255) DEFAULT NULL'

**/

class m141030_141903_auto_generated extends CDbMigration {

   public function safeUp(){
         $this->addColumn('nav_menu','alias','varchar(255) DEFAULT NULL');
   }


   public function safeDown(){

         $this->dropColumn('nav_menu','alias');
   }
}
?>