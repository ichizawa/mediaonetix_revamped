@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between mt-6 pt-4 border-t border-white/10 gap-4">
        {{-- Results Info --}}
        <p class="text-sm text-gray-400">
            Showing 
            <span class="font-semibold text-white">{{ $paginator->firstItem() }}</span>
            to 
            <span class="font-semibold text-white">{{ $paginator->lastItem() }}</span>
            of 
            <span class="font-semibold text-white">{{ $paginator->total() }}</span>
            merchants
        </p>

        {{-- Pagination Buttons --}}
        <div class="flex gap-2">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <button disabled
                    class="px-3 py-1.5 bg-white/5 text-gray-600 rounded-lg transition-all cursor-not-allowed opacity-50">
                    Previous
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                    Previous
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-1.5 bg-white/5 text-gray-400 rounded-lg">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg font-semibold">
                                {{ $page }}
                            </button>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                    Next
                </a>
            @else
                <button disabled
                    class="px-3 py-1.5 bg-white/5 text-gray-600 rounded-lg transition-all cursor-not-allowed opacity-50">
                    Next
                </button>
            @endif
        </div>
    </div>
@endif