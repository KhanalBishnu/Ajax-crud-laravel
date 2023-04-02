@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3"></div>

            <div class="col-lg-6">Test Edit</div>
            {{-- <div class="col-lg-3"> <a class="btn btn-primary" href="{{route('test')}}">Add Test</a></div> --}}
            <form action="{{route('testing')}}" method="post">
                @csrf
                <div class="clo-md-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control name">
                </div>
                <div class="clo-md-3">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control description">
                </div>
                <div class="clo-md-3">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control price">
                </div>
                <div>
                    <button type="submit">save</button>
                </div>
            </form>
    </div>

@endsection
