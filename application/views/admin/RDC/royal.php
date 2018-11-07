<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h3>Manage Royal DC TV Shows</h3>
            <hr>
            <?php
            if(empty($royalLists))
            {
                echo '<p>List empty</p>';
            }
            else
            {
                ?>
                <table id="manageCapital" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Date Time</th>
                        <th>Number</th>
                        <th>Active</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($royalLists as $item) {
                        ?>
                            <tr>
                                <td><?php echo $item['datetime']?></td>
                                <td><?php echo $item['number']?></td>
                                <td><?php echo $item['active']?></td>
                                <td><?php echo $item['remarks']?></td>
                                <td><?php echo ($item['is_delete'] == 0) ? 'Active' : 'De-Activated' ?></td>
                                <td>
                                    <a href="<?php echo base_url()?>admin/edit_royal/<?php echo $item['id']?>">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </a>
                                    <?php
                                    if($item['is_delete'] == 0)
                                    {
                                        echo '<a href="'.base_url().'admin/disableRyl/'.$item["id"].'">
                                        <span class="fa fa-minus-circle"></span></a>';
                                    }
                                    else
                                    {
                                        echo '<a href="'.base_url().'admin/activeRyl/'.$item["id"].'">
                                        <span class="fa fa-check"></span></a>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>
                <?php
            }
            ?>

            <a href="<?php echo base_url()?>admin/add_royal" class="btn btn-primary">Add New</a>
        </div>
    </div>
</div>