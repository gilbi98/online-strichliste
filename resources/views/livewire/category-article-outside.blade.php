<div>
<form method="post" action="{{route('createPurchaseWithCategoryOutside')}}">
    @csrf
                                               
        <div class="form-group">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-2"> Entnahme eintragen</div>
                                                    
                <select class="form-control" wire:model="selectedCategory" id="category" name="category">
                    <option value="null">Kategorie wählen</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                              
                <select class="form-control mt-2" id="article" name="article">
                    <option value="null">Artikel wählen</option>
                    @if (!is_null($articles))
                    @foreach($articles as $article)
                        <option value="{{$article->id}}">{{$article->name}}</option>
                    @endforeach
                    @endif
                </select>
                                
                <select class="form-control mt-2 py-0" id="quantity" name="quantity">
                    <option value="null">Menge wählen</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                
            </div>

            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Speichern</button>
            
</form>

</div>
