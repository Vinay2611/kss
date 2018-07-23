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
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
        loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){

            if (jQuery().dataTable) {

                var table = jQuery('#sample_5');
                table.dataTable({
                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 20,
                    "pagingType": "bootstrap_full_number",
                    "language": {
                        "lengthMenu": "  _MENU_ records",
                        "paginate": {
                            "previous":"Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "asc"]
                    ] // set first column as a default sort by asc
                });

                var tableWrapper = jQuery('#datatable_sample_wrapper');

                table.find('.group-checkable').change(function () {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function () {
                        if (checked) {
                            jQuery(this).attr("checked", true);
                            jQuery(this).parents('tr').addClass("active");
                        } else {
                            jQuery(this).attr("checked", false);
                            jQuery(this).parents('tr').removeClass("active");
                        }
                    });
                    jQuery.uniform.update(set);
                });

                table.on('change', 'tbody tr .checkboxes', function () {
                    jQuery(this).parents('tr').toggleClass("active");
                });

                tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

            }

        });
    });
</script>


