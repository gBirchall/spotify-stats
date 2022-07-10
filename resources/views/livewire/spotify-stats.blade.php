<div x-data="{ type: 'artists' }">
    <div class="block md:flex items-center justify-between">
        <div class="mb-5">
            <button wire:click="changeTerm('short_term')"
                class="{{ $term == 'short_term' ? 'bg-green-600' : 'bg-white text-green-600' }}
            inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white
            green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Last
                4 weeks</button>
            <button wire:click="changeTerm('medium_term')"
                class="{{ $term == 'medium_term' ? 'bg-green-600' : 'bg-white text-green-600' }}
            inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white
            green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Last
                6 Months</button>
            <button wire:click="changeTerm('long_term')"
                class="{{ $term == 'long_term' ? 'bg-green-600' : 'bg-white text-green-600' }}
            inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white
            green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Last
                All Time</button>
        </div>
        <div class="mb-5">
            <button x-on:click="type = 'artists'"
                :class="{ 'bg-green-600': type == 'artists', 'bg-white text-green-600': type != 'artists' }"
                class="
            inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white
            green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">View
                Top Artists</button>
            <button x-on:click="type = 'tracks'"
                :class="{ 'bg-green-600': type == 'tracks', 'bg-white text-green-600': type != 'tracks' }"
                class="
            inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white
            green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">View
                Top Tracks</button>

        </div>
    </div>

    <div x-show="type == 'artists'">
        <h2 class="mb-7">Your Top Artists: </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 auto-rows-fr	mx-4">
            @foreach ($topArtists as $artist)
                <x-artist-card :artist="$artist" />
            @endforeach
        </div>
    </div>
    <div x-show="type == 'tracks'">
        <h2 class="mb-7">Your Top Tracks: </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 auto-rows-fr	mx-4">
            @foreach ($topTracks as $track)
                <x-track-card :track="$track" />
            @endforeach
        </div>
    </div>

</div>
