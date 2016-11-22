$(document).on('ready', function(){

    // VALIDATION
    
	var rules = {
        rules:{
            group_name: {required: true, maxlength: 200},
            legal_name: {required: true, maxlength: 200},
            ruc: {required: true, maxlength: 11},
            address: {maxlength: 200},
        },
        ignore: ".ignore",
        errorPlacement: function (error, element) {

            if (element.prop('type') === 'checkbox') {
                error.insertAfter('.table-container');
            } else {
                error.insertAfter(element);
            }
        },
    };

	// CRUD MODALS
     
    ModalCRUD.create({
        url:    url_create_holding_form,
        title:  entity_title,
        rules:  rules,
    });

    ModalCRUD.show({
        url:    url_show_holding_form,
        title:  entity_title,
    });

    ModalCRUD.delete({
        title:  entity_title,
    });

    ModalCRUD.edit({
        url:    url_edit_holding_form,
        title:  entity_title,
        rules:  rules,
//        ignore: '.input-password'
    });

	// KENDO GRID

    var col = [
        {field:'group_name',         title:'NOMBRE DE GRUPO'},
        {field:'legal_name',         title:'NOMBRE LEGAL'},
        {field:'ruc',                title:'RUC'},
        {field:'address',            title:'DIRECCIÓN'},
        {field:'subscription_date',  title:'REGISTRADO'},
        {title:'OPCIONES', template:kendo.template($("#command-template").html()), attributes:{ 'class' : 'text-center', 'data-id' : "#: id #", 'data-name' : '#: group_name #' }}
    ];

    var filter = [];

    (new KendoSettings())
        .setUrl(url_load_holding)
        .setWrapper('.content-kendo')
        .setPage(5)
        .setcolumns(col)
        .setFilter(filter)
        .render();

    // KENDO SEARCH

    $("#button-search").on('click',function(e){

        where = {
            group_name: $("#txt_group_name").val(),
            legal_name: $("#txt_legal_name").val(),
            ruc:        $("#txt_ruc").val(),
        };

        var grid = $('.content-kendo').data("kendoGrid");

        grid.dataSource.filter([
            {field:'group_name', value:where.group_name},
            {field:'legal_name', value:where.legal_name},
            {field:'ruc',        value:where.ruc},
        ]);
        
        e.preventDefault();
    });

})