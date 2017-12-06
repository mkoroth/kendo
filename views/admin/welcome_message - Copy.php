<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        html {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .header {
            padding: 1em;
            color: white;
            background-color: #5a4a8c;
            clear: left;
            text-align: center;
        }
    </style>
    <meta charset="utf-8">
    <title>Welcome to PartyCity</title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.3.1026/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.3.1026/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.3.1026/styles/kendo.material.mobile.min.css" />

    <script src="https://kendo.cdn.telerik.com/2017.3.1026/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.3.1026/js/kendo.all.min.js"></script>

</head>
<body>

<div id="example">
    <div id="grid"></div>
    <script>
        $(document).ready(function () {
            $("#grid").kendoGrid({
            dataSource: {
                pageSize:10,
                    transport: {
                        read: {
                            url: "http://10.0.40.40/party_city/index.php/api/TrailerPallets/index",
                            dataType: "json"
                        }

//                    read: "http://10.0.40.40/party_city/index.php/api/TrailerPallets/index",
//                    read: "http://localhost/party_city/index.php/api/TrailerPallets/index",
//                        update: {
//                        url: "../NEW PROJECT/mainForm.php",
//                            type: "POST",
//                            dataType: "json"
//                    }
                },
                error: function(e) {
                    console.log(e);
                },
                schema: {
                    data: "data",
                        model: {
                        id: "PalletNum",
                            fields: {
                            PalletNum: { editable: false },
                            DestinationCode: { editable: false },
                            TrailerId: { validation: { required: true} },
                            TimeLoaded: { editable: false }
                        }
                    }
                }
            },

//                TimeCreated: { editable: false },


            selectable: "multiple cell",
                pageable: true,
                sortable: true,
                filterable: true,
                groupable: true,
                columns: [
                    {title:"Pallet", field: "PalletNum" },
                    {title:"City",field: "DestinationCode" },
                    {title:"Trailer Number", field: "TrailerId" },
                    {title:"Time Loaded",field: "TimeLoaded" }],
                editable: true,
                navigable: true,  // enables keyboard navigation in the grid
                toolbar: [ "save", "cancel","pdf", "excel" ],
                // adds save and cancel buttons
                pdf: {
                fileName: "export.pdf",
                    allPages: true,
                    avoidLinks: true,
                    paperSize: "A4",
                    margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "2cm" },
                landscape: true,
                    repeatHeaders: true,
                    template: $("#page-template").html(),
                    scale: 0.8
            },
            excel: {
                fileName: "export.xlsx",
                    allPages: true
            },	excelExport: function(e) {
                var sheet = e.workbook.sheets[0];
                for (var rowIndex = 1; rowIndex < sheet.rows.length; rowIndex++) {
                    if (rowIndex % 2 == 0) {
                        var row = sheet.rows[rowIndex];
                        for (var cellIndex = 0; cellIndex < row.cells.length; cellIndex ++) {
                            row.cells[cellIndex].background = "#def";
                        }
                    }
                }
            },
            pdf: {
                defineFont: {
                    "FontAwesome": "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.ttf"
                }
            }
        });

        });











            /*

            $("#grid").kendoGrid({
                dataSource: {
                    type: "data",
                    transport: {
                        read: "http://10.0.40.40/party_city/index.php/api/TrailerPallets/index"
                    },
                    pageSize: 10
                },
                error: function(e) {
                    console.log(e);
                },
                schema: {
                    data: "data",
                    model: {
                        id: "PalletNum",
                        fields: {
                            PalletNum: { editable: false },
                            TrailerId: { editable: false },
                            DestinationCode: { editable: false }, //{ validation: { required: true} },
                            TimeCreated: { editable: false },
                            TimeLoaded: { editable: false }
                        }
                    }
                }
                ,
//                selectable: "multiple cell",
//
//                filterable: true,
//                editable: true,
//                navigable: true,

                height: 550,
//                groupable: true,
//                sortable: true,
                pageable: {
                    refresh: true,
                    pageSizes: true,
                    buttonCount: 5
                },
                columns: [ {
                    field: "PalletNum",
                    title: "Pallet"
                }, {
                    field: "DestinationCode",
                    title: "Destination"
                }, {
                    field: "TrailerId",
                    title: "Trailer Number"
                }, {
                    field: "TimeCreated",
                    title: "Time Started"
                }, {
                    field: "TimeLoaded",
                    title: "Time Loaded"
                }]
            });
        });
        */
    </script>
</div>
<style type="text/css">
    .customer-name {
        display: inline-block;
        vertical-align: middle;
        line-height: 32px;
        padding-left: 3px;
        cursor: pointer;
    }
</style>


</body>
</html>