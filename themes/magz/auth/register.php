<?php cve_theme_include('inc/head'); ?>
<?php cve_theme_include('inc/header'); ?>

    <section class="login first grey">
        <div class="container">
            <div class="box-wrapper">
                <div class="box box-border">
                    <div class="box-body">
                        <h4>Register</h4>
                        <form>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="fw">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-primary btn-block">Register</button>
                            </div>
                            <div class="form-group text-center">
                                <span class="text-muted">Already have an account?</span> <a href="login.html">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php cve_theme_include('inc/footer'); ?>