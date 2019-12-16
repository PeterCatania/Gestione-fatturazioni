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
                                <form method="POST" action="<?php echo URL; ?>invoices/saveInvoice">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group mb-3">
                                                <label for="description-input" class="mb-n1 h6">
                                                    Descrizione
                                                </label>
                                                <input id="description-input" name="description" type="text" class="form-control mt-1
                                                    <?= $_SESSION['descriptionCSSValidityClass'] ?>" value="<?= $_SESSION['description'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire una descrizione
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group mb-3">
                                                <label for="price-input" class="mb-n1 h6">
                                                    Prezzo
                                                </label>
                                                <input id="price-input" name="price" type="number" step="0.01" class="form-control mt-1
                                                        <?= $_SESSION['priceCSSValidityClass'] ?>" value="<?= $_SESSION['price'] ?>">
                                                <div class="invalid-feedback very-small">
                                                    Inserire un prezzo che non sia 0
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

