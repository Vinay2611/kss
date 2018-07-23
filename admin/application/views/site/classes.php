<?php
include_once "../classes_data.php";
/*$c_type=(array)json_decode($ClassesData);
$c_type=$c_type['Sports & Movement'];
echo "<pre>";
print_r($c_type);die;*/
?>
<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong><?php echo isset($_GET['id'])?'Update':'Add'?> Classes</strong>
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
                                   <!-- <select name="category" id="category" class="form-control">
                                        <option value="">-select-</option>
                                        <?php
/*                                        foreach ($CatData as $cd){
                                           */?>
                                            <?php /*if(isset($FormData['category'])){
                                                if($FormData['type']=='classes'){
                                                    $hidden=1;
                                                }else{$hidden=2;}
                                                */?>
                                                <option <?php /*echo isset($FormData['category']) && $FormData['category']==$cd['name']?'selected':'';*/?> <?php /*echo $cd['parent_id']==$hidden?'hidden':''*/?> data-val="<?php /*echo $cd['parent_id'];*/?>" value="<?php /*echo $cd['name'];*/?>"><?php /*echo $cd['name'];*/?></option>
                                           <?php /*}else{
                                               */?>
                                                <option <?php /*echo $cd['parent_id']=='1'?'':'hidden'*/?> data-val="<?php /*echo $cd['parent_id'];*/?>" value="<?php /*echo $cd['name'];*/?>"><?php /*echo $cd['name'];*/?></option>
                                                <?php
/*                                            }*/?>

                                        <?php
