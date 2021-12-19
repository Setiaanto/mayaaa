<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h1 mb-4" style="font-family: 'Satisfy', cursive; color: black;"><b>Mayaaa</b></h1>
                            <img src="<?= base_url('assets/img/forgot_password.png') ?>" style="width: 110px; height: auto;">
                            <h1 class="h4 text-gray-900 mb-3 mt-1"><b>Trouble Logging In?</b></h1>
                            <h1 class="h6 text-black-900 mb-3">Enter your email, phone, or username and we'll send you a link to get back into your account.</h1>
                            <div class="dropdown-divider my-4"></div>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/forgotPassword');?>">
                            <?= $this->session->flashdata('message');?>
                           <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email')?>" placeholder="Your email">
                                <small id="emailHelp" class="form-text text-danger"><?= form_error('email'); ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-user mt-4">
                                Send Login Link
                            </button>
                        </form>
                        <div class="dropdown-divider my-4"></div>
                        <div class="text-center">
                        	<a href="<?= base_url('auth/signup'); ?>" class="alert-link">Create New Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
   			<div class="text-center">
   				<a href="<?= base_url('auth') ?>" class="alert-link">Back to login.</a>
   			</div>
  		</div>
    </div>
</div>

