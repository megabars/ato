<div class="dashboard-block">

    <?php echo $this->renderPartial('_log', array('log' => $log)) ?>

    <?php echo $this->renderPartial('_metrika') ?>

    <?php echo $this->renderPartial('_feedback', array('feedback' => $feedback)) ?>

    <div class="item">
        <div class="head">Резервное копирование</div>
        <div class="body backups">
            <?php
            for ($i = 1; $i <= 5 ; $i++):
            ?>
            <div class="items accept">
                <span class="date"><?php echo date('d.m.Y', time() - $i * 24 * 3600); ?></span> <b></b>
<!--                <div class="buttons">-->
<!--                    <a href="" class="btn btn-light">Скачать дамп</a>-->
<!--                </div>-->
            </div>
            <?php endfor;?>

<!--            <div class="items error">-->
<!--                <span class="date">16.02.15 11:26</span>-->
<!--                <div class="buttons">-->
<!--                    <a href="" class="error-btn">Просмотр лога</a>-->
<!--                </div>-->
<!--            </div>-->

        </div>
    </div>

    <div class="item">
        <div class="head">Системные характеристики</div>
        <div class="body systems">
            <div class="groups groups3">
                <div class="items">
                    <div class="title">Версия CMS</div>
                    <div class="desc">yii framework версия - 1.1.15</div>
                </div>
                <div class="items">
                    <div class="title">Версия PHP</div>
                    <div class="desc"><?php echo $system['php']?></div>
                </div>
                <div class="items">
                    <div class="title">Версия СУБД</div>
                    <div class="desc">PostgreSQL версия - 8.4.20</div>
                </div>
            </div>
            <div class="groups groups2">
                <div class="items">
                    <div class="title">Доступная память (RAM)</div>
                    <div class="desc">
                        <canvas id="ram" width="30" height="30"></canvas>
                        <?php
                        @$free_persent = round(100*$system['free_memory']/$system['max_memory'],2);
                        ?>
                        <script>
                            var ramData = [
                                {
                                    value: <?php  echo $free_persent?>,
                                    color:"#80a4ed",
                                    highlight: "#f0f6ff"
                                },
                                {
                                    value: <?php  echo 100-$free_persent?>,
                                    color: "#f0f6ff",
                                    highlight: "#f0f6ff"
                                },
                            ]
                            var ram = $("#ram").get(0).getContext("2d");
                            var myLineChart = new Chart(ram).Doughnut(ramData, {
                                showTooltips: false
                            });
                        </script>
                        <?php  echo 100-$free_persent?>%
                        <span><?php echo Utils::getReadableFileSize($system['max_memory']-$system['free_memory'],'%01.1f %s')?> из <?php echo Utils::getReadableFileSize($system['max_memory'],'%01.1f %s')?></span>
                    </div>
                </div>
                <div class="items">
                    <div class="title">Доступно места (HDD)</div>
                    <div class="desc">
                        <canvas id="hdd" width="30" height="30"></canvas>
                        <?php
                        $free_persent = round(100*$system['free_hdd']/$system['max_hdd'],2);
                        ?>
                        <script>
                            var ramData = [
                                {
                                    value:<?php  echo 100-$free_persent?>,
                                    color:"#80a4ed",
                                    highlight: "#f0f6ff"
                                },
                                {
                                    value:<?php  echo $free_persent?>,
                                    color: "#f0f6ff",
                                    highlight: "#f0f6ff"
                                },
                            ]
                            var ram = $("#hdd").get(0).getContext("2d");
                            var myLineChart = new Chart(ram).Doughnut(ramData, {
                                showTooltips: false
                            });
                        </script>
                        <?php  echo $free_persent?>%
                        <span><?php echo Utils::getReadableFileSize($system['free_hdd'],'%01.1f %s')?> из <?php echo Utils::getReadableFileSize($system['max_hdd'],'%01.1f %s')?></span>
                    </div>
                </div>
            </div>
            <div class="groups">
                <div class="items">
                    <div class="title">Время работы системы</div>
                    <div class="desc">
                        <?php echo "".Utils::declOfNum((int)($system['uptime']/3600/24),array('день','дня','дней'))." ".gmdate("H:i:s",$system['uptime']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>