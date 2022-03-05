<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- navbar -->
<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg pl-0 pr-0">
    <div class="ml-2 pb-1"><img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="40"> </div>
    <button class="btn btn-dark navbar-toggler ml-auto mb-2 mr-2" type="button" data-toggle="collapse" data-target="#myNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
        <div class="container-fluid">
            <div class="row">
                <!-- sidebar -->
                <div class="col-xl-2 col-lg-3 col-md-12 sidebar fixed-top">
                    <a href="#" class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4"><img src="<?php echo URLROOT; ?>/images/zoneclaudians.svg" width="150"></a>
                    <ul class="navbar-nav flex-column mt-4">
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/home" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-home text-light fa-lg mr-3"></i>Home</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/my_loads" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-list text-light fa-lg mr-3"></i>My Loads</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/my_class" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="far fa-address-book text-light fa-lg mr-3"></i>Class Record</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/history" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-history text-light fa-lg mr-3"></i>History</a></li>
                    </ul>
                </div>
                <!-- end of sidebar -->
                <!-- top-nav -->
                <div class="col-xl-10 col-lg-9 col-md-8 ml-lg-auto pt-3 pb-2 fixed-top top-navbar bg">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-12 text-white">
                            <h4><?php echo 'SY ' . $_SESSION['school_year']; ?></h4>
                        </div>
                        <div class="ml-lg-auto mr-3 ml-3">
                            <div class="dropdowns">
                                <a class="dropdown-toggle text-light" href="" id="navbarDropdown" role="button" data-toggle="dropdown">
                                    <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mr-xl-1 mt-1" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-item"><strong>My Account</strong></div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item small" href="<?php echo URLROOT; ?>/teachers/change_password">Change Password</a>
                                    <a class="dropdown-item small" href="" name="btn-logout" data-toggle="modal" data-target="#logout">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of top-nav -->
            </div>
        </div>
    </div>
</nav>
<!-- end of navbar -->
<!--modal logout-->
<div class="modal" tabindex="-1" role="dialog" id="logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form method="post" action="<?php echo URLROOT; ?>/users/logout"><button class="btn btn-success">Logout</button></form>
            </div>
        </div>
    </div>
</div>

<!--end of modal logout-->

<!--Content start-->
<section>
    <div class="container-fluid pl-0 pr-0">
        <div class="col-xl-10 col-lg-9 col-md-12 ml-auto">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!--navigation-->
                    <div class="card pl-0 pr-0 mt-3">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div>
                                        <h4>Write Post<button class="btn btn-info float-right writePost" href="" data-id="" role="button"><i class="fas fa-pencil-alt"></i></button></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of navigation-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card pl-0 pr-0 mt-1">
                        <div class="row pt-3 justify-content-center">
                            <div class="col-12">
                                <?php if (!empty($data['post'])) : ?>
                                    <?php foreach ($data['post'] as $post) : ?>
                                        <div class="card mx-lg-2 mt-2">
                                            <div class="card-header bg-white">
                                                <h5><?php echo $post->post_name; ?><button class="btn float-right bg-white btn-outline-white postDelete" href="" data-id="<?php echo $post->post_id; ?>" data-name="<?php echo $post->name_id; ?>" role="button"><i class="fas fa-ellipsis-h"></i></button></h5>
                                            </div>
                                            <div class="card-body text-dark">
                                                <h5><strong><?php echo $post->pos_title; ?></strong></h5>
                                                <p><?php echo $post->feeds; ?></p>
                                            </div>
                                            <div class="card-footer text-dark bg-white">
                                                <h6><?php echo $post->current_date; ?></h6>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (empty($data['post'])) : ?>
                                    <div class="ml-4 mt-3 mb-4">
                                        <h5>No post Available</h5>
                                    </div>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!--Content end-->
<div class="modal" tabindex="-1" id="postModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Post</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Title</label>
                    <input type="text" class="form-control title" id="exampleInputPassword1" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Post</label>
                    <textarea class="form-control post" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btnPost">Post</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Post</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary deletePost">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="confirmModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Post</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary confirmPost">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>




<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('.writePost').click(function() {
            $('#postModal').toggle();

            $('.btnPost').click(function() {
                var title = $('.title').val();
                var post = $('.post').val();

                if (title === '' || post === '') {
                    alert('Please complete all fields');
                } else {
                    $('#confirmModal').toggle();
                    $('#postModal').hide();

                    $('.confirmPost').click(function() {
                        $.ajax({
                            url: '<?php echo URLROOT ?>' + '/Actions/AddPost',
                            method: 'post',
                            data: {
                                title: title,
                                post: post
                            },
                            success: function(response) {
                                alert(response);
                                $('#confirmModal').hide();
                                location.reload();

                            }
                        });
                    });

                }


            });
        });

        $('.postDelete').click(function() {
            var id = $(this).data('id');
            var postName = $(this).data('name');
            var myId = '<?php echo $data['myId']; ?>';

            if (postName != myId) {
                alert('This is not your post you cannot delete it')
            } else {
                $('#deleteModal').toggle();

                $('.deletePost').click(function() {
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/DeletePost',
                        method: 'post',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            alert(response);
                            $('#deleteModal').hide();

                            location.reload();

                        }
                    });
                });

            }
        });
    });
</script>