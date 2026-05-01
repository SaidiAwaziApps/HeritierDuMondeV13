<div class="comment-item" style="display: {{ $index < 4 ? 'block' : 'none' }}">
    <div class="comment-item-header">
        <a href="{{ Storage::url($commentaire->auteur->morphModel()->photo) }}">
            <img src="{{ Storage::url($commentaire->auteur->morphModel()->photo) }}" alt="" class="rounded-circle"> 
            <span>{{ $commentaire->auteur->morphModel()->nom }} {{ $commentaire->auteur->morphModel()->prenom }}</span>   
        </a>
        <form method="POST" action="{{ route('commentaire.delete_one',['id'=>$commentaire->id]) }}" style="float: right;">
            @csrf
            @method('DELETE')
            <button onclick="if(!confirm('Voulez vous supprimer ?')){ event.preventDefault(); }"  type="submit" title="Cliquer pour supprimer" class="btn btn-default btn-sm" style="opacity: 0.7;">
                <span><i class="fa fa-x" style="color: red;"></i></span>
            </button>
        </form>             
    </div>

    <div class="comment-item-content">
        <div class="comment-data-content">
            <div class="text-content"><p>{{ $commentaire->texte }}</p></div>
            @if($commentaire->images)
                <div class="imgs-content">
                    @foreach($commentaire->images as $image)
                        <x-blog.admin.image.comment-image :image="$image" />
                    @endforeach                      
                </div>
            @endif
        </div>

        <div class="reply" id="reply">
            <div class="reply-header">
                <a href="#" onclick="openReplyModal(event,{{ $commentaire->id }})" title="Cliquer pour repondre">
                    <span>Repondre<i>({{ $commentaire->objections->count() }})</i></span>
                </a>
                <form method="post" action="{{ route('commentaire.delete_one',['id'=>$commentaire->id]) }}">
                    @csrf
                    @method('DELETE')
                    <label onclick="if(!confirm('Voulez-vous vraiment supprimer?')){ event.preventDefault() }" for="delete_comment_{{$commentaire->id}}" title="Cliquer pour supprimer">
                        Supprimer
                    </label>
                    <input type="submit" id="delete_comment_{{ $commentaire->id }}" style="display: none;">
                </form>
            </div>
            <div class="reply-content">
                <div class="existed-items">
                    @php $index_2 = 0; @endphp
                    @foreach($commentaire->objections as $index_2 => $objection)
                        @php $index_2++; @endphp
                        <div style="display: {{ $index_2 < 2 ? 'block' : 'none' }}">
                            <x-blog.admin.objection.reply-item :objection="$objection" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="reply-footer" style="display: {{ $index_2 > 2 ? 'block' : 'none' }}">
                <a href="#" title="Cliquer pour toutes les notifications" class="all-reply-link" id="for_comment_{{ $commentaire->id }}">
                    <span>Toutes les reponses <i class="fa fa-angle-down"></i></span>
                </a>
            </div>
        </div>
    </div>                                 
</div>



