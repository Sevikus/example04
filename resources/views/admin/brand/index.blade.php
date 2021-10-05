<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="container">
          <div class="row">  
          	
          	<div class="col-md-8">
          	  <div class="card">
          	  	
          	  	@if(session('success'))
          	  	<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>{{ session('success') }}</strong> 
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
                @endif  
          	  	
          	  	<div class="card-header">All Brand
          	  	</div>

	            <table class="table">
	              <thead>
	                <tr>
	                  <th scope="col">SL No</th>
	                  <th scope="col">Brand Name</th>
	                  <th scope="col">Brand Imager</th>
	                  <th scope="col">Created At</th>
	                  <th scope="col">Action</th>

	                </tr>
	              </thead>

	              <tbody>
	              	@foreach($brands as $brand)
	                <tr>
    	              <td>{{ $brands->firstItem()+$loop->index }}</td>	
	                  <td>{{ $brand->brand_name }}</td>
	                  <td><img src="{{ asset($brand->brand_image) }}" style="height: 40px; width: 70px;" alt="Picture"></td>
	                  <td>
	                  	@if($brand->created_at)
	                  	{{  Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
	                  @else
	                  <span class="text-danger">No Date Set</span>
                      </td>  
	                  @endif
	                  <td><a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</td>
	                  <td><a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are You Sure to Delete')" class="btn btn-danger">Delete</td>
	                </tr>
	                @endforeach
	              </tbody>     
	            </table>
	            {{ $brands->links() }}

              </div>  
            </div>
            <div class="col-md-4">
          	  <div class="card">
          	  	<div class="card-header">Add Brand</div>
          	  	<div class="card-body">

          	  	<form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
          	  	@csrf	
				  <div class="form-group">
				    <label for="">Brand Name</label>
				    <input type="text" name="brand_name" class="form-control" id="" aria-describedby="" placeholder="brand">

                    @error('brand_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror

				  </div>

				  <div class="form-group">
				    <label for="">Brand Image</label>
				    <input type="file" name="brand_image" class="form-control" id="" aria-describedby="">

                    @error('brand_image')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror

				  </div>

				  <button type="submit" class="btn btn-primary">Add Brand</button>
				</form>

			    </div>

          	  </div>
            </div>

          </div>
        </div> 

      </div>   
</x-app-layout>
