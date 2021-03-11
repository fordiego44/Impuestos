@if (session('status'))
    <div class="notification success closeable margin-bottom-30">
        <p>Se ha <strong>guardado</strong> correctamente.</p>
        <a class="close"></a>
    </div>
@endif

@if (session('error'))
    <div class="notification error closeable margin-bottom-30">
        <p>Un <strong>error</strong> ha ocurrido</p>
        <a class="close"></a>
    </div>
@endif

@if (session('delete'))
    <div class="notification warning closeable margin-bottom-30">
        <p>El mensaje ha sido <strong>borrado</strong></p>
        <a class="close"></a>
    </div>
@endif