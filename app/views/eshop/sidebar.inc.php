<!--Sidebar show Category of webpage-->
<div class="col-sm-3">
    <div class="left-sidebar">
        <br>
        <h2>Danh Mục</h2>
        <!--category-products-->
        <div class="panel-group category-products" id="accordian">

            <?php if (isset($categories) && is_array($categories)): ?>
                <?php foreach ($categories as $row):

                    if ($row->parent > 0) {
                        continue;
                    }
                    //Get integer id in column parent
                    $parents = array_column($categories, "parent");
                    ?>

                    <!--Category parent with Category children-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">

                                <!-- Check category has children or not-->
                                <a <?= in_array($row->id, $parents) ? 'data-toggle="collapse"' : ''; ?>
                                        data-parent="#accordian"
                                        href="<?= in_array($row->id, $parents) ? '#'
                                            . $row->category_slug : ROOT . 'shop/category/'
                                            . $row->category_slug ?>">
                                    <?= $row->category_name ?>
                                    <?php if (in_array($row->id, $parents)): ?>
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    <?php endif; ?>
                                </a>
                            </h4>
                        </div>

                        <!-- If parent has children-->
                        <?php if (in_array($row->id, $parents)): ?>
                            <div id="<?= $row->category_slug ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <?php foreach ($categories as $sub_row): ?>
                                            <?php if ($sub_row->parent == $row->id): ?>
                                                <li><a href="<?= ROOT . 'shop/category/' .
                                                    $sub_row->category_slug ?>"> <?= $sub_row->category_name ?> </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!--/category-products-->

        <div class="shipping text-center">
            <!--shipping-->
            <img src="<?= ASSETS . THEME ?>images/home/shipping.jpg" alt=""/>
        </div>
        <!--/shipping-->

    </div>
</div>