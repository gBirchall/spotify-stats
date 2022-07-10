<div>

    <div class="h-full">
        <div
            class="h-full relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
            <div class="flex-shrink-0">
                <img class="h-20 w-20 rounded-full" src="{{ $track->album->images[0]->url }}" alt="">
            </div>
            <div class="flex-1 min-w-0">
                <a href="{{ $track->uri }}" class="focus:outline-none" target="_blank">
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    <h2 class="text-xl mb-4">{{ $track->name }}</h2>
                    <div>
                        @foreach ($track->artists as $artist)
                            <h3>{{ $artist->name }}</h3>
                        @endforeach
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
