<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong><?php echo isset($_GET['id'])?'Update':'Add'?> Camp Package</strong>
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
                                    <label>Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">-select-</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Camps by Season'?'selected':'';?> value="Camps by Season">Camps by Season</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Camps by Date'?'selected':'';?> value="Camps by Date">Camps by Date</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Camps by School'?'selected':'';?> value="Camps by School">Camps by School</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Camps by Location'?'selected':'';?> value="Camps by Location">Camps by Location</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='addon'?'selected':'';?> value="addon">AddOn Package</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>Package Title</label>
                                    <input type="text" class="form-control" name="package_title" value="<?php echo isset($FormData['package_title'])?$FormData['package_title']:''; ?>" placeholder="Package Title" maxlength="250">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3">
                                    <label>Age</label>
                                    <input type="text" class="form-control" name="age" value="<?php echo isset($FormData['age'])?$FormData['age']:''; ?>" placeholder="Age" maxlength="250">
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label>Number Of Children</label>
                                    <input type="text" class="form-control" name="num_of_children" value="<?php echo isset($FormData['num_of_children'])?$FormData['num_of_children']:''; ?>" placeholder="" maxlength="250">
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-12 col-sm-12" id="time">
                                <label>Timing Detail</label>
                                <textarea class="form-control summernote" name="time" rows="5" ><?php echo isset($FormData['time'])?$FormData['time']:''; ?></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12" id="location">
                                <label>Location/Address</label>
                                <textarea class="form-control summernote location" name="location" rows="5" ><?php echo isset($FormData['location'])?$FormData['location']:''; ?></textarea>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-6 col-sm-6" id="what_bring">
                                <label>What To Bring</label>
                                <textarea class="form-control summernote what_bring" name="what_bring" rows="5" ><?php echo isset($FormData['what_bring'])?$FormData['what_bring']:''; ?></textarea>
                                

                            </div>

                            <div class="col-md-6 col-sm-6" id="what_wear">
                                <label>What To Wear</label>
                                <textarea class="form-control summernote what_wear" name="what_wear" rows="5"  ><?php echo isset($FormData['what_wear'])?$FormData['what_wear']:''; ?></textarea>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12" id="description">
                                <label>Description</label>
                                <textarea class="form-control summernote description" name="description" rows="5"  ><?php echo isset($FormData['description'])?$FormData['description']:''; ?></textarea>
                                
                            </div>
                        </div>
                    </div>


                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>Date From</label>
                                    <input type="text" class="form-control datepicker" name="date_from" value="<?php echo isset($FormData['date_from'])?$FormData['date_from']:''; ?>" placeholder="Date From" maxlength="10">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Date To</label>
                                    <input type="text" class="form-control datepicker" name="date_to" value="<?php echo isset($FormData['date_to'])?$FormData['date_to']:''; ?>" placeholder="Date To" maxlength="10">
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <label>Product Recommend</label>
                                <select multiple="multiple" name="p_recommand[]" class="form-control select2">
                                    <option value="">---Select---</option>
                                    <?php
                                    $r_list=array();
                                    if(isset($FormData['recommand_product']) && !empty($FormData['recommand_product'])){
                                        $r_list=json_decode($FormData['recommand_product']);
                                    }
                                    foreach ($products as $prd){
                                        ?>
                                        <option <?php echo in_array($prd['id'],$r_list)?'selected':''?> value="<?php echo $prd['id'];?>"><?php echo $prd['title'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                        <div class="OptionList">
                            <h3>Details</h3>
                            <a href="javascript:void(0);" class="btn btn-success btn-xs AddMore">Add More</a> <a href="javascript:void(0);" class="btn btn-warning btn-xs removeLast">Remove</a>
                            <?php
                            if(isset($FormData['fee_detail'])){
                                $op=(array)json_decode($FormData['fee_detail']);
                                $i=0;
                                foreach ($op['fees'] as $data){
                                ?>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2 col-sm-2">
                                                <label>Fees</label>
                                                <input type="text" class="form-control" name="fee_detail[fees][]" value="<?php echo $op['fees'][$i];?>" placeholder="fees" maxlength="10">
                                            </div>
                                            <div class="col-md-10 col-sm-10">
                                                <label>Fee Description</label>
                                                <input type="text" class="form-control" name="fee_detail[description][]" value="<?php echo $op['description'][$i];?>" placeholder="" maxlength="100">
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $i++;
                                }
                            }else{
                                ?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-2 col-sm-2">
                                            <label>Fees</label>
                                            <input type="text" class="form-control" name="fee_detail[fees][]"  placeholder="fees" maxlength="10">
                                        </div>
                                        <div class="col-md-10 col-sm-10">
                                            <label>Fee Description</label>
                                            <input type="text" class="form-control" name="fee_detail[description][]"  placeholder="" maxlength="100">
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <input type="hidden" name="RecordId" value="<?php echo isset($FormData['id'])?$FormData['id']:''?>">
                    </form>
                </div>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-sm submit-btn btn-success pull-left" form="RecordForm" value="<?php echo isset($FormData['id'])?'Update':'Add' ?>" id="submit">

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">
                    <form name="bulk_action_form" action="" method="post">
                        <div class="panel-body ">
                            <table class="table table-striped table-bordered table-hover sample_5" id="sample_5">
                                <thead>
                                <tr>
                                    <th  class="">Category</th>
                                    <th  class="">Title</th>
                                    <th  class="">Location</th>
                                    <th  class="">Date</th>
                                    <th  class="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($records as $rec){
                                    ?>
                                    <tr>
                                        <td><?php echo $rec['category'];?></td>
                                        <td><?php echo $rec['package_title'];?></td>
                                        <td><?php echo $rec['location'];?></td>
                                        <td><?php echo $rec['date_from'];?></td>

                                        <td>
                                            <a href="?id=<?php echo $rec['id'];?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="DeleteRecord('<?php echo $rec['id'];?>',$(this))" >Delete</a>
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
    var ClickedSubCat="";
    function DeleteRecord(id,elm) {
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "DeletePackage",
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

        $(".AddMore").click(function () {
            $(".removeLast").show();
           $(".OptionList").append(' <div class="row">'+
               '<div class="form-group">'+
               '<div class="col-md-2 col-sm-2">'+
                '<label>Fees</label>'+
                '<input type="text" class="form-control" name="fee_detail[fees][]" value="" placeholder="fees" maxlength="10">'+
                '</div>'+
                '<div class="col-md-10 col-sm-10">'+
                '<label>Fee Description</label>'+
                '<input type="text" class="form-control" name="fee_detail[description][]" value="" placeholder="" maxlength="100">'+
                '</div>'+
                '</div>'+
                '</div>');
        });

        $(".removeLast").click(function () {
            if($(".OptionList .row").length>1){
                $(".OptionList .row:last-child").remove();
            }else{
                $(".removeLast").hide();
            }
        });

        $("#RecordForm").submit(function (e) {
            e.preventDefault();
            $elm = $(".submit-btn");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
			
			$(".summernote").each(function(){
				$(this).val($(this).code());
			});
			
          /*   $(".what_wear").val($("#what_wear").find(".note-editable").html());
            $(".what_bring").val($("#what_bring").find(".note-editable").html());
            $(".description").val($("#description").find(".note-editable").html());
            $(".location").val($("#location").find(".note-editable").html());
            $(".time").val($("#time").find(".note-editable").html());
 */

            $.ajax({
                type: "POST",
                url: "AddCampsPackage",
                dataType: 'json',
                data:$(this).serialize(),
                success: function (resp) {
                    if (resp.success) {
                        _toastr(resp.msg,"bottom-right","success",false);
                        location.href="camps_package";
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