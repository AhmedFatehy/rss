var TableDatatablesButtons = function () {

    var initAjaxCategoriesDatatables = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });

        var grid = new Datatable();

        // grid.setAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));

        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid, response) {},
            onError: function (grid) {},
            onDataLoad: function(grid) {},

            loadingMessage: 'تحميل ...',
            dataTable: {
                "bStateSave": true,
                "lengthMenu": [
                    [5, 10, 15, 20, 25],
                    [5, 10, 15, 20, 25]
                ],
                "pageLength": 5,
                "ajax": {
                    "url": "/dashboard/categories/ajax",
                },
                "aoColumns": [
                    { "bSortable": false },
                    null,
                    null,
                    null,
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    null,
                    { "bSortable": false }
                ],
                "order": [
                    [1, "asc"]
                ],
                buttons: [
                    { extend: 'print', className: 'btn default' },
                    { extend: 'copy', className: 'btn default' },
                    { extend: 'pdf', className: 'btn default' },
                    { extend: 'excel', className: 'btn default' },
                    { extend: 'csv', className: 'btn default' },
                    {
                        text: 'Reload',
                        className: 'btn default',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload();
                            alert('Datatable reloaded!');
                        }
                    }
                ],
            }
        });


        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            // console.log(action.val());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                // grid.addAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));
                // grid.setAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                // grid.addAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));
                // grid.setAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));

            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'من فضلك اختر إجراء',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'لم يتم اختيار اي سجلات',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        $('#datatable_ajax_tools > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }

    var initAjaxSeedsDatatables = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });

        var grid = new Datatable();

        // grid.setAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));

        grid.init({
            src: $("#seeds_datatable"),
            onSuccess: function (grid, response) {},
            onError: function (grid) {},
            onDataLoad: function(grid) {},

            loadingMessage: 'تحميل ...',
            dataTable: {
                "bStateSave": true,
                "lengthMenu": [
                    [5, 10, 15, 20, 25],
                    [5, 10, 15, 20, 25]
                ],
                "pageLength": 5,
                "ajax": {
                    "url": "/dashboard/seeds/ajax",
                },
                "aoColumns": [
                    { "bSortable": false },
                    null,
                    null,
                    null,
                    { "bSortable": false },
                    { "bSortable": false },
                    null,
                    { "bSortable": false }
                ],
                "order": [
                    [1, "asc"]
                ],
                buttons: [
                    { extend: 'print', className: 'btn default' },
                    { extend: 'copy', className: 'btn default' },
                    { extend: 'pdf', className: 'btn default' },
                    { extend: 'excel', className: 'btn default' },
                    { extend: 'csv', className: 'btn default' },
                    {
                        text: 'Reload',
                        className: 'btn default',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload();
                            alert('Datatable reloaded!');
                        }
                    }
                ],
            }
        });


        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            // console.log(action.val());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                // grid.addAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));
                // grid.setAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
                // grid.addAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));
                // grid.setAjaxParam("_token" , $('meta[name="csrf-token"]').attr('content'));

            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'من فضلك اختر إجراء',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'لم يتم اختيار اي سجلات',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        $('#datatable_ajax_tools > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }


    return {
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initAjaxCategoriesDatatables();
            initAjaxSeedsDatatables();
        }
    };
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init();
});