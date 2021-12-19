<div class="container">

    <div class="card o-hidden border-0 shadow-lg mt-5 mb-3 col-lg-5 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h1 mb-5" style="font-family: 'Satisfy', cursive; color: black;"><b>Mayaaa</b></h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth');?>">
                            <?= $this->session->flashdata('message');?>
                           <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email')?>" placeholder="Username or Email">
                                 <small id="emailHelp" class="form-text text-danger"><?= form_error('email'); ?></small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                <small id="emailHelp" class="form-text text-danger"><?= form_error('password'); ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-user mt-4">
                                Sign in
                            </button>
                        <div class="dropdown-divider mt-4"></div>
                            <a href="" class="btn btn-primary btn-block btn-user mt-4 mb-3"><i class="fab fa-facebook-square"></i> Log in with Facebook</a>
                            <a href="<?= base_url('auth/google') ?>" class="btn btn-danger btn-block btn-user mb-4"><i class="fab fa-google-plus-g"></i> 
                            Log in with Google</a>
                        </form>
                        <div class="text-center">
                            <a href="<?= base_url('auth/forgotpassword') ?>" class="alert-link">Forgot password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card o-hidden border-0 shadow-lg mb-5 col-lg-5 mx-auto">
        <div class="card-body">
            <div class="text-center my-auto">
                <h1 class="h6 text-black-900">Don't have an account? <a href="<?= base_url('auth/signup'); ?>" class="alert-link">Sign up</a></h1>
            </div>
        </div>
    </div>
</div>

