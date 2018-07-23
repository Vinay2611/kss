<style>
    .sp-container{
        display: none!important;
    }
</style>
<section id="middle">
    <div id="content" class="dashboard padding-20">

        <!-- panel content -->
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Store Orders</strong>
                    </span>

                </div>
                <div class="panel-body">
                    <form name="bulk_action_form" action="" method="post">
                        <div class="panel-body ">
                            <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                    <tr>
                                        <th  class="">Order Date</th>
                                        <th>Product Title</th>
                                        <th  class="">Size</th>
                                        <th  class="">Color</th>
                                        <th  class="">Quantity</th>
                                        <th  class="">Price</th>
                                        <th  class="">Discount</th>
                                        <th  class="">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($FormData as $trn){
                                        ?>
                                        <tr>
                                            <td><?php echo $trn['entry_date'];?></td>
                                            <td><?php echo $trn['title'];?></td>
                                            <td><?php echo $trn['size'];?></td>
                                            <td><div style="height: 20px;width: 20px; background-color: <?php echo $trn['color'];?>"></td>
                                            <td><?php echo $trn['quantity'];?></td>
                                            <td><?php echo $trn['price'];?></td>
                                            <td><?php echo $trn['discount'];?></td>
                                            <td><?php echo $trn['total'];?></td>
                                        </tr>
                                        <?php
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    <!-- JS DATATABLE -->
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
        loadScript(plugin_path + "datatables/js/dataTables.tableTools.min.js", function(){
            loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){
                loadScript(plugin_path + "select2/js/select2.full.min.js", function(){

                    var table = jQuery('#sample_5');

                    /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

                    /* Set tabletools buttons and button container */

                    jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
                        "container": "btn-group pull-right tabletools-topbar",
                        "buttons": {
                            "normal": "btn btn-sm btn-default",
                            "disabled": "btn btn-sm btn-default disabled"
                        },
                        "collection": {
                            "container": "DTTT_dropdown dropdown-menu tabletools-dropdown-menu"
                        }
                    });

                    var oTable = table.dataTable({
                        "order": [
                            [0, 'asc']
                        ],

                        "lengthMenu": [
                            [5, 15, 20, -1],
                            [5, 15, 20, "All"] // change per page values here
                        ],
                        // set the initial value
                        "pageLength": 20,

                        "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                        "tableTools": {
                            "sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                            "aButtons": [{
                                "sExtends": "pdf",
                                "sButtonText": "PDF",
                                "sFileName":"kss-product-orders.pdf",
                                "sTitle": "Kss Products Orders"
                            }, {
                                "sExtends": "csv",
                                "sButtonText": "CSV",
                                "sFileName":"kss-product-orders.csv",
                                "sTitle": "Kss Products Orders"
                            }, {
                                "sExtends": "xls",
                                "sButtonText": "Excel",
                                "sFileName":"kss-tutoring-orders.xls",
                                "sTitle": "Kss Products Orders"
                            }]
                        }
                    });

                    var tableWrapper = jQuery('#sample_5_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

                    tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

                });
            });
        });
    });
</script>


