<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Slider Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
            <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>                    
            </div>
            <?php } ?>
            <?php  
                $success = $this->session->flashdata('success');
                if($success)
                {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            </div>
            <div class="col-xs-6 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#sliderModal"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Slider List</h3>
                    <div class="box-tools">
                        <button id="sort_save"  type="button" class="btn btn-success btn-sm pull-right" onClick="saveSlider();" >Save sort</button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Slider Title</th>
                            <th>Slider Url</th>
                            <th>Slider Image</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="row_position">
                        <?php
                        if(!empty($slider_data))
                        {
                            foreach($slider_data as $record)
                            {
                        ?>
                        
                        <tr  id="<?php echo $record->slider_id; ?>">
                            <td><?php echo $record->slider_name ?></td>
                            <td><?php echo $record->slider_link ?></td>
                            <td><img width="60px" src="<?php echo site_url('drives/slider/'.$record->slider_img); ?>"/></td>
                            
                            <td class="text-center">
                                <a class="btn btn-sm btn-danger deleteSlider" href="#" data-slider_id="<?php echo $record->slider_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                       
                        <?php
                            }
                        }
                        ?>
                     </tbody>
                    
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div id="sliderModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Slider</h4>
      </div>
      <div class="modal-body">
        <?php $this->load->helper("form"); ?>
        <form role="form" id="addslider" action="<?php echo site_url() ?>backoffice/slider/addNewslider" method="post" role="form" enctype="multipart/form-data">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10">                                
                        <div class="form-group">
                            <label for="slider_name">Slider Title</label>
                            <input type="text" class="form-control required" value="<?php echo set_value('slider_name'); ?>" id="slider_name" name="slider_name" maxlength="128" required>
                        </div>
                        
                    </div>
                    <div class="col-md-10">                                
                        <div class="form-group">
                            <label for="slider_link">Slider Url</label>
                            <input type="text" class="form-control required" value="<?php echo set_value('slider_link'); ?>" id="slider_link" name="slider_link" maxlength="255" required>
                        </div>
                        
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="slider_img">Slider Image</label>
                            <input type="file" class="form-control required" value="<?php echo set_value('slider_img'); ?>" id="slider_img" name="slider_img" required>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <input type="submit" class="btn btn-success" value="Submit" />
                <input type="reset" class="btn btn-default" value="Reset" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        document.getElementById("sort_save").disabled = true;
    });

    $('row_position').sortable();

    $(function () {
        $(".row_position").sortable({
            delay: 150,
            change: function () {
                var selectedLanguage = new Array();
                $('.row_position>tr').each(function () {
                    selectedLanguage.push($(this).attr("id"));


                    document.getElementById("sort_save").disabled = false;




                });
                document.getElementById("row_order").value = selectedLanguage;
            }
        });
    });

    function saveSlider() {
        var data = new Array();
        $('.row_position tr').each(function () {
            data.push($(this).attr("id"));
        });
        //alert(data);

        $.ajax({
            url: "<?php echo site_url();?>backoffice/getSortedSliders",
            type: 'post',
            data: {position: data},
            success: function () {
                alert('your change successfully saved');
                document.getElementById("sort_save").disabled = true;
            },
            error: function (html) {
                alert(html.responseText);
                alert(html.responseStatus);
            }
        })
    }
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>resource/backoffice/assets/js/common.js" charset="utf-8"></script>