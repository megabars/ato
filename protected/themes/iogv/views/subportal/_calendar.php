<div class="calendar-block">
    <div class="calendar">
        <div class="head">Календарь мероприятий</div>
        <div class="dates">
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'justmonday',
                'flat'=>true,
                'language'=>'ru',
                'options'=>array(
                    'showOtherMonths'=>true,
                    'showOtherDay'=>true,
                    'showAnim'=>'drop',
                    'dateFormat' => 'dd.mm.yy',
                    'altFormat'=>'dd MM yy',
                    'onSelect'=>'js:function(date) {
                    window.location = "/events/index?date=" + date;
                }'
                )
            ));?>
        </div>
        <div class="foot">
            План <a href="">на квартал</a> <a href="">на год</a>
        </div>
    </div>

    <div class="calendar-table">
        <table>
            <thead>
            <tr>
                <th>Дата</th>
                <th>Место проведения</th>
                <th>мероприятие</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>27.11</td>
                <td><span>ул. Красноармейская, 146</span></td>
                <td>
                    <span>
                        Открытие нового учебно-лабораторного корпуса ФГБОУ ВПО «Томский государственный
                        университет систем управления и радиоэлектроники»
                    </span>
                </td>
            </tr>
            <tr>
                <td>27.11</td>
                <td>
                    <span>
                        с. Кожевниково
                        Кожевниковского района
                    </span>
                </td>
                <td>
                    <span>Открытие МАОУ «Кожевниковская средняя общеобразовательная школа № 2»</span>
                </td>
            </tr>
            <tr>
                <td>27.11</td>
                <td>
                    <span>
                        с. Кожевниково
                        Кожевниковского района
                    </span>
                </td>
                <td>
                    <span>Открытие МАОУ «Кожевниковская средняя общеобразовательная школа № 2»</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>