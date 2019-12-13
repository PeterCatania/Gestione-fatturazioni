<!-- Invoices Card -->
<div class"container">
<div class="row d-flex justify-content-center mt-sm-6 ">
    <div class="col-md-11 col-xl-10">
        <div class="card card-primary border-0">
            <div class="card-body px-4">
                <!-- Login Form Title-->
                <h2 class="card-title">Utenti</h2>

                <!-- New User Form -->
                <div class="container mb-5 mt-5 ml-lg-0">
                    <div class="row justify-content-md-center">
                        <div class="col-md-11 section-form px-4 pb-4">

                            <h4 class="underlined-title">Nuovo Utente</h4>

                            <form method="POST" action="<?php echo URL; ?>users/saveUser">
                                <!-- 1th row -->
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label for="username-input" class="mb-n1 h6">
                                                Username
                                            </label>
                                            <input id="username-input" name="username" type="text" maxlength="50"
                                                   class="form-control mt-1 <?= $_SESSION['usernameCSSValidityClass'] ?>"
                                                   value="<?= $_SESSION['username'] ?>">
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
                                            <input id="email-input" name="email" type="email" maxlength="100"
                                                   class="form-control mt-1 <?= $_SESSION['emailCSSValidityClass'] ?>"
                                                   value="<?= $_SESSION['email'] ?>">
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
                                            <input id="password-input" name="password" type="password" class="form-control mt-1
												<?= $_SESSION['passwordCSSValidityClass'] ?>" value="<?= $_SESSION['password'] ?>">
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
                                            <input id="confirmedPassword-input" name="confirmedPassword" type="password" class="form-control mt-1
												<?= $_SESSION['confirmedPasswordCSSValidityClass'] ?>" value="<?= $_SESSION['confirmedPassword'] ?>">
                                            <div class="invalid-feedback very-small">
                                                Inserire la stessa password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Submit -->
                                <button class="btn btn-primary btn-wide" type="submit" name="saveUser">Aggiungi</button>
                            </form>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 underlined-title">Lista Utenti</h3>

                <!-- List of users -->
                <button id="btn-save-all" class="btn btn-primary btn-wide mr-1" type="button" name="saveUsers"><i class="far fa-save fa-lg mr-2"></i>Salva Tutto</button>
                <button id="btn-modify-all" class="btn btn-primary btn-wide" type="button" name="saveUsers"><i class="far fa-edit fa-lg mr-2"></i>Modifica Tutto</button>
                <div class="table-responsive">
                    <table class="table table-striped mt-md-3 mt-1 ty-align col-12">
                        <thead class="thead-midnight-blue">
                        <tr>
                            <th class="d-none">Id</th>
                            <th scope="col">Nome Utente</th>
                            <th scope="col">Email</th>
                            <th class="text-center pl-4" scope="col">Abilitato</th>
                            <th class="text-right" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody id="usersTableBody">
                        <?php if ($data['users']->count() > 0) : ?>
                            <?php foreach ($data['users'] as $user) :
                                $id = $user->getId();
                            ?>
                                <tr id="<?= "tr-user-" . $id ?>">
                                    <td class="d-none">
                                        <input id="id-user-<?= $id ?>" class="input-table" value="<?= $id ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="username-user-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $user->getUsername() ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="email-user-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $user->getEmail() ?>" disabled>
                                    </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <label class="checkbox p-0" for="enabled-user-<?= $id ?>">
                                                <input id="enabled-user-<?= $id ?>" type="checkbox" name="usersIdToEnable[]" data-toggle="checkbox" value="<?= $id ?>" <?= $user->getEnabled() ? 'checked' : '' ?>>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-right pl-0">
                                        <div class="btn-group">
                                            <button class="btn-icon icon-save mr-2" type="button" value="<?= $id ?>">
                                                <i class="far fa-save fa-lg btn-icon-src"></i>
                                            </button>
                                            <button class="btn-icon icon-modify mr-2" type="button" value="<?= $id ?>">
                                                <i class=" far fa-edit fa-lg btn-icon-src"></i>
                                            </button>
                                            <button class="btn-icon icon-delete" type="button" value="<?= $id ?>">
                                                <i class="far fa-trash-alt fa-lg btn-icon-src"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <td colspan="5">
                                <p class="h6">Non ci sono utenti memorizzati!</p>
                            </td>
                        <?php endif; ?>
                        <td colspan="5" id="no-data d-none" style="display: none;">
                            <p class="h6">Non ci sono utenti memorizzati!</p>
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>