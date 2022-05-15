{include file='layouts/header.tpl'}

{if $Auth::check()}
    <div class = "m-3 p-3">
        {foreach item=issue from=$issues}
            <div class="alert alert-primary">            
                <div>email: {$issue.email}</div>
                {if $issue.name}<div>Создана: {$issue.name}</div>{/if}
                <div>Статус задачи: {if $issue.status}закрыта{else}открыта{/if}</div>
                <div class = "lead text-left">
                    Задача: 
                    <a href = 'issue.display?id={$issue.id}'>
                        {$issue.title}
                    </a>
                </div>
                {if $issue.updated_by}
                    отредактировано
                    {$Auth::findById($issue['updated_by'])->email} <br>
                {/if}
                <button type="submit" class="btn btn-primary mt-4">
                    Редактировать
                </button>
            </div>
        {foreachelse}
            <div class="position-absolute top-50 start-50 translate-middle">
                Вас никто не озадачил.
            </div>
        {/foreach}
    </div>
{else}
    <div class = "m-3 p-3">
        {foreach item=issue from=$issues}
            <div class="alert alert-primary">            
                <div>email: {$issue.email}</div>
                {if $issue.name}<div>Создана: {$issue.name}</div>{/if}
                <div>Статус задачи: {if $issue.status}открыта{else}закрыта{/if}</div>
                <div class = "lead text-left">
                    <a href = 'issue.display?id={$issue.id}'>
                        Задача: {$issue.title}
                    </a>
                </div>
                {if $issue.updated_by}
                    отредактировано 
                    {$Auth::findById($issue['updated_by'])->email}
                {/if}
            </div>
        {foreachelse}
            <div class="position-absolute top-50 start-50 translate-middle">
                Нету открытых задач.
            </div>
        {/foreach}
    </div>
{/if}

{if $paginator}
    <div class = "text-center"> {$paginator} </div>
{/if}
<div>
    <button target="/fasfa" type="submit" class="btn btn-primary mt-4">
        Создать новую задачу
    </button>
</div>

{include file='layouts/footer.tpl'}
