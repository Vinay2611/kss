<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Slider</strong>
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
                    echo form_open('dashboard',$attributes);
                    ?>

                    <div class="col-lg-12 error-box">
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Title</label>
                                <input type="text" class="form-control" value="<?php echo isset($FormData['title'])?$FormData['title']:'' ?>" name="title" id="title" placeholder="Title"  required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Image</label>
                                <input  type="file" class="custom-file-upload" name="file" id="attachment" accept = "image/*" data-btn-text="Select a File" <?php echo isset($FormData['id'])?'':'required' ?>/>
                                <small class="text-muted block">Max file size: 10Mb (jpg/png)</small>
                                <?php if(isset($FormData['id'])){
                                    ?>
                                    <img style="max-width: 150px;" src="<?php echo base_url().'../uploads/slider/'.$FormData['image'];?>">
                                    <?php
                                }?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Link</label>
                                <input type="text" class="form-control" value="<?php echo isset($FormData['link'])?$FormData['link']:'' ?>" name="link" id="link" placeholder="Insert Link"  required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="RecordID" value="<?php echo isset($FormData['id'])?$FormData['id']:'' ?>" >

                    <!-- <input type="hidden" name="RecordID" value="<?php /*echo isset($data->id)?$data->id:'' ;*/?>">-->
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
                                <th  class="">Title</th>
                                <th  class="">Image</th>
                                <th  class="">Featured</th>
                                <th  class="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_slider as $cat){
                                ?>
                                <tr>
                                    <td><?php echo $cat['title'];?></td>
                                    <td><img style="max-width: 150px;" src="<?php echo base_url().'../uploads/slider/'.$cat['image'];?>"></td>
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
                url: "AddSlider",
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

    function DeleteRecord(id,elm) {
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "DeleteSlider",
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