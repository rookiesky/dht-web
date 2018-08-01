@foreach($banner as $val)
    <div class="right-img">
        <a href="{{ $val->link }}" target="_blank">
            <img src="/{{ $val->img }}" alt="">
        </a>
    </div>
@endforeach