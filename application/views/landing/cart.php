    <?php $this->load->view('snippets/title'); ?>
    <title>Checkout - Intelligent Campaign Hub</title>

    <?php $this->load->view('snippets/head.php'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
<style type="text/css">

</style>
</head>
<body>

    <!-- Navigation -->
    <?php $this->load->view('snippets/nav.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <?php if( $this->cart->contents() ) : ?>
            <?php $this->load->view('msg_view'); ?>
            <div class="well text-center text text-danger">
                    <h2><strong>Checkout your orders.</strong></h2>
                    <h5>Orders could take 3 working days before delivery.</h5>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <!-- <?php 
                            if( $this->session->userdata('logged_in')){
                                form_open('cart/cart_process'); 
                            }
                        ?> -->
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">QTY</th>
                                    <th class="text-center">Item Description</th>
                                    <th class="text-center">Item Price</th>
                                    <th class="text-center">Sub-Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $x = 0; 
                                    foreach( $this->cart->contents() as $items ) : 
                                ?>
                                    <tr class="cart_row">
                                        <td class="text-center qty_change">
                                            <?php echo form_hidden($x.'[rowid]', $items['rowid']); ?>
                                            <div class="form-group">
                                                <select class="form-control qty-control" data-item-id="<?= $items['rowid']; ?>" data-amount="<?= $items['price']; ?>" 
                                                    name="<?= $x.'[qty]'; ?>">
                                                    <?php 
                                                    for( $i=1; $i<32; $i++) { 
                                                    ?>
                                                        <option value="<?= $i; ?>" <?php if($i == $items['qty']){echo 'selected';} ?>><?=$i;?></option>
                                                    
                                                    <?php } ?>
                                                </select>                                        
                                            </div>
                                        </td>
                                        <td class="text-center"><?= strtoupper($items['name']); ?></td>
                                        <td class="text-center">
                                            <?php echo lang('ngn') . $this->cart->format_number($items['price']); ?>
                                        </td>
                                        <td class="text-center subtotal">
                                            <?php echo lang('ngn') . $this->cart->format_number($items['subtotal']); ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-md btn-danger remove-item" data-item-id="<?= $items['rowid']; ?>">Remove Item</button>
                                        </td>
                                    </tr>
                                    <?php 
                                        $x++;
                                        endforeach;
                                     ?>
                                    <tr>
                                        <td colspan="2"> </td>
                                        <td class="text-center"><strong>Total</strong></td>
                                        <td class="text-center total_amount"><?= lang('ngn') . $this->cart->format_number($this->cart->total()); ?></td>
                                    </tr>
                            </tbody>
                        </table>

                        <?php
                            if( $this->session->userdata('logged_in') ) :
                        ?>
                            <p class="pull-right">
                                <button type="button" class="btn btn-md btn-success checkout" data-email="<?= $this->session->userdata('email');?>">
                                    Checkout
                                </button>
                            </p>
                        <?php else : ?>
                            <p class="pull-right">
                                <button type="button" class="btn btn-md btn-success no-login">Checkout</button>
                            </p>
                        <?php endif; ?>
                        <!-- <?= form_close(); ?> -->
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="well text-center text text-danger">
                    <h2><strong>Heads up!</strong></h2>
                    <h5>You need to add orders to your <?= anchor('landing', 'item'); ?> before checking out.</h5>
            </div>
        <?php endif; ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript"> var base_url = "<?= base_url(); ?>" </script>
    <script src="<?= base_url('assets/landing/js/script.js'); ?>"></script>
</body>
</html>
