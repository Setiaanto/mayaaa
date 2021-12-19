<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h1 mb-4" style="font-family: 'Satisfy', cursive; color: black;"><b>Mayaaa</b></h1>
                            <img src="<?= base_url('assets/img/password-reset.png') ?>" style="width: 110px; height: auto;">
                            <h1 class="h4 text-gray-900 mb-3 mt-1"><b>Create new password</b></h1>
                            <h1 class="h6 text-black-900 mb-3">Create a password at least 8 characters long.</h1>
                        </div>
                        <div class="dropdown-divider my-4"></div>
                        <form class="user" method="post" action="<?= base_url('auth/changepassword');?>">
                            

                            <p class="text-center"><?= $this->session->userdata('reset_email');?></p>

                           <div class="form-group">
                                <input type="password" class="form-control form-control-user mt-2" id="password" name="password" placeholder="New password">
                                <small id="emailHelp" class="form-text text-danger"><?= form_error('password'); ?></small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="passwordrepeat" name="passwordrepeat" placeholder="Confirm new password">
                                <small id="emailHelp" class="form-text text-danger"><?= form_error('passwordrepeat'); ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-user mt-4">
                                Reset Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

