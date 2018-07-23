<style>
    .sp-container{
        display: none!important;
    }
</style>
<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong>Product</strong>
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
                    <div class="accordion panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#acordion1" class="">
                                        Product Detail
                                    </a>
                                </h4>
                            </div>
                            <div id="acordion1" class="collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-6">
                                                <label>Product Title</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['title'])?$FormData['title']:'' ?>" name="title"  id="title" placeholder="Product Title" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-6">
                                                <label>Category</label>
                                                <select name="category" class="form-control" title="select Category" required>
                                                    <option value="">-select-</option>
                                                    <?php foreach ($prd_cat as $pcat){
                                                        ?>
                                                        <option <?php echo isset($FormData['category']) && $FormData['category']==$pcat['id']?'selected':'' ?> value="<?php echo $pcat['id'];?>"><?php echo !empty($pcat['parent_name'])?$pcat['parent_name'].'>'.$pcat['name']:$pcat['name'];?></option>
                                                        <?php
                                                    }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-6">
                                                <label>Current Stock</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['current_stock'])?$FormData['current_stock']:'' ?>" name="current_stock"  id="current_stock" placeholder="Current Stock" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-6">
                                                <label>Stock Unit</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['unit'])?$FormData['unit']:'pc' ?>" name="unit"  id="unit" placeholder="Unit (e.g. pc etc)" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-6">
                                                <label>Images</label>
                                                <input class="custom-file-upload" type="file" id="file" name="file[]" multiple="multiple" data-btn-text="Select a File" />
                                                <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>
                                                <br>
                                                <?php
                                                if(isset($FormData['product_imgs'])){
                                                foreach ($FormData['product_imgs'] as $pimg){
                                                    ?>
                                                    <div class="col-md-3" style="width: 150px;position: relative;">
                                                        <img style="width: 100%;" src="<?php echo base_url().'../uploads/products/'.$pimg['img_name'];?>">
                                                        <div class="DeleteImg" style="cursor: pointer;  position: absolute;    top: 0;    right: 0;    color: red;" onclick="DeleteImg(<?php echo $pimg['id'];?>,$(this))"><i class="fa fa-trash" aria-hidden="true"></i></div>
                                                    </div>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-6">
                                                <label>Description</label>
                                                <textarea class="form-control summernote" name="description"><?php echo isset($FormData['description'])?$FormData['description']:'' ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#acordion2" class="collapsed">
                                       Bussiness Detail
                                    </a>
                                </h4>
                            </div>
                            <div id="acordion2" class="collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-12">
                                                <label>Sale Price</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['sale_price'])?$FormData['sale_price']:'' ?>" name="sale_price"  id="sale_price" placeholder="Sales Price" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-12">
                                                <label>Business Price</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['purchase_price'])?$FormData['purchase_price']:'' ?>" name="business_price"  id="business_price" placeholder="Business Price" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-12">
                                                <label>Shipping Cost</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['shipping_cost'])?$FormData['shipping_cost']:'0' ?>" name="shipping_cost"  id="shipping_cost" placeholder="Shipping Cost">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9">
                                                <label>Product Tax</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['tax'])?$FormData['tax']:'' ?>" name="tax"  id="tax" placeholder="Product Tax" >
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>&nbsp;</label>
                                                <select name="tax_type" class="form-control">
                                                    <option <?php echo isset($FormData['tax_type']) && $FormData['tax_type']=='percent'?'selected':'' ?> value="percent">%</option>
                                                    <option <?php echo isset($FormData['tax_type']) && $FormData['tax_type']=='rs'?'selected':'' ?> value="rs">$</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9">
                                                <label>Product Discount</label>
                                                <input type="text" class="form-control" value="<?php echo isset($FormData['discount'])?$FormData['discount']:'' ?>" name="discount"  id="discount" placeholder="Discount Type">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>&nbsp;</label>
                                                <select name="discount_type" class="form-control">
                                                    <option <?php echo isset($FormData['discount_type']) && $FormData['discount_type']=='percent'?'selected':'' ?> value="percent">%</option>
                                                    <option <?php echo isset($FormData['discount_type']) && $FormData['discount_type']=='rs'?'selected':'' ?> value="rs">$</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#acordion3" class="collapsed">

                                        Customer Choice Options
                                    </a>
                                </h4>
                            </div>
                            <div id="acordion3" class="collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 relative colors">
                                                <label class="col-md-12">Choose Color <a href="javascript:void(0);" class="btn btn-xs btn-success btn-add">Add More</a></label>
                                                <?php
                                                if(isset($FormData['color'])) {
                                                    $color = json_decode($FormData['color']);
                                                    foreach ($color as $clr) {
                                                        ?>
                                                        <div class="more-color">
                                                            <div class="col-md-9">
                                                                <div id="cp2" class="input-group colorpicker-component cp1">
                                                                    <input type="text" name="color[]" value="<?php echo $clr;?>" class="form-control" />
                                                                    <span class="input-group-addon"><i></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-delete">Delete</a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <div class="more-color">
                                                        <div class="col-md-9">
                                                            <div id="cp2" class="input-group colorpicker-component cp1">
                                                                <input type="text" name="color[]" value="#00AABB" class="form-control" />
                                                                <span class="input-group-addon"><i></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-12 ">
                                                <label>Choose Size</label>
                                               <div> <input style="width: 100%!important;" name="size" type="text" value="<?php echo isset($FormData['size'])?$FormData['size']:'' ?>" class="form-control" placeholder="Type Size & Press Enter" data-role="tagsinput"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        <th  class="">Product Name</th>
                                        <th  class="">Product Category</th>
                                        <th  class="">Sale Price</th>
                                        <th  class="">Purchase Price</th>
                                        <th  class="">Featured</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_prd as $prd){
                                        ?>
                                        <tr>
                                            <td><?php echo $prd['title'];?></td>
                                            <td><?php echo $prd['category'];?></td>
                                            <td><?php echo $prd['sale_price'];?></td>
                                            <td><?php echo $prd['purchase_price'];?></td>
                                            <td><?php echo $prd['featured']=='1'?'Yes':'No';?></td>
                                            <td>
                                                <a href="javascript:void(0);"  data-val="<?php echo $prd['id'];?>" class="btn btn-sm btn-default AddStock">Maintain Stock</a>
                                                <a href="?id=<?php echo $prd['id'];?>" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="DeleteRecord('<?php echo $prd['id'];?>',$(this))" >Delete</a>
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
<div class="modal fade StockModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
            </div>

            <!-- body modal -->
            <div class="modal-body">
                <form class="MaintainStock">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-6">
                            <label>Current Quantity</label>
                            <input type="text" class="form-control" disabled id="Quantity" placeholder="">
                            <input type="hidden" name="product_id" id="ProductId">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-6">
                            <label>Action Type</label>
                            <select class="form-control" name="action_type">
                                <option value="add">Add Quantity</option>
                                <option value="remove">Remove Quantity</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-6">
                            <label>New Quantity</label>
                            <input type="text" class="form-control" value="" name="quantity" id="title" placeholder="New Quantity" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-6">
                            <label>Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-6">
                            <input type="submit" name="Submit" value="Submit">
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>
<script>
    /*contact form insert jquery*/

    $(function () {
       $(".AddStock").click(function () {
           $(".StockModal").modal('show');
           var id=$(this).attr('data-val');
           $.ajax({
               type: "POST",
               url: "GetStock",
               dataType: 'json',
               data: {id:id},
               success: function (resp) {
                   if (resp.success) {
                       $("#Quantity").val(resp.data.current_stock);
                       $("#ProductId").val(resp.data.id);
                   } else {

                   }
               },
               error: function (data) {
               }
           });
       });

        $(".MaintainStock").submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "MaintainStock",
                dataType: 'json',
                data: $(this).serialize(),
                success: function (resp) {
                    if (resp.success) {
                        location.reload();
                        _toastr(resp.msg,"bottom-right","success",false);

                    } else {
                        _toastr(resp.msg,"bottom-right","warning",false);

                    }
                },
                error: function (data) {
                }
            });
        })
    });

    function DeleteRecord(id,elm) {
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "DeleteProduct",
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
    function DeleteImg(id,elm) {
        $elm=elm;
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
        $.ajax({
            type: "POST",
            url: "DeleteProductImg",
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
        $(document).on('click','.btn-add',function () {
            $(".colors").append('<div class="more-color">'+
                '<div class="col-md-9">'+
                '<div id="cp2" class="input-group colorpicker-component cp1">'+
                '<input type="text" name="color[]" value="#00AABB" class="form-control" />'+
                '<span class="input-group-addon"><i></i></span>'+
                '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                '<a href="javascript:void(0);" class="btn btn-xs btn-danger btn-delete">Delete</a>'+
                '</div>'+
                '</div>');

            $('.cp1').colorpicker();
        });
        $(document).on('click','.btn-delete',function () {
            $(this).closest('.more-color').remove();
        });

        $('.cp1').colorpicker();

        $("#RecordForm").submit(function (e) {
            e.preventDefault();
            $elm = $(".submit-btn");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
            $(".summernote").each(function(){
                $(this).val($(this).code());
            });
            $form = $(this)[0];
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "AddProduct",
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