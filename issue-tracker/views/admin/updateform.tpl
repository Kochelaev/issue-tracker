{include file='layouts/header.tpl'}

<div class="row justify-content-center">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-header">Редактировать задачу</div>
            <div class="card-body">
                <form method="POST" action="http://{$smarty.server.HTTP_HOST}/admin/issue.update?id={$issue.id}">
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email:</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" 
                            name="email" required autocomplete="email"
                            value="{$issue.email}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Создано:</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required
                            value="{$issue.name}">
                        </div>
                    </div>

                        <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">Задача:</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" required
                            value="{$issue.title}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">Описание:</label>
                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description"
                            value="{$issue.description}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-form-label text-md-end">Статус:</label>
                        <div class="col-md-6">
                            <select name="status" class="form-control">
                                <option value="0">открыта</option>
                                <option value="1">зактыра</option>
                            </select>
                        </div>
                    </div>

                    {* <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status" id="status" >

                                <label class="form-check-label" for="remember">
                                    Задача закрыта
                                </label>
                            </div>
                        </div>
                    </div> *}
               
                    {if $issue.updated_by}
                        отредактировано: 
                        {$Auth::findById($issue['updated_by'])->email}
                    {/if}

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Обновить
                            </button>
                        </div>
                    </div> 

                </form>    
            </div>
        </div>
    </div>
</div>

{include file='layouts/footer.tpl'}
