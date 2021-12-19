<!-- Navbar -->
<div class="navbar navbar-expand-lg navbar-light fixed-top bg-light border-bottom">
	<div class="col-lg-9 mx-auto">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<a class="navbar-brand mr-auto" href="<?= base_url('content') ?>"><h1 class="h4" style="font-family: 'Satisfy', cursive; color: black;"><b>Mayaaa</b></h1></a>
		<form class="form-inline my-2 my-lg-0 mr-5">
		  <input class="form-control mr-sm-2 text-center" type="search" placeholder="Search" aria-label="Search">
		</form>
		<a href="<?= base_url('content'); ?>" class="mt-2 ml-5 mr-3" style="color: black;"><h1 class="h4"><i class="fas fa-home"></i></h1></a>
		<a href="<?= base_url('content/direct') ?>" class="mt-2 mr-2" style="color: black;"><h1 class="h4"><i class="far fa-paper-plane"></i></h1></a>
		<button type="button" class="mt-2 mr-2 btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" style="color: black;"><h1 class="h4"><i class="fas fa-plus-circle"></i></h1></button>
		<a href="" class="mt-2 mr-3" style="color: black;"><h1 class="h4"><i class="far fa-compass"></i></h1></a>
		<a href="" class="mt-2 mr-3" style="color: black;"><h1 class="h4"><i class="far fa-heart"></i></h1></a>
		<a href="<?= base_url('user'); ?>"><img src="<?= base_url('assets/img/userprofile.png') ?>" class="img-profile rounded-circle" width="28px;"></a>
		</div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create new post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>