@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование статья</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Статья "{{ $post->title }}"</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" role="form" method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Название</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ $post->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                                   placeholder="Название">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Цитата</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="6" placeholder="Цитата">{{ $post->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Контент</label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="6" placeholder="Контент">{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Категории</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                            @foreach($categories as $value => $title)
                                <option value="{{ $value }}" @if($value == $post->category_id) selected @endif>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tags">Теги</label>
                        <select name="tags[]" id="tags" class="select2" multiple="multiple" data-placeholder="Выбор тегов" style="width: 100%;">
                            @foreach($tags as $value => $title)
                                <option value="{{ $value }}" @if(in_array($value, $post->tags->pluck('id')->all())) selected @endif>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                <label class="custom-file-label" for="thumbnail">Выберете файл</label>
                            </div>
                        </div>
                    </div>
                    <div><img src="{{ $post->getImage() }}" alt="" class="img-thumbnail mt-2" width="200px"></div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </section>
    <!-- /.content -->

@endsection
