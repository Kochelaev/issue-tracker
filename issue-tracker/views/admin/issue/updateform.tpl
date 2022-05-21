{include file='layouts/header.tpl'}

<div class="row justify-content-center">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-header">Редактировать задачу</div>
            <div class="card-body">
                <form method="POST" action="http://{$smarty.server.HTTP_HOST}/admin/issue.update?id={$issue.id}">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input id="email" type="email" class="form-control" 
                        name="email" required autocomplete="email"
                        value="{$issue.email}">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Создана:</label>
                        <input id="name" type="text" class="form-control" name="name" required
                        value="{$issue.name}">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Задача:</label>
                        <input id="title" type="text" class="form-control" name="title" required
                        value="{$issue.title}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Описание:</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{$issue.description}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Статус:</label>
                        <select name="status" class="form-control">
                            <option value="0">открыта</option>
                            <option value="1">зактыра</option>
                        </select>
                    </div>
               
                    {if $issue.updated_by}
                        отредактировано: 
                        {$Auth::findById($issue['updated_by'])->email}
                    {/if}

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Обновить
                        </button>
                    </div> 

                </form>    
            </div>
        </div>
    </div>
</div>

{include file='layouts/footer.tpl'}
