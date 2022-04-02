<div class="relative">
    <div class="container">
        <main role="main">


            <input type="text" class="form-input input-group-text g-3 mt-2 " placeholder="Search for product..."
                wire:model='sentence' />
            @if ($sentence != null)
                <h2>Results</h2>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="{{ Storage::url($product->image) }}" height="200" style="width: 100%">
                                <div class="card-body">
                                    <p><b>{{ $product->name }}</b></p>
                                    <p class="card-text">
                                        {{ Str::limit($product->description, 120) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('product.view', $product->id) }}"><button type="button"
                                                    class="btn btn-sm btn-outline-success">View</button></a>
                                            <button type="button" class="btn btn-sm btn-outline-primary">Add to
                                                cart</button>
                                        </div>
                                        <small class="text-muted">{{ $product->price }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <h3>
                        There is no results for this search
                    </h3>
                        @endforelse
                </div>
            @endif
        </main>
    </div>
</div>
