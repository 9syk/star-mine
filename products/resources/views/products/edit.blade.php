@extends('layouts.app')

@section('content')
<h1>商品を編集する</h1>

@include('commons.errors')

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>カテゴリ</label>
        <select name="category_id" class="form-select">
            @foreach(App\Models\Category::all() as $category)
                <option value="{{ $category->id }}"{{ $product->category_id == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>商品名</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
    </div>

    <div class="mb-3">
        <label>メーカー</label>
        <input type="text" name="maker" class="form-control" value="{{ old('maker', $product->maker) }}">
    </div>

    <div class="mb-3">
        <label>価格</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
    </div>

    <button type="submit" class="btn btn-success">更新する</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">キャンセル</a>
</form>
@endsection