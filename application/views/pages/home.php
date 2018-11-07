<style>
    img{
        display:block;
        margin:auto !important;
    }
    .button{
        text-align: center !important;
    }
    @keyframes blink {
        to { color: white; }
    }

    .button_message {
        color: #d9534f;
        animation: blink 1s steps(2, start) infinite;
    }
</style>



<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <h3 style="text-align: center">Capital Bazaar</h3>
                <div style="height: 360px; margin-bottom: 10px">
                    <?php

                    if(!empty($cVideoNumber))
                    {
                        if($cPlay == 'no')
                        {
                            ?>
                            <img src="<?php echo base_url() ?>video/cb/<?php echo $cVideoNumber ?>.jpg" alt="" >
                            <?
                        }
                        else
                        {
                            ?>
                            <input type="hidden" id="video1ID" value="<?php echo $cVideoID ?>">
                            <video src="<?php echo base_url()?>video/cb/<?php echo $cVideoNumber ?>.mp4" height="360" width="100%" id="video1" muted autoplay ></video>
                            <img src="<?php echo base_url()?>video/cb/<?php echo $cVideoNumber ?>.jpg" height="360" alt="" id="video1Image" style="display: none">
                            <?
                        }
                    }
                    else {
                        ?>
                        <img src="<?php echo base_url()?>video/noVideo.jpg" height="360" alt="">
                        <?
                    }

                    ?>
                </div>
                <div class="col-sm-12 button">
                    <?php
                    if(!empty($cButtonTitle) && !empty($cButtonTime))
                    {
                        ?>
                        <a class="btn btn-danger button_message"><?php echo $cButtonTitle.' '. $cButtonTime ?></a>
                        <?
                    }
                    else
                    {
                        ?>
                        <a class="btn btn-danger button_message">No Video in Loop</a>
                        <?
                    }
                    ?>
                </div>
                <div style="clear: both"></div>
                <div style="padding-top: 5%">
                    <?php
                    if(empty($capitalList))
                    {
                        echo '<p style="text-align: center; font-weight: bold; font-size: 20px">Empty List</p>';
                    }
                    else
                    {
                        ?>
                        <table class="table  table-hover table-striped">
                            <thead>
                            <tr align="center">
                                <th width="20%">#</th>
                                <th width="40%">DateTime</th>
                                <th width="40%">Number</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($capitalList as $capItem) {
                                ?>
                                <tr>
                                    <td><?php echo $capItem['id']?></td>
                                    <td><?php echo date_format(date_create($capItem['datetime']),'H:i') ?></td>
                                    <td><?php echo $capItem['number']?></td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
                <div style="clear: both"></div>
                <hr>
                <div class="col-sm-12">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input class="form-control" type="text" id="capdatepicker" name="date" required>
                        </div>
                        <button type="submit" class="btn btn-default" id="capDateForm">Submit</button>
                    </form>
                    <div style="clear: both"></div>
                    <table class="table  table-hover table-striped table-bordered hidden" id="capAjaxTable" style="margin-top: 3%">
                        <tr>
                            <th width="20%">#</th>
                            <th width="40%">DateTime</th>
                            <th width="40%">Number</th>
                        </tr>
                        <tbody id="capAjaxTableBody">

                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                $(function(){
                    $( "#capDateForm" ).click(function(event)
                    {
                        event.preventDefault();
                        var date= $("#capdatepicker").val();

                        $("#capAjaxTableBody").empty();
                        $.ajax(
                            {
                                type:"post",
                                url: "<?php echo base_url(); ?>home/getAjaxCapital",
                                data:{ date:date},
                                dataType:"json",
                                success:function(data)
                                {
                                console.log(data);
                                    var len = data.length;
                                    var txt = "";
                                    if(len > 0){
                                        for(var i=0;i<len;i++)
                                        {
                                            if(data[i].id && data[i].datetime)
                                            {
                                                txt += "<tr><td>"+data[i].id+"</td><td>"+data[i].datetime+"</td><td>"+data[i].number+"</td></tr>";
                                            }
                                        }
                                        if(txt != "")
                                        {
                                            $("#capAjaxTable").removeClass("hidden");
                                            $("#capAjaxTableBody").append(txt);

                                        }
                                    }
                                }
                            });
                    });
                });
            </script>
            <script type="text/javascript" src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
            <script src="<?php echo base_url()?>assets/timepick/jquery-ui-timepicker-addon.js"></script>

            <script  type="text/javascript">

                var video= $('#video1')[0];
                var videoJ= $('#video1');
                var id = $("#video1ID").val();

                videoJ.on('ended',function(){
                    $("#video1").hide();
                    $("#video1Image").show();
                });

                $( function() {
                    $( "#capdatepicker" ).datepicker();
                    $("#capdatepicker").datepicker("setDate", new Date());
                    $( "#capdatepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

                    $( "#rddatepicker" ).datepicker();
                    $("#rddatepicker").datepicker("setDate", new Date());
                    $( "#rddatepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
                } );
            </script>



            <!--Royal DC-->
            <div class="col-sm-6">
                <h3 style="text-align: center">Royal DC</h3>
                <div style="height: 360px; margin-bottom: 10px">
                    <?php

                    if(!empty($rVideoNumber))
                    {
                        if($rPlay == 'no')
                        {
                            ?>
                            <img src="<?php echo base_url() ?>video/rdc/<?php echo $rVideoNumber ?>.jpg" height="360" alt="">
                            <?
                        }
                        else
                        {
                            ?>
                            <input type="hidden" id="video2ID" value="<?php echo $rVideoID ?>">
                            <video src="<?php echo base_url()?>video/rdc/<?php echo $rVideoNumber ?>.mp4" height="360" width="100%" id="video2" muted autoplay ></video>
                            <img src="<?php echo base_url()?>video/rdc/<?php echo $rVideoNumber ?>.jpg" height="360" alt="" id="video2Image" style="display: none">
                            <?
                        }
                    }
                    else {
                        ?>
                        <img src="<?php echo base_url()?>video/noVideo.jpg" height="360" alt="" >
                        <?
                    }

                    ?>
                </div>
                <div class="col-sm-12 button">
                    <?php
                    if(!empty($rButtonTitle) && !empty($rButtonTime))
                    {
                        ?>
                        <a class="btn btn-danger button_message"><?php echo $rButtonTitle.' '. $rButtonTime ?> </a>
                        <?
                    }
                    else
                    {
                        ?>
                        <a class="btn btn-danger button_message">No Video in Loop</a>
                        <?
                    }
                    ?>
                </div>
                <div style="clear: both"></div>
                <div style="padding-top: 5%">

                    <?php
                    if(empty($royalList))
                    {
                        echo '<p style="text-align: center; font-weight: bold; font-size: 20px">Empty List</p>';
                    }
                    else
                    {
                        ?>
                        <table class="table  table-hover table-striped">
                            <thead>
                            <tr align="center">
                                <th width="20%">#</th>
                                <th width="40%">DateTime</th>
                                <th width="40%">Number</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($royalList as $royalItem) {
                                ?>
                                <tr>
                                    <td><?php echo $royalItem['id']?></td>
                                    <td><?php echo date_format(date_create($royalItem['datetime']),'H:i')?></td>
                                    <td><?php echo $royalItem['number']?></td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
                <div style="clear: both"></div>
                <hr>
                <div class="col-sm-12">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input class="form-control" type="text" id="rddatepicker" name="date" required>
                        </div>
                        <button type="submit" class="btn btn-default" id="rdDateForm">Submit</button>
                    </form>
                    <div style="clear: both"></div>
                    <table class="table  table-hover table-striped table-bordered hidden" id="rdAjaxTable" style="margin-top: 3%">
                        <tr>
                            <th width="20%">#</th>
                            <th width="40%">DateTime</th>
                            <th width="40%">Number</th>
                        </tr>
                        <tbody id="rdAjaxTableBody">

                        </tbody>
                    </table>
                </div>
                <script>
                    $(function(){
                        $( "#rdDateForm" ).click(function(event)
                        {
                            event.preventDefault();
                            var date= $("#rddatepicker").val();

                            $("#rdAjaxTableBody").empty();
                            $.ajax(
                                {
                                    type:"post",
                                    url: "<?php echo base_url(); ?>home/getAjaxRoyal",
                                    data:{ date:date},
                                    dataType:"json",
                                    success:function(data)
                                    {
                                    console.log(data);
                                        var len = data.length;
                                        var txt = "";
                                        if(len > 0){
                                            for(var i=0;i<len;i++)
                                            {
                                                if(data[i].id && data[i].datetime)
                                                {
                                                    txt += "<tr><td>"+data[i].id+"</td><td>"+data[i].datetime+"</td><td>"+data[i].number+"</td></tr>";
                                                }
                                            }
                                            if(txt != "")
                                            {
                                                $("#rdAjaxTable").removeClass("hidden");
                                                $("#rdAjaxTableBody").append(txt);

                                            }
                                        }
                                    }
                                });
                        });
                    });
                </script>
            </div>
            <script  type="text/javascript">

                var video= $('#video2')[0];
                var videoJ= $('#video2');
                var id = $("#video2ID").val();

                videoJ.on('ended',function(){
                    $("#video2").hide();
                    $("#video2Image").show();
                });

            </script>
        </div>
    </div>
    <div style="clear: both"></div>
    <div class="row">
        <div style="margin-bottom: 5%"></div>
    </div>
</div>


</body>
</html>

<script type="text/javascript">
    $(document).ready(function()
    {
        // var player =  iframe.getElementById('player');
        // player.mute();
        
       // setInterval(function(){alert("works!");}, 1000);
       
        /*$.ajax(
	    {
	        type:"post",
	        url: "<?php echo base_url(); ?>home/test",
	        dataType:"json",
	        success:function(data)
	        {
	        console.log(data);
	        },
	        failure: function(data){
	        	console.log("error", data);
	        }
	    });*/

    });
</script>