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
                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                    <li class="nav-item"><a class="nav-link" href="#values" data-toggle="tab">Attribute Values</a></li>
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
                                <label class="control-label" for="value">Value</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Enter attribute value"
                                    id="value"
                                    name="value"
                                />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="price">Price</label>
                                <input
                                    class="form-control"
                                    type="number"
                                    placeholder="Enter attribute value price"
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
                                    <button class="btn btn-success" type="submit" >
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                    </button>
                                    <button class="btn btn-primary" type="submit" >
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div id="">
                        <div class="tile">
                            <h3 class="tile-title">Option Values</h3>
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Value</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="value in values">
                                            <td style="width: 25%" class="text-center">Place holder</td>
                                            <td style="width: 25%" class="text-center">Place holder</td>
                                            <td style="width: 25%" class="text-center">Place holder</td>
                                            <td style="width: 25%" class="text-center">
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>
            </div>
        </div>      
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/js/app.js') }}"></script>
@endpush