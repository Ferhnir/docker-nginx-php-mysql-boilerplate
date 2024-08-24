<?php require_once base() . '/View/includes/_header.php'; ?>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
            <?php

            if($_GET && isset($_GET['error'])){
                echo '<div class="alert alert-danger mt-5" role="alert">' . $_GET["error"] . '</div>';
            }

            ?>
                <div class="card mt-5">
                    <div class="card-header">
                        Login:
                    </div>
                    <div class="card-body">
                        <form action="/login" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="username-input" aria-describedby="emailHelp" name="email">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password-input" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        Don't have a account? <a href="register">Click here to register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once base() . '/View/includes/_footer.php'; ?>