@extends('layouts.app')

@section('content')
<h1>商品を登録する</h1>

@include('commons.errors') {{-- バリデーションエラー表示 --}}

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>カテゴリ</label>
        <select name="category_id" class="form-select">
            @foreach(App\Models\Category::all() as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>商品名</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label>メーカー</label>
        <input type="text" name="maker" class="form-control" value="{{ old('maker') }}">
    </div>

    <div class="mb-3">
        <label>価格</label>
        <input type="number" name="price" class="form-control" value="{{ old('price') }}">
    </div>

    <button type="submit" class="btn btn-primary">登録する</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">キャンセル</a>
</form>
@endsection