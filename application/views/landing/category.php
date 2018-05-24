    <?php $this->load->view('snippets/title'); ?>
    <title><?= ucfirst($this->uri->segment(3)); ?> - Intelligent Campaign Hub</title>

    <?php $this->load->view('snippets/head.php'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <!-- Navigation -->
    <?php $this->load->view('snippets/nav.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            

            <div class="col-md-12">

                <?php $this->load->view('msg_view'); ?>

                <div class="well">
                    <p class="text-center text-danger">
                        <h4>Get yourself the best and affordable <?= $this->uri->segment(3);?></h4>
                    </p>
                </div>

                <div class="row">
                    <div style="padding-left: 3px; margin-left: 5px;">
                        <p class="lead"><label class="label label-danger"><?= ucfirst($this->uri->segment(3));?></label></p>                    
                    </div>

                    <?php
                    $x = 0;
                        foreach( $products as $product ):
                    ?>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <a href="<?= base_url('product/item/shoe/' . $product['id']); ?>">
                                    <img src="<?= base_url('assets/img/' . $product['img_name']); ?>" alt="Sneaker" class="img img-responsive product-img">
                                </a>
                                <div class="caption">
                                    <h4 class="pull-right"><?= lang('ngn'); ?><?= $product['amount']; ?></h4>
                                    <h4><a href="<?= base_url('product/shoe/' . $product['id']); ?>"><?= $product['product_name']; ?></a>
                                    </h4>
                                    <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="ratings clearfix">
                                    <p class="pull-right">
                                        <?php 
                                            $set = false;
                                            if( $cart ) :
                                                foreach( $cart as $item ) :
                                                    if( $item['id'] == $product['id'] ):
                                                        $set = true;
                                            ?>
                                                    <button type="button" class="btn btn-md btn-danger remove_cart" data-id="<?= $item['rowid']; ?>">Remove from cart</button>
                                                <?php
                                                    endif;
                                                endforeach;
                                            endif;
                                            ?>
                                            <?php if(!$set) :?>
                                                <button type="button" class="btn btn-md btn-warning add_cart" data-id="<?= $product['id']; ?>">Add to Cart</button>
                                            <?php endif;?>
                                    </p>
                                    <p>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>



                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p><?= lang('footer_text'); ?></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/landing/js/jquery.js'); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('assets/landing/js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript"> var base_url = "<?= base_url(); ?>" </script>
    <script src="<?= base_url('assets/landing/js/script.js'); ?>"></script>
</body>
</html>
