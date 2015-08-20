<div class="right-content">
    <div class="right-menu">
        <a href="/independentEvaluation/front/reason" class="<?php echo ($this->action->id=='reason')?'active':''; ?>">
            <?php echo DocumentType::instance()->list[DocumentType::REASON]; ?>
        </a>
        <a href="/independentEvaluation/front/recommendation" class="<?php echo ($this->action->id=='recommendation')?'active':''; ?>">
            <?php echo DocumentType::instance()->list[DocumentType::RECOMMENDATION]; ?>
        </a>
        <a href="/independentEvaluation/front/support" class="<?php echo ($this->action->id=='support')?'active':''; ?>">
            <?php echo DocumentType::instance()->list[DocumentType::SUPPORT]; ?>
        </a>
        <a href="/independentEvaluation/front/realization" class="<?php echo ($this->action->id=='realization')?'active':''; ?>">
            Реализация независимой оценки в Томской области
        </a>
        <a href="/independentEvaluation/front/result" class="<?php echo ($this->action->id=='result')?'active':''; ?>">
            <?php echo DocumentType::instance()->list[DocumentType::RESULT]; ?>
        </a>
    </div>
</div>
