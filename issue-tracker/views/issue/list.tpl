{include file='layouts/header.tpl'}

{if !empty($issue)}
    {include file='components/sorterform.tpl'}
{/if}

    <div class = "m-3 p-3">
        {foreach item=issue from=$issues}
            <a href = 'issue.display?id={$issue.id}' class="text-decoration-none text-reset">
                <div class="alert alert-{if $issue.status}success{else}primary{/if}">            
                    <strong>email:</strong>
                    <div class="px-3">{$issue.email}</div>
                    
                    <strong>Создана:</strong>
                    <div class="px-3">{$issue.name}</div>
                    
                    <strong>Статус задачи:</strong>
                    <div class="px-3">{if $issue.status}закрыта{else}открыта{/if}</div>

                    <strong>Задача:</strong>
                    <div class="px-3">{$issue.title}</div>

                    {if $issue.updated_by}
                        отредактировано
                        <strong>{$Auth::findById($issue['updated_by'])->email}</strong>
                    {/if}
                </div>
            </a>
        {foreachelse}
            <div class="position-absolute top-50 start-50 translate-middle">
                Нету открытых задач.
            </div>
        {/foreach}
    </div>

{if $paginator}
    <div class = "text-center"> {$paginator} </div>
{/if}

{include file='layouts/footer.tpl'}
