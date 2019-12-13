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
            <?php foreach ($data['users'] as $user) : ?>

                <tr id="<?= "tr-user-" . $user->getId() ?>">
                    <td class="d-none">
                        <input id="id-user-<?= $user->getId() ?>" class="input-table" value="<?= $user->getId() ?>" disabled>
                    </td>
                    <td>
                        <input id="username-user-<?= $user->getId() ?>" class="input-table form-control input-sm" type="text" value="<?= $user->getUsername() ?>" disabled>
                    </td>
                    <td>
                        <input id="email-user-<?= $user->getId() ?>" class="input-table form-control input-sm" type="text" value="<?= $user->getEmail() ?>" disabled>
                    </td>
                    <td>
                        <div class="row justify-content-center">
                            <label class="checkbox p-0" for="enabled-user-<?= $user->getId() ?>">
                                <input id="enabled-user-<?= $user->getId() ?>" type="checkbox" name="usersIdToEnable[]" data-toggle="checkbox" value="<?= $user->getId() ?>" <?= $user->getEnabled() ? 'checked' : '' ?>>
                            </label>
                        </div>
                    </td>
                    <td class="text-right pl-0">
                        <div class="btn-group">
                            <button class="btn-icon icon-save mr-2" type="button" value="<?= $user->getId() ?>">
                                <i class="far fa-save fa-lg btn-icon-src"></i>
                            </button>
                            <button class="btn-icon icon-modify mr-2" type="button" value="<?= $user->getId() ?>">
                                <i class=" far fa-edit fa-lg btn-icon-src"></i>
                            </button>
                            <button class="btn-icon icon-delete" type="button" value="<?= $user->getId() ?>">
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
        <td colspan="5" id="no-data" style="display: none;">
            <p class="h6">Non ci sono utenti memorizzati!</p>
        </td>
        </tbody>
    </table>
</div>