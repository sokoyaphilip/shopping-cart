<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url(); ?>"><i class="fas fa-home"></i> Shopping Cart</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li>
                    <a href="<?= base_url('cart'); ?>">
                        <i class="fas fa-cart-plus"></i> Cart 
                        <label class="label label-danger" id="cart_counter"><?= $this->cart->total_items(); ?></label></a>
                </li>
                <li>
                    <?php
                        if( $this->session->userdata('logged_in') ) : 
                    ?>
                        <a href="<?= base_url('logout'); ?>"><i class="fas fa-redo"></i> Logout </a>
                    <?php else : ?>
                        <a href="<?= base_url('account/'); ?>"><i class="fas fa-key"></i> Login </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>