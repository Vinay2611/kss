<section id="middle">
    <style>
        .error-box
        {
            color:red;
        }
    </style>
    <div id="content" class="dashboard padding-20">
        <div class="col-md-12">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong>Change Password</strong>
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
                    $attributes = array('class' => '', 'id' => 'RecordForm');
                    echo form_open('stock/add_stock',$attributes);
                    ?>

                    <div class="col-lg-12 error-box">
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Old Password</label>
                                <input type="password" class="form-control" name="old_password" minlength="4" placeholder="Old Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="password" minlength="4" placeholder="New Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="conf_password" minlength="4" placeholder="Confirm Password" required>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <input type="submit" class="btn btn-sm btn-success submit-btn pull-right" form="RecordForm" value="Submit">
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- / -->
        </div>
    </div>
</section>

<script>
    $(function () {
        $("#RecordForm").submit(function (e) {
            e.preventDefault();
            $elm=$(".submit-btn");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw submit-loading"></i>');
            $.ajax({
                type	: "POST",
                url		: "change_password",
                dataType : 'json',
                data	:$(this).serialize(),
                success	: function (resp) {
                    if(resp.success){
                        _toastr(resp.msg,"bottom-right","success",false);
                        setTimeout(function () {
                           location.reload();
                        },3000);
                    }else{
                        if(resp.error_msg!==""){
                            $(".error-box").html(resp.error_msg);
                        }
                        _toastr(resp.msg,"bottom-right","warning",false);
                    }
                    $(".submit-loading").remove();
                    $elm.show();
                }
            });
        });
    });
</script>