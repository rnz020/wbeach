$(document).ready(function () {


});

function KendoSettings() {
    this.url = '';
    this.height= '';
    this.rowTemplate = '';
    this.columns = '';
    this.filter = '';
    this.pageable = true;
    this.page = 10;
    this.wrapper = '#grid';
    this.filterable = false;
    this.data = {};
    this.dataBound = function (e) {
        showMessage(e);
    };
}

KendoSettings.prototype.setUrl = function (url) {
    this.url = url;
    return this;
};
KendoSettings.prototype.setHeight = function (height) {
    this.height = height;
    return this;
};
KendoSettings.prototype.setRowTemplate = function (template) {
    this.rowTemplate = template;
    return this;
};
KendoSettings.prototype.setcolumns = function (columns) {
    this.columns = columns;
    return this;
};
KendoSettings.prototype.setPage = function (page) {
    this.page = page;
    return this;
};
KendoSettings.prototype.setPageable = function (pageable) {
    this.pageable = pageable;
    return this;
};
KendoSettings.prototype.setWrapper = function (wrapper) {
    this.wrapper = wrapper;
    return this;
};

KendoSettings.prototype.setData = function (data) {
    this.data = data;
    return this;
};

KendoSettings.prototype.setDataBound = function (fnc) {
    this.dataBound = fnc;
    return this;
};

KendoSettings.prototype.filterable = function (fnc) {
    this.filterable = fnc;
    return this;
};

KendoSettings.prototype.setFilter = function (filter) {
    this.filter = filter;
    return this;
};

KendoSettings.prototype.render = function () {

    if (typeof window.kendo !== 'object') {
        alert('Kendo no ha sigo cargado aún');
        return;
    }

    if (! this.pageable )
    {
        var pageable = false;
    }
    else
    {
        var pageable = {pageSize: this.page, refresh: true, pageSizes: true, messages: {
            display: "{0} - {1} de {2} registros",
            empty: "No se encontraron registros",
            page: "Página",
            of: "of {0}",
            itemsPerPage: "registros por página",
            first: "Ir a la primera página",
            previous: "Ir a la página anterior",
            next: "Ir a la página siguiente",
            last: "Ir a la última página",
            refresh: "Refrescar"
        }};
    }

    var settings = {
        dataSource: {
            transport: {
                read: {url: this.url, dataType: 'json', type: 'GET', data: this.data}
            },
            schema: {data: 'data', total: 'total'},
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },
        scrollable: true,
        resizable: true,
        dataBound: this.dataBound,
        filterable: this.filterable,
        sortable: true,
        height: this.height,        
        pageable: pageable,
        columns: this.columns

    };

    if (this.filter !== '') {
        settings.dataSource.filter = this.filter;
    }
    if (this.rowTemplate !== '') {
        settings.rowTemplate = kendo.template(this.rowTemplate);
    }

    $(this.wrapper).kendoGrid(settings);
};

