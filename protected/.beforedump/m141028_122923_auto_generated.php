<?php

/**### Timestamp 28/10/14 16:29:23 ###


* Table 'nav_items' -> New column: 'photo' | type: 'varchar(255) DEFAULT NULL'

**/

class m141028_122923_auto_generated extends CDbMigration {

   public function safeUp(){

         $this->addColumn('nav_items','photo','varchar(255) DEFAULT NULL');
   }


   public function safeDown(){

         $this->dropColumn('nav_items','photo');
   }
}
?>