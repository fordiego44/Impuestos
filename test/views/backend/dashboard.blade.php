@extends('backend.layouts.app')
<!-- Content
	================================================== -->
@section('content')
<!-- Dashboard -->

	<!-- Content
	================================================== -->

		<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
					<h2>Hola! Como estas?</h2>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="{{ route('blog.index') }}">Blogs Creados</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<div class="row">
			
			<!-- Recent Activity -->
			<div class="col-lg-12 col-md-12">
				<div class="dashboard-list-box with-icons margin-top-20">
					<h4>Blogs Creados</h4>
					<ul>
						@foreach ($covers as $key => $cover)
							<li>
								<i class="list-box-icon sl sl-icon-layers"></i> {{$cover->title}} <strong><br/><a href="#">{{$cover->title}}</a></strong> 
								
								<div class="buttons-to-right">
									<a href="{{ url('/admin/cover/' . $cover->id . '/edit') }}" class="button gray">Editar</a>
								</div>
							</li>
						@endforeach
						
					</ul>
				</div>
			</div>
		</div>
	<!-- Content / End -->

<!-- Dashboard / End -->
@endsection



@section('after-scripts')
	<script type="text/javascript">
			let newsForm = function(){
				let data = {
					title: $("#title").val(),
					category: $("#category").val(),
					photo: $("#photo").val(),
					summary: $("#summary").val(),
				};
				return data;	
			}
		$(function(){
			$('.delete').click(function(e){
				e.preventDefault();
            	e.stopPropagation();
				let self = $(this).attr("value");
				console.log('self',self);
				$.ajax({

					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					url: '/admin/news/delete/' + self,
					type: 'POST',
					success: function (res){
						//toastr.succes('News borrada')
						window.location.href = '/admin/dashboard';
						console.log(res)
					},
					error: function (err){
						console.log(err)
					}
				})
			})
			
		})

	</script>

@endsection