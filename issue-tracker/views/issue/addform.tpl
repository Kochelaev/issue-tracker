{include file='layouts/header.tpl'}

  <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Добавить новую задачу</div>

                <div class="card-body">
                    <form method="POST" action="http://{$smarty.server.HTTP_HOST}/issue.post">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email:</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" 
                                name="email" required autocomplete="email">
                            </div>
                        </div>                       

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Ваше имя:</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Задача:</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Описание:</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description">
                            </div>
                        </div>

                        <!-- <div class="md-form mb-4 pink-textarea active-pink-textarea">
                            <label for="description" class="col-md-4 col-form-label text-md-end pr-2 pl-2">Описание:</label>
                            <textarea rows="3"  id="description" type="text" class="form-control" name="description"> </textarea>
                        </div> -->

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Создать
                                </button>
                            </div>
                        </div>                      

                    </form>
                </div>
            </div>
        </div>
    </div>

{include file='layouts/footer.tpl'}