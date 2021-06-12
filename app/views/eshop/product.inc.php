
<!--This is php file include to show product-->
<!--style="height: 500px"-->

<div class="col-sm-4" style="height: 450px; display: flex" >
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">

                <!-- image is a link to show products details page-->
                <a href="<?= ROOT ?>product_details/<?= $data->slug ?>">
                    <div style="overflow: hidden">
                        <img class="product-image" src="<?= ROOT . $data->image ?>" alt=""/>
                    </div>
                </a>
                <h2><?= number_format($data->price, 0, ',') ?> ₫</h2>
                <p style="height: 50px"><?= $data->description ?></p>
                <a href="<?= ROOT ?>add_to_cart/<?= $data->id ?>" class="btn btn-default add-to-cart">
                    <i class="fa fa-shopping-cart"></i>Thêm vào Giỏ
                </a>
            </div>
        </div>
    </div>
</div>
<!--end one product in section feature items-->
