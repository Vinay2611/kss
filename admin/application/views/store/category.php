<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Category</strong>
                    </span>
                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Colapse"></a></li>

                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>

                        <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Close"><i class="fa fa-times"></i></a></li>

                    </ul>
                </div>
                <div class="panel-body">

                    <?php
                    $attributes = array('class' => '', 'id' => 'RecordForm', 'enctype'=>"multipart/form-data");
                    echo form_open('site',$attributes);
                    ?>

                    <div class="col-lg-12 error-box">
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Category Name</label>
                                <input type="text" class="form-control" value="<?php echo isset($FormData['name'])?$FormData['name']:'' ?>" name="name"  id="name" placeholder="Category Name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Parent Category</label>
                                <select name="parent_id" class="form-control">
                                    <option value="0">-select-</option>
                                    <?php foreach ($parent_cat as $pcat){
                                        ?>
                                        <option <?php echo isset($FormData['parent_id']) && $FormData['parent_id']==$pcat['id']?'selected':'' ?> value="<?php echo $pcat['id'];?>"><?php echo $pcat['name'];?></option>
                                    <?php
                                    }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="RecordID" value="<?php echo isset($FormData['id'])?$FormData['id']:'' ?>" >
                    </form>
                </div>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-sm submit-btn btn-success pull-left" form="RecordForm" value="<?php echo isset($FormData['id'])?'Update':'Add' ?>" id="submit">

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>
        <!-- panel content -->
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">
                    <form name="bulk_action_form" action="" method="post">
                        <div class="panel-body ">
                            <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                    <tr>
                                        <th  class="">Name</th>
                                        <th  class="">Parent Name</th>
                                        <th  class="">Featured</th>
                                        <th  class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_cat as $cat){
                                        ?>
                                        <tr>
                                            <td><?php echo $cat['name'];?></td>
                                            <td><?php echo $cat['parent_name'];?></td>
                                            <td><?php echo $cat['featured']=='1'?'Yes':'No';?></td>
                                            <td>
                                                <a href="?id=<?php echo $cat['id'];?>" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="DeleteRecord('<?php echo $cat['id'];?>',$(this))" >Delete</a>
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
        </div>
    </div>
</section>

<script>
    /*contact form insert jquery*/
    function DeleteRecord(id,elm) {
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "DeleteCategory",
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
    $(function () {
        $("#RecordForm").submit(function (e) {
            e.preventDefault();
            $elm = $(".submit-btn");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
            $form = $(this)[0];
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "AddCategory",
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function (resp) {
                    if (resp.success) {
                        _toastr(resp.msg,"bottom-right","success",false);
                        location.reload();

                    } else {
                        _toastr(resp.msg,"bottom-right","warning",false);

                    }
                    $(".submit-loading").remove();
                    $elm.show();
                },
                error: function (data) {
                }
            });
        });
    });
    /*delete query*/


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