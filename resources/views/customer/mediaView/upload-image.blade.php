@extends('layouts.customerapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            @include('customer.shareview.media-options')
            <div class="card">
                <div class="card-header">MEDIA TYPE: IMAGE</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="post" action="{{ route('customer.storeimage' )}}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleFormControlFile1">Example file input</label>
                          <input type="file" class="form-control-file" id="mdimg" name="mdimg">
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="imgwidth">Image Width</label>
                            <input type="text" class="form-control" name="imgwidth" id="imgwidth" value="800"/>
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter media title">
                        <small id="titlehelp" class="form-text text-muted">Title will be shown under each image.</small>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row"> 
            <?php foreach($images as $image): ?>
            <div class="col-md-3 col-xs-6 col-sm-6" style="margin-top: 20px;">
                <img src="{{ asset('media-image')."/".$image->imgfile }}" style="max-width: 100%;"/>
                <p class="text-justify"><strong><a href="{{ route('customer.image-random-view',['width' => 500,'img' => $image->imgfile]) }} ">{{ $image->title }}</a></strong></p>
            </div>
            
            <?php endforeach; ?>
    </div>
</div>
@endsection
