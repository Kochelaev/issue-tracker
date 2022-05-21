{include file='layouts/header.tpl'}

<div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    <form method="POST" action="http://{$smarty.server.HTTP_HOST}/auth.login">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Логин</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control " name="email" value="" required="" autocomplete="email" autofocus="">

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password" required="" autocomplete="current-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Вход
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {include file='layouts/footer.tpl'}
