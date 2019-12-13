<!-- Products Card -->
<div class"container">
<div class="row d-flex justify-content-center mt-sm-6 ">
    <div class="col-md-11 col-xl-10">
        <div class="card card-primary border-0">
            <div class="card-body px-4">
                <!-- Login Form Title-->
                <h2 class="card-title">Prodotti</h2>

                <!-- New Product Form -->
                <div class="container mb-5 mt-5 ml-lg-0">
                    <div class="row justify-content-md-center">
                        <div class="col-md-11 section-form px-4 pb-4">

                            <h4 class="underlined-title">Nuovo prodotto</h4>

                            <form method="POST" action="<?php echo URL; ?>products/saveProduct">
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
                                <button class="btn btn-primary btn-wide" type="submit" name="saveProduct">Salva</button>
                            </form>
                        </div>
                    </div>
                </div>

                <h3 class="mb-3 underlined-title">Lista Prodotti</h3>


                <!-- List of products -->

                <button id="btn-save-all" class="btn btn-primary btn-wide mr-1" type="button" name="saveUsers"><i class="far fa-save fa-lg mr-2"></i>Salva Tutto</button>
                <button id="btn-modify-all" class="btn btn-primary btn-wide" type="button" name="saveUsers"><i class="far fa-edit fa-lg mr-2"></i>Modifica Tutto</button>
                <div class="table-responsive">
                    <table class="table table-striped mt-md-4 mt-2" class="col-12">
                        <thead class="thead-dark">
                        <tr>
                            <th class="d-none">Id</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col">Prezzo</th>
                            <th class="text-right" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody id="usersTableBody">
                        <?php if ($data['products']->count() > 0) : ?>
                            <?php foreach ($data['products'] as $product) :
                                $id = $product->getId();
                            ?>
                                <tr id="<?= "tr-product-" . $id ?>">
                                    <td class="d-none">
                                        <input id="id-product-<?= $id ?>" class="input-table" value="<?= $id ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="description-product-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $product->getDescription() ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="price-product-<?= $id ?>" class="input-table form-control input-sm" type="text" value="<?= $product->getPrice() ?>" disabled>
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
