<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Ведутся технические работы';
?>

<div class="working">
    <div class="text">Портал должен заработать через:</div>
    <div class="timer" id="timer">
        <div class="item">
            <div class="numb">00</div>
            <div class="label">дней</div>
        </div>
        <div class="item">
            <div class="numb">00</div>
            <div class="label">часа</div>
        </div>
        <div class="item">
            <div class="numb">00</div>
            <div class="label">минут</div>
        </div>
        <div class="item">
            <div class="numb">00</div>
            <div class="label">секунд</div>
        </div>
    </div>
</div>
<div class="work-message">
    Просим прощения, но на портале<br/>
    ведутся <b>технические работы</b>
</div>


<script>
    $(document).ready(function(){
        var date = new Date(2015, 5, 15);
        $('#timer').countdown({
            until: date,
            format: 'DHMS',
            layout: '<div class="item"><div class="numb">{dn}</div><div class="label">{dl}</div></div><div class="item"><div class="numb">{hnn}</div><div class="label">{hl}</div></div><div class="item"><div class="numb">{mnn}</div><div class="label">{ml}</div></div><div class="item"><div class="numb">{snn}</div><div class="label">{sl}</div></div>'
        });
    });
</script>