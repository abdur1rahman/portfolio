<div class="container mt-5">
    <div class="row">
        @foreach($PrjectData as $PrjectData)
            <div class="col-md-3 p-1 text-center">
                <div class=" m-1 card">
                    <div class="text-center">
                        <img class="w-100" src="{{$PrjectData->	project_img}}" alt="Card image cap">
                        <h5 class="service-card-title mt-4">{{$PrjectData->	project_name}} </h5>
                        <h6 class="service-card-subTitle p-0 m-0">{{$PrjectData->project_description}} </h6>
                        <button class="normal-btn mt-2 mb-4 btn">বিস্তারিত</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
