<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
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
          	  	
          	  	<div class="card-header">All Category
          	  	</div>

	            <table class="table">
	              <thead>
	                <tr>
	                  <th scope="col">SL No</th>
	                  <th scope="col">Category Name</th>
	                  <th scope="col">User</th>
	                  <th scope="col">Created At</th>
	                  <th scope="col">Action</th>

	                </tr>
	              </thead>

	              <tbody>
	              	@foreach($categories as $category)
	                <tr>
    	              <td>{{ $categories->firstItem()+$loop->index }}</td>	
	                  <td>{{ $category->category_name }}</td>
	                  <td>{{ $category->user->name }}</td>
	                  
	                <!--   Query builder way
	                  <td>{{ $category->name }}</td> -->

	                  <td>
	                  	@if($category->created_at)
	                  	{{  Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
	                  @else
	                  <span class="text-danger">No Date Set</span>
                      </td>  
	                  @endif
	                  <td><a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</td>
	                  <td><a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</td>
	                </tr>
	                @endforeach
	              </tbody>     
	            </table>
	            {{ $categories->links() }}

              </div>  
            </div>
            <div class="col-md-4">
          	  <div class="card">
          	  	<div class="card-header">Add Category</div>
          	  	<div class="card-body">

          	  	<form action="{{ route('store.category') }}" method="POST">
          	  	@csrf	
				  <div class="form-group">
				    <label for="">Category Name</label>
				    <input type="text" name="category_name" class="form-control" id="" aria-describedby="" placeholder="category">

                    @error('category_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror

				  </div>
				  <button type="submit" class="btn btn-primary">Add Category</button>
				</form>

			    </div>

          	  </div>
            </div>

          </div>
        </div> 

        <!-- Trash part -->

         <div class="container">
          <div class="row">  
          	
          	<div class="col-md-8">
          	  <div class="card">  
          	  	
          	  	<div class="card-header">Trash List
          	  	</div>

	            <table class="table">
	              <thead>
	                <tr>
	                  <th scope="col">SL No</th>
	                  <th scope="col">Category Name</th>
	                  <th scope="col">User</th>
	                  <th scope="col">Created At</th>
	                  <th scope="col">Action</th>

	                </tr>
	              </thead>

	              <tbody>
	              	@foreach($trashCat as $category)
	                <tr>
    	              <td>{{ $trashCat->firstItem()+$loop->index }}</td>	
	                  <td>{{ $category->category_name }}</td>
	                  <td>{{ $category->user->name }}</td>	     
	                  <td>
	                  @if($category->created_at)
	                  	{{  Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
	                  @else
	                  <span class="text-danger">No Date Set</span>
                      </td>  
	                  @endif
	                  <td><a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</td>
	                  <td><a href="{{ url('category/perdelete/'.$category->id) }}" class="btn btn-danger">Per.Delete</td>
	                </tr>
	                @endforeach
	              </tbody>     
	            </table>
	            {{ $trashCat->links() }}

              </div>  
            </div>
       

          </div>
        </div> 
      </div>   
</x-app-layout>
