<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4 col-sm-offset-2">
                <h3>Add Capital Bazaar TV Shows</h3>
                <hr>
                <form role="form" method="post" action="<?php echo base_url()?>admin/addd_capital" >
                    <div class="form-group">
                        <label>Number</label>
                        <input class="form-control" type="text" name="number">
                        <p class="help-block"><?php echo form_error('number'); ?></p>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control" type="text" id="datepicker" name="date">
                        <p class="help-block"><?php echo form_error('date'); ?></p>
                    </div>

                    <div class="inner cover indexpicker">
                        <label for="">Time</label>
                        <input id="timepicker" type="text" name="time" class="form-control"/>
                        <p class="help-block"><?php echo form_error('time'); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="active">
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Remarks</label>
                        <input class="form-control"  type="tel" name="remarks">
                        <p class="help-block"><?php echo form_error('remarks'); ?></p>
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