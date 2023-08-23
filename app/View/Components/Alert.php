<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * 警告タイプ
     *
     * @var string
     */
    public $type;

    /**
     * 警告メッセージセッション
     *
     * @var string
     */
    public $session;


    public function __construct($type,$session)
    {
        $this->type = $type;
        $this->session = $session;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