var ModalCRUD = {
    create_element: '#new-entity',
    edit_element:   '.edit-entity',
    show_element:   '.show-entity',
    delete_element: '.delete-entity',

    create: function (options) {

        if (!options.element)
        {
            options.element = ModalCRUD.create_element
        }
       
        $(options.element).on('click', function(e){
            e.preventDefault(); 
            var current_button = $(this)

            $(current_button).addClass('not-active')

            $.get(options.url).done(function (form_content) {
console.log(form_content);
                var form_title  = 'NUEVO ' + options.title.toUpperCase()
                var form_submit = 'GUARDAR'
                var form_selector   = options.form_element ? options.form_element : '#form-create'

                var confirm_message = '¿Está seguro de crear este registro de ' + options.title.toLowerCase() + '?'
                var confirm_title   = 'CREACIÓN DE ' + options.title.toUpperCase()
                var success_message = 'El registro se creó correctamente.'

                ModalForm( form_title, form_submit, form_content, form_selector, options, confirm_message, confirm_title, success_message, current_button)
            });

        });

    },
    edit: function (options) {

        if (!options.element)
        {
            options.element = ModalCRUD.edit_element
        }
       
        $('body').on('click', options.element, function(e){
            e.preventDefault();
            var current_button = $(this)
                
            $(current_button).addClass('not-active')

            var parent = $(this).parent()

            var id = $(parent).data('id')
            var entity_name = String($(parent).data('name'))

            var url = options.url.replace(':ROW_ID', id)

            $.get(url, id).done(function (form_content) {

                if (options.full_form_title)
                {
                    var form_title      = options.full_form_title
                    var confirm_message = options.full_confirm_message
                    var confirm_title   = options.full_confirm_title

                    var success_message = options.full_success_message
                }
                else
                {
                    var form_title      = 'EDITAR ' + options.title.toUpperCase() + ' "' + entity_name.toUpperCase() + '"'
                    var confirm_message = '¿Está seguro de editar el registro de ' + options.title.toLowerCase() + '?'
                    var confirm_title   = 'EDICIÓN DE ' + options.title.toUpperCase()

                    var success_message = 'El registro se editó correctamente.'
                }

                var form_selector   = options.form_element ? options.form_element : '#form-update'
                var form_submit     = 'ACTUALIZAR'


                ModalForm( form_title, form_submit, form_content, form_selector, options, confirm_message, confirm_title, success_message, current_button)

            }).error(function(jqXHR){

                AlertMessage.hideSpining('.confirm-dialog')
                $('.confirm-dialog').modal('hide')

                if (jqXHR.status == 404)
                {
                    AlertMessage.printError('.side-body', 'El registro no existe o ha sido eliminado.')
                }

            });;

        });

    },
    show: function (options) {

        if (!options.element)
        {
            options.element = ModalCRUD.show_element
        }

        $('body').on('click', options.element, function(e){
            e.preventDefault();
            var current_button = $(this)
            
            $(current_button).addClass('not-active')

            var parent = $(this).parent()

            var id = $(parent).data('id')
            var entity_name = String($(parent).data('name'))

            var url = options.url.replace(':ROW_ID', id)

            $.get(url, id).done(function (data) {

                bootbox.dialog({
                    className: 'modal-primary',
                    closeButton: false,
                    message: data,
                    title: "DETALLE " + options.title,
                    buttons: {
                        default: {
                            label: "CERRAR",
                            className: "btn-default",
                            callback: function() {
                                $(current_button).removeClass('not-active')
                            }
                        },
                    }
                });
            }).error(function(jqXHR){

                AlertMessage.hideSpining('.confirm-dialog')
                $('.confirm-dialog').modal('hide')

                if (jqXHR.status == 404)
                {
                    AlertMessage.printError('.side-body', 'El registro no existe o ha sido eliminado.')
                }

            });

        });
    },
    delete: function (options) {

        if (!options.element)
        {
            options.element = ModalCRUD.delete_element
        }

        $('body').on('click', options.element, function(e){
            e.preventDefault(); 
            var parent = $(this).parent()

            var id = $(parent).data('id')
            var entity_name = String($(parent).data('name'))

            bootbox.dialog({
                    className: 'modal-danger',
                    closeButton: false,
                    message: '¿Está seguro de eliminar el registro de '+ options.title.toLowerCase() + ' "' + entity_name + '"?',
                    title: "ELIMINACIÓN DE " + options.title.toUpperCase(),
                    buttons: {
                        default: {
                            label: "NO",
                            className: "btn-default",
                            callback: function() {
                                // Example
                            }
                        },
                        main: {
                            label: "SÍ",
                            className: "btn-primary",
                            callback: function() {

                                var form = $('#form-delete');
                                var url  = form.attr('action').replace(':ROW_ID', id);
                                var data = form.serialize();

                                 $.ajax({
                                    url: url,
                                    type: "post",
                                    data: data,
                                    dataType: 'json',
                                    success: function(data)
                                    {
                                        $('.bootbox').modal('hide');
                                        
                                        refreshKendo()

                                        var success_message = bootbox.dialog({
                                            className: 'modal-success',
                                            backdrop: true,
                                            message: 'El registro se eliminó correctamente.',
                                            title: "ÉXITO",
                                        })

                                        hideModal(success_message, 3)
                                    },
                                    error: function(jqXHR)
                                    {
                                        AlertMessage.hideSpining('.confirm-dialog')
                                        $('.confirm-dialog').modal('hide')

                                        if (jqXHR.status == 404)
                                        {
                                            AlertMessage.printError('.side-body', 'El registro no existe o ha sido eliminado.')
                                        }

                                        if (jqXHR.status == 422)
                                        {
                                            var message = jqXHR.responseJSON ? jqXHR.responseJSON : ''
                                            AlertMessage.printError('.side-body', message)
                                        }

                                        if (jqXHR.status == 500)
                                        {
                                            AlertMessage.printError('.side-body', 'Error interno del servidor')
                                        }
                                    }
                                });
                            }
                        }
                    }
                });
        });
    }
};

