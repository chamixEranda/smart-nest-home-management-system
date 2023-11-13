@extends('layouts.app')

@section('content')

<section class="reciepes-section">
    <div class="page-haeder-path px-3">
        <h2 class="text-uppercase">{{ translate('messages.meal_planning') }} <i class="fas fa-chevron-right"></i> {{
            translate('messages.recipes') }}</h2>
    </div>
    <div class="container">
        <div class="page-button text-end">
            <a href="{{ route('meal-planning.recipes.create') }}" class="btn btn-primary">{{
                translate('messages.add_new_recipe') }}</a>
        </div>
        @forelse ($lims_recipe_list as $recipe)
        <div class="col-md-12 recipe-card">
            <div class="row">
                <div class="col-md-4 reciepe-image">
                    <img src="{{ asset('public/documents/recipes/'.$recipe->image) }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="recipe-name">
                        <h3>{{ $recipe->name }}</h3>
                    </div>
                    <div class="recipe-details">
                        <h5>Instructions:</h5>
                        {!! $recipe->instruction !!}
                    </div>
                </div>
                <div class="col-md-2 text-end">
                    <a href="{{ route('meal-planning.recipes.edit',$recipe->id) }}" class="text-dark mx-1"><i
                            class="fas fa-pencil-alt"></i></a>
                    <a class="text-dark mx-1" href="javascript:"
                        onclick="form_alert('recipe-{{$recipe['id']}}','{{ translate('Want to delete this recipe ?') }}')"
                        title="{{translate('messages.delete')}} {{translate('messages.recipe')}}"><i
                            class="fas fa-trash"></i>
                    </a>
                    <form action="{{route('meal-planning.recipes.destroy',[$recipe['id']])}}" method="post"
                        id="recipe-{{$recipe['id']}}">
                        @csrf @method('delete')
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-list-div my-5 py-5 h-100">
            <img src="{{ asset('assets/img/cooking.png') }}" class="d-block mx-auto" alt="Recipe" width="200">
            <h3 class="text-center text-dark">{{ translate('messages.no_recipes_to_show') }}</h3>
        </div>
        @endforelse
    </div>
</section>

@endsection

@push('scripts')
<script>
    $('#delete-recipe-btn').on('click', function(e){
        e.preventDefault();
        $('#delete-recipe-form').submit();
    })
</script>
@endpush