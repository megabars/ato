<?php
/**
 * @var $this Controller
 * @var $records Video[]
 */

$this->pageTitle = 'Видеогалерея';

$this->breadcrumbs = array(
    'Видеогалерея'
);
?>
<div class="wrap">
    <h2>Видеогалерея</h2>
    <ul class="gallery-list clearfix">
        <li>
            <a href="<?php echo $this->createUrl('/video/front/view') ?>">
                <img src="<?php echo $this->getAssetsBase(); ?>/images/medium.jpg"/>
                <span class="desc">Lorem ipsum dolor sit amet.</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/video/front/view') ?>">
                <img src="<?php echo $this->getAssetsBase(); ?>/images/medium.jpg"/>
                <span class="desc">Lorem ipsum dolor sit amet.</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/video/front/view') ?>">
                <img src="<?php echo $this->getAssetsBase(); ?>/images/medium.jpg"/>
                <span class="desc">Lorem ipsum dolor sit amet.</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/video/front/view') ?>">
                <img src="<?php echo $this->getAssetsBase(); ?>/images/medium.jpg"/>
                <span class="desc">Lorem ipsum dolor sit amet.</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/video/front/view') ?>">
                <img src="<?php echo $this->getAssetsBase(); ?>/images/medium.jpg"/>
                <span class="desc">Lorem ipsum dolor sit amet.</span>
            </a>
        </li>
        <li>
            <a href="<?php echo $this->createUrl('/video/front/view') ?>">
                <img src="<?php echo $this->getAssetsBase(); ?>/images/medium.jpg"/>
                <span class="desc">Lorem ipsum dolor sit amet.</span>
            </a>
        </li>
    </ul>
</div>