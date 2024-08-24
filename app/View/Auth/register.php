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
                    <form action="/register" method="POST">
                        <div class="mb-3">
                            <label for="first-name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first-name" name="first_name">
                        </div>
                        <div class="mb-3">
                            <label for="last-name" class="form-label">Last NAme</label>
                            <input type="text" class="form-control" id="last-name" name="last_name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="re-password" class="form-label">Re-Password</label>
                            <input type="password" class="form-control" id="re-password" name="re_password">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php require_once base() . '/View/includes/_footer.php'; ?>