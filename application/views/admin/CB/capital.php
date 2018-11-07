<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h3>Manage Capital Bazaar TV Shows</h3>
            <hr>
            <?php
            if(empty($capitalLists))
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

                    foreach ($capitalLists as $item) {
                        ?>
                            <tr>
                                <td><?php echo $item['datetime']?></td>
                                <td><?php echo $item['number']?></td>
                                <td><?php echo $item['active']?></td>
                                <td><?php echo $item['remarks']?></td>
                                <td><?php echo ($item['is_delete'] == 0) ? 'Active' : 'De-Activated' ?></td>
                                <td>
                                    <a href="<?php echo base_url()?>admin/edit_capital/<?php echo $item['id']?>">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </a>
                                    <?php
                                    if($item['is_delete'] == 0)
                                    {
                                        echo '<a href="'.base_url().'admin/disableCap/'.$item["id"].'">
                                        <span class="fa fa-minus-circle"></span></a>';
                                    }
                                    else
                                    {
                                        echo '<a href="'.base_url().'admin/activeCap/'.$item["id"].'">
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

            <a href="<?php echo base_url()?>admin/add_capital" class="btn btn-primary">Add New</a>
        </div>
    </div>
</div>