<?php include_once 'layout/header.php' ?>

    <section class="row">
        <header class="col-12 text-center">
            <h1 class="display-4">Count Top 5 Colors</h1>
        </header>

        <section class="row justify-content-center">
            <div class="col col-6 mt-5">
                <form action="/upload" method="post" enctype="multipart/form-data">
                    <input class="form-control form-control-lg" type="file" name="file"
                           accept="image/jpg, image/jpeg, image/png">
                    <div class="d-grid gap-2 mt-2">
                        <button class="btn btn-primary" type="submit">Send It!</button>
                    </div>
                </form>

                <?php if ($error): ?>
                    <div class="alert alert-danger mt-2" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data) && !isset($data['error'])): ?>
                    <section class="row mt-2">
                        <h6 class="display-6">Your Image Results:</h6>
                        <?php foreach ($data as $key => $val): ?>
                            <div class="col border p-2" style="background-color: rgb(<?= $key ?>);">
                                <div class="text-center" style="filter: invert(100%);">
                                    <div><?= $val ?>%</div>
                                    <div>RGB: <?= $key ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </section>
                <?php endif; ?>
            </div>
        </section>
    </section>

<?php include_once 'layout/footer.php' ?>