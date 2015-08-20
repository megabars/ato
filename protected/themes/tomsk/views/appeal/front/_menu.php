<?php
/**
 * Created by PhpStorm.
 * User: rrnasibullin
 * Date: 12.02.2015
 * Time: 14:23
 */

$page = $this->action->id;
?>
<div class="right-content">
    <div class="right-menu">
        <a href="/appeal/front" class="<?php echo ($page=='index')?'active':'' ?>">Общая информация</a>
        <a href="/appeal/front/new" class="<?php echo ($page=='new')?'active':'' ?>">Подать обращение</a>
        <a href="/appeal/front/status" class="<?php echo ($page=='status')?'active':'' ?>">Ход рассмотрения</a>
        <a href="/grafik-priema-grazhdan" class="<?php echo ($page=='schedule')?'active':'' ?>">График приема граждан</a>
        <a href="/appeal/front/place" class="<?php echo ($page=='place')?'active':'' ?>">Место, время и порядок приема</a>
        <a href="/appeal/front/documents" class="<?php echo ($page=='documents')?'active':'' ?>">Нормативные документы</a>
        <a href="/appeal/front/review" class="<?php echo ($page=='review')?'active':'' ?>">Обзор обращений</a>
    </div>
</div>