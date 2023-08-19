@extends('admin.app')
@section('title') Attributes @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"></i> Attribute Information</h1>
        </div>
    </div>
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">Attribute Type</a></li>
                    <li class="nav-item"><a class="nav-link" href="#values" data-toggle="tab">Add a Product Attribute</a></li>
                    <li class="nav-item"><a class="nav-link" href="#edit_values" data-toggle="tab">Edit a Product Attribute</a></li>

                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="/admin/attributes/{{$attribute->id}}" method="POST" role="form">
                            @csrf
                            @method('PUT')
                            <h3 class="tile-title">Attribute Information</h3>
                            <hr>
                            <div class="tile-body">
                                
                                <input type="hidden" name="id" value="{{ $attribute->id }}">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        placeholder="Enter attribute name"
                                        id="type"
                                        name="type"
                                        value="{{ old('name', $attribute->type) }}"
                                    />
                                </div>
                            
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Attribute</button>
                                        <a class="btn btn-danger" href="{{ route('admin.attributes.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="values">
                    <div class="tile">
                        <h3 class="tile-title">Attribute Values</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                             <form action="/admin/product_attributes" method="POST" role="form">
                                @csrf
                                <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                                
                                <label class="control-label" for="name">Name</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Enter product attribute name"
                                    id="name"
                                    name="name"
                                />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="price">Price</label>
                                <input
                                    class="form-control"
                                    type="number"
                                    placeholder="Enter attribute price"
                                    id="price"
                                    name="price"
                                />
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                    </button>
                                    <button class="btn btn-primary" type="submit" >
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>



                </div>

                <div class="tab-pane" id="edit_values">
                    <div class="tile">
                        <h3 class="tile-title">Edit Attribute Values</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                             <form  id="editValuesForm" action="/admin/product_attributes" method="POST" role="form">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                                
                                <label class="control-label" for="name">Name</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Enter product attribute name"
                                    id="name"
                                    name="name"
                                />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="price">Price</label>
                                <input
                                    class="form-control"
                                    type="number"
                                    placeholder="Enter attribute price"
                                    id="price"
                                    name="price"
                                />
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                    </button>
                                    <button class="btn btn-primary" type="submit" >
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    

                    <div id="">
                        
                        @foreach($product_attributes as $product_attribute)
                        <div class="tile">
                            <h3 class="tile-title">Option Values</h3>
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr >
                                            <td style="width: 25%" class="text-center">{{$product_attribute->id}}</td>
                                            <td style="width: 25%" class="text-center">{{$product_attribute->name}}</td>
                                            <td style="width: 25%" class="text-center">{{$product_attribute->price}}</td>
                                            <td style="width: 25%" class="text-center">
                                                <button class="btn btn-sm btn-primary" onclick="editAttributeValue({{$product_attribute->id}}, '{{$product_attribute->name}}', {{$product_attribute->price}})">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.attributes.values.destroy', $product_attribute->id) }}" style="display: inline-block;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>


                </div>



            </div>
        </div>      
    </div>
@endsection


@push('scripts')
<script src="{{ asset('backend/js/app.js') }}"></script>
<script>
function editAttributeValue(id, name, price) {
    // Update the form action
    const form = document.querySelector('#editValuesForm');
    form.action = `/admin/product_attributes/${id}`;

    // Pre-fill the name and price fields
    const nameInput = form.querySelector('input[name="name"]');
    const priceInput = form.querySelector('input[name="price"]');
    nameInput.value = name;
    priceInput.value = price;

    // Switch to the "Edit Attribute Values" tab
    const editValuesTab = document.querySelector('#edit_values_tab');
    editValuesTab.click();
}
</script>
@endpush
