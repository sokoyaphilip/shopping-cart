    <?php $this->load->view('snippets/title'); ?>

    <title>Shopping Cart - Intelligent Campaign Hub</title>

    <!-- Bootstrap Core CSS -->
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
            <div class="col-md-6 col-md-offset-3">
                <h4 class="title text-center">Login to your account.</h4>
                <hr class="rule" />
                <div class="well">
                    <?php $this->load->view('msg_view'); ?>
                    <?= form_open('account', 'class="form-horizontal" autocomplete="off" autocomplete="off"'); ?>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" placeholder="Enter email" autofocus="autofocus();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="password">Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <p><button type="submit" class="btn btn-success">Submit</button> | 
                                <a href="<?= base_url('account/signup'); ?>">Don't have an account?</a>
                            </p>
                            </div>
                        </div>
                    <?php form_close(); ?>
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

</body>

</html>