var AlertMessage = {
    SUCCESS: 1,
    ERROR: 0,
    spinId: '32er32',
    printError: function ($elm, msg) {
        var out = '';
        if (typeof msg === "object") {
            var a = [];
            for (var i in msg) {
                a.push(msg[i]);
            }
            out = a.join("<br/>");
        } else {
            out = msg;
        }

        var tpl = AlertMessage.errorTpl();
        var msg = tpl.replace("##msg##", "<br/>" + out);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printSuccess: function ($elm, msg) {
        var tpl = AlertMessage.successTpl();
        msg = tpl.replace("##msg##", msg);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    printInfo: function ($elm, msg) {
        var tpl = AlertMessage.infoTpl();
        msg = tpl.replace("##msg##", msg);
        AlertMessage.removeCurrentAlerts()
        $($elm).prepend(msg);
    },
    errorTpl: function () {
        return "<div class='alert fresh-color alert-danger alert-dismissible' role='alert'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                        "<strong>Ha ocurrido un error!</strong> ##msg##" +
                "</div>"
    },
    successTpl: function () {
        return "<div class='alert fresh-color alert-success alert-dismissible' role='alert'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                        "<strong>Éxito!</strong> ##msg##" +
                "</div>"
    },
    infoTpl: function () {
        return "<div class='alert fresh-color alert-info alert-dismissible' role='alert'>" +
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                        "<strong>Info!</strong> ##msg##" +
                "</div>"
    },
    spin: function () {
        return "<div id='32er32' class='loader-container text-center color-white'>" +
                    "<div><i class='fa fa-spinner fa-pulse fa-3x'></i></div>" +
                    "<div>Cargando</div>" +
                "</div>"
    },
    showSpining: function (idElement) {
        $('.modal-content', idElement).append(AlertMessage.spin());
        $('.modal-content', idElement).addClass('loader');
    },
    hideSpining: function (idElement) {
        $(idElement).find("#" + AlertMessage.spinId).remove();
    },
    removeCurrentAlerts: function(){
        $('body .alert').remove()
    },
};

function hideModal(element, seconds)
{
    setTimeout(function() { $(element).modal('hide'); }, seconds * 1000);
}

function showMessage(e)
{
    var grid = e.sender;
    if (grid.dataSource.total() == 0)
    {
        var colCount = grid.columns.length;
        $(e.sender.wrapper)
            .find('tbody')
            .append('<tr><td colspan="' + (colCount) + '" class="text-muted">No hay registros en la base de datos.</td></tr>');
    }
}

function refreshKendo(element)
{
    if ( !element )
    {
        element = '.content-kendo'
    }

    $(element).data('kendoGrid').dataSource.read();
}

function ignoreFields(fields)
{
    $(fields).addClass('ignore') 
}

function ModalForm( form_title, form_submit, form_content, form_selector, options, confirm_message, confirm_title, success_message, current_button)
{
    var form_dialog = bootbox.dialog({
        className: 'modal-primary modal-form',
        closeButton: false,
        message: form_content,
        title: form_title,
        buttons: {
            default: {
                label: "CERRAR",
                className: "btn-default",
                callback: function() {
                    // Example
                }
            },
            main: {
                label: form_submit,
                className: "btn-primary",
                callback: function() {

                    ignoreFields(options.ignore)

                    AlertMessage.removeCurrentAlerts()

                    var form = $(form_selector);

                    $(form).validate(options.rules);

                    var url = form.attr('action');

                    if ( form.valid() )
                    {
                        var confirm_dialog = bootbox.dialog({
                            className: 'modal-primary confirm-dialog',
                            closeButton: false,
                            backdrop: true,
                            message: confirm_message,
                            title: confirm_title,
                            buttons: {
                                default: {
                                    label: "NO",
                                    className: "btn-default nos",
                                    callback: function(e) {

                                    }
                                },
                                main: {
                                    label: "SÍ",
                                    className: "btn-primary",
                                    callback: function() {

                                        AlertMessage.showSpining('.confirm-dialog')

                                        var fields = $( form ).serialize();

                                        $.ajax({
                                            url: url,
                                            type: "post",
                                            data: fields,
                                            dataType: 'json',
                                            success: function(data)
                                            {
                                                $('.bootbox').modal('hide');
                                                
                                                refreshKendo()

                                                var success_dialog = bootbox.dialog({
                                                    className: 'modal-success',
                                                    backdrop: true,
                                                    message: success_message,
                                                    title: "ÉXITO",
                                                })
                                                
                                                hideModal(success_dialog, 3)
                                            },
                                            error: function(jqXHR)
                                            {
                                                AlertMessage.hideSpining('.confirm-dialog')
                                                
                                                $('.confirm-dialog').modal('hide')

                                                if (jqXHR.status == 422)
                                                {
                                                    var message = jqXHR.responseJSON ? jqXHR.responseJSON : ''
                                                    AlertMessage.printError($('.modal-body', form_dialog), message)
                                                }
                                                else
                                                {
                                                    if (jqXHR.status == 404)
                                                    {
                                                        var message = jqXHR.responseJSON ? jqXHR.responseJSON : ''
                                                        AlertMessage.printError($('.modal-body', form_dialog), message)
                                                    }

                                                    if (jqXHR.status == 500)
                                                    {
                                                        var message = 'Error interno de servidor'
                                                        AlertMessage.printError($('.modal-body', form_dialog), message)
                                                    }
                                                }
                                            }
                                        });

                                        return false;
                                    }
                                }
                            }
                        }).init(function () {

                            form_dialog.addClass('push-back');

                        }).on('hidden.bs.modal', function (e) {

                            form_dialog.removeClass('push-back');

                            var modal = e.target

                            if ( $(modal).hasClass('confirm-dialog') )
                            {
                                var $body = $('body')
                                $body.addClass('modal-open')
                            }

                        }); 

                        return false;
                    }
                    
                    return false;
                }
            }
        }
    }).on('hidden.bs.modal', function (e) {

        var modal = e.target

        if ( $(modal).hasClass('modal-form') )
        {
            $(current_button).removeClass('not-active')
        }

    });  
}


