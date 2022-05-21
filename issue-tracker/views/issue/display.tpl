{include file='layouts/header.tpl'}

<div class="row justify-content-center">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-header">Просмотр задачи</div>

            <div class="card-body">
                    <fieldset disabled>
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

                    <div class=" mb-3">
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
                        <input id="status" type="text" class="form-control" name="status"
                        value="{if $issue.status}закрыта{else}открыта{/if}">

                </fieldset>
                {if $issue.updated_by}
                    отредактировано: 
                    {$Auth::findById($issue['updated_by'])->email}
                {/if}
            </div>
        </div>
    </div>
</div>

{include file='layouts/footer.tpl'}
