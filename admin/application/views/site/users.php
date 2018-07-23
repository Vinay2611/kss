
<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Users</strong>
                    </span>
                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Colapse"></a></li>

                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>

                        <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Close"><i class="fa fa-times"></i></a></li>

                    </ul>
                </div>

                <div class="panel-body">
                    <form name="bulk_action_form" action="" method="post">
                        <div class="panel-body ">
                            <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                <tr>
                                    <td> <input type="checkbox" name="checkedall" id = "bump-offer" onClick = "check();"/></td>
                                    <th  class="">First Name</th>
                                    <th  class="">Last Name</th>
                                    <th  class="">E mail</th>
                                    <th  class="">Age</th>
                                    <th  class="">Sex</th>
                                    <th  class="">Medical</th>
                                    <th  class="">User Role</th>
                                    <th  class="">Referrer Site</th>
                                    <th  class="hidden-print">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($users as $s){
                                    ?>
                                    <tr class="odd gradeX">
                                        <td align="center">
                                            <input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $s->id; ?>"/>
                                        </td>
                                        <td><?php echo $s->first_name;?></td>
                                        <td><?php echo $s->last_name;?></td>
                                        <td><?php echo $s->email;?></td>
                                        <td><?php echo $s->age;?></td>
                                        <td><?php echo $s->sex;?></td>
                                        <td><?php echo $s->medical_condition;?></td>
                                        <td><?php echo $s->user_role;?></td>
                                        <td><?php echo $s->referrer_site;?></td>
                                        <td  class="hidden-print">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="DeleteRecord('<?php echo $s->id;?>',$(this))" >Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </form>
        </div>
    </div>
</section>

<script>
    function DeleteRecord(id,elm) {
        if(confirm("Are you sure, that you want to delete this user!")){
            $elm=elm;
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
            $.ajax({
                type: "POST",
                url: "Deleteusers",
                dataType: 'json',
                data: {record_id:id},
                success: function (resp) {
                    if (resp.success) {
                        location.reload();
                        _toastr(resp.msg,"bottom-right","success",false);

                    } else {
                        _toastr(resp.msg,"bottom-right","warning",false);

                    }
                    $(".submit-loading").remove();
                    $elm.show();
                },
                error: function (data) {
                }
            });
        }
    }
</script>


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
                                "mColumns": [1,2, 3, 4,5],
                                "sFileName":"kss-users.pdf",
                                "sTitle": "Kss Users"
                            }, {
                                "sExtends": "csv",
                                "sButtonText": "CSV",
                                "mColumns": [1,2, 3, 4,5],
                                "sFileName":"kss-users.csv",
                                "sTitle": "Kss Users"
                            }, {
                                "sExtends": "xls",
                                "sButtonText": "Excel",
                                "mColumns": [1,2, 3, 4,5],
                                "sFileName":"kss-users.xls",
                                "sTitle": "Kss Users"
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