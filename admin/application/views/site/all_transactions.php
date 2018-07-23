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
                        <strong>Transactions</strong>
                    </span>

                </div>
                <div class="panel-body">
                    <form name="bulk_action_form" action="" method="post">
                        <div class="panel-body ">
                            <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                <tr>
                                    <th  class="">Transactions Date</th>
                                    <th  class="">Gateway</th>
                                    <th  class="">Token</th>
                                    <th  class="">Payment Id</th>
                                    <th  class="">Payment For</th>
                                    <th  class="">Tax</th>
                                    <th  class="">Shipping</th>
                                    <th  class="">Sub Total</th>
                                    <th  class="">Total</th>
                                    <th  class="">Payment Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($FormData as $trn){
                                    ?>
                                    <tr>
                                        <td><?php echo $trn['entry_date'];?></td>
                                        <td><?php echo $trn['gateway'];?></td>
                                        <td><?php echo $trn['token'];?></td>
                                        <td><?php echo $trn['payment_id'];?></td>
                                        <td><?php echo $trn['payment_for'];?></td>
                                        <td><?php echo $trn['tax'];?></td>
                                        <td><?php echo $trn['shipping'];?></td>
                                        <td><?php echo $trn['sub_total'];?></td>
                                        <td><?php echo $trn['total'];?></td>
                                        <td><?php echo $trn['payment_status'];?></td>
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
                                    "sFileName":"kss-transactions.pdf",
                                    "sTitle": "Kss All Transactions"

                                }, {
                                    "sExtends": "csv",
                                    "sButtonText": "CSV",
                                    "sFileName":"kss-transactions.csv",
                                    "sTitle": "Kss All Transactions"
                                }, {
                                    "sExtends": "xls",
                                    "sButtonText": "Excel",
                                    "sFileName":"kss-transactions.xls",
                                    "sTitle": "Kss All Transactions"
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


