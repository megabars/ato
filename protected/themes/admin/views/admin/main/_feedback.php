<div class="item">
    <div class="head"><a href="<?php echo $this->createUrl('/'); ?>feedback/back/index">Обратная связь</a></div>
    <div class="body feeback-message">
        <div class="items">
            <div class="title <?php echo ($feedback['new_question'] != 0) ? 'active': ''; ?>">Задать вопрос</div>
            <div class="number">
                <div class="all"><?php echo $feedback['question']; ?></div>
                <div class="right">
                    <div class="new"><?php echo ($feedback['new_question'] != 0) ? '+'. $feedback['new_question']: '&nbsp;'; ?></div>
                    <div class="text">вопросов</div>
                </div>
            </div>
        </div>

        <div class="items">
            <div class="title <?php echo ($feedback['new_suggestion'] != 0) ? 'active': ''; ?>">Отзывы и предложения</div>
            <div class="number">
                <div class="all"><?php echo $feedback['suggestion']; ?></div>
                <div class="right">
                    <div class="new"><?php echo ($feedback['new_suggestion'] != 0) ? '+'. $feedback['new_suggestion']: '&nbsp;'; ?></div>
                    <div class="text">сообщений</div>
                </div>
            </div>
        </div>

        <div class="items">
            <div class="title <?php echo ($feedback['new_support'] != 0) ? 'active': ''; ?>">Техподдержка</div>
            <div class="number">
                <div class="all"><?php echo $feedback['support']; ?></div>
                <div class="right">
                    <div class="new"><?php echo ($feedback['new_support'] != 0) ? '+'. $feedback['new_support']: '&nbsp;'; ?></div>
                    <div class="text">запросов</div>
                </div>
            </div>
        </div>

        <div class="items">
            <div class="title <?php echo ($feedback['new_complain'] != 0) ? 'active': ''; ?>">Пожаловаться</div>
            <div class="number">
                <div class="all"><?php echo $feedback['complain']; ?></div>
                <div class="right">
                    <div class="new"><?php echo ($feedback['new_complain'] != 0) ? '+'. $feedback['new_complain']: '&nbsp;'; ?></div>
                    <div class="text">жалобы</div>
                </div>
            </div>
        </div>
    </div>
</div>