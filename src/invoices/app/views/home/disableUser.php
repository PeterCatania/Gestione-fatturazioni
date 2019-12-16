<div class="row d-flex justify-content-center mt-page">
    <div class="col-md-8 col-xl-6">
        <div class="card card-primary">
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Attenzione!</h4>
                    <p>L’accesso non può essere effettuato, perché questo utente non è ancora stato abilitato.<br>
                    <hr>
                    Per contattare l’amministratore si prega di inviare un email all’indirizzo: <strong><?= $data['administrator']->getEmail();  ?></strong></p>
                    <a class="close" aria-label="Close" href="<?= URL ?>home/logout">
                        <span>&times;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>