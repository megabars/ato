<?php

class m140826_101028_yii_rights extends CDbMigration
{
//	public function up()
//	{
//	}

    public function down()
    {
        echo "m140826_101028_yii_rights does not support migration down.\n";
        return true;
    }

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $sql = <<<END
CREATE TABLE IF NOT EXISTS usr_AuthAssignment (
  itemname varchar(64) NOT NULL,
  userid varchar(64) NOT NULL,
  bizrule text,
  data text,
  PRIMARY KEY (itemname,userid)
); 

INSERT INTO usr_AuthAssignment (itemname, userid, bizrule, data) VALUES
('Admin', '1', NULL, 'N;');

CREATE TABLE IF NOT EXISTS usr_AuthItem (
  name varchar(64) NOT NULL,
  type NUMERIC(11) NOT NULL,
  description text,
  bizrule text,
  data text,
  PRIMARY KEY (name)
);

INSERT INTO usr_AuthItem (name, type, description, bizrule, data) VALUES
('Admin', 2, NULL, NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Feedback.Front.*', 1, NULL, NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;'),
('News.Front.*', 1, NULL, NULL, 'N;'),
('Pages.Front.*', 1, NULL, NULL, 'N;'),
('User.Activation.*', 1, NULL, NULL, 'N;'),
('User.Login.*', 1, NULL, NULL, 'N;'),
('User.Logout.*', 1, NULL, NULL, 'N;'),
('User.Recovery.*', 1, NULL, NULL, 'N;'),
('User.Registration.*', 1, NULL, NULL, 'N;');

CREATE TABLE IF NOT EXISTS usr_AuthItemChild (
  parent varchar(64) NOT NULL,
  child varchar(64) NOT NULL,
  PRIMARY KEY (parent,child)  
);

INSERT INTO usr_AuthItemChild (parent, child) VALUES
('Authenticated', 'Feedback.Front.*'),
('Guest', 'Feedback.Front.*'),
('Authenticated', 'News.Front.*'),
('Guest', 'News.Front.*'),
('Authenticated', 'Pages.Front.*'),
('Guest', 'Pages.Front.*'),
('Authenticated', 'User.Activation.*'),
('Guest', 'User.Activation.*'),
('Authenticated', 'User.Login.*'),
('Guest', 'User.Login.*'),
('Authenticated', 'User.Logout.*'),
('Guest', 'User.Logout.*'),
('Authenticated', 'User.Recovery.*'),
('Guest', 'User.Recovery.*'),
('Authenticated', 'User.Registration.*'),
('Guest', 'User.Registration.*');

ALTER TABLE usr_AuthAssignment
ADD CONSTRAINT usr_AuthAssignment_ibfk_1 FOREIGN KEY (itemname) REFERENCES usr_AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE usr_AuthItemChild
  ADD CONSTRAINT usr_AuthItemChild_ibfk_1 FOREIGN KEY (parent) REFERENCES usr_AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT usr_AuthItemChild_ibfk_2 FOREIGN KEY (child) REFERENCES usr_AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE;
END;
        $command = $this->dbConnection->createCommand();
        $command->text = $sql;
        $command->execute();

    }
    /*
    public function safeDown()
    {
    }
    */
}
