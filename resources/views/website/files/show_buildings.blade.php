@if(count($buildings) > 0)
    <div class="profile-content" style="min-height: 350px;">
        @foreach($buildings as $building)
            <div class="col-md-4 col-sm-6 pull-right">
                <div class="product-grid3">
                    <div class="product-image3">
                        <a href="{{  url('/building/' . $building->id) }}">
                            <img class="pic-1" src="{{ $building->imagePath }}">
                            <img class="pic-2" src="{{ $building->imagePath }}">
                        </a>
                        <ul class="social">
                            <li><a href="{{ url('/building/' . $building->id) }}"><i class="fa fa-eye"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <span class="product-new-label">
                            {{ $building->rent == 1 ? 'تمليك' : 'ايجار' }}
                        </span>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="{{ url('/building/' . $building->id) }}">{{ $building->name }}</a></h3>
                        <div class="price">
                            {{ $building->square }} متر مربع
                        </div>

                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                        <hr>
                        <div class="price">
                            {{ $building->price }} جنيه
                        </div>
                        <div class="price pull-right">
                            @if($building->type == 0)
                                شقه
                            @elseif($building->type == 1)
                                فيلا
                            @else
                                شاليه
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-danger">
        لا يوجد عقارات حاليا
    </div>
@endif
