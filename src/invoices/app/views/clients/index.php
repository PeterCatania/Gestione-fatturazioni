
<!-- Invoices Card -->
<div class"container">
<div class="row d-flex justify-content-center mt-sm-6">
    <div class="col-md-11 col-xl-10">
        <div class="card card-primary">
            <div class="card-body">

                <!-- Modal -->
                <div class="modal fade" id="save-modal-client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Aggiungi un nuovo prodotto</h5>
                                <button id="b-cancel-save-client-icon"  class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form method="POST" action="<?php echo URL; ?>clients/saveClient">

                                    <!-- 1° Row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <div class="custom-control custom-checkbox ml-4 mt-4">
                                                    <input id="cbCompany" type="checkbox" class="custom-control-input" name="cbCompanyName" value="checked" <?= $data['cbCompanyName'] ?>>
                                                    <label for="cbCompany" class="custom-control-label"><b style="margin-left:5px;">Cliente Aziendale</b></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-">
                                                <label for="companyName-input" class="mb-n1 h6">
                                                    Nome Azienda
                                                </label>
                                                <input id="companyName-input" name="companyName" type="text" class="form-control mt-1
                                                <?= $data['companyNameCSSValidityClass'] ?>" value="<?= $data['companyName'] ?>" <?= $data['cbCompanyName'] ? : 'disabled'?>>
                                                <div class="invalid-feedback very-small">
                                                    Inserire il nome dell'azienda, o disabilitare il campo se non necessario
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 2° Row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="clientName-input" class="mb-n1 h6">
                                                    Nome Cliente
                                                </label>
                                                <input id="clientName-input" name="clientName" type="text" class="form-control mt-1
                                            <?= $data['clientNameCSSValidityClass'] ?>" value="<?= $data['clientName'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire il nome del cliente
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="clientSurname-input" class="mb-n1 h6">
                                                    Cognome Cliente
                                                </label>
                                                <input id="clientSurname-input" name="clientSurname" type="text" class="form-control mt-1
                                                <?= $data['clientSurnameCSSValidityClass'] ?>" value="<?= $data['clientSurname'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire il cognome del cliente
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 3° Row -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label for="street-input" class="mb-n1 h6">
                                                    Via
                                                </label>
                                                <input id="street-input" name="street" type="text" class="form-control mt-1
                                            <?= $data['streetCSSValidityClass'] ?>" value="<?= $data['street'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire la via dell'indirizzo del cliente
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="houseNo-input" class="mb-n1 h6">
                                                    Numero Civico
                                                </label>
                                                <input id="houseNo-input" name="houseNo" type="text" class="form-control mt-1
                                                <?= $data['houseNoCSSValidityClass'] ?>" value="<?= $data['houseNo'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire il numero civico dell'indirizzo del cliente
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 4° Row -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label for="city-input" class="mb-n1 h6">
                                                    Città
                                                </label>
                                                <input id="city-input" name="city" type="text" class="form-control mt-1
                                                <?= $data['cityCSSValidityClass'] ?>" value="<?= $data['city'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire la citta dell'indirizzo del cliente
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="nap-input" class="mb-n1 h6">
                                                    NAP
                                                </label>
                                                <input id="nap-input" name="nap" type="text" class="form-control mt-1
                                            <?= $data['napCSSValidityClass'] ?>" value="<?= $data['nap'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire il nap dell'indirizzo del cliente
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 5° Row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="telephone-input" class="mb-n1 h6">
                                                    Telefono
                                                </label>
                                                <input id="telephone-input" name="telephone" type="tel" class="form-control mt-1
                                            <?= $data['telephoneCSSValidityClass'] ?>" value="<?= $data['telephone'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire il telefono del cliente
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="email-input" class="mb-n1 h6">
                                                    Email
                                                </label>
                                                <input id="email-input" name="email" type="email" class="form-control mt-1
                                                <?= $data['emailCSSValidityClass'] ?>" value="<?= $data['email'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire l'email del cliente
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Submit -->
                                    <div class="modal-footer">
                                        <button id="b-cancel-save-client" class="btn btn-secondary" type="submit" name="cancelSaveClient">Annulla</button>
                                        <button class="btn btn-primary" type="submit" name="saveClient">Salva</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 underlined-title">Lista Clienti</h3>

                <div class="row">
                    <!-- Button trigger modal -->
                    <button id="b-save-modal-client" type="button" class="btn btn-primary btn-wide mr-2 ml-3" data-toggle="modal" data-target="#save-modal-client">
                        <i class="far fa-save fa-lg mr-2"></i>
                        Aggiungi
                    </button>
                    <!-- Button save all -->
                    <button id="btn-save-all" class="btn btn-primary btn-wide mr-2" type="button">
                        <i class="far fa-save fa-lg mr-2"></i>
                        Salva Tutto
                    </button>
                    <!-- Button modify all -->
                    <button id="btn-modify-all" class="btn btn-primary btn-wide" type="button">
                        <i class="far fa-edit fa-lg mr-2"></i>
                        Modifica Tutto
                    </button>
                </div>
                <!-- List of clients -->
                <div class="table-responsive">
                    <table class="table table-striped mt-md-4 mt-2 col-12">
                        <thead class="thead-dark">
                        <tr>
                            <th class="mr-auto" scope="col"></th>
                            <th class="d-none">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody id="usersTableBody">
                        <?php if (!empty($data['clients'])) : ?>
                            <?php
                            foreach ($data['clients'] as $client) :
                                $id = $client['id'];
                                $clientName = $client['clientName'];
                                $clientSurname = $client['clientSurname'];
                                $companyName = $client['companyName'];
                                $street =  $client['street'];
                                $houseNo =  $client['houseNo'];
                                $nap = $client['nap'];
                                $city = $client['city'];
                                $telephone = $client['telephone'];
                                $email = $client['email'];
                            ?>
                                <tr id="<?= "tr-client-" . $id ?>">
                                    <td class="mr-auto pl-0">
                                        <div class="btn-group">
                                            <button class="btn-icon icon-save mr-2 ml-2" type="button" value="<?= $id ?>">
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
                                    <td class="d-none">
                                        <input id="id-client-<?= $id ?>" class="input-table" value="<?= $id ?>" disabled>
                                    </td>
                                    <td>
                                        <!-- Span -->
                                        <span id="clientName-client-<?= $id ?>-span" class="span-table"><?= $clientName ?> </span>
                                        <span id="clientSurname-client-<?= $id ?>-span" class="span-table"><?= $clientSurname ?> </span>
                                        <!-- Input -->
                                        <input id="clientName-client-<?= $id ?>" class="input-table form-control input-sm d-none" type="text" value="<?= $clientName ?>" disabled>
                                        <input id="clientSurname-client-<?= $id ?>" class="input-table form-control input-sm d-none" type="text" value="<?= $clientSurname ?>" disabled>

                                        <?php if(isset($client['companyName'])) : ?>
                                            <!-- Span -->
                                            <span class="span-table">responsabile di </span>
                                            <span id="companyName-client-<?= $id ?>-span" class="span-table"><?= $companyName ?></span>
                                            <!-- Input -->
                                            <input id="companyName-client-<?= $id ?>" class="input-table form-control input-sm d-none" type="text" value="<?= $companyName ?>" disabled>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Span -->
                                        <span id="street-client-<?= $id ?>-span" class="span-table"><?= $street ?> </span>
                                        <span id="houseNo-client-<?= $id ?>-span" class="span-table"><?= $houseNo ?> </span>
                                        <span id="nap-client-<?= $id ?>-span" class="span-table"><?= $nap ?> </span>
                                        <span id="city-client-<?= $id ?>-span" class="span-table"><?= $city ?></span>
                                        <!-- Input -->
                                        <input id="street-client-<?= $id ?>" class="input-table form-control input-sm float-left d-none" type="text" value="<?= $street ?>" disabled>
                                        <input id="houseNo-client-<?= $id ?>" class="input-table form-control input-sm float-left d-none" type="text"  value="<?= $houseNo ?>" disabled>
                                        <input id="nap-client-<?= $id ?>" class="input-table form-control input-sm float-left d-none" type="number" value="<?= $nap ?>" disabled>
                                        <input id="city-client-<?= $id ?>" class="input-table form-control input-sm float-left d-none" type="text" value="<?= $city ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="telephone-client-<?= $id ?>" class="input-table form-control input-sm" type="tel" value="<?= $telephone ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="email-client-<?= $id ?>" class="input-table form-control input-sm" type="email" value="<?= $email ?>" disabled>
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
            </div>
        </div>
    </div>
</div>