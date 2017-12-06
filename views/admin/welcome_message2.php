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

</head>
<body>

<div id="example">
    <div id="grid">

    </div>

    <script >
        $(document).ready(function () {


            $.urlParam = function (name) {
                var results = new RegExp('[\?&]' + name + '=([^&#]*)')
                    .exec(window.location.href);

                return results[1] || 0;
            }

            $("#grid").kendoGrid({
                dataSource: {
                    pageSize:20,
                    transport: {
                        read: {
                            url: "http://10.0.40.40/party_city/index.php/admin2/skus?PalletNum=" + $.urlParam('PalletNum'),
                            dataType: "json"
                        },
                        update: {
                            url: "../NEW PROJECT/palletPackage.php",
                            type: "POST"
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    },
                    schema: {
                        data: "data",
                        model: {
                            //Id,PalletNum,city,TrailerId,TimeLoaded
                            //Id,SKU,DestinationCode,TimeOnPallet,PalletNum,timeLoaded
                            id: "Id",
                            fields: {
                                SKU: { editable: false },
                                DestinationCode: { editable: false },
                                TimeOnPallet : { editable: false } ,
                                PalletNum: { editable: false },
                                timeLoaded: { editable: false }
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
                    { title:"PalletNum",field: "PalletNum" },
                    {title:"SKU", field: "SKU" },
                    { title:"DestinationCode",field: "DestinationCode" },
                    { title:"TimeOnPallet",field: "TimeOnPallet" },
                    { title:"TimeLoaded",field: "TimeLoaded" }],
                //detailTemplate: kendo.template($("#template").html()),
                //detailInit: detailInit,
                editable: true,
                navigable: true // adds save and cancel buttons
            });

            function showDetails(e) {
                e.preventDefault();

                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                console.log(dataItem.PalletNum);
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

