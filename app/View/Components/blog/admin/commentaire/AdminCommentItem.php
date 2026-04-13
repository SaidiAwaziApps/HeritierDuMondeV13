<?php

namespace App\View\Components\blog\admin\commentaire;

use Illuminate\View\Component;

class AdminCommentItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog.admin.commentaire.admin-comment-item');
    }
}
