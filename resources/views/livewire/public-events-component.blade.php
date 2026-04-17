<div>
    @if ($event->count() > 0)
        <section class="relative py-16 sm:py-20 md:py-24 lg:py-32 bg-[#111827]">
            <div class="container mx-auto px-4 sm:px-6 lg:px-12">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-12 sm:mb-16">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-500/10 border border-blue-500/20 rounded-full backdrop-blur-sm mb-4">
                            <span class="text-blue-300 text-xs sm:text-sm font-medium">UPCOMING</span>
                        </div>
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white">
                            Recent <span class="gradient-text">Events</span>
                        </h2>
                    </div>
                    <a href="{{ route('events.view') }}"
                        class="group px-6 py-3 border border-blue-500/30 rounded-xl font-semibold hover:bg-blue-500/10 transition-all inline-flex items-center gap-2 text-blue-400">
                        View All Events
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Events Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @forelse($event as $event)
                        <div
                            class="purchase-btn group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden hover:border-{{ $event->statuslabel['color'] }}-500/50 transition-all duration-500 hover:shadow-xl hover:shadow-{{ $event->statuslabel['color'] }}-500/10 cursor-pointer"
                            data-event-id="{{ $event->id }}">
                            <!-- Image -->
                            <div
                                class="relative aspect-[16/10] bg-gradient-to-br from-{{ $event->statuslabel['color'] }}-600 to-{{ $event->statuslabel['color'] }}-400 overflow-hidden">
                                @if (!empty($event->event_image))
                                    @php
                                        $hasCrop =
                                            !is_null($event->crop_x) &&
                                            !is_null($event->crop_y) &&
                                            !is_null($event->crop_width) &&
                                            !is_null($event->crop_height) &&
                                            !empty($event->crop_natural_width) &&
                                            !empty($event->crop_natural_height) &&
                                            $event->crop_width > 0 &&
                                            $event->crop_height > 0;

                                        $cropImageStyle = 'width: 100%; height: 100%; object-fit: cover;';

                                        if ($hasCrop) {
                                            $widthPercent = ($event->crop_natural_width / $event->crop_width) * 100;
                                            $heightPercent = ($event->crop_natural_height / $event->crop_height) * 100;

                                            $leftPercent = -($event->crop_x / $event->crop_width) * 100;
                                            $topPercent = -($event->crop_y / $event->crop_height) * 100;

                                            $cropImageStyle = sprintf(
                                                'width: %.6f%%; height: %.6f%%; max-width: none; max-height: none; left: %.6f%%; top: %.6f%%;',
                                                $widthPercent,
                                                $heightPercent,
                                                $leftPercent,
                                                $topPercent
                                            );
                                        }
                                    @endphp
                                    <img src="{{ asset('images/events/' . $event->event_image) }}"
                                        alt="{{ $event->event_name }}"
                                        class="absolute"
                                        style="{{ $cropImageStyle }}"
                                        loading="lazy">
                                    <div class="absolute inset-0 bg-black/20"></div>
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                @php
                                    $ticketsLeft  = $event->tickets_sum_quantity ?? 0;
                                    $ticketsTotal = $event->tickets_sum_original_qty ?? 0;
                                    if ($ticketsTotal <= 0) {
                                        $availBadgeText  = 'Upcoming';
                                        $availBadgeColor = 'bg-violet-500/80';
                                    } elseif ($ticketsLeft <= 0) {
                                        $availBadgeText  = 'Sold Out';
                                        $availBadgeColor = 'bg-red-500/80';
                                    } elseif ($ticketsTotal > 0 && ($ticketsLeft / $ticketsTotal) <= 0.30) {
                                        $availBadgeText  = 'Selling Fast';
                                        $availBadgeColor = 'bg-orange-500/80';
                                    } else {
                                        $availBadgeText  = 'Available';
                                        $availBadgeColor = 'bg-green-500/80';
                                    }
                                @endphp
                                <div
                                    class="absolute top-3 right-3 px-2.5 py-1 {{ $availBadgeColor }} backdrop-blur-sm rounded-lg text-white text-xs font-semibold">
                                    {{ $availBadgeText }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 space-y-4">
                                <div>
                                    <div class="flex items-center gap-1.5 text-xs text-{{ $event->statuslabel['color'] }}-400 font-semibold mb-2">
                                        <span>{{ $event->category }}</span>
                                        <span class="opacity-50">·</span>
                                        <span>{{ date('M d', strtotime($event->event_date)) }}</span>
                                    </div>
                                    <h3
                                        class="text-xl font-bold text-white mb-2 group-hover:text-{{ $event->statuslabel['color'] }}-400 transition-colors">
                                        {{ $event->event_name }}
                                    </h3>
                                    <p class="text-sm text-gray-400 line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($event->description ?? ''))), 120) }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-4 text-sm text-gray-400">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                        </svg>
                                        <span>{{ $event->event_venue }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <div>
                                        <div class="text-xs text-gray-500">From</div>
                                        <div class="text-2xl font-bold text-white">
                                            ₱{{ number_format($event->tickets_min_price, 2) }}</div>
                                    </div>
                                    @php
                                        $statusColor = data_get($event, 'status_label.color', data_get($event, 'statuslabel.color', 'blue'));
                                        $statusColorHex = [
                                            'yellow' => '#ca8a04',
                                            'green' => '#16a34a',
                                            'blue' => '#2563eb',
                                            'grey' => '#6b7280',
                                            'red' => '#dc2626',
                                        ][$statusColor] ?? '#2563eb';
                                    @endphp
                                    <button
                                        class="purchase-btn px-5 py-2.5 rounded-lg font-semibold text-sm transition-colors text-white"
                                        style="background-color: {{ $statusColorHex }};"
                                        data-event-id="{{ $event->id }}">
                                        Buy Tickets
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </section>
    @endif
</div>
