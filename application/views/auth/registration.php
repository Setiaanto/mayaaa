<div class="container">

    <div class="card o-hidden border-0 shadow-lg mt-5 mb-3 col-lg-5 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h1 mb-3" style="font-family: 'Satisfy', cursive; color: black;"><b>Mayaaa</b></h1>
                            <h1 class="h6 text-black-900 mb-4">Sign up to see photos and videos from your friends.</h1>
                            <div class="dropdown-divider my-4"></div>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/signup'); ?>">
                           <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email')?>" placeholder="Email address">
                                <small id="emailHelp" class="form-text text-danger"><?= form_error('email'); ?></small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="Name" name="name" value="<?= set_value('name')?>" placeholder="Full name">
                                <small id="emailHelp" class="form-text text-danger"><?= form_error('name'); ?></small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="Username" name="username" 
                                    placeholder="Username" value="<?= set_value('username'); ?>">
                                <small class="form-text text-danger"><?= form_error('username'); ?></small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="Password" name="password" 
                                    placeholder="Password">
                                <small class="form-text text-danger"><?= form_error('password'); ?></small>     
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-user mt-4">Sign up</button>
                            <div class="dropdown-divider mb-4 mt-4"></div>

                            <a href="" class="btn btn-primary btn-block btn-user mt-4 mb-3"><i class="fab fa-facebook-square"></i> Log in with Facebook</a>
                            <a href="" class="btn btn-danger btn-block btn-user mb-4"><i class="fab fa-google-plus-g"></i> Log in with Google</a>
                        </form>
                        <div class="text-center">
                            <h1 class="h6 text-black-900 mt-4">By signing up, you agree to our
                                <a href="#" class="alert-link">Terms</a>,
                                <a href="#" class="alert-link">Data Policy</a>, and 
                                <a href="#" class="alert-link">Cookies Policy</a>.</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card o-hidden border-0 shadow-lg mb-5 col-lg-5 mx-auto">
        <div class="card-body">
            <div class="text-center my-auto">
                <h1 class="h6 text-black-900">Have an account? <a href="<?= base_url('auth'); ?>" class="alert-link">Log in</a></h1>
            </div>
        </div>
    </div>
</div>

    