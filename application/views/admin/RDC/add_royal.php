<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4 col-sm-offset-2">
                <h3>Add Royal DC TV Shows</h3>
                <hr>
                <form role="form" method="post" action="<?php echo base_url()?>admin/addd_royal" >
                    <div class="form-group">
                        <label>Number</label>
                        <input class="form-control" type="text" name="number">
                        <?php echo form_error('number'); ?>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control" type="text" id="datepicker" name="date">
                        <?php echo form_error('date'); ?>
                    </div>

                    <div class="inner cover indexpicker">
                        <label for="">Time</label>
                        <input id="timepicker" type="text" name="time" class="form-control"/>
                        <?php echo form_error('time'); ?>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="active">
                                <?php echo form_error('active'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Remarks</label>
                        <input class="form-control"  type="tel" name="remarks">
                        <?php echo form_error('remarks'); ?>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
<script src="<?php echo base_url()?>assets/timepick/jquery-ui-timepicker-addon.js"></script>

<script type="text/javascript">

    $(function(){
        $('#timepicker').timepicker();
        $('#timepicker').timepicker('setTime', new Date());
    });
    $( function() {
        $( "#datepicker" ).datepicker();
        $("#datepicker").datepicker("setDate", new Date());
        $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        $( "#datepicker" ).datepicker( "option", "minDate", new Date() );
    } );

</script>