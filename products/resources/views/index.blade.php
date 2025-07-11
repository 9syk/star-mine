@extends("layouts.app")
@section("content")
<div class="row">
    <div class="col-md-4 col-lg-3  mb-4">
        <div class="mb-3 text-end">
    

</div>

        <form class="card mb-4" action="/" method="get">
            <div class="card-header">商品検索</div>
            <dl class="search-box card-body mb-0">
                <dt>カテゴリ</dt>
                <dd>
                    <select name="category_id" class="form-select">
                        <option value=""></option>
                        @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"{{ Request::get('category_id') == $category->id ? ' selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </dd>
                <dt>キーワード</dt>
                <dd>
                    <input type="text" name="keyword" class="form-control" placeholder="メーカー・商品名" value="{{ Request::get('keyword') }}">
                </dd>
                <dt>価格帯</dt>
                <dd>
                    <div class="input-group">
                        <input type="text" name="min_price" class="form-control" placeholder="円" value="{{ Request::get('min_price') }}">
                        <span class="input-group-text">〜</span>
                        <input type="text" name="max_price" class="form-control" placeholder="円" value="{{ Request::get('max_price') }}">
                    </div>
                </dd>
                <dt>ソート</dt>
                <dd>
                    <select name="sort" class="form-select">
                        <option value="">登録順</option>
                        <option value="price_asc"{{ Request::get('sort') == 'price_asc' ? ' selected' : ''}}>価格の安い順</option>
                        <option value="price_desc"{{ Request::get('sort') == 'price_desc' ? ' selected' : ''}}>価格の高い順</option>
                        <option value="id_asc"{{ Request::get('sort') == 'id_asc' ? ' selected' : ''}}>ID昇順</option>
                        <option value="id_desc"{{ Request::get('sort') == 'id_desc' ? ' selected' : ''}}>ID降順</option>
                        <option value="name_asc"{{ Request::get('sort') == 'name_asc' ? ' selected' : ''}}>商品名</option>
                        <option value="maker_asc"{{ Request::get('sort') == 'maker_asc' ? ' selected' : ''}}>メーカー名</option>
                    </select>
                </dd>                          
            </dl>
            <div class="card-footer">
                <button type="submit" class="btn w-100 btn-success">検索</button>
            </div>
        </form>
        <form onsubmit="return confirm('ログアウトしますか？')" action="{{ route('logout') }}" method="post">
            @csrf
            <a href="{{ route('products.create') }}" class="btn btn-primary">商品を登録する</a>
            <button type="submit" class="btn btn-sm btn-dark">ログアウト</button>
        </form>

    </div>
    
    <div class="col-md-8 col-lg-9">
        @if ($products->total() > 0)
    <p class="text-muted mb-2">
        該当商品：{{ $products->total() }} 件
    </p>
@endif
        <div class="table-responsive">            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th><th>カテゴリ</th><th>メーカー</th><th>商品名</th><th>価格</th><th>登録日</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->count() > 0)
                    @foreach ($products as $product)
                    <tr>
                        <td><a href="{{ route('products.edit', $product) }}">{{ $product->id }}</a></td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->maker }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('Y年m月d日') }}</td>
<td>
    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">削除</button>
    </form>
</td>
                    </tr>
                    @endforeach
                    @else
        <tr>
            <td colspan="7" class="text-center text-muted py-4">
                該当する商品は見つかりませんでした。<br>
                条件を変更して再検索してみてください。
            </td>
        </tr>
    @endif

                </tbody>
            </table>
        </div>
        {{ $products->appends(Request::all())->links() }}
    </div>
</div>
@endsection