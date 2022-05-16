{include file='layouts/header.tpl'}

 <div>
    {* <form action="page/new.html"> *}
        <button  class="btn btn-primary mt-4">
            Создать новую задачу
        </button>
    {* </form> *}
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
    </form>
</div>



 {* Возможно стоило бы разбить на две разные вьюхи *}
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


{include file='layouts/footer.tpl'}
