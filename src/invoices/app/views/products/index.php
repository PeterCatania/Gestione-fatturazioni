<!-- Products Card -->
<div class"container">
<div class="row d-flex justify-content-center mt-sm-6 ">
    <div class="col-md-11 col-xl-10">
        <div class="card card-primary border-0">
            <div class="card-body px-4">

                <!-- Modal -->
                <div class="modal fade" id="save-modal-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Aggiungi un nuovo prodotto</h5>
                                <button id="b-cancel-save-product-icon"  class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                                <div class="modal-body">
                                    <form method="POST" action="<?php echo URL; ?>products/saveProduct">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group mb-3">
                                                    <label for="description-input" class="mb-n1 h6">
                                                        Descrizione
                                                    </label>
                                                    <input id="description-input" name="description" type="text" class="form-control mt-1
                                                    <?= $data['descriptionCSSValidityClass'] ?>" value="<?= $data['description'] ?>">
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
                                                        <?= $data['priceCSSValidityClass'] ?>" value="<?= $data['price'] ?>">
                                                    <div class="invalid-feedback very-small">
                                                        Inserire un prezzo che non sia 0
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Submit -->
                                        <div class="modal-footer">
                                            <button id="b-cancel-save-product" class="btn btn-secondary" type="submit" name="cancelSaveProduct">Annulla</button>
                                            <button class="btn btn-primary" type="submit" name="saveProduct">Salva</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 underlined-title">Lista Prodotti</h3>

                <div class="row">
                    <!-- Button trigger modal -->
                    <button id="b-save-modal-product" type="button" class="btn btn-primary btn-wide mr-2 ml-3" data-toggle="modal" data-target="#save-modal-product">
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
                <!-- List of products -->
                <div class="table-responsive">
                    <table class="table table-striped mt-md-4 mt-2" class="col-12">
                        <thead class="thead-dark">
                        <tr>
                            <th class="mr-auto" scope="col"></th>
                            <th class="d-none">Id</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Prezzo</th>
                        </tr>
                        </thead>
                        <tbody id="usersTableBody">
                        <?php if ($data['products']->count() > 0) : ?>
                            <?php foreach ($data['products'] as $product) :
                                $id = $product->getId();
                                ?>
                                <tr id="<?= "tr-product-" . $id ?>">
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
                                        <input id="id-product-<?= $id ?>" class="input-table" value="<?= $id ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="description-product-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $product->getDescription() ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="price-product-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $product->getPrice() ?>" disabled>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <td colspan="5">
                                <p class="h6">Non ci sono prodotti memorizzati!</p>
                            </td>
                        <?php endif; ?>
                        <td colspan="5" id="no-data" style="display: none;">
                            <p class="h6">Non ci sono prodotti memorizzati!</p>
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
