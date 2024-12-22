<div id="{{ $toast->id }}" class="toast {{ $toast->class }}">
    <div class="flex justify-center items-center mr-3">
        <div class="toast-icon">
            <div class="toast-icon-svg"></div>
        </div>

        <div class="flex flex-col justify-center items-start ml-3">
            <span class="text-dark text-lg font-bold"> {{ $toast->title }} </span>
            <span class="text-dark text-base font-normal"> {{ $toast->message }} </span>
        </div>
    </div>

    <button type="button" class="toast-close" data-target="{{ $toast->id }}">
        <img src="{{ asset('images/icons/clear.svg') }}" alt="Close" class="toast-close-svg" />
    </button>
</div>
