<?php

class m150219_125409_new_table_executive extends CDbMigration
{
    public function down()
    {
        $this->dropTable('executive');
    }

    public function safeUp()
    {

        $this->createTable('executive', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'name'=>'varchar(500)',
        ));

        $this->insert('executive', array('name' => 'Департамент экономики'));
        $this->insert('executive', array('name' => 'Департамент по недропользованию и развитию нефтегазодобывающего комплекса'));
        $this->insert('executive', array('name' => 'Департамент энергетики'));
        $this->insert('executive', array('name' => 'Департамент по науке и инновационной политике'));
        $this->insert('executive', array('name' => 'Департамент по высшему профессиональному образованию'));
        $this->insert('executive', array('name' => 'Департамент государственной гражданской службы'));
        $this->insert('executive', array('name' => 'Департамент информационной политики'));
        $this->insert('executive', array('name' => 'Департамент потребительского рынка'));
        $this->insert('executive', array('name' => 'Департамент международных и региональных связей'));
        $this->insert('executive', array('name' => 'Департамент экспертно-аналитической работы'));
        $this->insert('executive', array('name' => 'Департамент по работе с органами местного самоуправления'));
        $this->insert('executive', array('name' => 'Департамент по взаимодействию с законодательными и представительными органами власти'));
        $this->insert('executive', array('name' => 'Департамент развития информационного общества'));
        $this->insert('executive', array('name' => 'Комитет общественной безопасности'));
        $this->insert('executive', array('name' => 'Комитет по мобилизационной подготовке'));
        $this->insert('executive', array('name' => 'Комитет по вопросам гражданской обороны и чрезвычайным ситуациям'));
        $this->insert('executive', array('name' => 'Комитет по общим вопросам'));
        $this->insert('executive', array('name' => 'Комитет по государственно-правовым вопросам'));
        $this->insert('executive', array('name' => 'Комитет организационной работы и протокола'));
        $this->insert('executive', array('name' => 'Комитет по атомной промышленности'));
        $this->insert('executive', array('name' => 'Финансово-хозяйственное управление'));
        $this->insert('executive', array('name' => 'Контрольно-ревизионное управление'));
        $this->insert('executive', array('name' => 'Отдел по обеспечению деятельности Совета безопасности'));
        $this->insert('executive', array('name' => 'Отдел по документальной связи и режиму'));
        $this->insert('executive', array('name' => 'Департамент финансов'));
        $this->insert('executive', array('name' => 'Департамент государственного заказа'));
        $this->insert('executive', array('name' => 'Департамент тарифного регулирования'));
        $this->insert('executive', array('name' => 'Департамент промышленности и развития предпринимательства Томской области'));
        $this->insert('executive', array('name' => 'Департамент транспорта, дорожной деятельности и связи'));
        $this->insert('executive', array('name' => 'Департамент лесного хозяйства'));
        $this->insert('executive', array('name' => 'Департамент по социально-экономическому развитию села'));
        $this->insert('executive', array('name' => 'Департамент природных ресурсов и охраны окружающей среды'));
        $this->insert('executive', array('name' => 'Департамент по культуре и туризму'));
        $this->insert('executive', array('name' => 'Департамент по управлению государственной собственностью'));
        $this->insert('executive', array('name' => 'Департамент инвестиций'));
        $this->insert('executive', array('name' => 'Департамент ЖКХ и государственного жилищного надзора'));
        $this->insert('executive', array('name' => 'Департамент архитектуры и строительства'));
        $this->insert('executive', array('name' => 'Департамент общего образования'));
        $this->insert('executive', array('name' => 'Департамент здравоохранения'));
        $this->insert('executive', array('name' => 'Департамент социальной защиты населения'));
        $this->insert('executive', array('name' => 'Департамент труда и занятости населения'));
        $this->insert('executive', array('name' => 'Департамент по вопросам семьи и детей'));
        $this->insert('executive', array('name' => 'Департамент по молодежной политике, физической культуре и спорту'));
        $this->insert('executive', array('name' => 'Департамент профессионального образования Томской области'));
        $this->insert('executive', array('name' => 'Департамент ЗАГС Томской области'));
        $this->insert('executive', array('name' => 'Комитет по обеспечению деятельности мировых судей'));
        $this->insert('executive', array('name' => 'Комитет по контролю, надзору и лицензированию в сфере образования'));
        $this->insert('executive', array('name' => 'Комитет по лицензированию'));
        $this->insert('executive', array('name' => 'Комитет рыбного хозяйства'));
        $this->insert('executive', array('name' => 'Комитет государственного финансового контроля'));
        $this->insert('executive', array('name' => 'Управление ветеринарии'));
        $this->insert('executive', array('name' => 'Управление охотничьего хозяйства'));
        $this->insert('executive', array('name' => 'Инспекция государственного технического надзора'));
        $this->insert('executive', array('name' => 'Главная инспекция государственного строительного надзора'));
        $this->insert('executive', array('name' => 'Представительство Томской области при Правительстве Российской Федерации'));
    }
}