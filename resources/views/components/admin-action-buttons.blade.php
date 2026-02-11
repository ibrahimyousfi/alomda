@props([
    'editRoute' => null,
    'deleteRoute' => null,
    'viewRoute' => null,
    'deleteMessage' => 'Are you sure you want to delete?'
])

<div class="flex items-center gap-2">
    @if($viewRoute)
        <x-admin-action-button 
            type="link"
            :href="$viewRoute"
            icon="view"
        />
    @endif
    
    @if($editRoute)
        <x-admin-action-button 
            type="link"
            :href="$editRoute"
            icon="edit"
        />
    @endif
    
    @if($deleteRoute)
        <x-admin-action-button 
            type="submit"
            :action="$deleteRoute"
            method="DELETE"
            icon="delete"
            color="red"
            :confirm="$deleteMessage"
        />
    @endif
</div>
