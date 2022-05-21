<div>
    <form method="get" class="mt-4">
        сортировать по: 
        <select name="sort">
             <option value="name" {if $smarty.get.sort=='name'}selected{/if}>Имя пользователя</option>
             <option value="email" {if $smarty.get.sort=='email'}selected{/if}>email</option>
             <option value="status" {if $smarty.get.sort=='status'}selected{/if}>статус</option>
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
