@php
    $filters = ['Keywords', 'Headers', 'Links', 'Images'];
@endphp

<div class="lqd-plagiarism-wrap flex flex-wrap justify-between gap-y-5">
    <div class="w-full pe-5 ps-2 lg:w-2/3">
        <div id="result_article">
        </div>
    </div>
    <div class="w-full px-2 lg:w-1/3 lg:border-s">
        <x-tabler-refresh
            class="size-8 refresh-icon mx-auto hidden animate-spin group-[&.lqd-is-busy]:block"
            stroke-width="1"
        />
        <h3 class="mb-7 text-center">
            {{ __('Seo Report') }}
        </h3>
        <div class="relative">
            <p class="total_percent absolute left-1/2 top-[calc(50%-5px)] m-0 -translate-x-1/2 text-center text-heading-foreground">
                <span class="text-[23px] font-bold">0</span>%
            </p>
            <div
                class="relative rounded-lg [&_.apexcharts-legend-text]:!m-0 [&_.apexcharts-legend-text]:!pe-2 [&_.apexcharts-legend-text]:ps-2 [&_.apexcharts-legend-text]:!text-heading-foreground"
                id="chart-credit"
            ></div>
        </div>
        <ul class="flex w-full justify-between gap-3 rounded-lg bg-foreground/10 p-1 text-xs font-medium">
            @foreach ($filters as $filter)
                <li>
                    <button
                        @class([
                            'px-3 py-3 leading-tight  transition-all hover:bg-background/80 [&.lqd-is-active]:bg-background [&.lqd-is-active]:shadow-[0_2px_12px_hsl(0_0%_0%/10%)]',
                            'lqd-is-active' => $loop->first,
                        ])
                        @click="activeFilter = '{{ $filter }}'"
                        :class="{ 'lqd-is-active': activeFilter == '{{ $filter }}' }"
                    >
                        @lang($filter)
                        <br>
                        <span
                            class= 'count_{{ $filter }} lqd-change-indicator mt-1 inline-flex items-center rounded-md px-1.5 py-0.5 text-3xs text-xs leading-none leading-snug'
                        >
                            <span class="numbers"></span>
                            <x-tabler-chevron-down
                                class="size-3 down ms-1 hidden"
                                stroke-width="1.5"
                            />
                            <x-tabler-chevron-up
                                class="size-3 up ms-1 hidden"
                                stroke-width="1.5"
                            />
                        </span>
                    </button>
                </li>
            @endforeach
        </ul>
        @foreach ($filters as $filter)
            <x-card
                class="group m-4"
                data-cat="{{ $filter }}"
                size="none"
                variant="none"
                ::class="{ 'hidden': !$el.getAttribute('data-cat')?.includes(activeFilter) && activeFilter !== '{{ $filter }}' }"
            >
                <span class="content_{{ $filter }}"></span>
            </x-card>
        @endforeach

        <div class="lqd-plagiarism-results scan_results flex w-full flex-col gap-5">
            <div class="select_area w-full">
                <div
                    class="flex w-full flex-wrap gap-3"
                    id="select_keywords"
                >
                </div>
            </div>
        </div>

        @if (setting('serper_seo_aw_improve', 0) == 1)
            <x-button
                class="improve-seo-btn mb-2 hidden w-1/2"
                @click="improveSeo"
                variant="primary"
            >
                {{ __('Improve SEO') }}
            </x-button>
        @endif
    </div>
</div>
