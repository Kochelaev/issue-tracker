{include file='layouts/header.tpl'}

  <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">Добавить новую задачу</div>

                <div class="card-body">
                    <form method="POST" action="http://{$smarty.server.HTTP_HOST}/issue.post">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input id="email" type="email" class="form-control" 
                            name="email" required autocomplete="email">
                        </div>                       

                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя:</label>
                            <input id="name" type="text" class="form-control" name="name" required>
                        </div>

                         <div class="mb-3">
                            <label for="title" class="form-label">Задача:</label>
                            <input id="title" type="text" class="form-control" name="title" required>
                        </div>

                        <div class=" mb-3">
                            <label for="description" class="form-label">Описание:</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                Создать
                            </button>
                        </div>      

                    </form>
                </div>
            </div>
        </div>
    </div>

{include file='layouts/footer.tpl'}
