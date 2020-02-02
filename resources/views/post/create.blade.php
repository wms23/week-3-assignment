@extends('layouts.app')

@section('content')
    <div>
        <form action="{{route('post.store')}}" method="POST">
            @csrf
            <text-input name="title" placeholder="Enter Title">Title</text-input>
            <!-- <div class="form-group">
                <label for="title"></label>
                <input type="text" class="form-control" id="title" value="" name="title" placeholder="Enter title">
            </div> -->
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="6"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Published Post</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="is_published" id="is_published_yes" value="1">
                    <label class="form-check-label" for="is_published_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_published" id="is_published_no" value="0">
                    <label class="form-check-label" for="is_published_no">No</label>
                </div>
            </div>
            <button class='btn btn-primary'>Save</button>
            <a href="{{route('post.index')}}" class='btn'>Cancel</a>
        </form>
    </div>



    @endsection
