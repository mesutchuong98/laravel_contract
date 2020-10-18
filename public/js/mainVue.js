
// $(function(){
    
//     var store = new DevExpress.data.CustomStore({
//         key: "",
//         load: function (loadOptions) {
//             var deferred = $.Deferred();
//                 //args = //
//             $.ajax({
//                 url: "http://localhost/testLaravel/public/index.php/allClients",
//                 dataType: "json",
//                 data: "",
//                 success: function(result) {
//                     // console.log(result.data);
//                     deferred.resolve(result.data, {
//                     });
                    
//                 },
//                 error: function() {
//                     deferred.reject("Data Loading Error");
//                 },
//                 timeout: 5000
//             });
           
//             return deferred.promise();
            
//         }
//     });
//     var filter = [
    
//     ],
//     fields = [
//     {
//         dataField: "clientName",
//         dataType: "string",
//         width:'100px',
//         color: 'blue'
//     }, 
//     {
//         dataField: "businessName",
//         dataType: "string",
//         width:'150px'
//     }, ,{
//         dataField: "subName",
//         caption:"Sub Vertical",
//         dataType: "string",
//         width:'300px'
//     },{
//         dataField: "tax_code",
//         dataType: "string",
//         width:'80px',
//     },{
//         dataField: "busStatus",
//         caption: "Status",
//         width:'60px',
//         dataType: "string"
//     }, {
//         dataField: "userName",
//         caption: "Account",
//         dataType: "string",
//         width:'200px'
//     }
//     , {
//         dataField: "userStatus",
//         caption: "User status",
//         width:'90px',
//         dataType: "string"
//     }, {
//         dataField: "teamName",
//         caption: "Owner's Team",
//         dataType: "string",
//         width:'100px'
//     },
//     {   
//         dataField: "Action",
//         cellTemplate: function(element){
//             element.append("<a href='#' style='margin-right: 15px'><i class='fa fa-caret-square-o-right' style='color: orange' ></i></a>");
//             element.append("<a href='#' style='margin-right: 15px'><i class='fa fa-pencil-square-o'style='color: orange'></i></a>");
//             element.append("<a href='#'><i class='fa fa-times'style='color: red'></i></a>");
    
//         }
    
//     },
//     ];

//     $("#filterBuilder").dxFilterBuilder({
//         fields: fields,
//         value: filter
//     });
//     $("#apply").dxButton({
//         text: "Apply Filter",
//         type: "default",
//         onClick: function() {
//             var filter = $("#filterBuilder").dxFilterBuilder("instance").option("value");
//             $("#gridContainer").dxDataGrid("instance").option("filterValue", filter);
//         },
//     });
//     $("#gridContainer").dxDataGrid({
//         dataSource: store,
//         columnsAutoWidth: true,
//         filterRow: { visible: true },
//         // headerFilter: { visible: true },
//         scrolling: { mode: "infinite" },
//         showBorders: true,
//         columns: fields
//     }).dxDataGrid("instance");
// });
 
