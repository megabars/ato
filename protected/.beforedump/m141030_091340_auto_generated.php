<?php

/**### Timestamp 30/10/14 13:13:40 ###


* Table 'nav_menu' -> New column: 'portal_id' | type: 'int(11) NOT NULL'
* Table 'nav_items' -> Dropped column: 'portal_id' | type: 'int(11) NOT NULL'
* Table 'nav_items' -> Dropped column: 'title' | type: 'varchar(255) NOT NULL'
* Table 'nav_items' -> Dropped column: 'url' | type: 'varchar(500) NOT NULL'
* Table 'nav_items' -> Dropped column: 'parent_id' | type: 'int(11) DEFAULT NULL'
* Table 'nav_items' -> Dropped column: 'ordi' | type: 'int(11) DEFAULT NULL'
* Table 'nav_items' -> Dropped column: 'state' | type: 'int(11) DEFAULT NULL'
* Table 'nav_items' -> Dropped column: 'menuId' | type: 'int(11) NOT NULL'
* Table 'nav_items' -> Dropped column: 'photo' | type: 'varchar(255) DEFAULT NULL'

**/

class m141030_091340_auto_generated extends CDbMigration {

   public function safeUp(){
         $this->addColumn('nav_menu','portal_id','NUMERIC(11) DEFAULT 1');
         $this->dropColumn('nav_items','portal_id');
   }


   public function safeDown(){
         $this->addColumn('nav_items','portal_id','NUMERIC(11) DEFAULT NULL');
         $this->dropColumn('nav_menu','portal_id');
   }
}
?>
