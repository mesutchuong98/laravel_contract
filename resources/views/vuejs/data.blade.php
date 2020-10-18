@extends('layouts.admin_template')
@section('content')
<head>
    <style>
       .dx-datagrid-rowsview .dx-select-checkboxes-hidden > tbody > tr > td > .dx-select-checkbox {
         display: inline-block;
        }
    </style>
</head>
<body class="dx-viewport">
    
    <div class="demo-container">
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target=".filter-container">FILTER</button>
        <div class="filter-container collapse" >
            <div id="filterBuilder"></div>
            <div id="apply"></div>
            <div class="dx-clearfix"></div>
        </div>
        <div id="gridContainer"></div>
        <div class="selected-data">
            <span class="selected-reco">Selected Records:</span>
            <span id="selected-items-container">Nobody has been selected</div>
        </div>
    </div>

<script>
   
$(function(){
    var store = new DevExpress.data.CustomStore({
        keyExpr: "idBus",
        load: function (loadOptions) {
            var deferred = $.Deferred();
            $.ajax({
                url: "http://localhost/testLaravel/public/index.php/allClients",
                dataType: "json",
                data: "",
                success: function(result) {
                    // console.log(result.data);
                    deferred.resolve(result.data, {
                    });  
                },
                error: function() {
                    deferred.reject("Data Loading Error");
                },
                timeout: 5000
            });
            return deferred.promise();  
        }
    });
    var filter = [
    ],
    fields = [
    {
        dataField: "clients_name",
        caption: "Client Name",
        dataType: "string",
        fixed: true 
    }, 
    {
        dataField: "business_vertical_name",
        caption:"Business Name",
        dataType: "string",
        fixed: true
    }, ,{
        dataField: "sub_vertical_name",
        caption:"Sub Vertical",
        dataType: "string",
        fixed: true,
    },{
        dataField: "tax_code",
        dataType: "string",
    },{
        dataField: "clients_status",
        caption: "Status",
        dataType: "string"
    }, {
        dataField: "users_name",
        caption: "Account",
        dataType: "string" 
    }
    , {
        dataField: "users_status",
        caption: "User status",
        dataType: "string"
    }, {
        dataField: "teams_name",
        caption: "Owner's Team",
        dataType: "string"
    }, {
        dataField: "groups_name",
        caption: "Owner's Groups",
        dataType: "string"
    },
    {   
        dataField: "Action",
        cellTemplate: function(element){
            element.append("<a href='#' style='margin-right: 15px'><i class='fa fa-caret-square-o-right' style='color: orange' ></i></a>");
            element.append("<a href='#' style='margin-right: 15px'><i class='fa fa-pencil-square-o'style='color: orange'></i></a>");
            element.append("<a href='#'><i class='fa fa-times'style='color: red'></i></a>");
        },
        width: "100px"
    },
    ];

    $(".checkbox").dxCheckBox({
        value: false
    });
    $("#filterBuilder").dxFilterBuilder({
        fields: fields,
        value: filter
    });
    $("#apply").dxButton({
        text: "Apply Filter",
        type: "default",
        onClick: function() {
            var filter = $("#filterBuilder").dxFilterBuilder("instance").option("value");
            $("#gridContainer").dxDataGrid("instance").option("filterValue", filter);
        },
    });
    $("#gridContainer").dxDataGrid({
        dataSource: store,
        allowColumnReordering: true,
        allowColumnResizing: true,
        columnAutoWidth: true,
        showBorders: true,
        filterRow: { visible: true },
        scrolling: { mode: "infinite" },
        showBorders: true,
        columns: fields,
        selection: {
            mode: "multiple",
            selectAllMode: "page" // or "allPages"
        },
        onSelectionChanged: function(selectedItems) {
            var data = selectedItems.selectedRowsData;
            if(data.length > 0)
                $("#selected-items-container").text(
                $.map(data, function(value) {
                    return value.clients_id + " ";
                }).join(", "));
            else 
                $("#selected-items-container").text("Nobody has been selected");
        }
    }).dxDataGrid("instance");
});
</script>
</body>
@endsection