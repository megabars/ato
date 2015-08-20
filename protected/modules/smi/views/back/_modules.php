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
                <?php echo $this->renderPartial('application.modules.pages.views.pageGallery.index', array('model' => $model->pageGallery)); ?>
            </div>
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
            <?php echo $this->renderPartial('application.modules.pages.views.pageDocuments.index', array('groupId' => $model->file_group_id) ,true); ?>
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
            <?php echo $this->renderPartial('application.modules.pages.views.pageVideo.index', array(
                'instanceType' => 'News',
                'pageModel' => $model)); ?>
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
            <?php echo $this->renderPartial('application.modules.pages.views.back._links', array(
                'groupId' => $model->pageLinks->id,
                'limit' => 5)); ?>
        </div>
    </div>

</div>
