<!-- Invoices Card -->
<div class"container">
<div class="row d-flex justify-content-center mt-sm-6">
    <div class="col-md-11 col-xl-10">
        <div class="card card-primary">
            <div class="card-body">

                <!-- Modal -->
                <div class="modal fade" id="save-modal-invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Aggiungi una nuova fattura</h5>
                                <button id="b-cancel-save-invoice-icon"  class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-5 mb-4">
                                        <h3>Fattura</h3>
                                    </div>
                                </div>
                                <form method="POST" action="<?php echo URL; ?>invoices/saveInvoice" autocomplete="on">
                                    <!-- Company Information -->
                                    <!-- Company Id -->
                                    <input name="clientId" type="number" class="d-none" value="<?= $data['clientId'] ?>">
                                    <!-- Row 1-->
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <input id="companyName-input" name="companyName" type="text" placeholder="Nome azienda" class="form-control mt-1
                                                    <?= $data['companyNameCSSValidityClass'] ?>" value="<?= $data['companyName'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un nome valido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 ml-auto mx-3 text-center underlined-title">
                                            <span><?= date("d/m/Y") ?></span>
                                        </div>
                                    </div>
                                    <!-- Row 2-->
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group mb-3">
                                                <input id="companyStreet-input" name="companyStreet" type="text" placeholder="Via" class="form-control mt-1
                                                    <?= $data['companyStreetCSSValidityClass'] ?>" value="<?= $data['companyStreet'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire una via valida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group mb-3">
                                                <input id="companyHouseNo-input" name="companyHouseNo" type="text" placeholder="CAP" class="form-control mt-1
                                                    <?= $data['companyHouseNoCSSValidityClass'] ?>" value="<?= $data['companyHouseNo'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un CAP valido
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 ml-auto mx-3 text-center underlined-title">
                                            <span><?= $data['invoiceNextId'] ?></span>
                                        </div>
                                    </div>
                                    <!-- Row 3-->
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group mb-3">
                                                <input id="companyCity-input" name="companyCity" type="text" placeholder="Città" class="form-control mt-1
                                                    <?= $data['companyCityCSSValidityClass'] ?>" value="<?= $data['companyCity'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire una città valida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group mb-3">
                                                <input id="companyNap-input" name="companyNap" type="text" placeholder="NAP" class="form-control mt-1
                                                    <?= $data['companyNapCSSValidityClass'] ?>" value="<?= $data['companyNap'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire NAP valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 4-->
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <input id="companyTelephone-input" name="companyTelephone" type="text" placeholder="Telefono" class="form-control mt-1
                                                    <?= $data['companyTelephoneCSSValidityClass'] ?>" value="<?= $data['companyTelephone'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un numero di telefono valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 5-->
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <input id="companyEmail-input" name="companyEmail" type="text" placeholder="Email" class="form-control mt-1
                                                    <?= $data['companyEmailCSSValidityClass'] ?>" value="<?= $data['companyEmail'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire una email valida
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 6-->
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <input id="companySite-input" name="companySite" type="text" placeholder="Sito Web" class="form-control mt-1
                                                    <?= $data['companySiteCSSValidityClass'] ?>" value="<?= $data['companySite'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un sito web valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 7-->
                                    <div class="row mt-3">
                                        <!-- Typology Id -->
                                        <input name="typologyId" type="number" class="d-none" value="<?= $data['typologyId'] ?>">

                                        <div class="col-2">
                                            <label for="typologyName-input" class="mt-2 h6">
                                                Tipologia
                                            </label>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <input id="typologyName-input" name="typologyName" type="text" placeholder="Tipologia" class="form-control mt-1
                                                    <?= $data['typologyNameCSSValidityClass'] ?>" value="<?= $data['typologyName'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un sito web valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informazioni clienti -->
                                    <h5 class="mt-4 underlined-title">Cliente</h5>

                                    <!-- Client Id -->
                                    <input name="clientId" type="number" class="d-none" value="<?= $data['clientId'] ?>">
                                    <!-- Row 1-->
                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <div class="form-group mb-3">
                                                <input id="clientName-input" name="clientName" type="text" placeholder="Nome" class="form-control mt-1
                                                    <?= $data['clientNameCSSValidityClass'] ?>" value="<?= $data['clientName'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un nome valido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group mb-3">
                                                <input id="clientSurname-input" name="clientSurname" type="text" placeholder="Cognome" class="form-control mt-1
                                                    <?= $data['clientSurnameCSSValidityClass'] ?>" value="<?= $data['clientSurname'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un cognome valido
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group mb-3">
                                                <input id="clientCompanyName-input" name="clientCompanyName" type="text" placeholder="Nome Azienda" class="form-control mt-1
                                                    <?= $data['clientCompanyNameCSSValidityClass'] ?>" value="<?= $data['clientCompanyName'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un nome valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 2-->
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group mb-3">
                                                <input id="clientStreet-input" name="clientStreet" type="text" placeholder="Via" class="form-control mt-1
                                                    <?= $data['clientStreetCSSValidityClass'] ?>" value="<?= $data['clientStreet'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire una via valida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group mb-3">
                                                <input id="clientHouseNo-input" name="clientHouseNo" type="text" placeholder="CAP" class="form-control mt-1
                                                    <?= $data['clientHouseNoCSSValidityClass'] ?>" value="<?= $data['clientHouseNo'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un CAP valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 3-->
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group mb-3">
                                                <input id="clientCity-input" name="clientCity" type="text" placeholder="Città" class="form-control mt-1
                                                    <?= $data['clientCityCSSValidityClass'] ?>" value="<?= $data['clientCity'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire una città valida
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group mb-3">
                                                <input id="clientNap-input" name="clientNap" type="text" placeholder="NAP" class="form-control mt-1
                                                    <?= $data['clientNapCSSValidityClass'] ?>" value="<?= $data['clientNap'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire NAP valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 4-->
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <input "clientTelephone-input" name="clientTelephone" type="text" placeholder="Telefono" class="form-control mt-1
                                                    <?= $data['clientTelephoneCSSValidityClass'] ?>" value="<?= $data['clientTelephone'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un numero di telefono valido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 5-->
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group mb-3">
                                                <input id="clientEmail-input" name="clientEmail" type="text" placeholder="Email" class="form-control mt-1
                                                    <?= $data['clientEmailCSSValidityClass'] ?>" value="<?= $data['clientEmail'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire una email valida
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Products Information -->
                                    <h5 class="mt-4 underlined-title">Prodotti</h5>

                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <span>Descrizione</span>
                                        </div>
                                        <div class="col-2">
                                            <span>Data V.tà</span>
                                        </div>
                                        <div class="col-2">
                                            <span>Q.tà</span>
                                        </div>
                                        <div class="col-2">
                                            <span>Prezzo uni.</span>
                                        </div>
                                        <div class="col-2">
                                            <span>Importo</span>
                                        </div>
                                    </div>

                                    <?php foreach (array_keys($data['productsDescription']) as $key) : ?>
                                        <!-- product Id -->
                                        <input name="productsId[]" type="number" class="d-none" value="<?= $data['productsId'][$key] ?>">

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group mb-3">
                                                    <input name="productsDescription[]" type="text" placeholder="descrizione" class="form-control mt-1" value="<?= $data['productsDescription'][$key] ?>">
                                                    <div class="invalid-feedback very-small">
                                                        Inserire una descrizione valida
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group mb-3">
                                                    <input name="productsSellDate[]" type="text" placeholder="Data V.tà" class="form-control mt-1" value="<?= $data['productsSellDate'][$key] ?>">
                                                    <div class="invalid-feedback very-small">
                                                        Inserire una data valida
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group mb-3">
                                                    <input name="productsQuantity[]" type="text" placeholder="Q.tà" class="form-control mt-1" value="<?= $data['productsQuantity'][$key] ?>">
                                                    <div class="invalid-feedback very-small">
                                                        Inserire un numero intero
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group mb-3">
                                                    <input name="productsPrice[]" type="text" placeholder="Prezzo uni." class="form-control mt-1" value="<?= $data['productsPrice'][$key] ?>">
                                                    <div class="invalid-feedback very-small">
                                                        Inserire un prezzo valido
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 mt-2">
                                                <span id="invoice-product-import-<?= $data['productsId'][$key] ?>">100 </span>
                                                <span> CHF</span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Submit -->
                                    <div class="modal-footer">
                                        <button id="b-cancel-save-invoice" class="btn btn-secondary" type="submit" name="cancelSaveInvoice">Annulla</button>
                                        <button class="btn btn-primary" type="submit" name="saveInvoice">Salva</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 underlined-title">Lista Fatture</h3>

                <div class="row">
                    <!-- Button trigger modal -->
                    <button id="b-save-modal-invoice" type="button" class="btn btn-primary btn-wide mr-2 ml-3" data-toggle="modal" data-target="#save-modal-invoice">
                        <i class="far fa-save fa-lg mr-2"></i>
                        Aggiungi
                    </button>
                </div>
                <!-- List of invoices -->
                <div class="table-responsive">
                    <table class="table table-striped mt-md-4 mt-2" class="col-12">
                        <thead class="thead-dark">
                        <tr>
                            <th class="mr-auto" scope="col"></th>
                            <th class="d-none">Id</th>
                            <th scope="col">Tipologia</th>
                            <th scope="col">Creata il</th>
                            <th scope="col">Pagata il</th>
                            <th scope="col">No. Stampe</th>
                            <th scope="col">Importo</th>
                        </tr>
                        </thead>
                        <tbody id="usersTableBody">
                        <?php if ($data['invoices']->count() > 0) : ?>
                            <?php foreach ($data['invoices'] as $invoice) :
                                $id = $invoice->getId();
                                ?>
                                <tr id="<?= "tr-invoice-" . $id ?>">
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
                                        <input id="id-invoice-<?= $id ?>" class="input-table" value="<?= $id ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="typology-invoice-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $invoice->getTypology()->getName() ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="creationDate-invoice-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $invoice->getCreationDate() ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="paymentDate-invoice-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $invoice->getPaymentDate() ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="printNo-invoice-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $invoice->getPintNo() ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="amount-invoice-<?= $id ?>" class="input-table form-control input-sm" type="text" value="" disabled>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <td colspan="7">
                                <p class="h6">Non ci sono fatture memorizzate!</p>
                            </td>
                        <?php endif; ?>
                        <td colspan="7" id="no-data" style="display: none;">
                            <p class="h6">Non ci sono fatture memorizzate!</p>
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

