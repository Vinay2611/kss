<section id="middle">
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
                    <span class="elipsis"><!-- panel title -->
                        <strong><?php echo isset($_GET['id'])?'Update':'Add'?> Terms & Conditions</strong>
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
                                    <label>Page Title</label>
                                    <input type="text" class="form-control" readonly name="package_title" value="<?php echo isset($FormData['title'])?$FormData['title']:''; ?>" placeholder="title" maxlength="250">
                                </div>
                            </div>
                        </div>


                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <label>Location</label>
                                <textarea class="summernote description" id="description" name="description"><?php echo isset($FormData['description'])?$FormData['description']:''; ?></textarea>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="panel-footer">
                    <input type="submit" class="btn btn-sm submit-btn btn-success pull-left" form="RecordForm" value="<?php echo isset($FormData['id'])?'Update':'Add' ?>" id="submit">

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>
</section>

<script>
    $(function () {


        $("#RecordForm").submit(function (e) {
            e.preventDefault();
            $elm = $(".submit-btn");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw  pull-right submit-loading"></i>');
           $(".summernote").each(function(){
				$(this).val($(this).code());
			});

            $.ajax({
                type: "POST",
                url: "add_terms_conditions",
                dataType: 'json',
                data:$(this).serialize(),
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
