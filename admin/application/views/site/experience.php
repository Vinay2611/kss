<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Experience</strong>
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
                                    <th  class="">Name</th>
                                    <th  class="">Email</th>
                                    <th  class="">Subject</th>
                                    <th  class="">Message</th>
                                    <th  class="">Attachment</th>
                                    <th  class="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($experience as $u){
                                    ?>
                                    <tr>
                                        <td><?php echo $u['name'];?></td>
                                        <td><?php echo $u['email'];?></td>
                                        <td><?php echo $u['subject'];?></td>
                                        <td><?php echo $u['message'];?></td>
                                        <td><?php echo $u['attachment'];?></td>
                                        <td>
                                            <?php
                                            if($u['status']==0){
                                                ?>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-success"  onclick="UpdateRecord('<?php echo $u['id'];?>',$(this))" >Approve</a>
                                                <?php
                                            }?>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="DeleteRecord('<?php echo $u['id'];?>',$(this))" >Delete</a>
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
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "Deleteexperience",
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

    function UpdateRecord(id,elm) {
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "UpdateExperience",
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

</script>

<!-- JS DATATABLE -->
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

                tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

            }

        });
    });
</script>