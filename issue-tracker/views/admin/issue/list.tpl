{include file='layouts/header.tpl'}

 <div>
    <form method="get" class="mt-4">
        сортировать по: 
        <select name="sort">
             <option value="name">Имя пользователя</option>
             <option value="email">email</option>
             <option value="status">статус</option>
           </select>
           <input class="btn" type="submit" value="сортировать">
    {if $smarty.get.page}
        <input type="hidden"  name="page" value="{$smarty.get.page}">
        <a class="btn" href="?page={$smarty.get.page}" >сбросить фильтр</a>
    {else}
       <a class="btn" href="/" >сбросить фильтр</a>
    {/if}
    </form>
</div>

    <div class = "m-3 p-3 " >
        {foreach item=issue from=$issues}
        <a href = 'issue.display?id={$issue.id}' class="text-decoration-none text-reset">
                <div class="alert alert-{if $issue.status}success{else}primary{/if}">            
                    <div>Email: {$issue.email}</div>
                    {if $issue.name}<div>Создана: {$issue.name}</div>{/if}
                    <div>Статус задачи: {if $issue.status}закрыта{else}открыта{/if}</div>
                    <div class = "lead text-left">
                        Задача: {$issue.title}
                    </div>
                    {if $issue.updated_by}
                        отредактировано
                        {$Auth::findById($issue['updated_by'])->email} <br>
                    {/if}
                    
                        <button type="submit" class="btn btn-primary mt-4">
                    <a href = 'admin/issue.updateform?id={$issue.id}' class="text-decoration-none text-reset"> Редактировать</a>
                        </button>
                </div>
            {foreachelse}
                <div class="position-absolute top-50 start-50 translate-middle">
                    Вас никто не озадачил.
                </div>
            {/foreach}
        </a>
    </div>

{if $paginator}
    <div class = "text-center"> {$paginator} </div>
{/if}

{include file='layouts/footer.tpl'}
