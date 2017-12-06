<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        html {
            font-size: 18px;
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
        }
        .header {
            padding: 2em;
            color: white;
            background-color: #8c4a4a;
            clear: left;
            text-align: center;
        }
    </style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.3.1026/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.3.1026/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.3.1026/styles/kendo.material.mobile.min.css" />

    <script src="https://kendo.cdn.telerik.com/2017.3.1026/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.3.1026/js/kendo.all.min.js"></script>


    <!--
    <link rel="stylesheet" href="../NEW PROJECT/styles/kendo.bootstrap.min.css" />
    <link rel="stylesheet" href="../NEW PROJECT/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="../NEW PROJECT/styles/kendo.default.min.css" />

    <script src="../NEW PROJECT/js/jquery.min.js"></script>
    <script src="../NEW PROJECT/js/kendo.all.min.js"></script>
    -->
</head>
<body>

<div id="example">
    <div id="grid">

    </div>

    <script >
        $(document).ready(function () {
//alert('hrre');
            /*
            $("#grid").kendoGrid({
                dataSource: {
                    transport: {
                        read: "data/mainForm.php"
                    },
                    schema: {
                       data: "data"
                    }
                },
               columns: [{ field: "pallet" }, { field: "city" },{ field: "trailerNum" },{ field: "loadedTime" }]
            });
            */



            $("#grid").kendoGrid({
                dataSource: {
                    pageSize:10,
                    transport: {
                        read: {
                            url: "http://10.0.40.40/party_city/index.php/api/TrailerPallets/index",
                            dataType: "json"
                        },
                        update: {
                            url: "http://10.0.40.40/party_city/index.php/api/TrailerPallets/index",
                            type: "POST"
                        }
                    },
                    error: function(e) {
                        alert(e.responseText);
                    },
                    schema: {
                        data: "data",
                        model: {
                            //Id,PalletNum,city,TrailerId,TimeLoaded
                            id: "PalletNum",
                            fields: {
                                PalletNum: { editable: false },
                                DestinationCode: { editable: false },
                                TrailerId : { validation: { required: true}} ,
                                TimeCreated: { editable: false },
                                TimeLoaded: { editable: false }
                            }
                        }
                    }
                },
                selectable: "multiple cell",
                pageable: true,
                sortable: true,
                filterable: true,
                groupable: true,
                columns: [
                    {title:"Pallet", field: "PalletNum" },
                    { title:"Destination",field: "DestinationCode" },
                    { title:"Trailer Id",field: "TrailerId" },
                    { title:"Time Loaded",field: "TimeLoaded" },
                    { title:"Time Created",field: "TimeCreated" },
                    { command: { text: "View Details", click: showDetails }, title: " ", width: "180px" }],
                //detailTemplate: kendo.template($("#template").html()),
                //detailInit: detailInit,
                editable: true,
                navigable: true,  // enables keyboard navigation in the grid
                toolbar: [ "save", "cancel" ]  // adds save and cancel buttons
            });

            function showDetails(e) {
                e.preventDefault();

                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                window.location.href="http://10.0.40.40/party_city/index.php/admin2?PalletNum=" + dataItem.PalletNum;
            }

        });

        //


        /*
                        $('body').on('click', '.customer-name', '', function () {
                            window.location.href = "/taskDetails.html";
                           // alert('here');
                        })

                    });
                    */

        //function customBoolEditor(container, options) {
        //    var guid = kendo.guid();
        //    $('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
        //    $('<label class="k-checkbox-label" for="' + guid + '">?</label>').appendTo(container);
        //}
    </script>


    <style type="text/css">
        .customer-name {
            display: inline-block;
            vertical-align: middle;
            line-height: 32px;
            padding-left: 3px;
            cursor: pointer;
        }
    </style>
</div>


</body>
</html>
































