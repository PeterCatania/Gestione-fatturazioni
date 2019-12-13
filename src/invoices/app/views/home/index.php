<!-- Login Card -->
<div class"container">
<div class="row d-flex justify-content-center mt-sm-6">
    <div class="col-md-6 col-xl-4">
        <div class="card card-primary">
            <div class="card-body">
                <!-- Login Form Title-->
                <h3 class="mb-3 underlined-title mb-4">Accedi</h3>

                <!-- Login Form -->
                <form method="POST" action="<?php echo URL; ?>home/login" autocomplete="on">
                    <!-- 1th row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="username-input" class="mb-n1 h6">
                                    Username
                                </label>
                                <input id="username-input" type="text" name="username" value="<?= $_SESSION['username'] ?>" class="form-control<?= " " . $_SESSION['usernameOrPasswordCSSValidityClass'] ?>" placeholder="Username">
                            </div>
                        </div>
                    </div>
                    <!-- 2nd row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="password-input" class="mb-n1 h6">
                                    Password
                                </label>
                                <input id="password-input" type="password" name="password" value="<?= $_SESSION['password'] ?>" class="form-control<?= " " . $_SESSION['usernameOrPasswordCSSValidityClass'] ?>" placeholder="Password">
                                <div class="invalid-feedback very-small">
                                    Nome utente o password non corretti.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit -->
                    <p class="form-control-static very-small mb-3">
                        Non sei registrato?
                        <a class="text-primary" href="<?= URL ?>registration/index">
                            Crea un account
                        </a>
                    </p>
                    <button type="submit" name="login" class="btn btn-primary">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

