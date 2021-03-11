<div class="cover-item"
        style="background-image:url( 'http://urdapilleta.com.ar/urdapilleta-web/public/uploads/developments/{{$development->img_mobile}}');"
    >
    <a href="{{ $development->link }}">
        <div class="cover-content cover-content-bottom">
            <h2 class="color-white left-text uppercase ultrabold top-30">{{$development->title}}</h2>
            <ul class="emprendimientos-list">
                <li><strong> <i class="far fa-dot-circle"></i> {{$development->location}}</strong></li>
                <li><strong><i class="fas fa-home"></i> {{$development->date}}</strong></li>
                <li><strong><i class="fas fa-tag"></i> EN {{$development->status}}</strong></li>
            </ul>
            <a href="{{ $development->link }}"
               class="close-menu button search-emprendimientos uppercase ultrabold">Ver
                proyecto</a>
        </div>
    </a>
    <div class="cover-overlay overlay overlay-gradient-small"></div>
</div>
