<!DOCTYPE html>
<html>
<head>
    <title>Video Admin</title>

    <!--css-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-glyphicons.css">
    <link href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" />
    <!--Script-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>


    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/timepick/jquery-ui-timepicker-addon.css" />
    <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<!---->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

    <script>
        $(document).ready(function() {
            $('#manageCapital').dataTable();
        } );
        $(document).ready(function() {
            $('#example2').dataTable();
        } );

    </script>

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/alertifyjs/1.4.1/alertify.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.4.1/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.4.1/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.4.1/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.4.1/css/themes/bootstrap.min.css"/>

</head>
<body>

<?php
if($this->session->flashdata('success') != '')
{
    ?>
    <script>
        alertify.success('<?=$this->session->flashdata('success'); ?>');
    </script>
    <?
}

if($this->session->flashdata('error') != '')
{
    ?>
    <script>
        alertify.error('<?=$this->session->flashdata('error'); ?>');
    </script>
    <?
}
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Video Admin</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url()?>admin/capital">Capital Bazaar</a></li>
            <li><a href="<?php echo base_url()?>admin/royal">Royal DC</a></li>
        </ul>
        <div class="" style="float: right !important; padding: 0.5%;">
            <a href="<?php echo base_url()?>delete" type="button" class="btn btn-danger">Clear Cookie</a>
            <a href="<?php echo base_url()?>logout" type="button" class="btn btn-danger">Logout</a>
        </div>
    </div>

</nav>

