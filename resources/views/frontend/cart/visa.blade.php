@extends('frontend.app' , ['bussines'=> $bussines, 'users', $users])
 
@section('content')
 
<script src="{{ asset('js/dropzone.js') }}"></script>
<div id="titlebar" style="padding: 39px 0;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Facturación: Sigue los 3 pasos.</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="/">Principal</a></li>
						<li>Facturación</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<div class="container margin-bottom-45">

    <button id='btnVisa' type="button">Enviar</button>
</div>
 
	 
@endsection

@section('after-scripts')
 
    <script>
        $("#btnVisa").on('click', async function() {
          let { data: data } = await axios.post('visa-developer',{id: 1})
           
        })
    </script>
@endsection