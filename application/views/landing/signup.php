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
                <h4 class="title text-center">Register an account in less than a minutes.</h4>
                <hr class="rule" />
                <div class="well">
                    <?php $this->load->view('msg_view'); ?>
                    <?= form_open('account/signup', 'autocomplete="off" autocomplete="off"'); ?>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your fullname" autofocus="autofocus();">
                        </div>
                        <div class="form-group">
                            <label for="name">Phone:</label>
                            <input type="number" name="phone" class="form-control" placeholder="Phone number" autofocus="">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="password">Repeat Password:</label>
                            <input type="password" name="rpassword" class="form-control" id="rpassword" placeholder="Repeat your password">
                        </div>

                        <div class="form-group">
                            <p><button type="submit" class="btn btn-success">Submit</button>
                                | <a href="<?= base_url('account'); ?>">Already have an account</a>
                            </p>
                        </div>
                    <?= form_close(); ?>
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
