<li class="menu-item">
    <a href="{{$link}}" class="menu-item-link @if($link == Request::url()) active @endif ">
        <span>
            <i class="{{$icon}}"></i>
            {{$name}}
        </span>
        <span class="badge badge-pill bg-white shadow-sm text-primary">{{$noti}}</span>
    </a>
</li>