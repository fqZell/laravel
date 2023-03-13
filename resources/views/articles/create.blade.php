@extends('layout.layout')

@section('page_title', 'Create Article Page')

@section('content')
    <section id="main">
        <div class="container">

            @if($errors->any())

                @foreach($errors->all() as $error)

                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>

                @endforeach

            @endif

            <form action="{{ route('article.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="title">Short Text:</label>
                    <input type="text" name="short_text" id="title">
                </div>

                <div class="form-group">
                    <label for="title">Content:</label>
                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="title">Photo:</label>
                    <input type="file" name="photo" id="photo">
                </div>

                <br/>

                <button class="button">Create Article</button>
            </form>
        </div>
    </section>
@endsection
