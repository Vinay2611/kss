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
                        <strong>Camps Booked</strong>
                    </span>

                </div>
                <div class="panel-body">
                    <form name="bulk_action_form" action="" method="post">
                        <div class="panel-body ">
                            <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                <tr>
                                    <th  class="">Date</th>
 <th  class="">Booked Date</th>
                                    <th  class="">First Name</th>
                                    <th  class="">Last Name</th>
                                    <th  class="">Age</th>
                                    <th  class="">Sex</th>
                                    <th  class="">Medical</th>
                                    <th  class="">Phone No</th>
                                    <th  class="">Title</th>
                                    <th  class="">Time</th>
                                    <th  class="">Where will child go after course</th>



                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($FormData as $trn){
                                    ?>
                                    <tr>
                                        <td><?php echo $trn['date_from']." to ".$trn['date_to'];?></td>
                                        <td><?php echo $trn['entry_date'];?></td>
     <td><?php echo $trn['first_name'];?></td>
                                        <td><?php echo $trn['last_name'];?></td>
                                        <td><?php echo $trn['age'];?></td>
                                        <td><?php echo $trn['sex'];?></td>
                                        <td><?php echo $trn['medical_condition'];?></td>
                                        <td><?php echo $trn['phone_no'];?></td>
                                        <td><?php echo $trn['package_title'];?></td>
                                        <td><?php echo $trn['item_description'];?></td>
                                        <td><?php echo !empty($trn['addon_detail'])?$trn['addon_detail']:'Parent Pick Up';?></td>

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
                                "sFileName":"kss-camps-orders.pdf",
                                "sTitle": "Kss Camps Orders"
                            }, {
                                "sExtends": "csv",
                                "sButtonText": "CSV",
                                "sFileName":"kss-camps-orders.csv",
                                "sTitle": "Kss Camps Orders"
                            }, {
                                "sExtends": "xls",
                                "sButtonText": "Excel",
                                "sFileName":"kss-camps-orders.xls",
                                "sTitle": "Kss Camps Orders"
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