/*                                        }
                                        */?>
                                    </select>-->
                                    <select name="category" id="category" class="form-control">
                                        <option value="">-select-</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Sports & Movement'?'selected':'';?> value="Sports & Movement">Sports & Movement</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Scholastics'?'selected':'';?> value="Scholastics">Scholastics</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Creative Arts'?'selected':'';?> value="Creative Arts">Creative Arts</option>
                                        <option <?php echo isset($FormData['category']) && $FormData['category']=='Performing Arts'?'selected':'';?> value="Performing Arts">Performing Arts</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Classes Type</label>
                                <select name="classes_type" id="classes_type" class="form-control">
                                    <option value="">-select-</option>
                                    <?php if(isset($FormData['category'])){
                                        $cat=$FormData['category'];
                                        $c_type=(array)json_decode($ClassesData);
                                        $c_type=$c_type['Sports & Movement'];
                                        foreach ($c_type as $ct){
                                            ?>
                                            <option <?php echo (isset($FormData['classes_type']) && $FormData['classes_type']== $ct->title ?'selected':'')?> value="<?php echo $ct->title?>"><?php echo $ct->title;?></option>
                                    <?php
                                        }
                                    }?>
                                </select>
                            </div>
                        </div>
                    </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>Address Line1</label>
                                    <input type="text" class="form-control" name="address1" value="<?php echo isset($FormData['address1'])?$FormData['address1']:''; ?>" placeholder="Address line1" maxlength="250">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Address Line2</label>
                                    <input type="text" class="form-control" name="address2" value="<?php echo isset($FormData['address2'])?$FormData['address2']:''; ?>" placeholder="Address line2" maxlength="250">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>State</label>
                                    <select name="state" class="form-control">
                                        <?php
                                            foreach ($StateData as $sd){
                                                ?>
                                                <option <?php echo isset($FormData['state']) && $FormData['state']==$sd['state']?'selected':'';?> value="<?php echo $sd['state'];?>"><?php echo $sd['state'];?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" value="<?php echo isset($FormData['city'])?$FormData['city']:''; ?>" placeholder="City" maxlength="25">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>Zip Code</label>
                                    <input type="text" class="form-control" name="zip_code" value="<?php echo isset($FormData['zip_code'])?$FormData['zip_code']:''; ?>" placeholder="Zip Code" maxlength="10">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label>Date From</label>
                                    <input type="text" class="form-control" name="date_from" value="<?php echo isset($FormData['date_from'])?$FormData['date_from']:''; ?>" placeholder="Date From" maxlength="10">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Date To</label>
                                    <input type="text" class="form-control" name="date_to" value="<?php echo isset($FormData['date_to'])?$FormData['date_to']:''; ?>" placeholder="Date To" maxlength="10">
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
                                        if(isset($FormData['recommand_product'])  && !empty($FormData['recommand_product'])){
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
                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-6 col-sm-6" id="what_bring">
                                <label>What To Bring</label>
                                <textarea class="form-control summernote what_bring" name="what_bring"  rows="5"><?php echo isset($FormData['what_bring'])?$FormData['what_bring']:''; ?></textarea>


                            </div>

                            <div class="col-md-6 col-sm-6" id="what_wear">
                                <label>What To Wear</label>
                                <textarea class="form-control summernote what_wear" name="what_wear"  rows="5" ><?php echo isset($FormData['what_wear'])?$FormData['what_wear']:''; ?></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-12 col-sm-12" id="wheather_policy">
                                <label>Wheather Policy</label>
                                <textarea class="form-control summernote what_bring" name="wheather_policy"  rows="5"><?php echo isset($FormData['wheather_policy'])?$FormData['wheather_policy']:''; ?></textarea>


                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-12 col-sm-12" id="Health_form">
                                <label>Health form</label>
                                <textarea class="form-control summernote what_bring" name="Health_form"  rows="5"><?php echo isset($FormData['Health_form'])?$FormData['Health_form']:''; ?></textarea>


                            </div>


                        </div>
                    </div>




                    <div class="OptionList">
                            <h3>Details</h3>
                            <a href="javascript:void(0);" class="btn btn-success btn-xs AddMore">Add More</a> <a href="javascript:void(0);" class="btn btn-warning btn-xs removeLast">Remove</a>
                            <?php
                            if(isset($FormData['form_data'])){
                                $op=(array)json_decode($FormData['form_data']);
                                $i=0;

                                foreach ($op['time_from'] as $data){
                                ?>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-3">
                                                <label>Time From</label>
                                                <input type="text" class="form-control" name="data[time_from][]" value="<?php echo $op['time_from'][$i];?>" placeholder="Date From" maxlength="10">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>Time To</label>
                                                <input type="text" class="form-control" name="data[time_to][]" value="<?php echo $op['time_to'][$i];?>" placeholder="Date To" maxlength="10">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <label>Age From</label>
                                                <input type="text" class="form-control" name="data[age_from][]" value="<?php echo $op['age_from'][$i];?>" placeholder="0" maxlength="10">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <label>Age To</label>
                                                <input type="text" class="form-control" name="data[age_to][]" value="<?php echo $op['age_to'][$i];?>" placeholder="100" maxlength="10">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <label>Fees</label>
                                                <input type="text" class="form-control" name="data[fees][]" value="<?php echo $op['fees'][$i];?>" placeholder="fees" maxlength="10">
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
                                        <div class="col-md-3 col-sm-3">
                                            <label>Time From</label>
                                            <input type="text" class="form-control" name="data[time_from][]" placeholder="Date From" maxlength="10">
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label>Time To</label>
                                            <input type="text" class="form-control" name="data[time_to][]" placeholder="Date To" maxlength="10">
                                        </div>
                                        <div class="col-md-2 col-sm-2">
                                            <label>Age From</label>
                                            <input type="text" class="form-control" name="data[age_from][]" placeholder="0" maxlength="10">
                                        </div>
                                        <div class="col-md-2 col-sm-2">
                                            <label>Age To</label>
                                            <input type="text" class="form-control" name="data[age_to][]" placeholder="100" maxlength="10">
                                        </div>
                                        <div class="col-md-2 col-sm-2">
                                            <label>Fees</label>
                                            <input type="text" class="form-control" name="data[fees][]" placeholder="100" maxlength="10">
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
                                    <th  class="">Type</th>
                                    <th  class="">Category</th>
                                    <th  class="">Date From</th>
                                    <th  class="">Date To</th>
                                    <th  class="">Address</th>
                                    <th  class="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($records as $rec){
                                    ?>
                                    <tr>
                                        <td><?php echo $rec['type'];?></td>
                                        <td><?php echo $rec['category'];?></td>
                                        <td><?php echo $rec['date_from'];?></td>
                                        <td><?php echo $rec['date_to'];?></td>
                                        <td><?php echo $rec['address1']."<br>".$rec['address2']."<br>".$rec['city'].", ".$rec['zip_code'].", ".$rec['state'];?></td>

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
    var ClassesData=<?php echo $ClassesData; ?>;
    function DeleteRecord(id,elm) {
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "DeleteClasses",
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
        $("#category").change(function () {
            ClickedSubCat=$(this).val();
            $items=ClassesData[ClickedSubCat];
            $("#classes_type").html('<select value="">select</select>');
            $.each($items,function (index,val) {
                $("#classes_type").append('<option value="'+val['title']+'">'+val['title']+'</option>');
            });
        });

        $(".AddMore").click(function () {
            $(".removeLast").show();
           $(".OptionList").append(' <div class="row">'+
               '<div class="form-group">'+
                '<div class="col-md-3 col-sm-3">'+
                '<label>Time From</label>'+
            '<input type="text" class="form-control" name="data[time_from][]" placeholder="Date From" maxlength="10">'+
                '</div>'+
                '<div class="col-md-3 col-sm-3">'+
                '<label>Time To</label>'+
            '<input type="text" class="form-control" name="data[time_to][]" placeholder="Date To" maxlength="10">'+
                '</div>'+
                '<div class="col-md-2 col-sm-2">'+
                '<label>Age From</label>'+
            '<input type="text" class="form-control" name="data[age_from][]" placeholder="0" maxlength="10">'+
                '</div>'+
                '<div class="col-md-2 col-sm-2">'+
                '<label>Age To</label>'+
            '<input type="text" class="form-control" name="data[age_to][]" placeholder="100" maxlength="10">'+
                '</div>'+
                '<div class="col-md-2 col-sm-2">'+
                '<label>Fees</label>'+
                '<input type="text" class="form-control" name="data[fees][]" placeholder="fees" maxlength="10">'+
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
            $(".summernote").each(function(){
                $(this).val($(this).code());
            });
            $elm = $(".submit-btn");

            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');

            $.ajax({
                type: "POST",
                url: "AddClasses",
                dataType: 'json',
                data:$(this).serialize(),
                success: function (resp) {
                    if (resp.success) {
                        _toastr(resp.msg,"bottom-right","success",false);
                        location.href="classes";
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