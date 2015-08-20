/*
    modified fixedTable plugin.
 */
(function($) {
    $.fn.fixedTable = function(params) {
        var options = $.extend({}, {height: 500}, params);

        return this.each(function(index, table){
            var tbl = $(table),
                fixedColumnWidth = setSizes(tbl),
                layout = buildLayout(tbl);

            setWidth(layout, fixedColumnWidth);
            setHeight(layout, options.height);

            $(window).bind('resize.fixedTable',{layout: layout, width: fixedColumnWidth}, function(event){
                setWidth(event.data.layout, event.data.width)
            });

            $(".fixedContainer > .fixedTable", layout).bind('scroll.fixedTable', {layout: layout}, handleScroll);
        });
    };
    var setSizes = function(table) {
        var fixedColumnWidth = 0;
        table.find('tr').each(function(index, element){
            var rowHeight = $(element).height();
            $(element).children().first().outerHeight(rowHeight).next().outerHeight(rowHeight);

            if(fixedColumnWidth == 0)
                fixedColumnWidth = $(element).children().first().outerWidth()+1;

            if($(element).parent().is('thead') || $(element).is('tbody :first')) {
                $(element).children().each(function(childIndex, child){
                    $(child).width($(child).width());
                });
            }
        });
        return fixedColumnWidth;
    };

    var buildLayout = function(table) {
        var area = $('<div class="fixedArea clearfix"></div>').appendTo($(table).parent());

        //fixed column
        var fixedColumn = $('<div class="fixedColumn" style="float: left;\"></div>').appendTo(area);
        var fixedColumnHeader = $('<div class="fixedHead"></div>').appendTo(fixedColumn);
        var fixedColumnTable = $('<div class="fixedTable"></div>').appendTo(fixedColumn);
        var fixedColumnFooter = $('<div class="fixedFoot"></div>').appendTo(fixedColumn);

        //fixed container
        var fixedContainer = $('<div class=\"fixedContainer\"></div>').appendTo(area);
        var fixedContainerHeader = $('<div class=\"fixedHead\"></div>').appendTo(fixedContainer);
        var fixedContainerTable = $('<div class=\"fixedTable\"></div>').appendTo(fixedContainer);
        var fixedContainerFooter = $('<div class=\"fixedFoot\"></div>').appendTo(fixedContainer);

        buildFixedColumns(table, "thead", fixedColumnHeader);
        buildFixedColumns(table, "tbody", fixedColumnTable);
        buildFixedColumns(table, "tfoot", fixedColumnFooter);

        buildFixedTable(table, "thead", fixedContainerHeader);
        buildFixedTable(table, "tfoot", fixedContainerFooter);

        fixedContainerTable.append(table);
        return area;
    };

    var buildFixedColumns = function(table, section, part) {
        if ($(section, table).length) {
            var columnHead = $("<table></table>").appendTo(part),
                cellType = (section.toLowerCase() == "tbody") ? "td" : "th";

            $(section + " tr", table).each(function() {
                var tr = $("<tr></tr>").appendTo(columnHead),
                    cell = $(cellType + ":first", this);
                $("<td>" + cell.html() + "</td>").addClass(cell[0].className).attr("id", cell[0].id).attr("style", cell.attr('style')).appendTo(tr);
                cell.remove();
            });
        }
    };

    var buildFixedTable = function(table, section, part) {
        if ($(section, table).length) {
            var th = $("<table></table>").appendTo(part),
                tr = null,
                cellType = (section.toLowerCase() == "tbody") ? "td" : "th";

            $(section + " tr", table).each(function() {
                var tr = $("<tr></tr>").appendTo(th);
                $(cellType, this).each(function() {
                    $("<td>" + $(this).html() + "</td>").addClass(this.className).attr("id", this.id).attr("style", $(this).attr('style')).appendTo(tr);
                });
            });

            $(section, table).remove();
        }
    };

    var handleScroll = function (event) {
        var layout = event.data.layout;

        var tableArea = layout.find(".fixedContainer > .fixedTable"),
            x = tableArea[0].scrollLeft,
            y = tableArea[0].scrollTop;

        layout.find(" .fixedColumn > .fixedTable")[0].scrollTop = y;
        layout.find(" .fixedContainer > .fixedHead")[0].scrollLeft = x;
        layout.find(" .fixedContainer > .fixedFoot")[0].scrollLeft = x;
    };

    var setWidth = function(layout, fixedColumnWidth){
        var w = layout.width() - fixedColumnWidth-17;
        if (w <= 0)
            w = layout.width()-17;

        $(".fixedContainer", layout).width(w);
        $(".fixedContainer .fixedHead", layout).width(w);
        $(".fixedContainer .fixedTable", layout).width(w+17);
        $(".fixedContainer .fixedFoot", layout).width(w);
        $(".fixedColumn", layout).width(fixedColumnWidth);
        $(".fixedColumn > .fixedTable", layout).width(fixedColumnWidth);
    };

    var setHeight = function(layout, height){
        $(".fixedColumn", layout).height(height);
        var h = height - parseInt($(".fixedContainer > .fixedHead", layout).height()) - parseInt($(".fixedContainer > .fixedFoot", layout).height());
        if (h < 0)
            h = height;
        $(".fixedContainer > .fixedTable", layout).height(h);
        $(".fixedColumn > .fixedTable", layout).height(h-17);
    }
})(jQuery);