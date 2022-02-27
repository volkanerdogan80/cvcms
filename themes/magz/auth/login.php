<?php cve_theme_include('inc/head'); ?>
<?php cve_theme_include('inc/header'); ?>

    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>Login</h4>
                        <form>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="fw">Password
                                    <a href="forgot.html" class="pull-right">Forgot Password?</a>
                                </label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">Don't have an account?</span> <a href="register.html">Create one</a>
                            </div>
                            <div class="title-line">
                                or
                            </div>
                            <a href="#" class="btn btn-social btn-block facebook"><i class="ion-social-facebook"></i> Login with Facebook</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php cve_theme_include('inc/footer'); ?>