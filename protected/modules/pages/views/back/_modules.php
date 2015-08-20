<div class="module-list">

    <!--    ФОТОГАЛЕРЕЯ -->
    <div class="item">
        <div class="head">
            <div class="name icon-photo">Фотографии <span id="photos_count">(<?php echo count($model->pageGallery->photoGalleryPhotos); ?>)</span></div>
            <div class="setting">
<!--                <a href="" class="link link-dotted toggle-module icon-off">Отключить</a>-->
<!--                <a href="" class="link link-dotted icon-settings open-settings">Редактировать</a>-->
<!--                <a href="" class="link link-dotted icon-on toggle-module">Подключить</a>-->
            </div>
        </div>
        <div class="body table-grid">
            <div class="module-gallery">
                <?php echo $this->renderPartial('../pageGallery/index', array('model' => $model->pageGallery)); ?>
            </div>
        </div>
    </div>


    <!-- НОВОСТИ -->
    <div class="item">
        <div class="head">
            <div class="name icon-link">Новости <span id="news_count">(<?php echo (isset($model->pageNews->news)) ? count($model->pageNews->news) : 'пусто'; ?>)</span></div>
            <div class="setting">
<!--                <a href="" class="link link-dotted toggle-module icon-off">Отключить</a>-->
            </div>
        </div>
        <div class="body table-grid">
            <?php echo $this->renderPartial('../pageNews/index', array('type' => $model->pageNews->id, 'limit' => 5)); ?>
        </div>
    </div>


<!--    ФАЙЛЫ -->
    <div class="item">
        <div class="head">
            <div class="name icon-file">Файлы
                <span id="files_count">(<?php echo Documents::model()->with('folder')->count('folder.group_id = '.$model->file_group_id) ?>)</span>
            </div>
            <div class="setting">
<!--                <a href="" class="link link-dotted toggle-module icon-off">Отключить</a>-->
<!--                <a href="" class="link link-dotted icon-settings open-settings">Редактировать</a>-->
<!--                <a href="" class="link link-dotted icon-on toggle-module">Подключить</a>-->
            </div>
        </div>
        <div class="body">
            <?php echo $this->renderPartial('../pageDocuments/index', array('groupId' => $model->file_group_id) ,true); ?>
        </div>
    </div>

    <!--    Видео -->
    <div class="item">
        <div class="head">
            <div class="name icon-link">Видео</div>
            <div class="setting">
<!--                <a href="" class="link link-dotted toggle-module icon-off">Отключить</a>-->
            </div>
        </div>
        <div class="body table-grid">
            <?php echo $this->renderPartial('../pageVideo/index', array('pageModel' => $model)); ?>
        </div>
    </div>

<!--    ФАКТЫ -->
    <div class="item">
        <div class="head">
            <div class="name icon-file">Факты
                <span id="facts_count">(<?php echo PageFacts::model()->countByAttributes(array('page_id' => $model->id)) ?>)</span>
            </div>
            <div class="setting">
<!--                <a href="" class="link link-dotted icon-settings open-settings">Редактировать</a>-->
<!--                <a href="" class="link link-dotted icon-on toggle-module">Подключить</a>-->
<!--                <a href="" class="link link-dotted toggle-module icon-off">Отключить</a>-->
            </div>
        </div>
        <div class="body">
            <?php echo $this->renderPartial('../pageFacts/index', array('pageModel' => $model, 'form' => $recordForm) ,true); ?>
        </div>
    </div>


<!--    ССЫЛКИ -->
    <div class="item">
        <div class="head">
            <div class="name icon-link">Карусель ссылок <span id="links_count">(<?php echo (isset($model->pageLinks->links)) ? count($model->pageLinks->links) : 'пусто'; ?>)</span></div>
            <div class="setting">
<!--                <a href="" class="link link-dotted icon-settings open-settings">Редактировать</a>-->
<!--                <a href="" class="link link-dotted icon-on toggle-module">Подключить</a>-->
<!--                <a href="" class="link link-dotted toggle-module icon-off">Отключить</a>-->
            </div>
        </div>
        <div class="body table-grid">
            <?php echo $this->renderPartial('_links', array('groupId' => $model->pageLinks->id, 'limit' => 5)); ?>
        </div>
    </div>

<!--    Контролирующий ИОГВ -->
    <div class="item">
        <div class="head">
            <div class="name icon-link">Органы власти <span id="exec_count">(<?php echo (isset($model->executives)) ? count($model->executives) : 'пусто'; ?>)</span></div>
            <div class="setting">
<!--                <a href="" class="link link-dotted toggle-module icon-off">Отключить</a>-->
            </div>
        </div>
        <div class="body table-grid">
            <?php echo $this->renderPartial('../pageExecutives/index', array('pageId' => $model->id)); ?>
        </div>
    </div>

</div>
