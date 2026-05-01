@props(['objection'])

<div class="reply-item" id="for_comment_{{$objection->objectable->id}}" style="display: block;">
    <div class="reply-item-header">
        <a href="{{ Storage::url($objection->auteur->morphModel()->photo) }}">
            <img src="{{ Storage::url($objection->auteur->morphModel()->photo) }}" alt="Profil {{ $objection->auteur->morphModel()->nom.' '.$objection->auteur->morphModel()->prenom }}" class="rounded-circle"> 
            <span>
                {{ $objection->auteur->morphModel()->nom.' '.$objection->auteur->morphModel()->prenom }}
            </span>
        </a>
        <form method="POST" action="{{ route('objection.delete_one',['id'=>$objection->id]) }}">
            @csrf
            @method('DELETE')
            <button onclick="if(!confirm('Voulez-vous vraiment supprimer ?')){ event.preventDefault() }" type="submit" class="btn btn-default btn-sm">
                <span><i class="fa fa-x"></i></span>
            </button>
        </form>
    </div> 
    <div class="reply-item-content">
        <div class="text-content">
            <p>{{ $objection->texte }}</p>
        </div>
        @if($objection->images)
            <div class="imgs-content">
                @foreach($objection->images as $image)
                    <x-blog.admin.image.reply-image :image="$image" />
                @endforeach 
            </div>
        @endif  
    </div>   
</div>
