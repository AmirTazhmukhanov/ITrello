
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="border-radius: 10px;">
        <a class="navbar-brand" href="index.php">ITrello</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse container" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link">About</a>
                </li>
                <form class="form-inline my-2 my-lg-0 ml-3" action="searched_cards.php" method="get">
                    <input class="form-control mr-sm-2" type="search" name="searched_card" placeholder="Search" aria-label="Search">
                    <button class="btn btn-light my-2 my-sm-0" type="submit" name="to_search">Search</button>
                </form>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['user'])){?>
                    <li class="nav-item">
                        <form method="post" action="views/authentication_view.php">
                            <button type="submit" class="btn btn-danger mt-1" name="log_out">Log out</button>
                        </form>
                    </li>
                    <li class="nav-item mt-2 ml-3"><a href="profile.php" class="btn btn-light"><?php echo $_SESSION['user']['name']?></a></li>
                    <?php } else{?>
                <li class="nav-item">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                        Log in
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Log in form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="views/authentication_view.php">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail3" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPassword3" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" value="checked" type="checkbox" id="gridCheck1" name="remember_me">
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="login_submit">Sign in</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item ml-3">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal1">
                        Register
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Register form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="views/authentication_view.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label  class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" name="reg_name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Surname</label>
                                            <div class="col-sm-10">
                                                <input required type="text" class="form-control" name="reg_surname">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" required name="reg_email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input required type="password" class="form-control" name="reg_password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Photo</label>
                                            <div class="col-sm-10">
                                                <input required type="file" class="form-control" name="image" value="upload">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="register_submit">Sign up</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
                <?php }?>
            </ul>
        </div>
</nav>
