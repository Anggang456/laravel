@extends('layouts.header') 

@section('content')

                <div class="container-fluid  mt-5">
				 <div class="row">
					<div class="col-md-12">
						<div class="card-body cart">
								<div class="col-sm-12 empty-cart-cls text-center">
									<img src="https://res.cloudinary.com/dwe1tyctm/image/upload/v1674976225/3828537-removebg-preview_e8yhw6.png" width="200" height="200" class="img-fluid mb-4 mr-3">
									<h3><strong>To Much Quantity </strong></h3>
									<h4>Add something to make me happy :)</h4>
									<a href="{{ url('home') }}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
@endsection