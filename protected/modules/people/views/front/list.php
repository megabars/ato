<div class="wrap">
    <h3><?php echo $this->pageTitle?></h3>

    <div class="collapses">
        <div class="item">
            <div class="title">
                <div class="name"><?php echo $this->pageTitle?></div>
                <div class="toggle"></div>
            </div>
            <div class="desc">
                <div class="list-links">
                    <ul>
                        <?php
                        if($models)
                            foreach($models as $m){?>
                                <li><a href="/people/front/view/id/<?php echo $m->id?>/from/upol"><?php echo People::getTypeLabels($m->type)?></a></li>
                            <?php }  ?>
                    </ul>
                </div>
            </div>
        </div>
        </div>
        </div>