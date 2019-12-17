<!-- Registration Card -->
<div class="row d-flex justify-content-center mt-sm-6">
    <div class="col-md-8 col-xl-6">
        <div class="card card-primary">
            <div class="card-body">
                <!-- Registration Form Title-->
                <h3 class="mb-3 underlined-title mb-4">Registrati</h3>

                <!-- Registration Form -->
                <form method="POST" action="<?php echo URL; ?>registration/register">
                    <!-- 1th row -->
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group mb-3">
                                <label for="username-input" class="mb-n1 h6">
                                    Username
                                </label>
                                <input id="username-input" name="username" type="text" class="form-control mt-1 shadow-sm
												<?= $data['usernameCSSValidityClass'] ?>" value="<?= $data['username'] ?>">
                                <div class="invalid-feedback very-small">
                                    Inserire username senza spazi e caratteri speciali
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group mb-3">
                                <label for="email-input" class="mb-n1 h6">
                                    Email
                                </label>
                                <input id="email-input" name="email" type="email" class="form-control mt-1 shadow-sm
												<?= $data['emailCSSValidityClass'] ?>" value="<?= $data['email'] ?>">
                                <div class="invalid-feedback very-small">
                                    Inserire una email valida
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 2th row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="password-input" class="mb-n1 h6">
                                    Password
                                </label>
                                <input id="password-input" name="password" type="password" class="form-control mt-1 shadow-sm
												<?= $data['passwordCSSValidityClass'] ?>" value="<?= $data['password'] ?>">
                                <div class="invalid-feedback very-small">
                                    Inserire una password valida
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="confirmedPassword-input" class="mb-n1 h6">
                                    Conferma Password
                                </label>
                                <input id="confirmedPassword-input" name="confirmedPassword" type="password" class="form-control mt-1 shadow-sm
												<?= $data['confirmedPasswordCSSValidityClass'] ?>" value="<?= $data['confirmedPassword'] ?>">
                                <div class="invalid-feedback very-small">
                                    Inserire la stessa password
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit -->
                    <p class="form-control-static very-small mb-3"><a class="text-primary" href="<?= URL ?>home/index">Ho già un account</a></p>
                    <button type="submit" name="register" class="btn btn-primary">Registrati</button>
                </form>
            </div>
        </div>
    </div>
</div>