<header class="p-2 bg-dark text-white">
    <div class="d-flex flex-wrap align-items-center  ">


        <div class="col-4">
            <ul class="nav col-lg-auto me-lg-auto mb-2 align-start mb-md-0">

                <li><a href="#" class="nav-link px-2 text-secondary">{{__('messages.header.home')}}</a></li>
                <li><a href="#" class="nav-link px-2 text-white">{{__('messages.header.feature')}}</a></li>
                <li><a href="#" class="nav-link px-2 text-white">{{__('messages.header.pricing')}}</a></li>
                <li><a href="#" class="nav-link px-2 text-white">{{__('messages.header.faqs')}}</a></li>
                <li><a href="#" class="nav-link px-2 text-white">{{__('messages.header.about')}}</a></li>
            </ul>
        </div>
        <div class="container col-4">
            <div class="input-group">
                <select class="category-select">
                    @foreach ($data['categories'] as $category)
                        <option class="category-options" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="flex-grow-4 serach-box">
                    {{-- <input type="text" class="form-control" name="search-box" id="liveSearch"
                    data-datalist="list-timezone"   placeholder="Search for..."> --}}

                    <input type="text" class="form-control" id="autocompleteDatalist" data-datalist="list-timezone" placeholder="Type something" />
                    <datalist id="list-timezone">


                      </datalist>
                    <ul class="search-suggestions" id="searchSuggestion"></ul>
                </div>
                <button type="button" id="productSearch">Search</button>
            </div>

        </div>

        <div class="col-3 last-header header-end text-start ">
           <select class="language-main">
            @foreach(config('app.available_locales') as $key=>$language)
                <option value={{$language}} {{$language==session()->get('language')?'selected':''}} >{{$key}}</option>
            @endforeach

           </select>

            <button type="button" class="btn btn-outline-light me-2">Login</button>

            <span class="cart"><i class="fa fa-shopping-cart shopping-cart fa-2x"  aria-hidden="true"><span class="cart-count"><div class="count-size">5</div></span></i></span>
        </div>




    </div>
</header>
<header class="p-2 second-header text-white">
    <ul class="nav ">

        @foreach($data['categories'] as $index=> $category )
        @if( !$index==0 && $index<=5)
        <li><a href="#" value="{{$category->id}}" class="nav-link px-2 text-secondary">{{$category->name}}</a></li>
        @endif
        @endforeach
    </ul>
</header>
